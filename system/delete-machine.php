<?php 
function deleteMachine($conn) {
    $sql = 'DELETE FROM Machine WHERE machineID = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $machine_id);
    $machine_id = htmlspecialchars($_GET['delete_id']);
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Unable to delete machine.';
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET['delete_id'])) {
    require_once '../include/database.php';
    deleteMachine($conn);
    mysqli_close($conn);
    header("location: ../pages/machines.php?machineID={$_GET['machineID']}&deleted=1");
    exit;
}
