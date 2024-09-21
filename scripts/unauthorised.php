<?php 
function setUnauthorisedButton() {
    if (isset($_SESSION['home'])) {
        echo "<a href=\"{$_SESSION['home']}?machineID={$_GET['machineID']}\">Home</a>";
    }
    else {
        echo "<a href=\"login.php?machineID={$_GET['machineID']}\">Login</a>";
        session_destroy();
    }
}
