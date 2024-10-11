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
    $operator_id = $operator_id ? $operator_id : NULL;
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to create machine.";
    }
    mysqli_stmt_close($stmt);
    return 'created=1';
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
    $operator_id = $operator_id ? $operator_id : NULL;
    $update_id = htmlspecialchars($_GET['update_id']);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to update machine.";
    }
    mysqli_stmt_close($stmt);
    return 'updated=1';
}

function updateMachineStatus($conn) {
    $sql = 'UPDATE Machine SET status = ? WHERE machineID = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $status, $update_id);
    $status = htmlspecialchars($_POST['status']);
    $update_id = htmlspecialchars($_GET['update_id']);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to update machine.";
    }
    mysqli_stmt_close($stmt);
    return 'updated=1';
}

if (isset($_POST['status'], $_GET['update_id'])) {
    require_once '../include/database.php';
    if (!$_GET['update_id']) {
        $action_parameter = createNewMachine($conn);
    } elseif (isset($_POST['name'])) {
        $action_parameter = updateMachineAll($conn);
    } else {
        $action_parameter = updateMachineStatus($conn);
    }
    mysqli_close($conn);
    header("location: ../pages/machines.php?machineID={$_GET['machineID']}&show_current=1&$action_parameter");
    exit;
}
