<?php
function createNewMachine($conn) {
    $sql = 'INSERT INTO Machine (name, location, status, assignedOperator) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ssii', $name, $location, $status, $operator_id);
    $name = htmlspecialchars($_POST['name']);
    $location = htmlspecialchars($_POST['location']);
    $status = htmlspecialchars($_POST['status']);
    $operator_id = htmlspecialchars($_POST['operator']);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to create machine.";
    }
    mysqli_stmt_close($stmt);
}

function updateMachineAll($conn) {
    $sql = 'UPDATE Machine SET name = ?, location = ?, status = ?, assignedOperator = ? WHERE machineID = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ssiii', $name, $location, $status, $operator_id, $update_id);
    $name = htmlspecialchars($_POST['name']);
    $location = htmlspecialchars($_POST['location']);
    $status = htmlspecialchars($_POST['status']);
    $operator_id = htmlspecialchars($_POST['operator']);
    $update_id = htmlspecialchars($_GET['update_id']);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to update machine.";
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['name'], $_GET['update_id'])) {
    require_once '../include/database.php';
    if (!$_GET['update_id']) {
        createNewMachine($conn);
        header("location: ../pages/machines.php?machineID={$_GET['machineID']}&created=1");
    } else {
        updateMachineAll($conn);
        header("location: ../pages/machines.php?machineID={$_GET['machineID']}&updated=1");
    }
    mysqli_close($conn);
    exit;
}
