<?php
function markAllMessagesAsRead($conn) {
    $sql = "UPDATE Message SET isRead = 1 WHERE recipientID = {$_SESSION['id']};";
    if (mysqli_query($conn, $sql)) {
        header("location: ../pages/messages.php?machineID={$_GET['machineID']}&all_read=1");
    }   
    else {
        echo 'Unable to mark all messages as read.';
    }
}

require_once '../include/database.php';
if (isset($_GET['read_all'])) {
    markAllMessagesAsRead($conn);
}
mysqli_close($conn);
exit;