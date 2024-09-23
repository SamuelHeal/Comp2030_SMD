<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobs | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/deleteJob.js"></script>
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
    if ($_SESSION['position'] == "Factory Manager") {
        $jobID = $_GET['id'];
        
        getJobManager($conn, $jobID);
    }
    ?>
    </div>
</body>
</html>
