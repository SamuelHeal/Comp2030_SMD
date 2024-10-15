<?php 
function restoreMachine($conn) {
    $sql = 'UPDATE Machine SET isArchived = 0 WHERE machineID = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $machine_id);
    $machine_id = htmlspecialchars($_GET['restore_id']);
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Unable to archive machine.';
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET['restore_id'])) {
    require_once '../include/database.php';
    restoreMachine($conn);
    mysqli_close($conn);
    header("location: ../pages/machines.php?machineID={$_GET['machineID']}&show_archived=1&restored=1");
    exit;
}
