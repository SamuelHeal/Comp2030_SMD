<!DOCTYPE html>
<html lang="en">
<head>
    <title>Messages | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/messages.js" defer></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/messages.php';
        alertIfParameterPresent();
        ?>
    <div id=body-container>
        <h1>Messages</h1>
        <?php 
            displayMessages($conn);
            mysqli_close($conn);
        ?>
        <div id="message-button-container">
            <a class="message-button red-hover" href="../system/delete-all-messages.php?machineID=<?php echo $_GET['machineID']; ?>&delete_all=1" id="messages-delete-all" onclick="return confirm('Are you sure you want to delete all your messages?')">Delete All Messages</a>
            <a class="message-button" href="../system/mark-all-read-messages.php?machineID=<?php echo $_GET['machineID']; ?>&read_all=1" id="messages-mark-all-read" >Mark All Read</a>
            <a class="message-button" href="new-message.php?machineID=<?php echo $_GET['machineID']; ?>&active=1">New Message</a>
        </div>
    </div>
</body>
</html>
