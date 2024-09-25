<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
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
    echo "<div class='headerContainer'>";
    echo "<h1>Create Job</h1>";
    echo "<div class='headerLinks'>";
    echo "<a href='jobs.php?machineID=" . $_GET['machineID'] . "'>Cancel</a>";
    echo "</div>";
    echo "</div>";
    echo "<div class='createJobForm'>";
    echo "<form action='../system/create-job.php?machineID=" . $_GET['machineID'] . "' method='POST'>";
    echo "<div class='innerJobForm'>";
    echo "<label for='machine'>Machine:</label> ";
    echo "<div class='select-dropdown'>";
    echo "<select id='machine' name='machine' required>";
    getMachinesForJob($conn);
    echo "</select>";
    echo "</div>";
    echo "<label for='opeartor'>Operator:</label>";
    echo "<div class='select-dropdown'>";
    echo "<select class='select-dropdown' id='operator' name='operator' required>";
    getOperatorsForJob($conn);
    echo "</select>";
    echo "</div>";
    echo "<label for='priority'>Priority:</label>";
    echo "<div class='select-dropdown'>";
    echo "<select id='priority' name='priority' required>";
    echo "<option value='1'>Low</option>";
    echo "<option value='2'>Medium</option>";
    echo "<option value='3'>High</option>";
    echo "</select>";
    echo "</div>";
    echo "</div>";
    echo "<div class='innerJobForm'>";
    echo "<label for='description'>Description:</label>";
    echo "<textarea id='description' name='description' required></textarea>";
    echo "<input name='submit' type='submit' value='Submit' />";
    echo "</div>";
    echo "</form>";
    echo "</div>";
    ?>
    </div>
</body>
</html>
