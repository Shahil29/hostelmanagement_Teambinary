<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'landlord') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['delete'])) {
    $room_id = intval($_GET['delete']);
    $sql = "DELETE FROM rooms WHERE id = ? AND landlord_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $room_id, $_SESSION['user']['id']);
    $stmt->execute();
    header("Location: manage-rooms.php");
    exit();
}

$sql = "SELECT * FROM rooms WHERE landlord_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user']['id']);
$stmt->execute();
$result = $stmt->get_result();
$rooms = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Rooms - UHMS</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="user.css">
</head>
<body>

<div class="rooms-container">
    <h2>Your Listed Rooms</h2>
    <?php if (count($rooms) > 0): ?>
        <?php foreach ($rooms as $room): ?>
            <div class="room-card">
                <div>
                    <h3><?php echo htmlspecialchars($room['room_name']); ?></h3>
                    <p><?php echo htmlspecialchars($room['location']); ?> - <?php echo $room['price']; ?> Taka</p>
                    <p>Status: <?php echo ucfirst($room['status']); ?></p>
                </div>
                <div>
                    <a href="manage-rooms.php?delete=<?php echo $room['id']; ?>" onclick="return confirm('Are you sure to delete this room?');">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No rooms listed yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
