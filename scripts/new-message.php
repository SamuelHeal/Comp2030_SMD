<?php 
function appendPersonsToSelect($conn) {
    $sql = "SELECT personID, firstName, lastName FROM Person WHERE personID != {$_SESSION['id']};";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<option value="">Recipient</option>';
        while ($assoc = mysqli_fetch_assoc($result)) {
            echo "<option value={$assoc['personID']}>{$assoc['firstName']} {$assoc['lastName']}</option>";
        }
    }
    else {
        echo '<option value=0>No recipients found</option>';
    }
    mysqli_free_result($result);
}

function formatMessageAsReply($conn) {
    $name = getNameFromID($conn, $_GET['recipientID']);
    $subject = explode(' ', $_GET['subject'])[0] === 'Re:' ? $_GET['subject'] : "Re: {$_GET['subject']}";;
    echo '<script>';
        echo "formatMessageAsReply({$_GET['recipientID']}, \"$name\", \"$subject\");";
    echo '</script>';
}

function getNameFromID($conn, $id) {
    $sql = "SELECT firstName, lastName FROM Person WHERE personID = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $assoc = mysqli_fetch_assoc($result);
        $output = "{$assoc['firstName']} {$assoc['lastName']}";
    } 
    else {
        $output = 'Person could not be found. ';
        echo $output;
    }
    mysqli_free_result($result);
    return $output;
}