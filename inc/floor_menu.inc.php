
<div class="headerContainer">
    <div class="username">
        <?php
        require_once "inc/dbconn.inc.php";
        session_start();
        echo "<p>";
        echo $_SESSION['username'];
        echo "</p>";
        ?>
    </div>
    <div class="navButtons">
        <div id="menu-items">
            <a class="menu-item" href="factory.php">Factory</a>
            <a class="menu-item" href="jobs.php">Jobs</a>
            <a class="menu-item" href="machines.php">Machines</a>
            <a class="menu-item" href="messages.php">Messages</a>
            <a class="menu-item" href="logoutsystem.php">Logout</a>
        </div>
        
    </div>
</div>
