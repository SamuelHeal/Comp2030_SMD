<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js" defer></script>
</head>
<body>
    <?php require_once "check-floor-permission.php"; ?>

    <nav>
        <?php require_once "inc/floor_menu.inc.php"; ?>
    </nav>

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
        require_once "inc/getjobs-manager.php";
        echo "</div>";
    }
    ?>

</body>
</html>
