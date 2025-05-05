<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'student') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard - UHMS</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="user.css">
</head>
<body>

<header>
    <h1>Student Dashboard</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="rooms.php">Book Rooms</a></li>
            <li><a href="my_bookings.php" class="btn">View My Booked Rooms</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</h2>
    <p>Browse available rooms and manage your bookings here.</p>
</section>

<footer>
    <p>&copy; 2025 ULAB Hostel Management System</p>
</footer>

</body>
</html>
