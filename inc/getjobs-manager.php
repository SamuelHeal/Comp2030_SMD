<?php
$sql = "SELECT Job.jobID, Job.priority, Job.status, Machine.name, Person.firstname, Person.lastname FROM Job INNER JOIN Machine ON Job.machineID=Machine.machineID INNER JOIN Person on Job.OperatorID=Person.personID WHERE Job.completed=0";
if ($result = mysqli_query($conn, $sql) ) {
    if ($rows = mysqli_num_rows($result)) {
        echo "<div class='jobList'>";
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "<div >";
            echo "<a class='job' href='job.php?id=" . $row['jobID'] . "'>";
            echo "<div class='jobID'>";
            echo "<p>" . $row['jobID'];
            echo "</div>";
            echo "<div class='jobInfo'>";
            echo "<p class='bold'>" . $row['name'];
            echo "<p>" . $row['status'];
            echo "<p>" . $row['firstname'] . " " . $row['lastname'];

            if ($row['priority'] == 1) {
                echo "<p class='priority'>!</p>";
            } else if ($row['priority'] == 2) {
                echo "<p class='priority'>!!</p>";
            } else {
                echo "<p class='priority'>!!!</p>";
            }
            echo "</div>";
            echo "</a>";
            // echo "</div>";
        };
        echo "</div>";
        mysqli_free_result($result);
    }
}

echo "</div>";
$mysqli->close();