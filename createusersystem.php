<?php 
    if (isset($_POST['register'])) { 

        require_once "inc/dbconn.inc.php";
        // Prepare and bind the SQL statement 
        $sql = "INSERT INTO Users (firstname, lastname, dob, position, phonenumber, email, employmentdate, pin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql); 
        mysqli_stmt_bind_param($statement, "ssssssss", $firstname, $lastname, $dob, $position, $phonenumber, $email, $employmentdate, $pin); 

        // Get the form data 
        $firstname = $_POST['firstname']; $lastname = $_POST['lastname']; $dob = $_POST['dob'];  $position = $_POST['position']; $phonenumber = $_POST['phonenumber']; $email = $_POST['email']; $employmentdate = $_POST['employmentdate']; $pin = $_POST['pin'];

        // Hash the password 
        // $pin = password_hash($pin, PASSWORD_DEFAULT); 

        // Execute the SQL statement 
        if (mysqli_stmt_execute($statement)) {
                header("location: factory.php"); 
            } else {
                mysqli_error($conn);
            }
            mysqli_close($conn);
        
} else {
        header("location: jobs.php");
}

// if (isset($_POST["task-name"])) { 
//         require_once "inc/dbconn.inc.php";
//         $sql = "INSERT INTO Task(name) VALUES(?);" ;
//         $statement = mysqli_stmt_init($conn);
//         mysqli_stmt_prepare($statement, $sql); 
//         mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_POST["task-name"]));
        // if (mysqli_stmt_execute($statement)) {
        //     header("location: index.php"); 
        // } else {
        //     mysqli_error($conn);
        // }
        // mysqli_close($conn);
//     }
// 