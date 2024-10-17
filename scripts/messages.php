<?php 
function alertIfParameterPresent() {
    $alert_message = array(
        'all_deleted' => 'All your messages were deleted!',
        'all_read' => 'All your messages are read!',
        'deleted' => 'Message was deleted!',
        'sent' => 'Message was sent!'
    );
    foreach($alert_message as $parameter => $message) {
        if (isset($_GET[$parameter])) {
            echo '<script>';
                echo "alert(\"{$message}\");";
                echo "window.location = \"messages.php?machineID={$_GET['machineID']}\";";
            echo '</script>';
        }
    }
}

function appendMessageToList($assoc, $author_name) {
    $unread_or_blank = $assoc['isRead'] ? '' : 'unread';
    $fomatted_date = formatDate($assoc['timestamp']);
    echo "<a class=\"{$unread_or_blank}\" href=\"message.php?machineID={$_GET['machineID']}&messageID={$assoc['messageID']}\">";
        echo "<div class=\"messages-list-label\">{$author_name}</div>";
        echo '<div class="messages-content">';
            echo '<div class="messages-subject-date-group">';
                echo "<h3 class=\"messages-subject\">{$assoc['subject']}</h3>";
                echo "<p class=\"date\">{$fomatted_date}</p>";
            echo '</div>';
            echo "<p class=\"messages-body\">{$assoc['body']}</p>";
        echo '</div>';
    echo '</a>';
}

function displayMessages($conn) {
    $users = getUsersAssoc($conn);
    $sql = "SELECT * FROM Message WHERE recipientID = {$_SESSION['id']} ORDER BY timestamp DESC;";
    $result = mysqli_query($conn, $sql);
    echo '<div id=messages-list-container>';
    if ($result && mysqli_num_rows($result)) {
        echo '<ul id="messages-list">';
        while ($assoc = mysqli_fetch_assoc($result)) {
            appendMessageToList($assoc, $users[$assoc['authorID']]);
        }
        echo '</ul>';
    } else {
        echo '<p id="messages-none">No messages to show.</p>';
    }
    echo '</div>';
    mysqli_free_result($result);
}

function getUsersAssoc($conn) {
    $users = array();
    $sql = 'SELECT * FROM Person';
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            $users[$assoc['personID']] = "{$assoc['firstName']} {$assoc['lastName']}";
        }
    } 
    else {
        echo 'No persons in the database. ';
    }
    mysqli_free_result($result);
    return $users;
}
