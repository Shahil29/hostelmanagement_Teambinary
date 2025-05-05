<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $room_id = intval($_POST['room_id']);

    // Insert booking request
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("ii", $user_id, $room_id);

    if ($stmt->execute()) {
        header("Location: student_dashboard.php?success=BookingRequested");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
