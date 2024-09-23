<!DOCTYPE html>
<html lang="en">
<head>
    <title>Message | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/message.js" defer></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/message.php';
        $message = getMessage($conn, $_GET['messageID']);
        $message['author'] = isset($message['authorID']) ? getAuthorName($conn, $message['authorID']) : "No author";
        $message['date'] = isset($message['timestamp']) ? formatDate($message['timestamp']) : "No date";
        ?>
    <div id="body-container">
        <h1 id="message-author"><?php echo $message['author'] ?></h1>
        <div id="message-container">
            <div id="message-subject-date-group">
                <h3 id="message-subject"><?php echo $message['subject'] ?></h3>
                <p id=message-date><?php echo $message['date'] ?></p>
            </div>
            <p id="message-body"><?php echo $message['body'] ?></p>
        </div>
        <div id="message-button-container">
            <button id="message-button-back" class="message-button">Back</a></button>
            <button class="message-button">Mark as Unread</button>
            <button id="message-button-delete" class="message-button">Delete</button>
            <button class="message-button">Reply</button>
        </div>
    </div>
</body>
</html>
