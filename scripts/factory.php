<?php 

function statusColor($result) {
    switch ($result) {
        case 'idle': return "#7b68ee";
        case 'active': return "#228b22";
        case 'maintenance': return "#dc143c";
        default: return "#faf8f6";  // Something is wrong.
    }
}

function getSpeed($result) {
    if ($result) {
        return $result;
    } else {
        return "N/A";
    }
}

date_default_timezone_set('Australia/Adelaide');
// Uses GET to set the disply time. Defaults to the current time. This is should be in the expected SQL format
$currentDisplayTimestamp = htmlspecialchars(isset($_GET['timestamp']) ? $_GET['timestamp'] : date('Y-m-d H:i:s'));
// Reformats to the format required for the datetime input i'll mention in a minute
$currentDisplayDateTimeLocal = date('Y-m-d\TH:i', strtotime($currentDisplayTimestamp));

    function appendMachineToList($assoc) {
        $background_colour = statusColor($assoc['operationalStatus']);
        $style = "background-color: $background_colour;";
        echo '<li class="list-boxes">';
            echo "<div style=\"$style\" class=\"listSmall-label\"> {$assoc['machineName']} </div>";
            echo '<table class="machine-table">';
                echo '<tr>';
                    echo "<td>Production: {$assoc['productionCount']} </td>";
                echo '<tr>';
                    echo "<td style='color: darkgrey;'>Power: {$assoc['powerConsumption']} </td>";
                echo '<tr>';
                    echo "<td>Humidity: {$assoc['humidity']}</td>";
                echo '<tr>';
                    echo "<td style='color: darkgrey;'>Pressure: {$assoc['pressure']} </td>";
                echo '<tr>';
                    echo "<td>Vibration: {$assoc['vibration']} </td>";
                echo '<tr>';
                    echo "<td style='color: darkgrey;'>Speed: ", getSpeed($assoc['speed']), "</td>";
                echo '<tr>';
                    echo "<td>Temperature: {$assoc['temperature']} </td>";
            echo '</table>';
        echo '</li>';
    }

function timeButtons() {
    lower30();
    selectDate();
    higher30();
}

function lower30() { //Reduces timestamp in SQL query by 30mins? Then re-build list? How to minus from a timestamp string?
    $sql = "SELECT DATEADD(MINUTE, -30, mostRecentTimestamp)";
    echo "<a class=\"machines-button\"> -30 Minutes </a>";
}

function selectDate() {
    // echo "<a class=\"machines-button\"> Select Date </a>";
    echo '<input class="machines-button" id="datetime-inp" type="datetime-local" value="$currentDisplayDateTimeLocal" onchange="setTimestamp()">';
}

function higher30() {
    $current_time = new DateTime('2024-07-01 23:30'); 
    $new_time = date_modify($current_time, '+30 minutes');
    echo "<a class=\"machines-button\"> + 30 Minutes </a>";
}