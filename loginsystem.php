<?php 
if (isset($_POST['login'])) { 
    require_once 'inc/dbconn.inc.php';
    $sql = 'SELECT personid, firstname, lastname, position, pin FROM Person';
    if ($result = mysqli_query($conn, $sql)) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($_POST['pin'], $row['pin'])) {
                    session_start();
                    $_SESSION['loggedin'] = true; 
                    $_SESSION['id'] = $row['personid']; 
                    $_SESSION['username'] = $row['firstname'] . ' ' . $row['lastname'];
                    $_SESSION['position'] = $row['position'];

                    $home = array(
                        'Administrator' => 'dashboardaccess.php',
                        'Auditor' => 'dashboardaccess.php',
                        'Factory Manager' => 'factory.php',
                        'Production Operator' => 'factory.php'
                    );

                    $_SESSION['home'] = $home[$_SESSION['position']];

                    header('location: '.$_SESSION['home']);
                    exit; 
                }
            };
            mysqli_free_result($result);
        }
        echo "Incorrect pin!"; 
    }    
}
