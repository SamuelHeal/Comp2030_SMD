<?php 
if (isset($_POST['login'])) { 
    require_once "inc/dbconn.inc.php";
    $sql = "SELECT id, pin FROM Users WHERE pin = ?";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 's', $pin);
    $pin = $_POST['pin']; 

    // Execute the SQL statement 
    $statement->execute(); 
    $statement->store_result(); 

    // Check if the user exists 
    if ($statement->num_rows > 0) { 

    // // Bind the result to variables 
    // $stmt->bind_result($id, $hashed_password); 

    // // Fetch the result 
    // $stmt->fetch(); 

    // // Verify the password 
    // if (password_verify($pin, $hashed_password)) { 

    // // Set the session variables 
    // $_SESSION['loggedin'] = true; $_SESSION['id'] = $id; $_SESSION['username'] = $username; 

    // Redirect to the user's dashboard 
    header("Location: factory.php"); exit; 
} else { 
    echo "Incorrect password!"; 
} 
    
    // Close the connection 
    $stmt->close(); $mysqli->close();
    
}