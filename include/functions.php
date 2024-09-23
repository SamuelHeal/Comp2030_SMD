<?php
function appendUserToList($row) {
    echo '<li>';
        echo '<div>'.$row['firstName'].' '.$row['lastName'].'</div>';
        echo '<table>';
            echo '<tr>';
                echo '<td>Position: '.$row['position'].'</td>';
                echo '<td>User ID: '.$row['personID'].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>Phone: '.$row['phoneNumber'].'</td>';
                echo '<td>Email: '.$row['email'].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>DOB: '.$row['DOB'].'</td>';
                echo '<td>Start Date: '.$row['employmentDate'].'</td>';
            echo '</tr>';
        echo '</table>';
    echo '</li>';
};

function checkMachineIdIsSet($conn) {
    if (!isset($_GET['machineID']) || !is_numeric($_GET['machineID'])) {
        $_GET['machineID'] = 1;
        return;
    }
    $sql = "SELECT * FROM Machine WHERE machineID = {$_GET['machineID']};";
    $query = mysqli_query($conn, $sql);
    if (!$query || !mysqli_num_rows($query)) {
        $_GET['machineID'] = 1;
        return;
    }
}

function console($string) {  // For debugging, delete for submission.
    echo '<script>';
        echo "console.log(\"$string\");";
    echo '</script>';
}

function redirectToDashboardIfLoggedIn() {
    if (isset($_SESSION['position'])) {
        header("location: {$_SESSION['home']}?machineID={$_GET['machineID']}");
    }
}

function setUnauthorisedButton() {
    if (isset($_SESSION['home'])) {
        echo "<a href=\"{$_SESSION['home']}?machineID={$_GET['machineID']}\">Home</a>";
    }
    else {
        echo '<a href="login.php">Login</a>';
        session_destroy();
    }
}

function setBannerColour($conn) {
    $sql = "SELECT status FROM Machine WHERE machineID = {$_GET['machineID']};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
        echo '<script>';
            echo "setBannerColour({$assoc['status']});";
        echo '</script>';
    }
    mysqli_free_result($result);
}

function setBannerColourAndMessage($conn) {
    $sql = "SELECT name, status FROM Machine WHERE machineID = {$_GET['machineID']};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
        echo '<script>';
            echo "setBannerColour({$assoc['status']});";
            echo "setBannerMessage({$assoc['status']});";
        echo '</script>';
    }
    mysqli_free_result($result);
}

function setLoginTitle($conn) {
    $sql = "SELECT name FROM Machine WHERE machineID = {$_GET['machineID']};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
        echo '<script>';
            echo "setLoginTitle(\"{$assoc['name']}\");";
        echo '</script>';
    }
    mysqli_free_result($result);
}

function getJobsManager($conn) {
    $sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=0";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            echo "<div class='jobList'>";
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "<div >";
                echo "<a class='job' href='job.php?id=" . $row['jobID'] . "'>";
                echo "<div class='jobID'>";
                echo "<p>" . $row['jobID'];
                echo "</div>";
                echo "<div class='jobInfo'>";
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
                // echo "</div>";
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
    $sql = "SELECT firstname, lastname, personID FROM Person";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['personID'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
            }
        }
    }
}

function getOperatorsForJobSelected($conn, $selectedID) {
    $sql = "SELECT firstname, lastname, personID FROM Person";
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

function getJobManager($conn, $jobID) {
    $sql = 'SELECT Job.description, Job.jobID, Job.priority, Job.OperatorID, Job.machineID, Job.status, Person.firstname, Person.lastname, Machine.name FROM Job INNER JOIN Person ON Person.personID = Job.OperatorID INNER JOIN Machine ON Machine.machineID = Job.machineID WHERE Job.jobID = ' . $jobID;
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            $job = mysqli_fetch_assoc($result);
            echo "<div class='jobsManagerHeader'>";
            echo "<h1> Job: " . $job['jobID'] . "</h1>";
            echo "<div class='jobsManagerLinks'>";
            echo "<a href='jobs.php'>Back</a>";
            echo "<a href='javascript:;' onclick='deleteJob()'>Delete</a>";
            echo "</div>";
            echo "</div>";
            echo "<div class='deleteJob hide'>";
            echo "<h2>Are you sure you want to delete this job?</h2>";
            echo "<div class='deleteButtons'>";
            echo "<a class='cancelButton' href='javascript:;' onclick='cancelDelete()'>No</a>";
            echo "<a class='deleteButton' href='../system/delete-job.php?jobID=" . $jobID . "'>Yes</a>";
            echo "</div>";
            echo "</div>";
            echo "<div class='createJobForm'>";
            echo "<form action='../system/update-job.php?jobID=" . $jobID . "' method='POST'>";
            echo "<div class='innerJobForm'>";
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
            echo "<select class='select-dropdown' id='operator' name='operator' required>";
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
            echo "<input id='status' name='status' type='text' value='" . $job['status'] . "'/>";
            echo "<input name='submit' type='submit' value='submit' />";
            echo "</div>";
            echo "</form>";
            echo "<div class='innerJobForm'>";
            echo "</div>";
            echo "</div>";
        }
    }
}