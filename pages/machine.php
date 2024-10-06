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
            <?php echoFormTag(); ?>
            <div class="machine-input-group">
                <label for="name">Name:</label><br>
                <input class="machine-input clickable" id="machine-input-name" name="name" placeholder="New Machine" required type="text">
            </div>
            <div class="machine-input-group">
                <label for="status">Staus:</label><br>
                <select class="machine-input clickable" id=machine-select-status required name="status">
                    <option value=0>Idle</option>
                    <option value=1>Active</option>
                    <option value=2>Maintenance</option>
                </select>
            </div>
            <div class="machine-input-group">
                <label for="location">Location:</label><br>
                <input class="machine-input clickable" id="machine-input-location" name="location" placeholder="New Location" required type="text">
            </div>
            <div class="machine-input-group">
                <label for="operator">Assigned Operator:</label><br>
                <select class="machine-input clickable" id=machine-select-operator name="operator">
                    <?php appendOperatorsToSelect($conn); ?>
                </select>
            </div>
        </form>
        <div id="machines-button-container">
            <?php
                echoBackButton(); 
                echoArchiveButton(); 
            ?>
            <button class="machines-button green-hover" id="machine-button-submit" onclick="submitForm();">✓</button>
        </div>
        <?php
            $machine = getMachine($conn);
            disableEdittingIfArchived();
            hideArchiveIfCreatingMachine();
            setPageValues($machine);
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
