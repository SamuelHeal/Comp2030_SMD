<?php
function getJobsManager($conn) {
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=0 ORDER BY Job.priority DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            echo "<div class='job-list'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                }
                echo "<div class='job-id'>";
                    echo "<p>" . $row['jobID'];
                echo "</div>";
                echo "<div class='job-info'>";
                    echo "<p class='bold'>" . $row['name'];
                    echo "<p>" . $row['status'];
                    echo "<p>" . $row['firstname'] . " " . $row['lastname'];

                    if ($row['priority'] == 1) {
                        echo "<p class='priority'>!</p>";
                    } else if ($row['priority'] == 2) {
                        echo "<p class='priority'>!!</p>";
                    } else {
                        echo "<p class='priority'>!!!</p>";
                    }
                echo "</div>";
                echo "</a>";
            };
            echo "</div>";
            mysqli_free_result($result);
        }
    }
    echo "</div>";
}

function getJobsOperator($conn) {
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=0 AND Job.OperatorID=" . $_SESSION['id'] . " ORDER BY Job.priority DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            echo "<div class='job-list'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                }
                echo "<div class='job-id'>";
                    echo "<p>" . $row['jobID'];
                echo "</div>";
                echo "<div class='job-info'>";
                    echo "<p class='bold'>" . $row['name'];
                    echo "<p>" . $row['status'];

                    if ($row['priority'] == 1) {
                        echo "<p class='priority'>!</p>";
                    } else if ($row['priority'] == 2) {
                        echo "<p class='priority'>!!</p>";
                    } else {
                        echo "<p class='priority'>!!!</p>";
                    }
                echo "</div>";
                echo "</a>";
            };
            echo "</div>";
            mysqli_free_result($result);
        }
    }
    echo "</div>";
}

function getJobHistoryManager($conn) {
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=1 ORDER BY Job.jobID DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            echo "<div class='job-list'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                }
                echo "<div class='job-id'>";
                echo "<p>" . $row['jobID'];
                echo "</div>";
                echo "<div class='job-info'>";
                echo "<p class='bold'>" . $row['name'];
                echo "<p>" . $row['status'];
                echo "<p>" . $row['firstname'] . " " . $row['lastname'];

                if ($row['priority'] == 1) {
                    echo "<p class='priority'>!</p>";
                } else if ($row['priority'] == 2) {
                    echo "<p class='priority'>!!</p>";
                } else {
                    echo "<p class='priority'>!!!</p>";
                }
                echo "</div>";
                echo "</a>";
            };
            echo "</div>";
            mysqli_free_result($result);
        }
    }
    echo "</div>";
}

function getJobHistoryOperator($conn) {
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=1 AND Job.OperatorID=" . $_SESSION['id'] . " ORDER BY Job.jobID DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            echo "<div class='job-list'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $_GET['machineID']. "'>";
                }
                echo "<div class='job-id'>";
                echo "<p>" . $row['jobID'];
                echo "</div>";
                echo "<div class='job-info'>";
                echo "<p class='bold'>" . $row['name'];
                echo "<p>" . $row['status'];

                if ($row['priority'] == 1) {
                    echo "<p class='priority'>!</p>";
                } else if ($row['priority'] == 2) {
                    echo "<p class='priority'>!!</p>";
                } else {
                    echo "<p class='priority'>!!!</p>";
                }
                echo "</div>";
                echo "</a>";
            };
            echo "</div>";
            mysqli_free_result($result);
        }
    }
    echo "</div>";
}

function getMachinesForJob($conn) {
    $sql = "SELECT name, machineID FROM Machine";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['machineID'] . "'>" . $row['name'] . "</option>";
            }
        }
    }
}

function getMachinesForJobSelected($conn, $selectedID) {
    $sql = "SELECT name, machineID FROM Machine";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['machineID'] == $selectedID) {
                    echo "<option selected='selected' value='" . $row['machineID'] . "'>" . $row['name'] . "</option>";
                } else {
                    echo "<option value='" . $row['machineID'] . "'>" . $row['name'] . "</option>";
                }
            }
        }
    }
}

function getOperatorsForJob($conn) {
    $sql = "SELECT firstname, lastname, personID FROM Person WHERE position = 'Production Operator'";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['personID'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
            }
        }
    }
}

function getOperatorsForJobSelected($conn, $selectedID) {
    $sql = "SELECT firstname, lastname, personID FROM Person WHERE position = 'Production Operator'";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['personID'] == $selectedID) {
                    echo "<option selected='selected' value='" . $row['personID'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
                } else {
                    echo "<option value='" . $row['personID'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
                }
            }
        }
    }
}

function getPrioritySelection($selectedPriority) {
    $options = array("Low", "Medium", "High");
    for ($i = 1; $i < 4; $i++) {
        if ($i == $selectedPriority) {
            echo "<option selected='selected' value='" . $selectedPriority . "'>" . $options[$selectedPriority-1] . "</option>";
        } else {
            echo "<option value='" . $i . "'>" . $options[$i-1] . "</option>";
        }
    }
}

function getStatusSelection($selectedStatus) {
    $options = array("Awaiting Confirmation", "In Progress", "Delayed", "Completed");
    for ($i = 0; $i < 4; $i++) {
        if ($options[$i] == $selectedStatus) {
            echo "<option selected='selected' value='" . $selectedStatus . "'>" . $options[$i] . "</option>";
        } else {
            echo "<option value='" . $options[$i] . "'>" . $options[$i] . "</option>";
        }
    }
}

function getJobManager($conn, $jobID) {
    $sql = 'SELECT Job.description, Job.jobID, Job.priority, Job.OperatorID, Job.machineID, Job.status, Job.completed, Person.firstname, Person.lastname, Machine.name FROM Job INNER JOIN Person ON Person.personID = Job.OperatorID INNER JOIN Machine ON Machine.machineID = Job.machineID WHERE Job.jobID = ' . $jobID;
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            $job = mysqli_fetch_assoc($result);
            echo "<div class='header-container'>";
                echo "<h1> Job: " . $job['jobID'] . "</h1>";
                echo "<div class='header-links'>";
                    echo "<a href='jobs.php?machineID=" . $_GET['machineID'] . "'>Back</a>";
                     if ($job['completed'] == 0) {
                        if ($job['status'] == 'Completed') {
                            echo "<a href='javascript:;' onclick='deleteJob()'>Complete</a>";
                        } else {
                            echo "<a href='javascript:;' onclick='deleteJob()'>Delete</a>";
                        }
                    } else {
                         echo "<a href='javascript:;' onclick='restoreJob()'>Restore</a>";
                    }
                echo "</div>";
            echo "</div>";
            echo "<div class='delete-job handle-job hide'>";
                if ($job['completed'] == 0) {
                    if ($job['status'] == 'Completed') {
                        echo "<h2>Are you sure you want to mark this job as complete?</h2>";
                    } else {
                        echo "<h2>Are you sure you want to delete this job?</h2>";
                    }
                }
                echo "<div class='delete-buttons'>";
                    echo "<a class='cancel-button' href='javascript:;' onclick='cancelDelete()'>No</a>";
                    echo "<a class='delete-button' href='../system/delete-job.php?jobID=" . $jobID . "&machineID=" . $_GET['machineID'] . "'>Yes</a>";
                echo "</div>";
            echo "</div>";
            echo "<div class='restore-job handle-job hide'>";
                echo "<h2>Are you sure you want to restore this job?</h2>";
                echo "<div class='delete-buttons'>";
                    echo "<a class='cancel-button' href='javascript:;' onclick='cancelRestore()'>No</a>";
                    echo "<a class='restore-button' href='../system/restore-job.php?jobID=" . $jobID . "&machineID=" . $_GET['machineID'] . "'>Yes</a>";
                echo "</div>";
            echo "</div>";
            echo "<div class='create-job-form'>";
                echo "<form action='../system/update-job.php?machineID={$_GET['machineID']}&jobID=" . $jobID . "' method='POST'>";
                echo "<div class='inner-job-form'>";
                    echo "<label for='description'>Description:</label>";
                    echo "<textarea id='description' name='description' required>" . $job['description']. "</textarea>";
                    echo "<label for='machine'>Machine:</label> ";
                    echo "<div class='select-dropdown'>";
                        echo "<select id='machine' name='machine' required>";
                            getMachinesForJobSelected($conn, $job['machineID']);
                        echo "</select>";
                    echo "</div>";
                    echo "<label for='opeartor'>Operator:</label>";
                    echo "<div class='select-dropdown'>";
                        echo "<select id='operator' name='operator' required>";
                            getOperatorsForJobSelected($conn, $job['OperatorID']);
                        echo "</select>";
                    echo "</div>";
                    echo "<label for='priority'>Priority:</label>";
                    echo "<div class='select-dropdown'>";
                        echo "<select id='priority' name='priority' required>";
                            getPrioritySelection($job['priority']);
                        echo "</select>";
                    echo "</div>";
                    echo "<label for='status'>Status:</label>";
                    echo "<div class='select-dropdown'>";
                        echo "<select id='status' name='status' required>";
                            getStatusSelection($job['status']);
                        echo "</select>";
                    echo "</div>";
                    echo "<input name='submit' type='submit' value='Update' />";
                echo "</div>";
            echo "</form>";
            echo "<div class='task-notes'>";
                echo "<div class='task-note-header'>";
                    echo "<h3>Task Notes</h3>";
                    echo "<a href='create-note.php?jobID=" . $jobID . "&machineID=" . $_GET['machineID']. "'>Add Note</a>";
                echo "</div>";
            echo "<div class='notes'>";
                getTaskNotes($conn, $jobID);
            echo "</div>";
        }
    }
}

function getJobOperator($conn, $jobID) {
    $sql = 'SELECT Job.description, Job.jobID, Job.priority, Job.OperatorID, Job.machineID, Job.status, Job.completed, Person.firstname, Person.lastname, Machine.name FROM Job INNER JOIN Person ON Person.personID = Job.OperatorID INNER JOIN Machine ON Machine.machineID = Job.machineID WHERE Job.jobID = ' . $jobID;
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            $job = mysqli_fetch_assoc($result);
            echo "<div class='header-container'>";
                echo "<h1> Job: " . $job['jobID'] . "</h1>";
                echo "<div class='header-links'>";
                    echo "<a href='jobs.php?machineID=" . $_GET['machineID'] . "'>Back</a>";
                echo "</div>";
            echo "</div>";
            echo "<div class=job-container>";
                echo "<div class=job-info-container>";
                    echo "<h3>Description:</h3>";
                    echo "<p>" . $job['description'] . "</p>";
                    echo "<h3>Machine:</h3>";
                    echo "<p>" . $job['name'] . "</p>";
                    echo "<h3>Priority:</h3>";
                    echo "<p>";
                    if ($job['priority'] == 1) {
                        echo "Low";
                    } else if ($job['priority'] == 2) {
                        echo "Medium";
                    } else {
                        echo "High";
                    }
                    echo "</p>";
                    echo "<form action='../system/update-job.php?jobID=" . $jobID . "&machineID=" . $_GET['machineID'] . "' method='POST'>";
                    echo "<h3>Status:</h3>";
                    echo "<div class='form-items'>";
                        echo "<div class='select-dropdown no-margin'>";
                            echo "<select id='status' name='status' required>";
                            getStatusSelection($job['status']);
                            echo "</select>";
                        echo "</div>";
                    echo "<input name='submit' type='submit' value='Update' />";
                    echo "</div>";
                    
                echo "</form>";
            echo "</div>";
            echo "<div class='task-notes'>";
                echo "<div class='task-note-header'>";
                    echo "<h3>Task Notes</h3>";
                    echo "<a href='create-note.php?jobID=" . $jobID . "&machineID=" . $_GET['machineID']. "'>Add Note</a>";
                echo "</div>";
                echo "<div class='notes'>";
                    getTaskNotes($conn, $jobID);
                echo "</div>";
            echo "</div>";
        }
    }
}



function getTaskNotes($conn, $jobID) {
    $sql = 'SELECT Note.noteID, Note.jobID, Note.personID, Note.timeCreated, Note.category, Note.description, Note.priority, Person.firstname, Person.lastname FROM Note INNER JOIN Person ON Person.personID = Note.personID WHERE jobID = ' . $jobID . ' ORDER BY timeCreated DESC';
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<a class='note' href='note.php?noteID=" . $row['noteID'] . "&machineID=" . $_GET['machineID'] . "'>";
                echo "<span class='time-created'>" . $row['timeCreated'] . "</span>    <span class='name'>" . $row['firstname'] . " " . $row['lastname'] . "</span>   <span class='category'>" . $row['category'] . "</span>  <span class='note-priority'>";
                if ($row['priority'] == 1) {
                    echo "!";
                } else if ($row['priority'] == 2) {
                    echo "!!";
                } else {
                    echo "!!!";
                }
                echo "</span>";
                echo "</a>";
                
            }
        }
    }
}

function getNote($conn) {
    $sql = 'SELECT Note.noteID, Note.jobID, Note.timeCreated, Note.category, Note.description, Note.priority, Note.personID, Person.firstname, Person.lastname FROM Note INNER JOIN Person on Person.personID = Note.personID WHERE noteID = ' . $_GET['noteID'];
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            $note = mysqli_fetch_assoc($result);
            echo "<div class='header-container'>";
                echo "<h1>Note for Job " . $note['jobID'] . "</h1>";
                echo "<div class='header-links'>";
                    echo "<a href='job.php?id=" . $note['jobID'] . "&machineID=" . $_GET['machineID'] . "'>Back</a>";
                echo "</div>";
            echo "</div>";
            echo "<div class='note-container'>";
                echo "<div class='note-header'>";
                    echo "<h3>Category:</h3>";
                    echo "<p>" . $note['category'] . "</p>";
                    echo "<h3>Time Created:</h3>";
                    echo "<p>" . $note['timeCreated'] . "</p>";
                    echo "<h3>Priority:</h3>";
                    echo "<p>";
                    if ($note['priority'] == 1) {
                        echo "Low";
                    } else if ($note['priority'] == 2) {
                        echo "Medium";
                    } else {
                        echo "High";
                    }
                    echo "</p>";
                echo "</div>";
            echo "<div class='note-description'>";
                echo "<h3>Created by:</h3>";
                echo "<p>" . $note['firstname'] . " " . $note['lastname'] . "</p>";
                echo "<h3>Description:</h3>";
                echo "<p class='description'>" . $note['description'] . "</p>";
            echo "</div>";
        }
    }
}