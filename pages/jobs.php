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
        $isManager = false;
        if ($_SESSION['position'] == "Factory Manager") {
            $isManager = true;
        }
        $machineID = $_GET['machineID'];
    ?>
    <div id=body-container>
        <div class='header-container'>
            <h1>Current Jobs</h1>
            <div class='header-links'>
                <?php 
                if ($isManager) {
                    echo "<a href='create-job.php?machineID=" . $machineID . "'>Create</a>";
                }
                echo "<a href='job-history.php?machineID=" . $machineID . "'>History</a>";
                ?>
            </div>
        </div>
        <div class='jobs-container'>
            <div class='job-list'>
                <?php 
                getJobs($conn, $isManager);
                ?>
            </div>
        </div>
    </div>
</body>
</html>
