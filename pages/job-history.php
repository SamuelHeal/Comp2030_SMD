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
    echo "<h1>Job History</h1>";
    echo "<div class='headerLinks'>";
    echo "<a href='jobs.php?machineID=" . $_GET['machineID'] . "'>Back</a>";
    echo "</div>";
    echo "</div>";
    if ($_SESSION['position'] == "Factory Manager") {
        echo "<div class='managerJobs'>";
        getJobHistoryManager($conn);
        echo "</div>";
    } else {
        echo "<div class='operatorJobs'>";
        getJobHistoryOperator($conn);
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>
