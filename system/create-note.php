<?php 
if (isset($_POST['submit'])) { 
    require_once '../include/database.php';
    $sql = "INSERT INTO Note (jobID, category, personID, priority, timeCreated, description) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, "isiiss", $jobID, $category, $personID, $priority, $timeCreated, $description); 
    
    // Get the form data 
    $description = htmlspecialchars($_POST['description']); 
    $jobID = htmlspecialchars($_GET['jobID']);
    $personID = htmlspecialchars($_SESSION['id']);
    $category = htmlspecialchars($_POST['category']);  
    $priority = htmlspecialchars($_POST['priority']); 
    $timeCreated = date("Y-m-d H:i:s");

    // Execute the SQL statement 
    if (mysqli_stmt_execute($statement)) {
            header("location: ../pages/job.php?id={$_GET['jobID']}&machineID={$_GET['machineID']}");
    } else {
        mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit;
} 
