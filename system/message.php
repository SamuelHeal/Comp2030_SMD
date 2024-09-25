<?php 
function updateMessageAsRead($conn) {
    $sql = "UPDATE Message SET isRead = 0 WHERE messageID = {$_GET['messageID']};";
    if (!mysqli_query($conn, $sql)) {
        echo 'Unable to set message as unread.';
    }
    else {
        header("location: ../pages/message.php?machineID={$_GET['machineID']}&messageID={$_GET['messageID']}&unread=1");
    }
}

require_once '../include/database.php';
if (isset($_GET['messageID'])) {
   updateMessageAsRead($conn);
}
else {
    echo 'No messageID.';
}
mysqli_close($conn);
exit;