<?php 
function archiveAllMachines($conn) {
    $sql = "UPDATE Machine SET isArchived = 1;";
    if (!mysqli_query($conn, $sql)) {
        echo 'Unable to archive all machines';
    }
}

if (isset($_GET['archive_all'])) {
    require_once '../include/database.php';
    archiveAllMachines($conn);
    mysqli_close($conn);
    header("location: ../pages/machines.php?machineID={$_GET['machineID']}&show_current=1&all_archived=1");
    exit;
}
