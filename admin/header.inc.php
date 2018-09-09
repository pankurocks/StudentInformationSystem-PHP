<?php require_once './admin.secure.php';;?>
<!-- Header -->
<header id="header">
    <h1><a href="../index.php">Student Information System || Admin Dashboard</a></h1>
    <nav id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="change_password.php">Change Password</a></li>
            <li>Welcome <?php echo $_SESSION['name'];?></li>
            <li><a href="logout.php" class="button special">Logout</a></li>
        </ul>
    </nav>
</header>