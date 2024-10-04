<?php 
function getStatus($result) {
    if ($result == 0) {
        return "<text style='color: #0ADD08;'> Active </text>"; //did not like default 'green' or 'greenyellow', was not visible enough
    }
    if ($result == 1) {
        return "<text style='color: blue;'> Idle </text>"; //echo vs return?
    }
    if ($result == 2) {
        return "<text style='color: red;'> Maintenance </text>";
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
