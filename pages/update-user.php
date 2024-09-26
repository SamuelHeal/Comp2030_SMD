<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/manage-user.js"></script>
</head>

<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/manage.php';

        // Get user details
        $personID = isset($_GET['personID']) ? $_GET['personID'] : '';
        $sql = "SELECT * FROM Person WHERE personID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $personID);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
    ?>

    <div id="body-container">
    <div class="header-container">
        <h1>Update <?php if($user['isArchived']) echo 'Archived ';
         echo htmlspecialchars("User {$user['firstName']} {$user['lastName']} ({$user['personID']})") ?></h1>

        <div class="top-layer-buttons">
            <?php $machineID = isset($_GET['machineID']) ? $_GET['machineID'] : ''; //keep the same machineID?>
            <button class="top-button" onclick="window.location.href='manage.php?machineID=<?php echo htmlspecialchars($machineID); ?>'">Cancel</button>
        </div>
    </div>

    <div class="form-container">

        <form class="user-details-form" action="../system/update-user.php" method="POST">
            <input type="hidden" name="personID" value="<?php echo htmlspecialchars($user['personID']); ?>" />
            <input type="hidden" name="machineID" value="<?php echo htmlspecialchars($machineID); ?>" />
            <div id="firstname-input">
            <label class="user-details-form-label" for="firstname">First Name:</label> 
            <input class="user-details-form-input" id="firstname" name="firstname" type="text" value="<?php echo htmlspecialchars($user['firstName']); ?>" required/>
            </div>
            <div id="lastname-input">
            <label class="user-details-form-label" for="lastname">Last Name:</label>
            <input class="user-details-form-input" id="lastname" name="lastname" type="text" value="<?php echo htmlspecialchars($user['lastName']); ?>" required/>
            </div>
            <div id="dob-input">
            <label class="user-details-form-label" for="dob">Date of Birth:</label>
            <input class="user-details-form-input" id="dob" name="dob" type="date" value="<?php echo htmlspecialchars($user['DOB']); ?>" required/>
            </div>
            <div id="position-input">
            <label class="user-details-form-label" for="position">Position:</label>
            <select class="user-details-form-input" id="position" name="position" required>
                <option value="" disabled hidden>Please Select</option>
                <option value="Production Operator" <?php if ($user['position'] == 'Production Operator') echo 'selected'; ?>>Production Operator</option>
                <option value="Factory Manager" <?php if ($user['position'] == 'Factory Manager') echo 'selected'; ?>>Factory Manager</option>
                <option value="Administrator" <?php if ($user['position'] == 'Administrator') echo 'selected'; ?>>Administrator</option>
                <option value="Auditor" <?php if ($user['position'] == 'Auditor') echo 'selected'; ?>>Auditor</option>
            </select>
            </div>
            <div id="phonenumber-input">
            <label class="user-details-form-label" for="phonenumber">Phone Number:</label>
            <input class="user-details-form-input" id="phonenumber" name="phonenumber" type="text" value="<?php echo htmlspecialchars($user['phoneNumber']); ?>" required/>
            </div>
            <div id="email-input">
            <label class="user-details-form-label" for="email">Email:</label>
            <input class="user-details-form-input" id="email" name="email" type="email" value="<?php echo htmlspecialchars($user['email']); ?>" required/>
            </div>
            <div id="employmentdate-input">
            <label class="user-details-form-label" for="employmentdate">Employment Date:</label>
            <input class="user-details-form-input" id="employmentdate" name="employmentdate" type="date" value="<?php echo htmlspecialchars($user['employmentDate']); ?>" required/>
            </div>

            <div id="pin-buttons-input">
            
            <div id="reset-button-input" style="display: flex;">
            <button type="button" id="resetPinButton" onclick="showPinFields()">Reset PIN</button> 
            </div>
                <!-- Hidden unless the reset pin button is clicked -->
                <div id="pin-input" style="display: none;">
                <label class="user-details-form-label" for="pin" >New PIN:</label>
                <input class="user-details-form-input" id="pin" name="pin" type="text" pattern="\d{4}" title="Please enter a 4-digit PIN" />
                </div>
                <div id="generate-button-input" style="display: none;">
                <button id="generate-pin-button" type="button" onclick="generatePin()">Generate New PIN</button>
                </div>           

            <div id="register-button-input">
            <input id="register-button" name="update" type="submit" value="Update" />
            </div>
            </div>
            
        </form>
    </div>
    </div>
</body>
</html>