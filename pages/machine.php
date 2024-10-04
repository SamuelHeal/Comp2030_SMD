<!DOCTYPE html>
<html lang="en">
<head>
    <title>Machine | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/machine.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/machine.php';        
    ?>
    <div id=body-container>
        <h1 id="machine-heading">Machine</h1>
        <form action="../system/machine.php?<?php echo "machineID={$_GET['machineID']}&update_id={$_GET['update_id']}"; ?>" id="machine-container" method="POST" name="machine-form">
            <div class="machine-input-group">
                <label for="name">Name:</label><br>
                <input class="machine-input" disabled="true" id="machine-input-name" name="name" type="text">
            </div>
            <div class="machine-input-group">
                <label for="status">Staus:</label><br>
                <select class="machine-input" disabled="true" id=machine-select-status name="status">
                    <option id=0>Idle</option>
                    <option id=1>Active</option>
                    <option id=2>Maintenance</option>
                </select>
            </div>
            <div class="machine-input-group">
                <label for="location">Location:</label><br>
                <input class="machine-input" disabled="true" id="machine-input-location" name="location" type="text">
            </div>
            <div class="machine-input-group">
                <label for="operator">Assigned Operator:</label><br>
                <select class="machine-input" disabled="true" id=machine-select-operator name="operator">
                    <?php appendOperatorsToSelect($conn); ?>
                </select>
            </div>
        </form>
        <div id="machines-button-container">
            <a class="machines-button" href="machines.php?machineID=<?php echo $_GET['machineID']; ?>" id="machine-button-back">Back</a>    
            <a class="machines-button red-hover" href="messages.php?machineID=<?php $_GET['machineID']; ?>">Delete</a>
            <a class="machines-button" href="machine.php?<?php echo "machineID={$_GET['machineID']}&update_id={$_GET['update_id']}&active=1&edit=1"; ?>" id="machine-button-edit">Edit</a>
        </div>
        <?php
            makeEditableIfParameterPresent();
            $machine = getMachine($conn);
            setPageValues($machine);
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
