<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Note | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/job-utils.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        $jobID = $_GET['jobID'];
        $machineID = $_GET['machineID'];
    ?>
    <div id=body-container>    
        <div class='header-container'>
            <h1>Create Task Note</h1>
            <div class='header-links'>
                <a href='javascript:;' onClick='cancelCreate()'>Cancel</a>
            </div>
        </div>

        <div id='cancel-create' class='handle-job hide'>
            <h2>Are you sure you want to cancel?</h2>
            <div class='delete-buttons'>
                <a class='cancel-button' href='javascript:;' onclick='cancelCancel()'>No</a>
                <?php echo "<a class='delete-button' href='../pages/job.php?id=" . $jobID . "&machineID=" . $machineID . "'>Yes</a>"; ?>
            </div>
        </div>
        
        <div class='create-job-form'>
            <?php echo "<form action='../system/create-note.php?jobID=" . $jobID . "&machineID=" . $machineID . "' method='POST'>"; ?>
                <div class='inner-job-form'>
                    <label for='category'>Category:</label> 
                    <div class='select-dropdown'>
                        <select id='category' name='category' required>
                            <option value='Missing part'>Missing part</option>
                            <option value='Awaiting part'>Awaiting part</option>
                            <option value='Machine issue'>Machine issue</option>
                            <option value='Quality concern'>Quality concern</option>
                            <option value='Issue with job details'>Issue with job details</option>
                            <option value='Safety concern'>Safety concern</option>
                            <option value='Other'>Other</option>
                        </select>
                    </div>
                    <label for='priority'>Priority:</label>
                    <div class='select-dropdown note-priority'>
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
