<?php
require_once '../include/database.php';
$sql = 'DELETE FROM Job WHERE jobID = ' . $_GET['jobID'];
$statement = mysqli_stmt_init($conn);
mysqli_stmt_prepare($statement, $sql);

if (mysqli_stmt_execute($statement)) {
    header("location: ../pages/jobs.php?machineID={$_GET['machineID']}");
} else {
    mysqli_error($conn);
}
mysqli_close($conn);

