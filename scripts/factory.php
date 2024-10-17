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
    // $sql = "SELECT DATEADD(MINUTE, -30, mostRecentTimestamp)";
    echo "<button onclick='addMinutes(-30)' class=\"machines-button\"> -30 Minutes </button>";
}

function selectDate() {
    // echo "<a class=\"machines-button\"> Select Date </a>";
    echo '<div id="datetime-inp-wrapper">';
    echo '<input class="machines-button" id="datetime-inp" type="datetime-local" value="$currentDisplayDateTimeLocal" onchange="setTimestamp()">';
    echo '</div>';
}

function higher30() {
    // $current_time = new DateTime('2024-07-01 23:30'); 
    // $new_time = date_modify($current_time, '+30 minutes');
    echo "<button onclick='addMinutes(30)' class=\"machines-button\"> + 30 Minutes </button>";
}