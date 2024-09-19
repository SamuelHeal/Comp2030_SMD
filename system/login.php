<?php 
$home = array(
    'Administrator' => 'users.php',
    'Auditor' => 'users.php',
    'Factory Manager' => 'factory.php',
    'Production Operator' => 'factory.php'
);

if (isset($_POST['login'])) { 
    require_once '..\\include\\database.php';
    $sql = 'SELECT personid, firstname, lastname, position, pin FROM Person';
    $result = mysqli_query($conn, $sql);
    if ($result && $rows = mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($_POST['pin'], $row['pin'])) {
                session_start();
                $_SESSION['loggedin'] = true; 
                $_SESSION['id'] = $row['personid']; 
                $_SESSION['username'] = $row['firstname'] . ' ' . $row['lastname'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['home'] = $home[$_SESSION['position']];
                header("location: ..\\pages\\{$_SESSION['home']}");
                exit; 
            }
        };
        mysqli_free_result($result);
    }
    echo "Incorrect pin!"; 
}
