<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="styles\style.css">
    <script src="scripts\keypad.js" defer></script>
    <script src="scripts\banner.js"></script>
</head>
<body>
    <?php
        require_once 'inc\functions.php';
        require_once 'inc\dbconn.inc.php';
        redirectToDashboardIfLoggedIn();
    ?>
    <div id=header-container>
        <p id=header-message>Smart Manafacturing Dashboard</p>
    </div>
    <div id=body-container>
        <h1 id=login-title>Login</h1>
        <form id=login-container action="loginsystem.php" method="POST">
            <input id="login-field" name="pin" type="password" placeholder="Enter PIN" required/>
            <div id="keypad-1">1</div>
            <div id="keypad-2">2</div>
            <div id="keypad-3">3</div>
            <div id="keypad-4">4</div>
            <div id="keypad-5">5</div>
            <div id="keypad-6">6</div>
            <div id="keypad-7">7</div>
            <div id="keypad-8">8</div>
            <div id="keypad-9">9</div>
            <div id="keypad-clear">✕</div>
            <div id="keypad-0">0</div>
            <input id="keypad-submit" name="login" type="submit" value="✓"/>
        </form>
    </div>
    <?php
        setLoginPageElements($conn);
        mysqli_close($conn);
    ?>
</body>
</html>
