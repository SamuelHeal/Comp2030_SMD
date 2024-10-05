<?php
function deleteAllMessages($conn) {
    $sql = "DELETE FROM Message WHERE recipientID = {$_SESSION['id']};";
    if (!mysqli_query($conn, $sql)) {
        echo 'Unable to delete messages.';
    }
}

if (isset($_GET['delete_all'])) {
    require_once '../include/database.php';
    deleteAllMessages($conn);
    mysqli_close($conn);
    header("location: ../pages/messages.php?machineID={$_GET['machineID']}&all_deleted=1");
    exit;
}
