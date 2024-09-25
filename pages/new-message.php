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
        require_once '../scripts/new-message.php';
        $timestamp = timestampNow();
        $date = formatDate($timestamp);
        ?>
    <div id="body-container">
        <form action="../system/new-message.php?machineID=<?php echo $_GET['machineID']?>" method="POST" name="new-message">
            <h1 id="new-message-recipient">New Message</h1>
            <div id="new-message-container">
                <div id="message-subject-date-group">
                    <h3 id="new-message-subject">Subject</h3>
                    <p class="date"><?php echo $date; ?></p>
                    <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">
                </div>
                <textarea id="new-message-input" name="body" placeholder="Type here" required></textarea>
            </div>
            <div id="new-message-button-container">
                <a class="message-button" href="messages.php?machineID=<?php echo $_GET['machineID']; ?>" onclick="return confirm('Are you sure you want to leave this message?')">Cancel</a>
                <select id="new-message-button-recipient" class="message-button" name="recipient_id" required>
                    <?php appendPersonsToSelect($conn) ?>
                </select>
                <select id="new-message-button-subject" class="message-button" name="subject" required>
                    <option value="">Subject</option>
                    <option value="Behaviour">Behaviour</option>
                    <option value="Job">Job</option>
                    <option value="Machine">Machine</option>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Notice">Notice</option>
                    <option value="Query">Query</option>
                    <option value="Safety">Safety</option>
                </select>
                <input id="new-message-button-send" class="message-button" for="new-message" name="send_message" type="submit" value="Send"/>
            </div>
        </form>
    </div>
    <script src="../scripts/new-message.js"></script>
    <?php
        if (isset($_GET['reply'])) {
            formatMessageAsReply($conn);
        }
        mysqli_close($conn);
    ?>
</body>
</html>
