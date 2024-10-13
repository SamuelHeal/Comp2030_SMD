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

function statusColor($result) {
    switch ($result) {
        case 0: return "#7b68ee";
        case 1: return "#228b22";
        case 2: return "#dc143c";
        default: return "#faf8f6";  // Something is wrong.
    }
}

if (!$assoc['isArchived']) {
    function appendMachineToList($assoc) {
        $background_colour = statusColor($assoc['status']);
        $style = "background-color: $background_colour;";
        echo '<li id="list-boxes">';
            echo "<div style=\"$style\" class=\"listSmall-label\"> {$assoc['name']} </div>";
            echo '<table class="machine-table">';
                echo '<tr>';
                    echo "<td>Location: {$assoc['location']}</td>";
                echo '<tr>';
                    echo "<td>Status: ", getStatus($assoc['status']), "</td>";
                echo '<tr>';
                    echo "<td>Assigned PO: ", getPO($assoc['assignedOperator']), "</td>";
            echo '</table>';
        echo '</li>';
    }
}
