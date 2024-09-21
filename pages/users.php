<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/users.php';
    ?>
    <div id="body-container">
        <h1>Users</h1>
        <?php 
            $sql = "SELECT * FROM Person ORDER BY lastName;";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                echo '<ul class=list>';
                while ($assoc = mysqli_fetch_assoc($result)) {
                    appendUserToList($assoc);
                }
                echo '</ul>';
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
