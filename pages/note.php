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
    
    $jobID = $_GET['noteID'];
    
    getNote($conn);
    
    ?>
    </div>
</body>
</html>
