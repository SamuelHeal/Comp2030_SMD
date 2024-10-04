<?php 
function appendOperatorsToSelect($conn) {
    $sql = "SELECT personID, firstName, lastName FROM Person WHERE position = \"Production Operator\" AND isArchived = 0 ORDER BY lastname;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<option value="">Operator</option>';
        while ($assoc = mysqli_fetch_assoc($result)) {
            echo "<option value={$assoc['personID']}>{$assoc['firstName']} {$assoc['lastName']}</option>";
        }
    } else {
        echo '<option value=0>No operators found</option>';
    }
    mysqli_free_result($result);
}

function getMachine($conn) {
    $output = array();
    $sql = "SELECT * FROM Machine WHERE machineID = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $id = htmlspecialchars($_GET['update_id']);
    mysqli_stmt_execute($stmt);
    if ($result = mysqli_stmt_get_result($stmt)) {
        $output = mysqli_fetch_assoc($result);
    } else {
        $output = array(
            'name' => 'New Machine',
            'operator' => '',
            'location' => 'New Location',
            'status' => 2
        );
    }
    mysqli_stmt_close($stmt);
    return $output;
}

function makeEditableIfParameterPresent() {
    if (isset($_GET['edit'])) {
        echo '<script>';
        if ($_SESSION['position'] === 'Factory Manager') {
            echo 'makeNameLocationOperatorEditable();';
        }
            echo 'makeStatusEditable();';
            echo 'changeButtons();';
        echo '</script>';
    }
}

function setPageValues($machine) {
    echo '<script>';
    echo "document.getElementById(\"machine-heading\").innerText = \"{$machine['name']}\";";
        echo "document.getElementById(\"machine-input-name\").value = \"{$machine['name']}\";";
        echo "document.getElementById(\"machine-select-status\").selectedIndex = \"{$machine['status']}\";";
        echo "document.getElementById(\"machine-input-location\").value = \"{$machine['location']}\";";
        // echo "document.getElementById(\"machine-select-operator\").selectedIndex = \"{$machine['operator']}\";";
    echo '</script>';
}
