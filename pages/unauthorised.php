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
    ?>
    <div id=header-container>
        <p id=header-message>Smart Manafacturing Dashboard</p>
    </div>
    <div id=body-container>
        <h1>Unauthorised</h1>
        <div id=unauthorised-container>
            <p>You do not have the correct permissions to access this page.</p>
            <?php setUnauthorisedButton(); ?>
        </div>
    </div>
    <?php 
        setBannerColourAndMessage($conn);
        mysqli_close($conn);
    ?>
</body>
</html>
