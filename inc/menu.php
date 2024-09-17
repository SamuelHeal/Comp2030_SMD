<nav>
    <div id="header-container">
        <div id=menu-username>
            <?php
            echo '<p>'.$_SESSION['username'].'</p>';
            ?>
        </div>
        <div id="menu-items">
            <?php
                $items = array(
                    'Administrator' => array(
                        'Users' => 'users.php',
                        'Reports' => 'reports.php',
                        'Manage' => 'manage.php'
                    ),
                    'Auditor' => array(
                        'Users' => 'users.php',
                        'Reports' => 'reports.php',
                        'Manage' => 'manage.php'
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
                    echo '<a class="menu-item" href="'.$address.'">'.$title.'</a>';
                }
            ?>
            <a class="menu-item" href="messages.php">Messages</a>
            <a class="menu-item" href="logoutsystem.php">Logout</a>
        </div>
    </div>
</nav>
