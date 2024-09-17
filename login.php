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
    <div id=header-container>
        <p id=login-message>Smart Manafacturing Dashboard</p>
    </div>
    <div id=body-container>
        <h1>Login</h1>
        <div id=login-container>
            <form action="loginsystem.php" method="POST">
                <input id="pin" name="pin" required type="text" placeholder="Enter PIN"/>
                <br>
                <input id=login-button name="login" type="submit" value="Submit"/>
            </form>
        </div>
    </div>
</body>
</html>
