<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$sql = "SELECT rooms.* FROM bookings 
        JOIN rooms ON bookings.room_id = rooms.id 
        WHERE bookings.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - UHMS</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
<header>
    <h1>My Bookings</h1>
    <nav>
        <ul>
            <li><a href="student_dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section>
    <h2>Your Booked Rooms</h2>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($room = $result->fetch_assoc()): ?>
                <li>
                    <strong>Location:</strong> <?= htmlspecialchars($room['location']) ?><br>
                    <strong>Price:</strong> <?= htmlspecialchars($room['price']) ?><br>
                    <strong>Type:</strong> <?= htmlspecialchars($room['room_type']) ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No rooms booked yet.</p>
    <?php endif; ?>
</section>

<footer>
    <p>&copy; 2025 ULAB Hostel Management System</p>
</footer>
</body>
</html>
