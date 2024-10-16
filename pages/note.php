<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobs | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/jobs.php';
        $note = getNote($conn);
    ?>
    <div id=body-container>
        <div class='header-container'>
            <?php echo "<h1>Note for Job " . $note['jobID'] . "</h1>" ?>
            <div class='header-links'>
                <?php echo "<a href='job.php?id=" . $note['jobID'] . "&machineID=" . $_GET['machineID'] . "'>Back</a>"; ?>
            </div>
        </div>
        <div class='note-container'>
            <div class='note-header'>
                <h3>Category:</h3>
                <?php echo "<p>" . $note['category'] . "</p>"; ?>
                <h3>Time Created:</h3>
                <?php echo "<p>" . $note['timeCreated'] . "</p>"; ?>
                <h3>Priority:</h3>
                <p>
                <?php
                if ($note['priority'] == 1) {
                    echo "Low";
                } else if ($note['priority'] == 2) {
                    echo "Medium";
                } else {
                    echo "High";
                }
                ?>
                </p>
            </div>
            <div class='note-description'>
                <h3>Created by:</h3>
                <?php echo "<p>" . $note['firstname'] . " " . $note['lastname'] . "</p>"; ?>
                <h3>Description:</h3>
                <?php echo "<p class='description'>" . $note['description'] . "</p>"; ?>
            </div>
        </div>
</body>
</html>
