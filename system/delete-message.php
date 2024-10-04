<?php 
function deleteMessage($conn) {
    $sql = "DELETE FROM Message WHERE messageID = {$_GET['messageID']};";
    if (mysqli_query($conn, $sql)) {
        header("location: ../pages/messages.php?machineID={$_GET['machineID']}&deleted=1");
    }   
    else {
        echo 'Unable to delete message.';
    }
}

function getMessageRecipient($conn) {
    $sql = "SELECT recipientID FROM Message WHERE messageID = {$_GET['messageID']};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
    }
    else {
        $assoc['recipientID'] = 0;
        echo 'Unable to find recipientID';
    }
    mysqli_free_result($result);
    return $assoc['recipientID'];
}

require_once '../include/database.php';
$recipient = getMessageRecipient($conn);
if ($recipient === $_SESSION['id']) {
    deleteMessage($conn);
}
mysqli_close($conn);
exit;