<?php 
function getMessage($conn, $message_id) {
    $sql = "SELECT * FROM Message WHERE messageID = {$message_id};";
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