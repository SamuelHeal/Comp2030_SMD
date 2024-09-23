<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/reports.js" defer></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/reports.php';
    ?>
    <div id="body-container">
        <h1>Reports</h1>
        <div id="reports-table-wrapper">
            <table>
                <tr id="reports-labels">
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
                <?php getLogs($conn); ?>
            </table>
        </div>
        <form id="reports-button-container" action="reports.php" method="GET">
            <input type="hidden" name="machineID" value="<?php echo $_GET['machineID'] ?>"/>  <!-- This is a bit ugly, it's there because submitting a GET form erases the existing query parameters.  -->
            <div id="reports-button-input-start-wrapper" class=reports-button>
                <p>Start date: </p>
                <input id="reports-button-input-start" class="reports-input" name="start" type="datetime-local" required/>
            </div>
            <div id="reports-button-input-end-wrapper" class=reports-button>
                <p>End date: </p>
                <input id="reports-button-input-end" class="reports-input" name="end" type="datetime-local" required/>
            </div>
            <select id="reports-button-select-machine" name="machine" required>
                <?php 
                    appendMachinesToSelect($conn);
                ?>
            </select>
            <input id="reports-button-submit" type="submit" value="✓"/>
        </form>
        <?php mysqli_close($conn); ?>
    </div>
</body>
</html>
