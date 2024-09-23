<?php 
function appendUserToList($assoc) {
    echo '<li>';
        echo "<div class=\"list-label\">{$assoc['firstName']} {$assoc['lastName']}</div>";
        echo '<table class="users-table">';
            echo '<tr>';
                echo "<td>Position: {$assoc['position']}</td>";
                echo "<td>User ID: {$assoc['personID']}</td>";
            echo '</tr>';
            echo '<tr>';
                echo "<td>Phone: {$assoc['phoneNumber']}</td>";
                echo "<td>Email: {$assoc['email']}</td>";
            echo '</tr>';
            echo '<tr>';
                echo "<td>DOB: {$assoc['DOB']}</td>";
                echo "<td>Start Date: {$assoc['employmentDate']}</td>";
            echo '</tr>';
        echo '</table>';
    echo '</li>';
}
