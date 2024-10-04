<!DOCTYPE html>
<html lang="en">
<head>
    <title>Machines | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/machines.php';
    ?>
    <div id=body-container>
        <h1>Machines</h1>
        <div id="machines-button-container">
            <a class="machines-button red-hover" href="messages.php?machineID=<?php $_GET['machineID'] ?>">Delete All Machines</a>
            <a class="machines-button" href="messages.php?machineID=<?php $_GET['machineID'] ?>">Create New Machine</a>
        </div>
        <?php 
            hideButtonsIfOperator();
            $sql = "SELECT * FROM Machine ORDER BY name;";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                echo '<ul class=list>';
                while ($assoc = mysqli_fetch_assoc($result)) {
                    appendMachineToList($assoc);
                }
                echo '</ul>';
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
