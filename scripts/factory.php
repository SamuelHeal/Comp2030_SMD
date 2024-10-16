<?php 
function getStatus($result) {
    switch ($result) {
        case 0: return "<text> Idle </text>";
        case 1: return "<text> Active </text>";
        case 2: return "<text> Maintenance </text>";
        default: return "<text> ERROR </text>";  // Something is wrong.
    }
}

function getPO($result) {
    if ($result) {
        return $result;
    } else {
        return "<text> Vacant </text>";
    }
}

function getSpeed($result) {
    if ($result) {
        return $result;
    } else {
        return "N/A";
    }
}

function getName($result) { //Need this as an SQL query so it doesn't break when adding a new machine, use the solution in reports?
    switch($result) {
        case 1: return "<text> 3D Printer </text>";
        case 2: return "<text> Automated Assembly Line </text>";
        case 3: return "<text> Automated Guided Vehicle (AGV) </text>";
        case 4: return "<text> CNC Machine </text>";
        case 5: return "<text> Energy Management System </text>";
        case 6: return "<text> IoT Sensor Hub </text>";
        case 7: return "<text> Industrial Robot </text>";
        case 8: return "<text> Predictive Maintenance System </text>";
        case 9: return "<text> Quality Control Scanner </text>";
        case 10: return "<text> Smart Conveyor System </text>";
    }
}

function statusColor($result) {
    switch ($result) {
        case 'idle': return "#7b68ee";
        case 'active': return "#228b22";
        case 'maintenance': return "#dc143c";
        default: return "#faf8f6";  // Something is wrong.
    }
}

    function appendMachineToList($assoc) {
        $background_colour = statusColor($assoc['operationalStatus']);
        $style = "background-color: $background_colour;";
        echo '<li id="list-boxes">';
            echo "<div style=\"$style\" class=\"listSmall-label\">", getName($assoc['machineID']), "</div>"; //Use 'getMachineNames()' function like in reports?
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

function lower30() { //Reduces timestamp in SQL query by 30mins? Then re-build list?
    echo "<a class=\"machines-button\"> -30 Minutes </a>";
}

function selectDate() { //Use datetime input like in reports?
    echo "<a class=\"machines-button\"> Select Date </a>";
}

function higher30() {
    echo "<a class=\"machines-button\"> + 30 Minutes </a>";
}