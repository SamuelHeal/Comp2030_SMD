<!DOCTYPE html>
<html lang="en">
<head>
    <title>Factory | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/factory.php';
        // mysqli_close($conn);
    ?>
    <div id=body-container-small>
        <h1>Factory Performance</h1> 
        <?php 
            $sql = "SELECT l.*, m.name AS machineName
                    FROM log l
                    INNER JOIN (
                        SELECT machineID, MAX(timestamp) as mostRecentTimestamp
                        FROM log
                        -- WHERE timestamp <= '2024-07-01 00:00'
                        GROUP BY machineID
                    ) r ON l.machineID = r.machineID AND l.timestamp = r.mostRecentTimestamp
                    INNER JOIN Machine m ON l.machineID = m.machineID;"; 
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                echo '<ul class=listSmall>';
                while ($assoc = mysqli_fetch_assoc($result)) {
                    appendMachineToList($assoc);
                }
                echo '</ul>';
                mysqli_free_result($result);
            }
            echo '<div id="machines-button-container">';
                timeButtons();
            echo '</div>';
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
