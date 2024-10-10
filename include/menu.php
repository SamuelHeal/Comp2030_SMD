<nav id="header-container">
    <div id=menu-username>
        <?php
            echo "<p>{$_SESSION['username']}</p>";
        ?>
    </div>
    <div id="menu-items">
        <?php
            $items = array(
                'Administrator' => array(
                    'Users' => 'users.php',
                    'Manage' => 'manage.php'
                ),
                'Auditor' => array(
                    'Users' => 'users.php',
                    'Reports' => 'reports.php'
                ),
                'Factory Manager' => array(
                    'Factory' => 'factory.php',
                    'Jobs' => 'jobs.php',
                    'Machines' => 'machines.php'
                ),
                'Production Operator' => array(
                    'Factory' => 'factory.php',
                    'Jobs' => 'jobs.php',
                    'Machines' => 'machines.php'
                ),
            );
            
            foreach ($items[$_SESSION['position']] as $title => $address) {
                $page_id = substr($address, 0, strlen($address)-4);
                echo "<a class=\"menu-item\" href=\"$address?machineID={$_GET['machineID']}\" id=\"menu-$page_id\">$title</a>";
            }
        ?>
        <a class="menu-item" href="messages.php?machineID=<?php echo $_GET['machineID'] ?>" id="menu-messages">Messages</a>
        <a class="menu-item" href="../system/logout.php?machineID=<?php echo $_GET['machineID'] ?>">Logout</a>
    </div>
</nav>
<?php
    checkForMachinesWithStatusMaintenance($conn);
    checkForMessages($conn);
    warnIfActive();
?>
