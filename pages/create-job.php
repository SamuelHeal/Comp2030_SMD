<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Job | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
<?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/jobs/jobs.php';
    ?>
    <div id=body-container>
    
        <div class='header-container'>
            <h1>Create Job</h1>
            <div class='header-links'>
                <?php echo "<a href='jobs.php?machineID=" . $_GET['machineID'] . "'>Cancel</a>"; ?>
            </div>
        </div>

        <div class='create-job-form'>
            <?php echo "<form action='../system/create-job.php?machineID=" . $_GET['machineID'] . "' method='POST'>"; ?>
                <div class='inner-job-form'>
                    <label for='machine'>Machine:</label> 
                    <div class='select-dropdown'>
                        <select id='machine' name='machine' required>
                            <?php getMachinesForJob($conn); ?>
                        </select>
                    </div>
                    <label for='operator'>Operator:</label>
                    <div class='select-dropdown'>
                        <select id='operator' name='operator' required>
                            <?php getOperatorsForJob($conn); ?>
                        </select>
                    </div>
                    <label for='priority'>Priority:</label>
                    <div class='select-dropdown'>
                        <select id='priority' name='priority' required>
                            <option value='1'>Low</option>
                            <option value='2'>Medium</option>
                            <option value='3'>High</option>
                        </select>
                    </div>
                </div>
                <div class='inner-job-form'>
                    <label for='description'>Description:</label>
                    <textarea id='description' name='description' required></textarea>
                    <input name='submit' type='submit' value='Submit' />
                </div>
            </form>
        </div>
    </div>
</body>
</html>
