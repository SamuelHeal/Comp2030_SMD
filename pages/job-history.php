<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job History | SMD</title>
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
    echo "<h1>Job History</h1>";
    echo "<div class='header-links'>";
    echo "<a href='jobs.php?machineID=" . $_GET['machineID'] . "'>Back</a>";
    echo "</div>";
    echo "</div>";
    if ($_SESSION['position'] == "Factory Manager") {
        echo "<div class='jobs-container'>";
        getJobHistoryManager($conn);
        echo "</div>";
    } else {
        echo "<div class='jobs-container'>";
        getJobHistoryOperator($conn);
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>
