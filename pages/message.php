<!DOCTYPE html>
<html lang="en">
<head>
    <title>Message | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/message.php';
        $message = getMessage($conn);
        redirectIfUserIsNotRecipient($message['recipientID']);
        setAuthorAndDateAttributes($conn, $message);
        markMessageAsRead($conn);
        mysqli_close($conn);
        ?>
    <div id="body-container">
        <h1 id="message-author">From <?php echo $message['author'] ?></h1>
        <div id="message-container">
            <div id="message-subject-date-group">
                <h3 id="message-subject"><?php echo $message['subject'] ?></h3>
                <p class="date"><?php echo $message['date'] ?></p>
            </div>
            <p id="message-body"><?php echo $message['body'] ?></p>
        </div>
        <div id="message-button-container">
            <?php appendButtons($message); ?>
        </div>
    </div>
</body>
</html>
