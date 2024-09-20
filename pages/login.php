<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/bad-pin.js" defer></script>
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/keypad.js" defer></script>
    <script src="../scripts/login.js"></script>
</head>
<body>
    <?php
        require_once '../include/functions.php';
        require_once '../include/database.php';
        redirectToDashboardIfLoggedIn();
    ?>
    <div id=header-container>
        <p id=header-message>Smart Manafacturing Dashboard</p>
    </div>
    <div id=body-container>
        <h1 id=login-title>Login</h1>
        <form id=login-container action="../system/login.php?machineID=<?php echo $_GET['machineID']?>" method="POST">
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
        checkMachineIdIsSet($conn);
        setBannerColourAndMessage($conn);
        setLoginTitle($conn);
        mysqli_close($conn);
    ?>
</body>
</html>
