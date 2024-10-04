<?php 
function alertIfParameterPresent() {
    $alert_message = array(
        'all_deleted' => 'All machines were deleted!',
        'created' => 'Machine was created!',
        'deleted' => 'Machine was deleted!',
        'updated' => 'Machine updated!'
    );
    foreach($alert_message as $parameter => $message) {
        if (isset($_GET[$parameter])) {
            echo '<script>';
                echo "alert(\"{$message}\");";
                $machine_id = htmlspecialchars($_GET['machineID']);
                echo "window.location = \"machines.php?machineID=$machine_id\";";
            echo '</script>';
        }
    }
}

function appendMachineToList($assoc) {
    $status = getStatusName($assoc['status']);
    echo "<a href=\"machine.php?machineID={$_GET['machineID']}&update_id={$assoc['machineID']}\">";
        echo "<div class=\"list-label\">{$assoc['name']}</div>";
        echo '<table class="users-table">';
            echo '<tr>';
                echo "<td>Status: $status</td>";
                echo "<td>Location: {$assoc['location']}</td>";
            echo '</tr>';
            echo '<tr>';
                echo "<td>ID: {$assoc['machineID']}</td>";
                echo "<td>Operator Assigned: {$assoc['operatorID']}</td>";
            echo '</tr>';
        echo '</table>';
    echo '</a>';
}

function getStatusName($code) {
    switch ($code) {
        case 0: return "Idle";
        case 1: return "Active";
        case 2: return "Maintenance";
    }
}

function hideButtonsIfOperator() {
    if ($_SESSION['position'] === 'Production Operator') {
        echo '<script>';
            echo 'const MACHINEs_BUTTON_CONTAINER = document.getElementById("machines-button-container");';
            echo 'MACHINEs_BUTTON_CONTAINER.style.display = "none";';
        echo '</script>';
    }
}