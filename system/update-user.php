<?php
require_once '../include/database.php';
require_once '../scripts/manage.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $personID = $_POST['personID'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $dob = $_POST['dob'];
    $position = $_POST['position'];
    $phoneNumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $employmentDate = $_POST['employmentdate'];
    $pin = $_POST['pin'];
    $machineID = $_POST['machineID'];

    // Prepare the SQL statement
    $sql = "UPDATE Person SET firstName = ?, lastName = ?, DOB = ?, position = ?, phoneNumber = ?, email = ?, employmentDate = ?";

    // If new pin is provided, add the new pin
    if (!empty($pin)) {
        $hashedPin = password_hash($pin, PASSWORD_DEFAULT);
        $sql .= ", PIN = ?";
    }

    $sql .= " WHERE personID = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    if (!empty($pin)) {
        $stmt->bind_param("ssssssssi", $firstName, $lastName, $dob, $position, $phoneNumber, $email, $employmentDate, $hashedPin, $personID);
    } else {
        $stmt->bind_param("sssssssi", $firstName, $lastName, $dob, $position, $phoneNumber, $email, $employmentDate, $personID);
    }

    $stmt->execute();
    $stmt->close();

    header("location: ../pages/manage.php?machineID={$machineID}");
    exit();
}
?>