<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="./styles/style.css">
    <script src="scripts/script.js" defer></script>
</head>
<body>
    <?php require_once "check-floor-permission.php"; ?>

    <nav>
        <?php require_once "inc/floor_menu.inc.php"; ?>
    </nav>
    
    <?php 
    require_once "inc/dbconn.inc.php";
    // session_start();
    if ($_SESSION['position'] == "Factory Manager") {
        
        echo "<div class='jobsManagerHeader'>";
        echo "<h1>Create Job</h1>";
        echo "<div class='jobsManagerLinks'>";
        echo "<a href='jobs.php'>Cancel</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='createJobForm'>";
        echo "<form action='createjobsystem.php' method='POST'>";
        echo "<label for='machine'>Machine:</label> ";
        echo "<select id='machine' name='machine' required>";
        $sql = "SELECT name, machineID FROM Machine";
        if ($result = mysqli_query($conn, $sql) ) {
            if ($rows = mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['machineID'] . "'>" . $row['name'] . "</option>";
                }
            }
        }
        echo "</select>";
        echo "<label for='opeartor'>Operator:</label>";
        echo "<select id='operator' name='operator' required>";
        $sql = "SELECT firstname, lastname, personID FROM Person";
        if ($result = mysqli_query($conn, $sql) ) {
            if ($rows = mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['personID'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
                }
            }
        }
        echo "</select>";
        echo "<label for='priority'>Priority:</label>";
        echo "<select id='priority' name='priority' required>";
        echo "<option value='1'>!</option>";
        echo "<option value='2'>!!</option>";
        echo "<option value='3'>!!!</option>";
        echo "</select>";
        echo "<label for='description'>Description:</label>";
        echo "<input id='description' name='description' required type='text' />";
        echo "<input name='submit' type='submit' value='submit' />";
        echo "</form>";
        echo "</div>";
    }
    ?>

</body>
</html>
