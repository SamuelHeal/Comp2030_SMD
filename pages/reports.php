<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/reports-buttons.js" defer></script>
</head>
<body>
    <?php
        require_once '../include/functions.php';
        require_once '../include/database.php';
        require_once '../include/check-authorisation.php';
        checkMachineIdIsSet($conn);
        require_once '../include/menu.php';
        setBannerColour($conn);
    ?>
    <div id=body-container>
        <h1>Reports</h1>
        <div id=reports-button-container>
            <div id=reports-button-select-start-wrapper class=reports-button>
                <p>Start date: </p>
                <input id=reports-button-select-start name="start" type="datetime-local"/>
            </div>
            <div id=reports-button-select-end-wrapper class=reports-button>
                <p>End date: </p>
                <input id=reports-button-select-end name="end" type="datetime-local"/>
            </div>
            <input id=reports-button-submit name="submit" type="submit" value="Submit"/>
        </div>
        <table id=reports-table>
            <tr id=reports-labels>
                <th>
                    Timestamp
                </th>
                <th>
                    Machine Name
                </th>
                <th>
                    Status
                </th>
                <th>
                    Log
                </th>
                <th>
                    Error
                </th>
                <th>
                    Production Count
                </th>
                <th>
                    Humidity
                </th>
                <th>
                    Power Consumption
                </th>
                <th>
                    Pressure
                </th>
                <th>
                    Speed
                </th>
                <th>
                    Temperature
                </th>
                <th>
                    Vibration
                </th>
            </tr>
            <?php 
            $machine_assoc = getMachineNames($conn);
            $timestamp_start = '2024-06-30 00:00';
            $timestamp_end = '2024-06-30 23:30';
            $sql = "SELECT * FROM Log WHERE timestamp >= \"$timestamp_start\" AND timestamp <= \"$timestamp_end\";";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                while ($assoc = mysqli_fetch_assoc($result)) {
                    $assoc['name'] = $machine_assoc[$assoc['machineID']];
                    appendLogToTable($assoc);
                }
            }
            else {
                echo 'Unable to query logs. ';
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>
