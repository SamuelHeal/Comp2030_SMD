<?php 
function getStatus($result) {
    switch ($result) {
        case 0: return "<text style='color: #7b68ee;'> Idle </text>";
        case 1: return "<text style='color: #228b22;'> Active </text>";
        case 2: return "<text style='color: #dc143c;'> Maintenance </text>";
    }
}

function appendMachineToList($assoc) {
    echo '<li id="list-boxes">';
        echo "<div class=\"listSmall-label\">{$assoc['name']}</div>"; //add {$assoc['machineID']} in brackets?
        echo '<table class="machine-table">';
            echo '<tr>';
                echo "<td>Location: {$assoc['location']}</td>";
            echo '<tr>';
                echo "<td>Status: ", getStatus($assoc['status']), "</td>"; //make a coloured text indicator instead?
            echo '<tr>';
                echo "<td>Assigned PO: {$assoc['status']}</td>"; //need to see merged changes to db for assigned PO, join table statement?
        echo '</table>';
    echo '</li>';
}
