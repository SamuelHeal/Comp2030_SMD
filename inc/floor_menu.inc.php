<!-- <ul id="navbar">
    <li><a href="factory.php">Factory</a></li>
    <li><a href="jobs.php">Jobs</a></li>
    <li><a href="machines.php">Machines</a></li>
    <li><a href="messages.php">Messages</a></li>
    <li><a href="">Logout</a></li>
</ul> -->


<div class="headerContainer">
    <div class="username">
        <?php
        require_once "inc/dbconn.inc.php";
        session_start();
        echo "<p>";
        echo $_SESSION['username'];
        echo "</p>";
        mysqli_close($conn);
        ?>
        <!-- <p>User name</p> -->
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
