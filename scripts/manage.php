<?php 

function appendUserToList($assoc) {
    $archivedOrActive = $assoc['isArchived'] ? 'archived-user' : 'active-user';
    $machineID = htmlspecialchars($_GET['machineID']);
    echo "<div class=\"$archivedOrActive user-container\" data-personid=\"{$assoc['personID']}\" data-machineid=\"{$machineID}\">";
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
            echo '<tr>';
            if ($assoc['lastActiveTime'] && $assoc['machineName']) { // Only display last active if set
                echo "<td>Last Active: {$assoc['lastActiveTime']}</td>";
                echo "<td>At : {$assoc['machineName']}</td>";
            }
            echo '</tr>';
            echo '<tr>';
            if ($assoc['isArchived']) echo "<td>Archived At: {$assoc['archivedAt']}</td>"; // Only display archived date if user is archived
            echo '</tr>';
        echo '</table>';
        // Archive button (only if user is not archived)
        if (!$assoc['isArchived']) echo "<button class=\"archive-button\" onclick=\"confirmArchive({$assoc['personID']}, '{$assoc['firstName']}', '{$assoc['lastName']}')\">Archive User</button>";
    echo '</li>';
    echo '<div class="edit-overlay">Edit User?</div>';
    echo '</div>';
}

?>