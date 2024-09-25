<?php
function deleteAllMessages($conn) {
    $sql = "DELETE FROM Message WHERE recipientID = {$_SESSION['id']};";
    if (mysqli_query($conn, $sql)) {
        header("location: ../pages/messages.php?machineID={$_GET['machineID']}&all_deleted=1");
    }   
    else {
        echo 'Unable to delete messages.';
    }
}

require_once '../include/database.php';
if (isset($_GET['delete_all'])) {
    deleteAllMessages($conn);
}
mysqli_close($conn);
exit;