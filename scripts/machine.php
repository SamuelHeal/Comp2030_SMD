<?php 
function appendOperatorsToSelect($conn) {
    $sql = "SELECT personID, firstName, lastName FROM Person WHERE position = \"Production Operator\" AND isArchived = 0 ORDER BY lastname;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<option value="0">Vacant</option>';
        while ($assoc = mysqli_fetch_assoc($result)) {
            echo "<option value={$assoc['personID']}>{$assoc['firstName']} {$assoc['lastName']}</option>";
        }
    } else {
        echo '<option value="0">No operators found</option>';
    }
    mysqli_free_result($result);
}

function disableEdittingIfArchived() {
    if (isset($_GET['show_archived'])) {
        echo '<script>';
            echo 'disableEditing();';
        echo '</script>';
    }
}

function echoArchiveButton() {
    $update_id = htmlspecialchars($_GET['update_id']);
    if (isset($_GET['show_archived'])) {
        $class = 'machines-button';
        $href = "../system/restore-machine.php?machineID={$_GET['machineID']}&restore_id=$update_id";;
        $label = 'Restore';
        $onclick = "return confirm('Are you sure you want to restore this machine?');";    
    } else {
        $class = 'machines-button red-hover';
        $href = "../system/archive-machine.php?machineID={$_GET['machineID']}&archive_id=$update_id";
        $label = 'Archive';
        $onclick = "return confirm('Are you sure you want to archive this machine?');";    
    }
    echo "<a class=\"$class\" href=\"$href\" id=\"machine-button-archive\" onclick=\"$onclick\">$label</a>";
}

function echoBackButton() {
    $onclick = "return confirm('Are you sure you want to leave this page?');";
    $show_parameter = isset($_GET['show_archived']) ? 'show_archived=1' : 'show_current=1';
    echo "<a class=\"machines-button\" href=\"machines.php?machineID={$_GET['machineID']}&$show_parameter\" id=\"machine-button-back\" onclick=\"$onclick\">Back</a>";
}

function echoFormTag() {
    $update_id = htmlspecialchars($_GET['update_id']);
    $show_parameter = isset($_GET['show_archived']) ? 'show_archived=1' : 'show_current=1';
    echo "<form action=\"../system/machine.php?machineID={$_GET['machineID']}&$show_parameter&update_id=$update_id\" id=\"machine-form\" method=\"POST\" name=\"machine-form\">";
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
            'assignedOperator' => 0,
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
        echo "const OPERATOR_OPTION = [...SELECT_OPERATOR.options].filter((option)=> option.value === \"{$machine['assignedOperator']}\");";
        echo "SELECT_OPERATOR.selectedIndex = OPERATOR_OPTION.length ? OPERATOR_OPTION[0].index : 0;";
    echo '</script>';
}
