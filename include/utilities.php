<?php
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

function formatDate($timestamp) {
    $date_object = new DateTimeImmutable($timestamp);
    $date = date_format($date_object, 'D, j M');
    $time = date_format($date_object, 'G:i a');
    return "{$date} at {$time}";
}

function redirectToDashboardIfLoggedIn() {
    if (isset($_SESSION['position'])) {
        header("location: {$_SESSION['home']}?machineID={$_GET['machineID']}");
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

function updateLastActive($conn) {
    if (isset($_SESSION['id'])) {
        $machineID = $_GET['machineID'];
        $personID = $_SESSION['id'];
        $updateSql = "UPDATE Person SET lastActiveTime = NOW(), lastActiveMachineID = ? WHERE personID = ?";
        $stmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($stmt, 'ii', $machineID, $personID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
