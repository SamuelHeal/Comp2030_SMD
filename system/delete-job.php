<?php
require_once '../include/database.php';

$sql;
if ($_GET['status'] == 'Completed') {
    $sql = 'UPDATE Job SET completed = 1 WHERE jobID = ' . $_GET['jobID'];
} else {
    $sql = 'UPDATE Job SET completed = 1, status = "Deleted" WHERE jobID = ' . $_GET['jobID'];
}

$statement = mysqli_stmt_init($conn);
mysqli_stmt_prepare($statement, $sql);

if (mysqli_stmt_execute($statement)) {
    header("location: ../pages/jobs.php?machineID={$_GET['machineID']}");
} else {
    mysqli_error($conn);
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
exit;

