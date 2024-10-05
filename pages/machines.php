<!DOCTYPE html>
<html lang="en">
<head>
    <title>Machines | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/machines.php';
        alertIfParameterPresent();
    ?>
    <div id=body-container>
        <h1>Machines</h1>
        <div id="machines-button-container">
            <a class="machines-button red-hover" href="../system/archive-all-machines.php?<?php echo "machineID={$_GET['machineID']}&archive_all=1"; ?>" onclick="return confirm('Are you sure you want to archive all machines?');">Archive All Machines</a>
            <a class="machines-button" href="machine.php?<?php echo "machineID={$_GET['machineID']}&active=1&update_id=0"; ?>">Create New Machine</a>
        </div>
        <?php 
            hideButtonsIfOperator();
            displayListOfMachines($conn);
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
