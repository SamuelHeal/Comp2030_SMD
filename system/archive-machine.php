<?php 
function archiveMachine($conn) {
    $sql = 'UPDATE Machine SET isArchived = 1 WHERE machineID = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $machine_id);
    $machine_id = htmlspecialchars($_GET['archive_id']);
    if (!mysqli_stmt_execute($stmt)) {
        echo 'Unable to archive machine.';
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET['archive_id'])) {
    require_once '../include/database.php';
    archiveMachine($conn);
    mysqli_close($conn);
    header("location: ../pages/machines.php?machineID={$_GET['machineID']}&show_current=1&archived=1");
    exit;
}
