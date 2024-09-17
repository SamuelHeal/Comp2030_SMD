<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="styles\style.css">
    <script src="scripts/script.js" defer></script>
</head>
<body>
    <?php
        require_once "inc/dbconn.inc.php";
        require_once "inc/check-authorisation.php";
        require_once "inc/menu.php";
        // mysqli_close($conn);
    ?>
    <div id="body-container">
        <h1>Users</h1>
        <?php 
            $sql = "SELECT * FROM Person ORDER BY lastName;";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<ul>';
                        echo '<li>';
                            echo '<div>'.$row['firstName'].' '.$row['lastName'].'</div>';
                            echo '<table>';
                                echo '<tr>';
                                    echo '<td>Position: '.$row['position'].'</td>';
                                    echo '<td>User ID: '.$row['personID'].'</td>';
                                echo '</tr>';
                                echo '<tr>';
                                    echo '<td>Phone: '.$row['phoneNumber'].'</td>';
                                    echo '<td>Email: '.$row['email'].'</td>';
                                echo '</tr>';
                                echo '<tr>';
                                    echo '<td>DOB: '.$row['DOB'].'</td>';
                                    echo '<td>Start Date: '.$row['employmentDate'].'</td>';
                                echo '</tr>';
                            echo '</table>';
                        echo '</li>';
                    echo '</ul>';
                }
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
