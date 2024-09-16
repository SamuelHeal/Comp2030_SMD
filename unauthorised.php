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
    <h3>You do not have the correct permissions to access this page</h3>
    <?php 
        session_start();
        if (isset($_SESSION['home'])) {
            echo '<a href="'.$_SESSION['home'].'">Home</a>';
        }
        else {
            echo '<a href="login.php">Login</a>';
            session_destroy();
        }
    ?>
    
</body>
</html>
