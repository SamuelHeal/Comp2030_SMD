<?php 
function alertIfParameterPresent() {
    $alert_message = array(
        'all_archived' => 'All machines were archived!',
        'all_unarchived' => 'All machines were unarchived!',
        'created' => 'Machine was created!',
        'archived' => 'Machine was archived!',
        'updated' => 'Machine updated!',
        'unarchived' => 'Machine was unarchived!',
    );
    $show_parameter = isset($_GET['show_archived']) ? 'show_archived=1' : 'show_current=1';
    foreach($alert_message as $parameter => $message) {
        if (isset($_GET[$parameter])) {
            echo '<script>';
                echo "alert(\"{$message}\");";
                echo "window.location = \"machines.php?machineID={$_GET['machineID']}&$show_parameter\";";
            echo '</script>';
        }
    }
}

function appendMachineToList($assoc) {
    $status = getStatusName($assoc['status']);
    $show_parameter = isset($_GET['show_archived']) ? 'show_archived=1' : 'show_current=1';
    echo "<a href=\"machine.php?machineID={$_GET['machineID']}&$show_parameter&active=1&update_id={$assoc['machineID']}\">";
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
    $show_archived = isset($_GET['show_archived']) ? 1 : 0;
    $sql = "SELECT * FROM Machine WHERE isArchived = $show_archived ORDER BY name;";
    $result = mysqli_query($conn, $sql);
    echo '<ul class=list>';
    if ($result && mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            $assoc['operator'] = isset($operators[$assoc['assignedOperator']]) ? $operators[$assoc['assignedOperator']] : "Vacant";
            appendMachineToList($assoc);
        }
    } else {
        echo '<p id="machines-none">No machines to show.</p>';
    }
    mysqli_free_result($result);
    echo '</ul>';
}

function echoArchiveAllButton() {
    if (isset($_GET['show_archived'])) {
        $label = 'Unarchive All Machines';
        $onclick = "return confirm('Are you sure you want to unarchive all machines?');";
        $show_parameter = 'show_current=1';
        $href = "../system/unarchive-all-machines.php?machineID={$_GET['machineID']}&$show_parameter&unarchive_all=1";
    } else {
        $label = 'Archive All Machines';
        $onclick = "return confirm('Are you sure you want to archive all machines?');";
        $show_parameter = 'show_archived=1';
        $href = "../system/archive-all-machines.php?machineID={$_GET['machineID']}&$show_parameter&archive_all=1";
    }
    echo "<a class=\"machines-button red-hover\" href=\"$href\" id=\"machines-button-archive-all\" onclick=\"$onclick\">$label</a>";
}

function echoCreateButton() {
    $show_parameter = isset($_GET['show_archived']) ? 'show_archived=1' : 'show_current=1';
    echo "<a class=\"machines-button\" href=\"machine.php?machineID={$_GET['machineID']}&$show_parameter&active=1&update_id=0\">Create New Machine</a>";
}

function echoHeading() {
    echo isset($_GET['show_archived']) ? '<h1>Archived Machines</h1>' : '<h1>Current Machines</h1>';
}

function echoShowButton() {
    if (isset($_GET['show_archived'])) {
        $show_parameter = 'show_current=1';
        $show_label = 'Show Current Machines';
    } else {
        $show_parameter = 'show_archived=1';
        $show_label = 'Show Archived Machines';
    }
    echo "<a class=\"machines-button\" href=\"machines.php?machineID={$_GET['machineID']}&$show_parameter\">$show_label</a>";
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
