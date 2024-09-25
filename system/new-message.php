<?php
if (isset($_POST['send_message'])) {
    require_once '../include/database.php';
    $sql = "INSERT INTO Message (timestamp, authorID, recipientID, isRead, subject, body) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'siiiss', $timestamp, $author_id, $recipient_id, $is_read, $subject, $body);
    $timestamp = htmlspecialchars($_POST['timestamp']);
    $author_id = $_SESSION['id'];
    $recipient_id = htmlspecialchars($_POST['recipient_id']);
    $is_read = 0;
    $subject = htmlspecialchars($_POST['subject']);
    $body = htmlspecialchars($_POST['body']);  // Privacy concern that messages are not encrypted?
    if (mysqli_stmt_execute($stmt)) {
        header("location: ../pages/messages.php?machineID={$_GET['machineID']}&sent=1"); 
    }
    else {
        mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit;
}
