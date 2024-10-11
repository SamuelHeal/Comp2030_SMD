<?php
require_once '../include/database.php';

if (isset($_POST['pin'])) {
    $pin = $_POST['pin'];
    $sql = 'SELECT pin FROM Person WHERE NOT isArchived;';
    $result = mysqli_query($conn, $sql);

    $isUnique = true;
    if ($result && mysqli_num_rows($result) > 0) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            if (password_verify($pin, $assoc['pin'])) {
                $isUnique = false;
                break;
            }
        }
    }
    mysqli_free_result($result);

    echo $isUnique ? 'true' : 'false';
    mysqli_close($conn);
}
?>