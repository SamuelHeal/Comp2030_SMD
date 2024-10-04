<?php 
if (isset($_POST['name'])) {
    require_once '../include/database.php';
    $sql = 'UPDATE Machine SET name = ?, location = ?, status = ?, operatorID = ? WHERE machineID = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ssiii', $name, $location, $status, $operator_id, $update_id);
    $name = htmlspecialchars($_POST['name']);
    $location = htmlspecialchars($_POST['location']);
    $status = htmlspecialchars($_POST['status']);
    $operator_id = htmlspecialchars($_POST['operator']);
    $update_id = htmlspecialchars($_GET['update_id']);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to update machine.";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    $machine_id = htmlspecialchars($_GET['machineID']);
    header("location: ../pages/machines.php?machineID=$machineID&updated=1");
    exit;
}
