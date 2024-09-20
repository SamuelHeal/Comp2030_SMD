<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobs | SMD</title>
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
        checkMachineIdIsSet($conn);
        require_once '..\\include\menu.php';
        setBannerColour($conn);
        mysqli_close($conn);
    ?>
    <div id=body-container>
        <h1>Current Jobs</h1>
    </div>
</body>
</html>
