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
        require_once '../include/page-defaults.php';
        require_once '../scripts/jobs.php';
    ?>
    <div id=body-container>
    <?php 
    echo "<div class='header-container'>";
    echo "<h1>Current Jobs</h1>";
    if ($_SESSION['position'] == "Factory Manager") {
        echo "<div class='header-links'>";
        echo "<a href='create-job.php?machineID=" . $_GET['machineID'] . "'>Create</a>";
        echo "<a href='job-history.php?machineID=" . $_GET['machineID'] . "'>History</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='jobs-container'>";
        getJobsManager($conn);
        echo "</div>";
    } else if ($_SESSION['position'] == "Production Operator") {
        echo "<div class='header-links'>";
        echo "<a href='job-history.php?machineID=" . $_GET['machineID'] . "'>History</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='jobs-container'>";
        getJobsOperator($conn);
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>
