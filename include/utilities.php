<?php
function checkForMessages($conn) {
    $sql = "SELECT * FROM Message WHERE recipientID = {$_SESSION['id']} AND isRead = 0;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<script>';
            echo 'const MESSAGES_BUTTON = document.getElementById("menu-messages");';
            echo 'MESSAGES_BUTTON.style.backgroundColor = "#ffff00";';
        echo '</script>';
    }
    mysqli_free_result($result);
}

function checkMachineIdIsSet($conn) {
    if (isset($_GET['machineID']) && is_numeric($_GET['machineID'])) {
        $sql = "SELECT * FROM Machine WHERE machineID = {$_GET['machineID']};";
        $result = mysqli_query($conn, $sql);
        if (!$result || !mysqli_num_rows($result)) {
            $_GET['machineID'] = 0;
        }
        mysqli_free_result($result);
    } else {
        $_GET['machineID'] = 0;
    }
}

function console($string) {  // For debugging, delete for submission.
    echo '<script>';
        echo "console.log(\"$string\");";
    echo '</script>';
}

function formatDate($timestamp) {
    $date_object = new DateTimeImmutable($timestamp);
    $date = date_format($date_object, 'D, j M');
    $time = date_format($date_object, 'G:i a');
    return "{$date} at {$time}";
}

function timestampNow() {
    $date_object = new DateTime('now', new DateTimeZone('Australia/Adelaide'));
    return date_format($date_object, 'Y-m-d H:i:s');
}

function redirectToDashboardIfLoggedIn() {
    if (isset($_SESSION['position'])) {
        header("location: {$_SESSION['home']}?machineID={$_GET['machineID']}");
    }
}

function redirectToOffice() {
    if ($_GET['machineID'] == 0) {
        header("location: login-desktop.php?machineID={$_GET['machineID']}");
    }
}

function redirectToMachine() {
    if ($_GET['machineID'] != 0) {
        header("location: login.php?machineID={$_GET['machineID']}");
    }
}

function setBannerColour($conn) {
    if ($_GET['machineID'] == '0') {
        echo '<script>';
            echo "setBannerColour('desktop');";
        echo '</script>';
    } else {
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
    } else {
        header('location: login-desktop.php?machineID=0');
    }
    mysqli_free_result($result);
}

function warnIfActive() {
    if (isset($_GET['active'])) {
        echo '<script>';
            echo '[...document.getElementsByClassName("menu-item")].forEach(element => {element.onclick = ()=> {return confirm("Are you sure you want to leave this page?");}});';
        echo '</script>';
    }
}

function updateLastActive($conn) {
    if (isset($_SESSION['id'])) {
        $machineID = $_GET['machineID'] ? $_GET['machineID'] : NULL;
        $isAtMachine = $_GET['machineID'] ? 1 : 0; // Sets TRUE/FALSE if logged into a machine or desktop
        $personID = $_SESSION['id'];
        $updateSql = "UPDATE Person SET lastActiveTime = NOW(), lastActiveMachineID = ?, lastActiveAtMachine = ? WHERE personID = ?";
        $stmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($stmt, 'iii', $machineID, $isAtMachine, $personID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
