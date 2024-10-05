<?php 
function appendOperatorsToSelect($conn) {
    $sql = "SELECT personID, firstName, lastName FROM Person WHERE position = \"Production Operator\" AND isArchived = 0 ORDER BY lastname;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<option value="">Vacant</option>';
        while ($assoc = mysqli_fetch_assoc($result)) {
            echo "<option value={$assoc['personID']}>{$assoc['firstName']} {$assoc['lastName']}</option>";
        }
    } else {
        echo '<option value="">No operators found</option>';
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
    if ($id) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $output = mysqli_fetch_assoc($result);
    } else {
        $output = array(
            'name' => '',
            'operatorID' => "",
            'location' => '',
            'status' => 2
        );
    }
    mysqli_stmt_close($stmt);
    return $output;
}

function hideArchiveIfCreatingMachine() {
    if (!$_GET['update_id']) {
        echo '<script>';
            echo 'document.getElementById("machine-button-archive").style.display = "none";';
        echo '</script>';
    }
}

function setPageValues($machine) {
    $heading = isset($machine) && $machine['name'] ? $machine['name'] : 'New Machine';
    echo '<script>';
        echo 'const SELECT_OPERATOR = document.getElementById("machine-select-operator");';
        echo "document.getElementById(\"machine-heading\").innerText = \"$heading\";";
        echo "document.getElementById(\"machine-input-name\").value = \"{$machine['name']}\";";
        echo "document.getElementById(\"machine-select-status\").selectedIndex = \"{$machine['status']}\";";
        echo "document.getElementById(\"machine-input-location\").value = \"{$machine['location']}\";";
        echo "const OPERATOR_OPTION = [...SELECT_OPERATOR.options].filter((option)=> option.value === \"{$machine['operatorID']}\");";
        echo "SELECT_OPERATOR.selectedIndex = OPERATOR_OPTION.length ? OPERATOR_OPTION[0].index : 0;";
    echo '</script>';
}
