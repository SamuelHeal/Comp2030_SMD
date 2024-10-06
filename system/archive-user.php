<?php
require_once '../include/database.php';

if (isset($_GET['personID'])) {
    $personID = $_GET['personID'];
    $currentTime = date('Y-m-d H:i:s');
    $invalidPin = password_hash('invalid', PASSWORD_DEFAULT); //  Set their pin to invalid

    $sql = "UPDATE Person SET isArchived = TRUE, archivedAt = ?, PIN = ? WHERE personID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $currentTime, $invalidPin, $personID);
    $stmt->execute();
    $stmt->close();

    header("location: ../pages/manage.php?machineID={$_GET['machineID']}");
    exit();
}
?>