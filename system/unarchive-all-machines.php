<?php 
function unarchiveAllMachines($conn) {
    $sql = "UPDATE Machine SET isArchived = 0;";
    if (!mysqli_query($conn, $sql)) {
        echo 'Unable to archive all machines';
    }
}

if (isset($_GET['unarchive_all'])) {
    require_once '../include/database.php';
    unarchiveAllMachines($conn);
    mysqli_close($conn);
    header("location: ../pages/machines.php?machineID={$_GET['machineID']}&show_archived=1&all_unarchived=1");
    exit;
} else {
    echo 'Unable to unarchive all machines.';
}
