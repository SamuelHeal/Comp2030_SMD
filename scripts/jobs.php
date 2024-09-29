<?php
function getJobsManager($conn) {
    $machineID = $_GET['machineID'];
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=0 ORDER BY Job.priority DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "'>";
                }
                
                echo 
                "<div class='job-id'>" .
                    "<p>" . $row['jobID'] . "</p>" .
                "</div>" .
                "<div class='job-info'>" .
                    "<p class='bold'>" . $row['name'] . "</p>" .
                    "<p>" . $row['status'] . "</p>" .
                    "<p>" . $row['firstname'] . " " . $row['lastname'] . "</p>";

                    if ($row['priority'] == 1) {
                        echo "<p class='priority'>!</p>";
                    } else if ($row['priority'] == 2) {
                        echo "<p class='priority'>!!</p>";
                    } else {
                        echo "<p class='priority'>!!!</p>";
                    }
                
                echo "</div>" .
                "</a>";
            };  
        }
        mysqli_free_result($result);
    }
}

function getJobsOperator($conn) {
    $machineID = $_GET['machineID'];
    $sql = "SELECT Job.jobID, Job.timeUpdated, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=0 AND Job.OperatorID=" . $_SESSION['id'] . " ORDER BY Job.priority DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "'>";
                }

                echo 
                "<div class='job-id'>" .
                    "<p>" . $row['jobID'] . "</p>" .
                "</div>" .
                "<div class='job-info'>" .
                    "<p class='bold'>" . $row['name'] . "</p>" .
                    "<p> Last updated: " . $row['timeUpdated'] . "</p>" .
                    "<p> Status: " . $row['status'] . "</p>";

                    if ($row['priority'] == 1) {
                        echo "<p class='priority'>!</p>";
                    } else if ($row['priority'] == 2) {
                        echo "<p class='priority'>!!</p>";
                    } else {
                        echo "<p class='priority'>!!!</p>";
                    }

                echo "</div>" .
                "</a>";
            };
        }
        mysqli_free_result($result);
    }
}

function getJobHistoryManager($conn) {
    $machineID = $_GET['machineID'];
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=1 ORDER BY Job.jobID DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "'>";
                }
                
                echo 
                "<div class='job-id'>
                    <p>" . $row['jobID'] . "</p>" .
                "</div>" .
                "<div class='job-info'>
                    <p class='bold'>" . $row['name'] . "</p>" .
                    "<p>" . $row['status'] . "</p>" .
                    "<p>" . $row['firstname'] .
                    " " . $row['lastname'] . "</p>";
                
                    if ($row['priority'] == 1) {
                        echo "<p class='priority'>!</p>";
                    } else if ($row['priority'] == 2) {
                        echo "<p class='priority'>!!</p>";
                    } else {
                        echo "<p class='priority'>!!!</p>";
                    }
                echo "</div>" . 
                "</a>";
            };
        }
        mysqli_free_result($result);
    }
}

function getJobHistoryOperator($conn) {
    $machineID = $_GET['machineID'];
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=1 AND Job.OperatorID=" . $_SESSION['id'] . " ORDER BY Job.jobID DESC";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Completed') {
                    echo "<a class='job complete' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "&history=true'>";
                } else {
                    echo "<a class='job' href='job.php?id=" . $row['jobID'] . "&machineID=" . $machineID . "&history=true'>";
                }

                echo 
                "<div class='job-id'>" .
                    "<p>" . $row['jobID'] . "</p>" .
                "</div>" .
                "<div class='job-info'>" .
                    "<p class='bold'>" . $row['name'] . "</p>" .
                    "<p>" . $row['status'] . "</p>";
                    if ($row['priority'] == 1) {
                        echo "<p class='priority'>!</p>";
                    } else if ($row['priority'] == 2) {
                        echo "<p class='priority'>!!</p>";
                    } else {
                        echo "<p class='priority'>!!!</p>";
                    }
                    
                echo "</div>" .
                "</a>";
            };
        }
        mysqli_free_result($result);
    }
}

function getMachinesForJob($conn) {
    $sql = "SELECT name, machineID FROM Machine";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['machineID'] . "'>" . $row['name'] . "</option>";
            }
        }
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
            mysqli_free_result($result);
            return $job;
        }
    }
}

function jobDetailsManager($conn, $jobID, $job) {
    $machineID = $_GET['machineID'];
    echo 
    "<div class='create-job-form'>" .
        "<form action='../system/update-job.php?machineID=" . $machineID . "&jobID=" . $jobID . "' method='POST'>" .
        "<div class='inner-job-form'>" .
            "<label for='description'>Description:</label>" .
            "<textarea id='description' name='description' required>" . $job['description']. "</textarea>" .
            "<label for='machine'>Machine:</label> " .
            "<div class='select-dropdown'>" .
                "<select id='machine' name='machine' required>";
                getMachinesForJobSelected($conn, $job['machineID']);
                echo "</select>" .
            "</div>" .
            "<label for='opeartor'>Operator:</label>" .
            "<div class='select-dropdown'>" .
                "<select id='operator' name='operator' required>";
                getOperatorsForJobSelected($conn, $job['OperatorID']);
                echo "</select>" .
            "</div>" .
            "<label for='priority'>Priority:</label>" .
            "<div class='select-dropdown'>" .
                "<select id='priority' name='priority' required>";
                getPrioritySelection($job['priority']);
                echo "</select>" .
            "</div>" .
            "<label for='status'>Status:</label>" .
            "<div class='select-dropdown'>" .
                "<select id='status' name='status' required>";
                getStatusSelection($job['status']);
                echo "</select>" .
            "</div>" .
            "<input name='submit' type='submit' value='Update' />" .
        "</div>" .
        "</form>";
}

function getJobOperator($conn, $jobID) {
    $sql = 'SELECT Job.description, Job.jobID, Job.priority, Job.OperatorID, Job.machineID, Job.status, Job.completed, Person.firstname, Person.lastname, Machine.name FROM Job INNER JOIN Person ON Person.personID = Job.OperatorID INNER JOIN Machine ON Machine.machineID = Job.machineID WHERE Job.jobID = ' . $jobID;
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            $job = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $job;
        }
    }
}

function jobDetailsOperator($jobID, $job) {
    $machineID = $_GET['machineID'];
    echo 
    "<div class=job-container>" .
    "<div class='job-info-container'>" .
        "<h3>Description:</h3>" .
        "<p>" . $job['description'] . "</p>" .
        "<h3>Machine:</h3>" .
        "<p>" . $job['name'] . "</p>" .
        "<h3>Priority:</h3>" .
        "<p>";
        if ($job['priority'] == 1) {
            echo "Low";
        } else if ($job['priority'] == 2) {
            echo "Medium";
        } else {
            echo "High";
        }
        echo 
        "</p>";
        if ($job['completed'] == 0) {
            echo 
            "<form action='../system/update-job.php?jobID=" . $jobID . "&machineID=" . $machineID . "' method='POST'>" .
                "<h3>Status:</h3>" .
                "<div class='form-items'>" .
                    "<div class='select-dropdown no-margin'>" .
                        "<select id='status' name='status' required>";
                        getStatusSelection($job['status']);
                        echo "</select>" .
                    "</div>" .
                "<input name='submit' type='submit' value='Update' />" .
                "</div>" .
            "</form>";
        } else {
            echo 
            "<h3>Status:</h3>" .
            "<p>" . $job['status'] . "</p>";
        }
    echo "</div>";
}

function getTaskNotes($conn, $jobID) {
    $machineID = $_GET['machineID'];
    $sql = 'SELECT Note.noteID, Note.jobID, Note.personID, Note.timeCreated, Note.category, Note.description, Note.priority, Person.firstname, Person.lastname FROM Note INNER JOIN Person ON Person.personID = Note.personID WHERE jobID = ' . $jobID . ' ORDER BY timeCreated DESC';
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<a class='note' href='note.php?noteID=" . $row['noteID'] . "&machineID=" . $machineID . "'>";
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
        mysqli_free_result($result);
    }
}

function getNote($conn) {
    $noteID = $_GET['noteID'];
    $sql = 'SELECT Note.noteID, Note.jobID, Note.timeCreated, Note.category, Note.description, Note.priority, Note.personID, Person.firstname, Person.lastname FROM Note INNER JOIN Person on Person.personID = Note.personID WHERE noteID = ' . $noteID;
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            $note = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $note;
        }
    }
}