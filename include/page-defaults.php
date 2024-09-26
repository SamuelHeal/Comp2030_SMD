<?php 
require_once '../include/utilities.php';
require_once '../include/database.php';
require_once '../include/check-authorisation.php';
checkMachineIdIsSet($conn);
require_once '../include/menu.php';
setBannerColour($conn);
if (isset($_SESSION['id'])) updateLastActive($conn, $_SESSION['id'], $_GET['machineID']);
?>