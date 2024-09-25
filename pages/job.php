<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobs | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/delete-job.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/jobs.php';
    ?>
    <div id=body-container>
    <?php 
    $jobID = $_GET['id'];
    if ($_SESSION['position'] == "Factory Manager") {
        getJobManager($conn, $jobID);
    } else if ($_SESSION['position'] == "Production Operator") {
        getJobOperator($conn, $jobID);
    }
    ?>
    </div>
</body>
</html>
