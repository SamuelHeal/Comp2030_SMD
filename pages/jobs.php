<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobs | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
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
    <?php 
    echo "<div class='headerContainer'>";
    echo "<h1>Current Jobs</h1>";
    if ($_SESSION['position'] == "Factory Manager") {
        echo "<div class='headerLinks'>";
        echo "<a href='create-job.php?machineID=" . $_GET['machineID'] . "'>Create</a>";
        echo "<a href='job-history.php?machineID=" . $_GET['machineID'] . "'>History</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='managerJobs'>";
        getJobsManager($conn);
    } else if ($_SESSION['position'] == "Production Operator") {
        echo "<div class='headerLinks'>";
        echo "<a href='job-history.php?machineID=" . $_GET['machineID'] . "'>History</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='operatorJobs'>";
        getJobsOperator($conn);
    }
    echo "</div>";
    ?>
    </div>
</body>
</html>
