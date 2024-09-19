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
        echo "<div class='managerHeader'>";
        echo "<h1>Current Jobs</h1>";
        echo "<a href='create-job.php'>Create</a>";
        echo "<a href='job-history.php'>History</a>";
        echo "</div>";
        echo "<div class='managerJobs'>";
        $sql = "SELECT jobID, machineID, OperatorID, priority FROM Job WHERE completed=0;";
        if ($result1 = mysqli_query($conn, $sql)) {
            echo "<h1>Current Jobs</h1>";
            // if ($rows = mysqli_num_rows($result)) {
            //     echo "<div class='jobList'>";
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         echo "<div class='list-item'>";
            //         echo "<a href='job.php?id=" . $row['jobid'] . "'>";
            //         $sql1 = "SELECT name FROM Machine WHERE machineid = " . $row['machineid'];
            //         if ($result1 = mysqli_query($conn, $sql1) ) {
            //             if ($rows1 = mysqli_num_rows($result1)) {
            //                 $machine = mysqli_fetch_assoc($result1);
            //                 echo$machine['name'] . "-" . $row['jobid'];
            //             }
            //             mysqli_free_result($result1);

            //         }
            //         $sql2 = "SELECT firstname, lastname FROM Person WHERE personid = " . $row['operatorid'];
            //         if ($result2 = mysqli_query($conn, $sql2) ) {
            //             if ($rows2 = mysqli_num_rows($result2)) {
            //                 $person = mysqli_fetch_assoc($result2);
            //                 echo$person['fistname'] . $person['lastname'];
            //             }
            //             mysqli_free_result($result2);

            //         }

            //         if ($row['priority'] == 1) {
            //             echo "!";
            //         } else if ($row['priority'] == 2) {
            //             echo "!!";
            //         } else {
            //             echo "!!!";
            //         }
            //         echo "</a>";
            //         echo "</div>";
            //     };
            //     echo "</div>";
                mysqli_free_result($result1);
            // }
        }

        echo "</div>";
    }
    $mysqli->close();

    
    ?>

</body>
</html>
