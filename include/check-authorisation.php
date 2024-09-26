<?php 
$authorisation = array(
    'Administrator' => array(
        'users.php' => true,
        'manage.php' => true,
        'message.php' => true,
        'messages.php' => true,
        'user-archive.php' => true,
        'create-user.php' => true,
        'update-user.php' => true
    ),
    'Auditor' => array(
        'users.php' => true,
        'reports.php' => true,
        'message.php' => true,
        'messages.php' => true,
        'user-archive.php' => true
    ),
    'Factory Manager' => array(
        'factory.php' => true,
        'jobs.php' => true,
        'machines.php' => true,
        'message.php' => true,
        'messages.php' => true,
    ),
    'Production Operator' => array(
        'factory.php' => true,
        'jobs.php' => true,
        'machines.php' => true,
        'message.php' => true,
        'messages.php' => true,
    ),
);

$position = $_SESSION['position'];
$page = basename($_SERVER['PHP_SELF']);

if (!isset($authorisation[$position][$page])) {
    header("location: ../pages/unauthorised.php?machineID={$_GET['machineID']}");
}
