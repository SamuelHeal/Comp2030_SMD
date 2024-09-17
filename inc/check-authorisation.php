<?php 
$authorisation = array(
    'Administrator' => array(
        'users.php' => true,
        'reports.php' => true,
        'manage.php' => true,
        'messages.php' => true
    ),
    'Auditor' => array(
        'users.php' => true,
        'reports.php' => true,
        'manage.php' => true,
        'messages.php' => true
    ),
    'Factory Manager' => array(
        'factory.php' => true,
        'jobs.php' => true,
        'machines.php' => true,
        'messages.php' => true,
    ),
    'Production Operator' => array(
        'factory.php' => true,
        'jobs.php' => true,
        'machines.php' => true,
        'messages.php' => true,
    ),
);

$position = $_SESSION['position'];
$page = basename($_SERVER['PHP_SELF']);

if (!isset($authorisation[$position][$page])) {
    header('location: unauthorised.php');
}
