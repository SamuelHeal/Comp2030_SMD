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
    <?php
        require_once "inc/dbconn.inc.php";
        require_once "inc/check-authorisation.php";
        require_once "inc/menu.php";
        mysqli_close($conn);
    ?>
    <div id=body-container>
        <h1>Manage</h1>
    </div>
</body>
</html>
