<?php 
    if (isset($_POST['register'])) { 
        require_once "../include/database.php";
        // Prepare and bind the SQL statement 
        $sql = "INSERT INTO Person (firstname, lastname, dob, position, phonenumber, email, employmentdate, pin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql); 
        mysqli_stmt_bind_param($statement, "ssssssss", $firstname, $lastname, $dob, $position, $phonenumber, $email, $employmentdate, $pin); 

        // Get the form data 
        $firstname = htmlspecialchars($_POST['firstname']); 
        $lastname = htmlspecialchars($_POST['lastname']); 
        $dob = htmlspecialchars($_POST['dob']);  
        $position = htmlspecialchars($_POST['position']); 
        $phonenumber = htmlspecialchars($_POST['phonenumber']); 
        $email = htmlspecialchars($_POST['email']); 
        $employmentdate = htmlspecialchars($_POST['employmentdate']); 
        $pin = htmlspecialchars($_POST['pin']);
        $machineID = htmlspecialchars($_POST['machineID']);

        // Hash the password 
        $pin = password_hash($pin, PASSWORD_DEFAULT); 

        // Execute the SQL statement 
        if (mysqli_stmt_execute($statement)) {
                header("location: ../pages/users.php?machineID={$machineID}"); 
            } else {
                mysqli_error($conn);
            }
            mysqli_close($conn);
        
} else {
        header("location: ../pages/users.php?machineID={$machineID}");
}
