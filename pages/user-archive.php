<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Archive | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/update-sort-order.js"></script>

</head>

<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/users.php';
    ?>

    <div id="body-container">
    <div class="header-container">
        <h1>User Archive</h1>

        <?php 

            $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'lastName';
            $sort_direction = isset($_GET['direction']) && $_GET['direction'] == 'desc' ? 'DESC' : 'ASC';

            $valid_columns = ['personID', 'lastName', 'firstName', 'position', 'archivedAt', 'lastActiveTime'];
            if (!in_array($sort_column, $valid_columns)) {
                $sort_column = 'lastName';
            }

            $sql = "SELECT p.*, m.name AS machineName
                    FROM Person p
                    LEFT JOIN Machine m ON p.lastActiveMachineID = m.machineID 
                    WHERE p.isArchived = TRUE 
                    ORDER BY $sort_column $sort_direction;";

            $result = mysqli_query($conn, $sql);

            $users = [];
            while ($assoc = mysqli_fetch_assoc($result)) {
                $users[] = $assoc;
            }

            mysqli_close($conn);
        ?>

        <div class="top-layer-buttons">
            
            <div class="sort-button">
                <label for="sort" class="sort-label">Sort by:</label>
                <select name="sort" id="sort" class="sort-box" onchange="updateSort()">
                    <option value="personID" <?php if ($sort_column == 'personID') echo 'selected'; ?>>User ID</option>
                    <option value="firstName" <?php if ($sort_column == 'firstName') echo 'selected'; ?>>First Name</option>
                    <option value="lastName" <?php if ($sort_column == 'lastName') echo 'selected'; ?>>Last Name</option>
                    <option value="position" <?php if ($sort_column == 'position') echo 'selected'; ?>>Position</option>
                    <option value="archivedAt" <?php if($sort_column == 'archivedAt') echo 'selected'; ?>>Archived At</option>
                    <option value="lastActiveTime" <?php if($sort_column == 'lastActiveTime') echo 'selected'; ?>>Last Active</option>
                </select>
            </div>
            <button id="direction" class="arrow-button 
            <?php echo $sort_direction == 'ASC' ? 'up' : 'down'; ?>
            " onclick="toggleDirection()"></button>

            <?php $machineID = isset($_GET['machineID']) ? $_GET['machineID'] : ''; //keep the same machineID?>
            <button class="top-button" onclick="window.location.href='users.php?machineID=<?php echo htmlspecialchars($machineID); ?>'">Current Users</button>

        </div>
    </div>
        <ul class="list">
            <?php foreach ($users as $user): ?>
                <?php appendUserToList($user); ?>
            <?php endforeach; ?>
        </ul>

    </div>
</body>