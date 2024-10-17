<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users | SMD</title>
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
    <div >
        <h1>Users</h1>
        <?php 

            $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'lastName';
            $sort_direction = isset($_GET['direction']) && $_GET['direction'] == 'desc' ? 'DESC' : 'ASC';
            $show_option = isset($_GET['show']) ? $_GET['show'] : 'currentUsers';

            $valid_columns = ['personID', 'lastName', 'firstName', 'position', 'lastActiveTime'];
            if (!in_array($sort_column, $valid_columns)) {
                $sort_column = 'lastName';
            }

            $show_condition = "p.isArchived = FALSE";
            if ($show_option == 'archivedUsers') {
                $show_condition = "p.isArchived = TRUE";
            } elseif ($show_option == 'allUsers') {
                $show_condition = "1=1"; // Always true: Show all users
            }

            $sql = "SELECT p.*, 
                CASE 
                    WHEN p.lastActiveAtMachine THEN m.name 
                    ELSE 'Desktop PC' 
                END 
                AS machineName
                FROM Person p
                LEFT JOIN Machine m ON p.lastActiveMachineID = m.machineID 
                WHERE $show_condition 
                ORDER BY $sort_column $sort_direction;";
    
            $result = mysqli_query($conn, $sql);

            $users = [];
            while ($assoc = mysqli_fetch_assoc($result)) {
                $users[] = $assoc;
            }
            mysqli_free_result($result);
            mysqli_close($conn);
        ?>
        
        <div class="top-layer-admin">

            <div class="sort-button">
                <label for="sort" class="sort-label">Sort by:</label>
                <select name="sort" id="sort" class="sort-box" onchange="updateSort()">
                    <option value="personID" <?php if ($sort_column == 'personID') echo 'selected'; ?>>User ID</option>
                    <option value="firstName" <?php if ($sort_column == 'firstName') echo 'selected'; ?>>First Name</option>
                    <option value="lastName" <?php if ($sort_column == 'lastName') echo 'selected'; ?>>Last Name</option>
                    <option value="position" <?php if ($sort_column == 'position') echo 'selected'; ?>>Position</option>
                    <option value="lastActiveTime" <?php if($sort_column == 'lastActiveTime') echo 'selected'; ?>>Last Active</option>
                </select>
            </div>

            <div class="sort-button">
                <button id="direction" class="direction-button <?php echo $sort_direction == 'ASC' ? 'asc' : 'desc'; ?>" onclick="toggleDirection()">
                    <?php echo $sort_direction == 'ASC' ? 'Ascending' : 'Descending'; ?>
                </button>
            </div>

            <div class="sort-button">
                <label for="show" class="sort-label">Show:</label>
                <select name="show" id="show" class="sort-box" onchange="updateSort()">
                    <option value="currentUsers" <?php if ($show_option == 'currentUsers') echo 'selected'; ?>>Current Users</option>
                    <option value="archivedUsers" <?php if ($show_option == 'archivedUsers') echo 'selected'; ?>>Archived Users</option>
                    <option value="allUsers" <?php if ($show_option == 'allUsers') echo 'selected'; ?>>All Users</option>
                </select>
            </div>
          
        </div>
    </div>
        <ul class="list">
            <?php foreach ($users as $user):
                appendUserToList($user);
            endforeach; ?>
        </ul>
    </div>
</body>
</html>
