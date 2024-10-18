<?php 
function appendLogToTable($assoc) {
    echo '<tr>';
        echo "<td>{$assoc['timestamp']}</td>";
        echo "<td>{$assoc['name']}</td>";
        echo "<td>{$assoc['operationalStatus']}</td>";
        echo "<td>{$assoc['maintenanceLog']}</td>";
        echo "<td>{$assoc['errorCode']}</td>";
        echo "<td>{$assoc['productionCount']}</td>";
        echo "<td>{$assoc['humidity']}</td>";
        echo "<td>{$assoc['powerConsumption']}</td>";
        echo "<td>{$assoc['pressure']}</td>";
        echo "<td>{$assoc['speed']}</td>";
        echo "<td>{$assoc['temperature']}</td>";
        echo "<td>{$assoc['vibration']}</td>";
    echo '</tr>';
} 

function appendMachinesToSelect($conn) {
    $sql = "SELECT machineID, name FROM Machine WHERE isArchived = 0;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        echo '<option value="0">Select a machine</option>';
        while ($assoc = mysqli_fetch_assoc($result)) {
            echo "<option value =\"{$assoc['machineID']}\">{$assoc['name']}</option>";
        }
    }
    else {
        echo '<option>No machines to display</option>';
    }
    mysqli_free_result($result);
}

function appendSummaryRow() {
    echo '<tr id="reports-summary">';
        echo '<td id="reports-summary-timestamp"></td>';
        echo '<td id="reports-summary-name"></td>';
        echo '<td id="reports-summary-operationalStatus"></td>';
        echo '<td id="reports-summary-maintenanceLog"></td>';
        echo '<td id="reports-summary-errorCode"></td>';
        echo '<td id="reports-summary-productionCount"></td>';
        echo '<td id="reports-summary-humidity"></td>';
        echo '<td id="reports-summary-powerConsumption"></td>';
        echo '<td id="reports-summary-pressure"></td>';
        echo '<td id="reports-summary-speed"></td>';
        echo '<td id="reports-summary-temperature"></td>';
        echo '<td id="reports-summary-vibration"></td>';
    echo '</tr>';
}

function createSummaryAssoc($start, $end) {
    return array(
        'number_of_rows' => 0,
        'number_of_speed_rows' => 1,
        'timestamp' => date_interval_format(date_diff(new DateTimeImmutable($end), new DateTimeImmutable($start)), '%a days'), // Difference
        'name' => '',
        'operationalStatus' => 0,  // Count maintenance
        'maintenanceLog' => array(),
        'errorCode' => array(),
        'productionCount' => 0,  // Sum 
        'humidity' => 0,  // Average
        'powerConsumption' => 0,  // Sum
        'pressure' => 0,  // Average
        'speed' => 0,  // Average
        'temperature' => 0,  // Average
        'vibration' => 0  // Average
    );
}

function getLogs($conn) {
    $machine_assoc = getMachineNames($conn);
    $start = isset($_GET['start']) ? $_GET['start'] : '2024-06-30 00:00';
    $end = isset($_GET['end']) ? $_GET['end'] :'2024-06-30 23:30';
    $machine = (isset($_GET['machine']) && $_GET['machine']) ? $_GET['machine'] : 'machineID';
    $sql = "SELECT * FROM Log WHERE timestamp >= \"$start\" AND timestamp <= \"$end\" AND machineID = $machine;";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        $summary_assoc = createSummaryAssoc($start, $end);
        appendSummaryRow();
        while ($assoc = mysqli_fetch_assoc($result)) {
            $assoc['name'] = $machine_assoc[$assoc['machineID']];
            updateSummaryRow($assoc, $summary_assoc);
            appendLogToTable($assoc);
        }
        setSummaryRow($summary_assoc);
    }
    else {
        echo '<tr><td>No results</td></tr>';
    }
    mysqli_free_result($result);
}

function getMachineNames($conn) {
    $machine_assoc = array();
    $sql = 'SELECT machineID, name FROM Machine;';
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result)) {
        while ($assoc = mysqli_fetch_assoc($result)) {
            $machine_assoc[$assoc['machineID']] = $assoc['name'];
        }
    }
    else {
        echo 'Unable to get machine names from the database. ';
    }
    mysqli_free_result($result);
    return $machine_assoc;
}

function setMutliLineTableData($suffix, $assoc) {
    echo "table_data = document.getElementById(\"reports-summary-$suffix\");";
    if (sizeof($assoc)) {
        $keys = array_keys($assoc);
        echo 'paragraph;';
        for ($i = 0; $i < sizeof($keys)-1; $i++) {
            echo 'paragraph = document.createElement("p");';
            echo "paragraph.innerText = \"{$assoc[$keys[$i]]}× {$keys[$i]},\";";
            echo 'table_data.appendChild(paragraph);';
        }
        echo 'paragraph = document.createElement("p");';
        echo "paragraph.innerText = \"{$assoc[$keys[sizeof($keys)-1]]}× {$keys[sizeof($keys)-1]}\";";
        echo 'table_data.appendChild(paragraph);';
    } else {
        $message = $suffix === 'maintenanceLog' ? 'logs' : 'error';
        echo 'paragraph = document.createElement("p");';
        echo "paragraph.innerText = \"0× $message\";";
        echo 'table_data.appendChild(paragraph);';
    }
}

function setSummaryRow($assoc) {
    $number_of_rows = number_format($assoc['number_of_rows']);
    $production_count = number_format($assoc['productionCount']);
    $number_of_maintenance = number_format($assoc['operationalStatus']);
    $power = round($assoc['powerConsumption']/1000, 2);
    $humidity = round($assoc['humidity']/$assoc['number_of_rows'], 2);
    $speed = round($assoc['speed']/$assoc['number_of_speed_rows'], 2);
    $pressure = round($assoc['pressure']/$assoc['number_of_rows'], 2);
    $vibration = round($assoc['vibration']/$assoc['number_of_rows'], 2);
    $temperature = round($assoc['temperature']/$assoc['number_of_rows'], 2);
    echo '<script>';
        echo 'let table_data;';
        echo 'let paragraph;';
        echo "document.getElementById(\"reports-summary-timestamp\").innerText = \"{$assoc['timestamp']}\";";
        echo "document.getElementById(\"reports-summary-name\").innerText = \"$number_of_rows instances\";";
        echo "document.getElementById(\"reports-summary-operationalStatus\").innerText = \"{$number_of_maintenance}× down\";";
        setMutliLineTableData('maintenanceLog', $assoc['maintenanceLog']);
        setMutliLineTableData('errorCode', $assoc['errorCode']);
        echo "document.getElementById(\"reports-summary-productionCount\").innerText = \"$production_count total\";";
        echo "document.getElementById(\"reports-summary-humidity\").innerText = \"{$humidity}% average\";";
        echo "document.getElementById(\"reports-summary-powerConsumption\").innerText = \"{$power}kW total\";";
        echo "document.getElementById(\"reports-summary-pressure\").innerText = \"{$pressure}Pa average\";";
        echo "document.getElementById(\"reports-summary-speed\").innerText = \"{$speed}mm/s average\";";
        echo "document.getElementById(\"reports-summary-temperature\").innerText = \"{$temperature}°C average\";";
        echo "document.getElementById(\"reports-summary-vibration\").innerText = \"{$vibration}mm/s average\";";
    echo '</script>';
}

function updateSummaryRow($assoc, &$summary) {
    $summary['number_of_rows']++;
    $summary['operationalStatus'] += $assoc['operationalStatus'] === 'maintenance' ? 1 : 0;
    if ($assoc['maintenanceLog']) {
        if (isset($summary['maintenanceLog'][$assoc['maintenanceLog']])) {
            $summary['maintenanceLog'][$assoc['maintenanceLog']]++;
        } else {
            $summary['maintenanceLog'][$assoc['maintenanceLog']] = 1;
        }
    }
    if ($assoc['errorCode']) {
        if (isset($summary['errorCode'][$assoc['errorCode']])) {
            $summary['errorCode'][$assoc['errorCode']]++;
        } else {
            $summary['errorCode'][$assoc['errorCode']] = 1;
        }
    }
    $summary['productionCount'] += $assoc['productionCount'];
    $summary['humidity'] += $assoc['humidity'];
    $summary['powerConsumption'] += $assoc['powerConsumption'];
    $summary['pressure'] += $assoc['pressure'];
    if ($assoc['speed']) {
        $summary['number_of_speed_rows']++;
        $summary['speed'] += $assoc['speed'];
    }
    $summary['temperature'] += $assoc['temperature'];
    $summary['vibration'] += $assoc['vibration'];
}
