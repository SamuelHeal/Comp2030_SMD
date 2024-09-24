<?php 
    if (isset($_POST['submit'])) { 

        require_once '../include/database.php';
        $sql = "INSERT INTO Job (description, machineID, OperatorID, priority, status, timeUpdated) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, "siiiss", $description, $machineID, $OperatorID, $priority, $status, $timeUpdated); 
       
        // Get the form data 
        $description = htmlspecialchars($_POST['description']); 
        // $description = "test";
        $machineID = htmlspecialchars($_POST['machine']);
        // $machineID = 1;
        $OperatorID = htmlspecialchars($_POST['operator']);  
        // $OperatorID = 1;
        $priority = htmlspecialchars($_POST['priority']); 
        $status = "In Progress";
        $timeUpdated = date("Y-m-d H:i:s");

        // Execute the SQL statement 
        if (mysqli_stmt_execute($statement)) {
                header("location: ../pages/jobs.php?machineID={$_GET['machineID']}");
            } else {
                mysqli_error($conn);
            }
            mysqli_close($conn);
        
} else {
    header("location: ../pages/create-job.php'");
}
