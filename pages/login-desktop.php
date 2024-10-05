
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <?php
        require_once '../include/utilities.php';
        require_once '../include/database.php';
        require_once '../scripts/login.php';
        redirectToDashboardIfLoggedIn();
        redirectToMachine();
        checkMachineIdIsSet($conn);
        ?>

    <div id="body-container">
        <div class="desktop-login-container">
            <h1>Smart Manufacturing Dashboard</h1>
            <div class="login-form-container">
                <h2>Login</h2>
                <p>Please enter your staff PIN:</p>
                <form action="../system/login.php?machineID=<?php echo $_GET['machineID']?>" method="POST">
                    <div>
                        <input class='pin-input-field' name='pin-1' type="password" maxlength=1 id="1" onkeyup="moveToNext(this,'2')" />
                        <input class='pin-input-field' name='pin-2' type="password" maxlength=1 id="2" onkeyup="moveToNext(this,'3')" />
                        <input class='pin-input-field' name='pin-3' type="password" maxlength=1 id="3" onkeyup="moveToNext(this,'4')" />
                        <input class='pin-input-field' name='pin-4' type="password" maxlength=1 id="4" />
                    </div>
                    <div class="login-button-container">
                        <button class="login-desktop-button" onclick="clearPin()">Clear</button>
                        <input class="login-desktop-button" name="login" type="submit" value="Login" />
                    </div>
                </form>
            </div>
        </div>

        <script src="../scripts/login-desktop.js"></script>

</body>
</html>
