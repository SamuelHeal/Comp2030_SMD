<!DOCTYPE html>
<html lang="en">
<head>
    <title>Factory | SMD</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/banner.js"></script>
</head>
<body>
    <?php
        require_once '../include/page-defaults.php';
        require_once '../scripts/factory.php';
        // mysqli_close($conn);
    ?>
    <div id=body-container-small>
        <h1>Factory Performance</h1>
        <?php 
            $sql = "SELECT * FROM Machine ORDER BY machineID;";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result)) {
                echo '<ul class=listSmall>';
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
