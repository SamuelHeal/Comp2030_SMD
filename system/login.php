<?php 
$home = array(
    'Administrator' => 'users.php',
    'Auditor' => 'users.php',
    'Factory Manager' => 'factory.php',
    'Production Operator' => 'factory.php'
);

if (isset($_POST['login'])) { 
    require_once '../include/database.php';
    $sql = 'SELECT personid, firstname, lastname, position, pin FROM Person;';
    $result = mysqli_query($conn, $sql);
    if ($result && $rows = mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            if (password_verify($_POST['pin'], $assoc['pin'])) {
                session_start();
                $_SESSION['id'] = $assoc['personid']; 
                $_SESSION['username'] = $assoc['firstname'] . ' ' . $assoc['lastname'];
                $_SESSION['position'] = $assoc['position'];
                $_SESSION['home'] = $home[$_SESSION['position']];
                header("location: ../pages/{$_SESSION['home']}?machineID={$_GET['machineID']}");
                mysqli_free_result($result);
                mysqli_close($conn);
                exit;
            }
        }
    }
    mysqli_free_result($result);
}
header("location: ../pages/login.php?machineID={$_GET['machineID']}&bad_pin=1");
mysqli_close($conn);
exit;
