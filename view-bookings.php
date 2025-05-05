<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'landlord') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT b.*, u.name AS student_name, r.square_feet 
        FROM bookings b
        JOIN users u ON b.user_id = u.id
        JOIN rooms r ON b.room_id = r.id
        WHERE r.landlord_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user']['id']);
$stmt->execute();
$result = $stmt->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bookings - UHMS</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="common.css">
</head>
<body>

<div class="bookings-container">
    <h2>Bookings for Your Rooms</h2>
    <?php if (count($bookings) > 0): ?>
        <table>
            <tr>
                <th>Student Name</th>
                <th>Location</th>
                <th>Booking Date</th>
            </tr>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($booking['location']); ?></td>
                    <td><?php echo htmlspecialchars($booking['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No bookings found for your rooms.</p>
    <?php endif; ?>
</div>

</body>
</html>
