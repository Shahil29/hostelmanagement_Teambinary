<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'landlord') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard - UHMS</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="user.css">
</head>
<body>

<header>
    <h1>Landlord Dashboard - UHMS</h1>
</header>

<nav>
    <ul>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</nav>

<section class="landlord-panel">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</h2>

    <div class="dashboard-links">
        <a href="add-room.php">List a New Room</a>
        <a href="manage-rooms.php">Manage Your Rooms</a>
        <a href="view-bookings.php">View Bookings</a>
    </div>
</section>

<footer>
    <p>&copy; 2025 ULAB Hostel Management System</p>
</footer>

</body>
</html>
