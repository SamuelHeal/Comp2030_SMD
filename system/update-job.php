<?php 
if (isset($_POST['submit'])) { 

    require_once '../include/database.php';
    if ($_SESSION['position'] == "Factory Manager") {
        $sql = "UPDATE Job SET description = ?, machineID = ?, OperatorID = ?, priority = ?, status = ?, timeUpdated = ? WHERE jobID = " . $_GET['jobID'];
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, "siiiss", $description, $machineID, $OperatorID, $priority, $status, $timeUpdated); 
        
        // Get the form data 
        $description = htmlspecialchars($_POST['description']); 
        $machineID = htmlspecialchars($_POST['machine']);
        $OperatorID = htmlspecialchars($_POST['operator']);  
        $priority = htmlspecialchars($_POST['priority']); 
        $status = htmlspecialchars($_POST['status']);
        $timeUpdated = date("Y-m-d H:i:s");

        // Execute the SQL statement 
        if (mysqli_stmt_execute($statement)) {
            header("location: ../pages/jobs.php?machineID={$_GET['machineID']}");
        } else {
            mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit;
    } else {
        $sql = "UPDATE Job SET status = ?, timeUpdated = ? WHERE jobID = " . $_GET['jobID'];
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, "ss", $status, $timeUpdated); 
        
        $status = htmlspecialchars($_POST['status']);
        $timeUpdated = date("Y-m-d H:i:s");

        // Execute the SQL statement 
        if (mysqli_stmt_execute($statement)) {
            header("location: ../pages/jobs.php?machineID={$_GET['machineID']}");
        } else {
            mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit;
    }
}
