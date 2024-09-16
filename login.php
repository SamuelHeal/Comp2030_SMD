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
        session_start();
        if (isset($_SESSION['position'])) {
            header('location: '.$_SESSION['home']);
        }
        else {
            session_destroy();
        }
    ?>
    <h1>Login</h1>
    <form action="loginsystem.php" method="POST">
        <label for="pin">Pin:</label> <input id="pin" name="pin" required type="text" />
        <input name="login" type="submit" value="Login" />
    </form>

</body>
</html>
