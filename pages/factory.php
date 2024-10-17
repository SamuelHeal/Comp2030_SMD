<!DOCTYPE html>
<html lang="en">
<head>
    <title>Factory | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/factory.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/factory.php';
        
        date_default_timezone_set('Australia/Adelaide');
        // Uses GET to set the disply time. Defaults to the current time. This is should be in the expected SQL format
        $currentDisplayTimestamp = htmlspecialchars(isset($_GET['timestamp']) ? $_GET['timestamp'] : date('Y-m-d H:i:s'));
        // Reformats to the format required for the datetime input i'll mention in a minute
        $currentDisplayDateTimeLocal = date('Y-m-d\TH:i', strtotime($currentDisplayTimestamp));
        // mysqli_close($conn);
    ?>
    <div id=body-container-small>
        <h1>Factory Performance</h1> 
        <?php 
            // SQL query gets most recent log entry for each machine from supplied timestamp
            $sql = "SELECT l.*, m.name AS machineName
                    FROM log l
                    INNER JOIN (
                        SELECT machineID, MAX(timestamp) as mostRecentTimestamp
                        FROM log
                        WHERE timestamp <= ?
                        GROUP BY machineID
                    ) r ON l.machineID = r.machineID AND l.timestamp = r.mostRecentTimestamp
                    INNER JOIN Machine m ON l.machineID = m.machineID;"; 
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $currentDisplayTimestamp);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // $result = mysqli_query($conn, $sql);
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
