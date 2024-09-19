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
    $query = mysqli_query($conn, $sql);
    if ($query && mysqli_num_rows($query)) {
        $result = mysqli_fetch_assoc($query);
        echo '<script>';
            echo "setBannerColour({$result['status']});";
        echo '</script>';
    }
}

function setBannerColourAndMessage($conn) {
    $sql = "SELECT name, status FROM Machine WHERE machineID = {$_GET['machineID']};";
    $query = mysqli_query($conn, $sql);
    if ($query && mysqli_num_rows($query)) {
        $result = mysqli_fetch_assoc($query);
        echo '<script>';
            echo "setBannerColour({$result['status']});";
            echo "setBannerMessage({$result['status']});";
        echo '</script>';
    }
}

function setLoginTitle($conn) {
    $sql = "SELECT name FROM Machine WHERE machineID = {$_GET['machineID']};";
    $query = mysqli_query($conn, $sql);
    if ($query && mysqli_num_rows($query)) {
        $result = mysqli_fetch_assoc($query);
        echo '<script>';
            echo "setLoginTitle(\"{$result['name']}\");";
        echo '</script>';
    }
}
