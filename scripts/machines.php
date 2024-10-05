<?php 
function alertIfParameterPresent() {
    $alert_message = array(
        'all_archived' => 'All machines were archived!',
        'created' => 'Machine was created!',
        'archived' => 'Machine was archived!',
        'updated' => 'Machine updated!'
    );
    foreach($alert_message as $parameter => $message) {
        if (isset($_GET[$parameter])) {
            echo '<script>';
                echo "alert(\"{$message}\");";
                echo "window.location = \"machines.php?machineID={$_GET['machineID']}\";";
            echo '</script>';
        }
    }
}

function appendMachineToList($assoc) {
    $status = getStatusName($assoc['status']);
    echo "<a href=\"machine.php?machineID={$_GET['machineID']}&active=1&update_id={$assoc['machineID']}\">";
        echo "<div class=\"list-label\">{$assoc['name']}</div>";
        echo '<table class="users-table">';
            echo '<tr>';
                echo "<td>Status: $status</td>";
                echo "<td>Location: {$assoc['location']}</td>";
            echo '</tr>';
            echo '<tr>';
                echo "<td>ID: {$assoc['machineID']}</td>";
                echo "<td>Operator Assigned: {$assoc['operator']}</td>";
            echo '</tr>';
        echo '</table>';
    echo '</a>';
}

function displayListOfMachines($conn) {
    $operators = getOperatorsAssoc($conn);
    $sql = "SELECT * FROM Machine ORDER BY name;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<ul class=list>';
        while ($assoc = mysqli_fetch_assoc($result)) {
            $assoc['operator'] = isset($operators[$assoc['operatorID']]) ? $operators[$assoc['operatorID']] : "Vacant";
            appendMachineToList($assoc);
        }
        echo '</ul>';
        mysqli_free_result($result);
    }
}

function getStatusName($code) {
    switch ($code) {
        case 0: return "Idle";
        case 1: return "Active";
        case 2: return "Maintenance";
    }
}

function getOperatorsAssoc($conn) {
    $users = array();
    $sql = 'SELECT * FROM Person WHERE position = "Production Operator"';
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            $users[$assoc['personID']] = "{$assoc['firstName']} {$assoc['lastName']}";
        }
    } 
    else {
        echo 'No operators in the database.';
    }
    mysqli_free_result($result);
    return $users;
}


function hideButtonsIfOperator() {
    if ($_SESSION['position'] === 'Production Operator') {
        echo '<script>';
            echo 'const MACHINEs_BUTTON_CONTAINER = document.getElementById("machines-button-container");';
            echo 'MACHINEs_BUTTON_CONTAINER.style.display = "none";';
        echo '</script>';
    }
}
