<?php
function appendLogToTable($assoc) {
    echo '<tr>';
        echo '<td>';
            echo $assoc['timestamp'];
        echo '</td>';
        echo '<td>';
            echo $assoc['name'];
        echo '</td>';
        echo '<td>';
            echo $assoc['operationalStatus'];
        echo '</td>';
        echo '<td>';
            echo $assoc['maintenanceLog'];
        echo '</td>';
        echo '<td>';
            echo $assoc['errorCode'];
        echo '</td>';
        echo '<td>';
            echo $assoc['productionCount'];
        echo '</td>';
        echo '<td>';
            echo $assoc['humidity'];
        echo '</td>';
        echo '<td>';
            echo $assoc['powerConsumption'];
        echo '</td>';
        echo '<td>';
            echo $assoc['pressure'];
        echo '</td>';
        echo '<td>';
            echo $assoc['speed'];
        echo '</td>';
        echo '<td>';
            echo $assoc['temperature'];
        echo '</td>';
        echo '<td>';
            echo $assoc['vibration'];
        echo '</td>';
    echo '</tr>';
} 

function appendUserToList($assoc) {
    echo '<li>';
        echo '<div>'.$assoc['firstName'].' '.$assoc['lastName'].'</div>';
        echo '<table>';
            echo '<tr>';
                echo '<td>Position: '.$assoc['position'].'</td>';
                echo '<td>User ID: '.$assoc['personID'].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>Phone: '.$assoc['phoneNumber'].'</td>';
                echo '<td>Email: '.$assoc['email'].'</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>DOB: '.$assoc['DOB'].'</td>';
                echo '<td>Start Date: '.$assoc['employmentDate'].'</td>';
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
    $result = mysqli_query($conn, $sql);
    if (!$result || !mysqli_num_rows($result)) {
        $_GET['machineID'] = 1;
        return;
    }
}

function console($string) {  // For debugging, delete for submission.
    echo '<script>';
        echo "console.log(\"$string\");";
    echo '</script>';
}

function getMachineNames($conn) {
    $machine_assoc = array();
    $sql = 'SELECT machineID, name FROM Machine;';
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            $machine_assoc[$assoc['machineID']] = $assoc['name'];
        }
    }
    else {
        echo 'Unable to get machine names from the database. ';
    }
    mysqli_free_result($result);
    return $machine_assoc;
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
