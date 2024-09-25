<!DOCTYPE html>
<html lang="en">
<head>
    <title>Messages | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/messages.php';
        alertIfParameterPresent('sent');
        alertIfParameterPresent('deleted');
        $users = getUsersAssoc($conn);
        ?>
    <div id=body-container>
        <h1>Messages</h1>
        <div id="message-button-container">
            <a class="message-button red-hover" href="../system/delete-all-messages.php?machineID=<?php echo $_GET['machineID']; ?>&delete_all=1" onclick="return confirm('Are you sure you want to delete all your messages?')">Delete All Messages</a>
            <a class="message-button" href="../system/mark-all-read-messages.php?machineID=<?php echo $_GET['machineID']; ?>&read_all=1">Mark All Read</a>
            <a class="message-button" href="new-message.php?machineID=<?php echo $_GET['machineID']; ?>&active=1">New Message</a>
        </div>
        <?php 
            $sql = "SELECT * FROM Message WHERE recipientID = {$_SESSION['id']} ORDER BY timestamp DESC;";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                echo '<ul class=list>';
                while ($assoc = mysqli_fetch_assoc($result)) {
                    appendMessageToList($assoc, $users);
                }
                echo '</ul>';
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
