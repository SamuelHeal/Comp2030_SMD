<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="..\styles\style.css">
    <script src="..\scripts\banner.js"></script>
</head>
<body>
    <?php
        require_once '..\\include\functions.php';
        require_once '..\\include\database.php';
        require_once '..\\include\check-authorisation.php';
        require_once '..\\include\menu.php';
        setBannerColour($conn);
    ?>
    <div id="body-container">
        <h1>Users</h1>
        <?php 
            $sql = "SELECT * FROM Person ORDER BY lastName;";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                echo '<ul class=list>';
                while ($row = mysqli_fetch_assoc($result)) {
                    appendUserToList($row);
                }
                echo '</ul>';
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
