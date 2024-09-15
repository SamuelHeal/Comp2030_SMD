<?php 
if (isset($_POST['login'])) { 
    require_once "inc/dbconn.inc.php";
    $pin = $_POST['pin'];     
    $sql = "SELECT personid, firstname, lastname, pin FROM Person";
    if ($result = mysqli_query($conn, $sql) ) {
        if ($rows = mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($pin, $row['pin'])) {
                    $username = $row['firstname'] . " " . $row['lastname'];
                    $_SESSION['loggedin'] = true; $_SESSION['id'] = $row['personid']; $_SESSION['username'] = $username; 
                    header("Location: factory.php"); exit; 
                }
            };
            mysqli_free_result($result);
        }
        echo "Incorrect pin!"; 
    }
    
    // Close the connection 
    $statement->close(); $mysqli->close();
    
}