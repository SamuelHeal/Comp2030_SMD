<?php 
function appendLogToTable($assoc) {
    echo '<tr>';
        echo '<td>';
            echo $assoc['timestamp'];
        echo '</td>';
        echo '<td>';
            echo $assoc['name'];
        echo '</td>';
        echo '<td>';
            echo $assoc['operationalStatus'];
        echo '</td>';
        echo '<td>';
            echo $assoc['maintenanceLog'];
        echo '</td>';
        echo '<td>';
            echo $assoc['errorCode'];
        echo '</td>';
        echo '<td>';
            echo $assoc['productionCount'];
        echo '</td>';
        echo '<td>';
            echo $assoc['humidity'];
        echo '</td>';
        echo '<td>';
            echo $assoc['powerConsumption'];
        echo '</td>';
        echo '<td>';
            echo $assoc['pressure'];
        echo '</td>';
        echo '<td>';
            echo $assoc['speed'];
        echo '</td>';
        echo '<td>';
            echo $assoc['temperature'];
        echo '</td>';
        echo '<td>';
            echo $assoc['vibration'];
        echo '</td>';
    echo '</tr>';
} 

function appendMachinesToSelect($conn) {
    $sql = "SELECT machineID, name FROM Machine;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<option value="0">Select a machine</option>';
        while ($assoc = mysqli_fetch_assoc($result)) {
            echo "<option value =\"{$assoc['machineID']}\">{$assoc['name']}</option>";
        }
    }
    else {
        echo '<option>No machines to display</option>';
    }
    mysqli_free_result($result);
}

function getLogs($conn) {
    $machine_assoc = getMachineNames($conn);
    $start = isset($_GET['start']) ? $_GET['start'] : '2024-06-30 00:00';
    $end = isset($_GET['end']) ? $_GET['end'] :'2024-06-30 23:30';
    $machine = (isset($_GET['machine']) && $_GET['machine']) ? $_GET['machine'] : 'machineID';
    $sql = "SELECT * FROM Log WHERE timestamp >= \"$start\" AND timestamp <= \"$end\" AND machineID = $machine;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            $assoc['name'] = $machine_assoc[$assoc['machineID']];
            appendLogToTable($assoc);
        }
    }
    else {
        echo '<tr><td>No results</td></tr>';
    }
    mysqli_free_result($result);
}

function getMachineNames($conn) {
    $machine_assoc = array();
    $sql = 'SELECT machineID, name FROM Machine;';
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            $machine_assoc[$assoc['machineID']] = $assoc['name'];
        }
    }
    else {
        echo 'Unable to get machine names from the database. ';
    }
    mysqli_free_result($result);
    return $machine_assoc;
}
