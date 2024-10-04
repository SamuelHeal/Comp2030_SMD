<?php 
$authorisation = array(
    'Administrator' => array(
        'manage.php' => true,
        'message.php' => true,
        'messages.php' => true,
        'new-message.php' => true,
        'create-user.php' => true,
        'update-user.php' => true
    ),
    'Auditor' => array(
        'users.php' => true,
        'reports.php' => true,
        'message.php' => true,
        'messages.php' => true,
        'new-message.php' => true
    ),
    'Factory Manager' => array(
        'factory.php' => true,
        'jobs.php' => true,
        'machines.php' => true,
        'message.php' => true,
        'messages.php' => true,
        'new-message.php' => true,
        'create-job.php' => true,
        'job.php' => true,
        'job-history.php' => true,
        'create-note.php' => true,
        'note.php' => true
    ),
    'Production Operator' => array(
        'factory.php' => true,
        'jobs.php' => true,
        'machines.php' => true,
        'message.php' => true,
        'messages.php' => true,
        'new-message.php' => true,
        'job.php' => true,
        'job-history.php' => true,
        'create-note.php' => true,
        'note.php' => true
    ),
);

$position = $_SESSION['position'];
$page = basename($_SERVER['PHP_SELF']);

if (!isset($authorisation[$position][$page])) {
    header("location: ../pages/unauthorised.php?machineID={$_GET['machineID']}");
}
