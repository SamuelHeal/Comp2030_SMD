<?php 
function restoreAllMachines($conn) {
    $sql = "UPDATE Machine SET isArchived = 0;";
    if (!mysqli_query($conn, $sql)) {
        echo 'Unable to archive all machines';
    }
}

if (isset($_GET['restore_all'])) {
    require_once '../include/database.php';
    restoreAllMachines($conn);
    mysqli_close($conn);
    header("location: ../pages/machines.php?machineID={$_GET['machineID']}&show_archived=1&all_restored=1");
    exit;
} else {
    echo 'Unable to restore all machines.';
}
