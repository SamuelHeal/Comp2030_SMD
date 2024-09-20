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