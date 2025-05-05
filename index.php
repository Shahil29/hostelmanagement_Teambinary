<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UHMS - Home</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
    <header>
        <h1>ULAB Hostel Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="rooms.php">Rooms</a></li>

                <?php if (isset($_SESSION['user'])): ?>
                    
                    <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                        <li><a href="admin_panel.php">Admin Dashboard</a></li>
                    <?php elseif ($_SESSION['user']['role'] == 'landlord'): ?>
                        <li><a href="landlord-dashboard.php">Landlord Dashboard</a></li>
                    <?php else: ?>
                        <li><a href="student_dashboard.php">User Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="contact.php">Contact</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h2>Find the Perfect Hostel Near ULAB</h2>
        <p>Book, manage, and stay with ease!</p>
    </section>

    <footer>
        <p>&copy; 2025 ULAB Hostel Management System</p>
    </footer>
</body>
</html>
