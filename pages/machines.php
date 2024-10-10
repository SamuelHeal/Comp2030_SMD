<!DOCTYPE html>
<html lang="en">
<head>
    <title>Machines | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/machines.js" defer></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/machines.php';
        alertIfParameterPresent();

    ?>
    <div id=body-container>
        <?php 
            echoHeading(); 
            displayListOfMachines($conn);
        ?>
        <div id="machines-button-container">
            <?php 
                displayButtons();
                mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
