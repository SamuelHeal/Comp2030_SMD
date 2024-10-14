<?php
require_once '../include/database.php';

if (isset($_GET['personID'])) {
    $personID = $_GET['personID'];

    $sql = "UPDATE Person SET isArchived = FALSE WHERE personID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $personID);
    $stmt->execute();
    $stmt->close();

    header("location: ../pages/manage.php?machineID={$_GET['machineID']}");
    exit();
}
?>