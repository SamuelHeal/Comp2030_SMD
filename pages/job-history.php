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
        require_once '../scripts/jobs/jobs.php';
    ?>
    <div id=body-container>
        <div class='header-container'>  
            <h1>Job History</h1>
            <div class='header-links'>
                <?php echo "<a href='jobs.php?machineID=" . $_GET['machineID'] . "'>Back</a>"; ?>
            </div>
        </div>
        <div class='jobs-container'>"
            <?php 
            if ($_SESSION['position'] == "Factory Manager") {
                getJobHistoryManager($conn);
            } else {
                getJobHistoryOperator($conn);
            }
            ?>
        </div>
    </div>
</body>
</html>
