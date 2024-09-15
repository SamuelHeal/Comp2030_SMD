<?php 
    if (isset($_POST['register'])) { 

        require_once "inc/dbconn.inc.php";
        // Prepare and bind the SQL statement 
        $sql = "INSERT INTO Person (firstname, lastname, dob, position, phonenumber, email, employmentdate, pin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql); 
        mysqli_stmt_bind_param($statement, "ssssssss", $firstname, $lastname, $dob, $position, $phonenumber, $email, $employmentdate, $pin); 

        // Get the form data 
        $firstname = $_POST['firstname']; $lastname = $_POST['lastname']; $dob = $_POST['dob'];  $position = $_POST['position']; $phonenumber = $_POST['phonenumber']; $email = $_POST['email']; $employmentdate = $_POST['employmentdate']; 
        // Hash the password 
        $pin = password_hash($_POST['pin'], PASSWORD_BCRYPT); 

        // Execute the SQL statement 
        if (mysqli_stmt_execute($statement)) {
                header("location: factory.php"); 
                exit;
            } else {
                mysqli_error($conn);
            }
            mysqli_close($conn);
        
} else {
    echo "Failed to create user"; 
}
