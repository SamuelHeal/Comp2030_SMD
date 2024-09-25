<?php 
function appendButtons($message) {
    $unread_inner_text = isset($_GET['unread']) ? '✓' : 'Mark as Unread';
    echo "<a class=\"message-button\" href=\"messages.php?machineID={$_GET['machineID']}\">Back</a>";
    echo "<a id=\"message-button-mark-unread\" class=\"message-button\" href=\"../system/message.php?machineID={$_GET['machineID']}&messageID={$_GET['messageID']}\">$unread_inner_text</a>";
    echo "<a id=\"message-button-delete\" class=\"message-button red-hover\" href=\"../system/delete-message.php?machineID={$_GET['machineID']}&messageID={$_GET['messageID']}\" onclick=\"return confirm('Are you sure you want to delete this message?')\">Delete</a>";
    echo "<a class=\"message-button\" href=\"new-message.php?machineID={$_GET['machineID']}&active=1&recipientID={$message['authorID']}&reply=1&subject={$message['subject']}\">Reply</a>";
}

function getMessage($conn) {
    $sql = "SELECT * FROM Message WHERE messageID = {$_GET['messageID']};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
    }
    else {
        $assoc = array(
            'subject' => 'Message Not Found',
            'body' => 'The message you are trying to view doesn\'t exist.' 
        );
    }
    mysqli_free_result($result);
    return $assoc;
}

function getAuthorName($conn, $author_id) {
    $sql = "SELECT firstName, lastName FROM Person WHERE personID = {$author_id};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
        $name = "{$assoc['firstName']} {$assoc['lastName']}";
    }
    else {
        $name = "No name";
    }
    mysqli_free_result($result);
    return $name;
}

function markMessageAsRead($conn) {
    if (!isset($_GET['unread'])) {
        $sql = "UPDATE Message SET isRead = 1 WHERE messageID = {$_GET['messageID']};";
        if (!mysqli_query($conn, $sql)) {
            echo 'Unable to set message as read.';
        }
    }
}

function redirectIfUserIsNotRecipient($recipient) {
    if ($_SESSION['id'] !== $recipient) {
        header("location: unauthorised.php?machineID={$_GET['machineID']}");
    }
}

function setAuthorAndDateAttributes($conn, &$message) {
    $message['author'] = isset($message['authorID']) ? getAuthorName($conn, $message['authorID']) : "No author";
    $message['date'] = isset($message['timestamp']) ? formatDate($message['timestamp']) : "No date";
}
