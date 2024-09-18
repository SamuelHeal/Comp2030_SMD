<?php
function redirectToDashboardIfLoggedIn() {
    if (isset($_SESSION['position'])) {
        header("location: {$_SESSION['home']}");
    }
}

function setBannerColour($conn) {
    $sql = "SELECT status FROM Machine WHERE machineID = (SELECT machineID FROM Scenario WHERE isCurrentScenario = 1);";
    $query = mysqli_query($conn, $sql);
    if ($query && mysqli_num_rows($query)) {
        $result = mysqli_fetch_assoc($query);
        echo '<script>';
            echo "setBannerColour({$result['status']});";
        echo '</script>';
    }
}

function setLoginPageElements($conn) {
    $sql = "SELECT * FROM Machine WHERE machineID = (SELECT machineID FROM Scenario WHERE isCurrentScenario = 1);";
    $query = mysqli_query($conn, $sql);
    if ($query && mysqli_num_rows($query)) {
        $result = mysqli_fetch_assoc($query);
        echo '<script>'; 
            echo "setLoginBanner(\"{$result['name']}\", \"{$result['location']}\", {$result['status']})";
        echo '</script>';
    }
}

function console($string) {  // For debugging, delete for submission.
    echo '<script>';
        echo "console.log(\"$string\");";
    echo '</script>';
}
