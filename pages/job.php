<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
    <script src="../scripts/delete-job.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/jobs.php';
        $isManager = false;
        if ($_SESSION['position'] == "Factory Manager") {
            $isManager = true;
        }
        $jobID = $_GET['id'];
        $machineID = $_GET['machineID'];
    ?>
    <div id=body-container>
        <?php 
        $job;
        if ($isManager) {
            $job = getJobManager($conn, $jobID);
        } else {
            $job = getJobOperator($conn, $jobID);
        }
        ?>
        <div class='header-container'>
            <?php echo "<h1> Job: " . $job['jobID'] . "</h1>"; ?>
            <div class='header-links'>
                <?php echo " <a href='jobs.php?machineID=" . $machineID . "'>Back</a>";
                if ($isManager) {
                    if ($job['completed'] == 0) {
                        if ($job['status'] == 'Completed') {
                            echo "<a href='javascript:;' onclick='deleteJob()'>Complete</a>";
                        } else {
                            echo "<a href='javascript:;' onclick='deleteJob()'>Delete</a>";
                        }
                    } else {
                        echo "<a href='javascript:;' onclick='restoreJob()'>Restore</a>";
                    }
                }
                ?>
            </div>
        </div>
        <div class='delete-job handle-job hide'>
            <?php
            if ($job['completed'] == 0) {
                if ($job['status'] == 'Completed') {
                echo "<h2>Are you sure you want to mark this job as complete?</h2>";
                } else {
                echo " <h2>Are you sure you want to delete this job?</h2>";
                }
            }
            ?>
            <div class='delete-buttons'>
                <a class='cancel-button' href='javascript:;' onclick='cancelDelete()'>No</a>
                <?php echo "<a class='delete-button' href='../system/delete-job.php?jobID=" . $jobID . "&machineID=" . $machineID . "'>Yes</a>"; ?>
            </div>
        </div>
        <div class='restore-job handle-job hide'>
            <h2>Are you sure you want to restore this job?</h2>
            <div class='delete-buttons'>
            <a class='cancel-button' href='javascript:;' onclick='cancelRestore()'>No</a>
            <?php echo "<a class='restore-button' href='../system/restore-job.php?jobID=" . $jobID . "&machineID=" . $machineID . "'>Yes</a>"; ?>
            </div>
        </div>
        <?php
        if ($isManager) {
            jobDetailsManager($conn, $jobID, $job);
        } else {
            jobDetailsOperator($jobID, $job);
        }
        ?>
        <div class='task-notes'>
            <div class='task-note-header'>
                <h3>Task Notes</h3>
            <?php echo "<a href='create-note.php?jobID=" . $jobID . "&machineID=" . $machineID . "'>Add Note</a>"; ?>
            </div>
        <div class='notes'>
            <?php getTaskNotes($conn, $jobID); ?>
        </div>
    </div>
</body>
</html>


