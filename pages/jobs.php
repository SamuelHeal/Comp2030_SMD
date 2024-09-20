<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobs | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="..\styles\style.css">
    <script src="..\scripts\banner.js"></script>
</head>
<body>
    <?php
        require_once '..\\include\functions.php';
        require_once '..\\include\database.php';
        require_once '..\\include\check-authorisation.php';
        checkMachineIdIsSet($conn);
        require_once '..\\include\menu.php';
        setBannerColour($conn);
    ?>
    <div id=body-container>
    <?php 
    require_once "inc/dbconn.inc.php";
    // session_start();
    if ($_SESSION['position'] == "Factory Manager") {
        echo "<div class='jobsManagerHeader'>";
        echo "<h1>Current Jobs</h1>";
        echo "<div class='jobsManagerLinks'>";
        echo "<a href='create-job.php'>Create</a>";
        echo "<a href='job-history.php'>History</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='managerJobs'>";
        require_once "include/getjobs-manager.php";
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>
