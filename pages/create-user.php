<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create User | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/manage-user.js"></script>
</head>

<body>
    <?php
        require_once '../include/page-defaults.php';
    ?>

    <div id="body-container">
    <div class="header-container">
        <h1>Create User</h1>

        <div class="top-layer-buttons">
            <?php $machineID = isset($_GET['machineID']) ? $_GET['machineID'] : ''; //keep the same machineID?>
            <button class="top-button" onclick="window.location.href='manage.php?machineID=<?php echo htmlspecialchars($machineID); ?>'">Cancel</button>
        </div>
    </div>
    <div class="form-container">

        <form class="user-details-form" action="../system/create-user.php" method="POST">
        <input type="hidden" name="machineID" value="<?php echo htmlspecialchars($machineID); ?>" />
            <div id="firstname-input">
            <label class="user-details-form-label" for="firstname">First Name:</label> 
            <input class="user-details-form-input" id="firstname" name="firstname" type="text" required/>
            </div>
            <div id="lastname-input">
            <label class="user-details-form-label" for="lastname">Last Name:</label>
            <input class="user-details-form-input" id="lastname" name="lastname" type="text" required/>
            </div>
            <div id="dob-input">
            <label class="user-details-form-label" for="dob">Date of Birth:</label>
            <input class="user-details-form-input" id="dob" name="dob" type="date" required/>
            </div>
            <div id="position-input">
            <label class="user-details-form-label" for="position">Position:</label>
            <select class="user-details-form-input" id="position" name="position" required>
                <option value="" selected disabled hidden>Please Select</option>
                <option value="Production Operator">Production Operator</option>
                <option value="Factory Manager">Factory Manager</option>
                <option value="Administrator">Administrator</option>
                <option value="Auditor">Auditor</option>
            </select>
            </div>
            <div id="phonenumber-input">
            <label class="user-details-form-label" for="phonenumber">Phone Number:</label>
            <input class="user-details-form-input" id="phonenumber" name="phonenumber" type="text" required/>
            </div>
            <div id="email-input">
            <label class="user-details-form-label" for="email">Email:</label>
            <input class="user-details-form-input" id="email" name="email" type="email" required/>
            </div>
            <div id="employmentdate-input">
            <label class="user-details-form-label" for="employmentdate">Employment Date:</label>
            <input class="user-details-form-input" id="employmentdate" name="employmentdate" type="date" required/>
            </div>
            <div id="pin-buttons-input">
            <div id="pin-input">
            <label class="user-details-form-label" for="pin">User PIN:</label>
            <input class="user-details-form-input" id="pin" name="pin" type="text" title="Please enter a 4-digit PIN" required/>
            </div>
            <div id="generate-button-input">
            <button id="generate-pin-button" type="button" onclick="generatePin()">Generate PIN</button>
            </div>

            <div id="register-button-input">
            <input class="user-details-form-input" id="register-button" name="register" type="submit" value="Register" />
            </div>
            
            </div>

        </form>
    </div>
    </div>
</body>
</html>