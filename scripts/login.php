<?php 
function setLoginTitle($conn) {
    $sql = "SELECT name FROM Machine WHERE machineID = {$_GET['machineID']};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
        echo '<script>';
            echo "setLoginTitle(\"{$assoc['name']}\");";
        echo '</script>';
    }
    mysqli_free_result($result);
}
