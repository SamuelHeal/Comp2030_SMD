<?php 
function alertIfParameterPresent() {
    $alert_message = array(
        'all_archived' => 'All machines were archived!',
        'all_restored' => 'All machines were restored!',
        'created' => 'Machine was created!',
        'archived' => 'Machine was archived!',
        'updated' => 'Machine updated!',
        'restored' => 'Machine was restored!',
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
    $show_parameter = isset($_GET['show_archived']) ? 'show_archived=1' : 'show_current=1';
    $status = getStatusName($assoc['status']);
    $background_colour = getStatusColour($assoc['status']);
    $style = "background-color: $background_colour;";
    echo "<a href=\"machine.php?machineID={$_GET['machineID']}&$show_parameter&active=1&update_id={$assoc['machineID']}\">";
        echo "<div class=\"machines-list-label\" style=\"$style\">{$assoc['name']}</div>";
        echo '<table class="machines-list-table">';
            echo '<tr>';
                echo "<td>Status: $status</td>";
            echo '</tr>';    
            echo '<tr>';
                echo "<td>Operator Assigned: {$assoc['operator']}</td>";
            echo '</tr>';
            echo '<tr>';
            echo "<td>Location: {$assoc['location']}</td>";
            echo '</tr>';
            echo '<tr>';
                echo "<td>ID: {$assoc['machineID']}</td>";
            echo '</tr>';    
        echo '</table>';
    echo '</a>';
}

function displayButtons() {
    if ($_SESSION['position'] === 'Factory Manager') {
        echoShowButton();
        echoArchiveAllButton();
        echoCreateButton();
    } else {
        expandMachinesContainerToFillSpace();
    }
}

function displayListOfMachines($conn) {
    $operators = getOperatorsAssoc($conn);
    $show_archived = isset($_GET['show_archived']) ? 1 : 0;
    $sql = "SELECT * FROM Machine WHERE isArchived = $show_archived ORDER BY name;";
    $result = mysqli_query($conn, $sql);
    echo '<div id=machines-list-container>';
    if ($result && mysqli_num_rows($result)) {
        echo '<ul id="machines-list">';
        while ($assoc = mysqli_fetch_assoc($result)) {
            $assoc['operator'] = isset($operators[$assoc['assignedOperator']]) ? $operators[$assoc['assignedOperator']] : "Vacant";
            appendMachineToList($assoc);
        }
        echo '</ul>';
    } else {
        echo '<p id="machines-none">No machines to show.</p>';
    }
    echo '</div>';
    mysqli_free_result($result);
}

function echoArchiveAllButton() {
    if (isset($_GET['show_archived'])) {
        $class = 'machines-button';
        $label = 'Restore All Machines';
        $onclick = "return confirm('Are you sure you want to restore all machines?');";
        $show_parameter = 'show_current=1';
        $href = "../system/restore-all-machines.php?machineID={$_GET['machineID']}&$show_parameter&restore_all=1";
    } else {
        $class = 'machines-button red-hover';
        $label = 'Archive All Machines';
        $onclick = "return confirm('Are you sure you want to archive all machines?');";
        $show_parameter = 'show_archived=1';
        $href = "../system/archive-all-machines.php?machineID={$_GET['machineID']}&$show_parameter&archive_all=1";
    }
    echo "<a class=\"$class\" href=\"$href\" id=\"machines-button-archive-all\" onclick=\"$onclick\">$label</a>";
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

function expandMachinesContainerToFillSpace() {
    echo '<script>';
        echo 'document.getElementById("machines-list-container").style.height = "66vh";';
    echo '</script>';
}

function getStatusColour($code) {
    switch ($code) {
        case 0: return '#7b68ee';
        case 1: return '#228b22';
        case 2: return '#dc143c';
        default: return '#dcdcdc';
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
