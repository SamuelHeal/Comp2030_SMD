<nav id="header-container">
    <div id=menu-username>
        <?php
            echo "<p id='username'>{$_SESSION['username']}</p>";
        ?>
    </div>
    <div id="menu-items">
        <?php
            $items = array(
                'Administrator' => array(
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
                echo "<a class=\"menu-item\" href=\"$address?machineID={$_GET['machineID']}\">$title</a>";
            }
        ?>
        <a class="menu-item" href="messages.php?machineID=<?php echo $_GET['machineID'] ?>" id="menu-messages">Messages</a>
        <a class="menu-item" href="../system/logout.php?machineID=<?php echo $_GET['machineID'] ?>">Logout</a>
    </div>
</nav>
<?php
    checkForMessages($conn);
    warnIfActive();
?>
