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
        require_once '../include/functions.php';
        require_once '../include/database.php';
        require_once '../include/check-authorisation.php';
        checkMachineIdIsSet($conn);
        require_once '../include/menu.php';
        setBannerColour($conn);
    ?>
    <div id=body-container>
    <?php 
    
    $jobID = $_GET['jobID'];
    
    echo "<div class='headerContainer'>";
    echo "<h1>Create Task Note</h1>";
    echo "<div class='headerLinks'>";
    echo "<a href='job.php?id=" . $jobID . "&machineID=" . $_GET['machineID']. "'>Cancel</a>";
    echo "</div>";
    echo "</div>";
    echo "<div class='createJobForm'>";
    echo "<form action='../system/create-note.php?jobID=" . $_GET['jobID'] . "&machineID=" . $_GET['machineID'] . "' method='POST'>";
    echo "<div class='innerJobForm'>";
    echo "<label for='category'>Category:</label> ";
    echo "<div class='select-dropdown'>";
    echo "<select id='category' name='category' required>";
    echo "<option value='Missing part'>Missing part</option>";
    echo "<option value='Awaiting part'>Awaiting part</option>";
    echo "<option value='Machine issue'>Machine issue</option>";
    echo "<option value='Quality concern'>Quality concern</option>";
    echo "<option value='Issue with job details'>Issue with job details</option>";
    echo "<option value='Safety concern'>Safety concern</option>";
    echo "<option value='Other'>Other</option>";
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
