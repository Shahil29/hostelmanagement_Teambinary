<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$users = $conn->query("SELECT * FROM users WHERE role != 'admin'");
$houses = $conn->query("SELECT * FROM houses");
$rooms = $conn->query("SELECT rooms.*, users.name AS landlord_name FROM rooms JOIN users ON rooms.landlord_id = users.id");
$bookings = $conn->query("SELECT bookings.*, users.name AS student_name FROM bookings JOIN users ON bookings.user_id = users.id JOIN rooms ON bookings.room_id = rooms.id");
$payments = $conn->query("SELECT payments.*, users.name AS student_name FROM payments JOIN users ON payments.user_id = users.id");
$contacts = $conn->query("SELECT * FROM contact_messages");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - UHMS</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header>
    <h1>Admin Panel - UHMS</h1>
    <nav>
        <ul><li><a href="logout.php" class="btn">Logout</a></li></ul>
    </nav>
</header>

<section>
    <h2>Users</h2>
    <table>
        <tr><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
        <?php while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td>
                    <a href="delete_user.php?id=<?= $row['id'] ?>" class="delete-btn" data-type="user">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Houses</h2>
    <table>
        <tr><th>ID</th><th>Title</th><th>Address</th><th>Action</th></tr>
        <?php while ($row = $houses->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['address']) ?></td>
                <td>
                    <a href="delete_house.php?id=<?= $row['id'] ?>" class="delete-btn" data-type="house">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Rooms</h2>
    <table>
        <tr><th>ID</th><th>Landlord</th><th>Price</th><th>Status</th><th>Action</th></tr>
        <?php while ($row = $rooms->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['landlord_name']) ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <?php if ($row['status'] === 'pending'): ?>
                        <a href="approve_rooms.php?id=<?= $row['id'] ?>" class="btn">Approve</a>
                        <a href="reject_room.php?id=<?= $row['id'] ?>" class="delete-btn" data-type="room">Reject</a>
                    <?php endif; ?>
                    <a href="delete_room.php?id=<?= $row['id'] ?>" class="delete-btn" data-type="room">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Bookings</h2>
    <table>
        <tr><th>ID</th><th>Student</th><th>Room ID</th><th>Status</th><th>Action</th></tr>
        <?php while ($row = $bookings->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['student_name']) ?></td>
                <td><?= $row['room_id'] ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <?php if ($row['status'] === 'pending'): ?>
                        <a href="approve_booking.php?id=<?= $row['id'] ?>" class="btn">Approve</a>
                        <a href="reject_booking.php?id=<?= $row['id'] ?>" class="delete-btn" data-type="booking">Reject</a>
                    <?php endif; ?>
                    <a href="delete_booking.php?id=<?= $row['id'] ?>" class="delete-btn" data-type="booking">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Payments</h2>
    <table>
        <tr><th>ID</th><th>Student</th><th>Amount</th><th>Status</th></tr>
        <?php while ($row = $payments->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['student_name']) ?></td>
                <td><?= $row['amount'] ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Contact Messages</h2>
    <table>
        <tr><th>Name</th><th>Email</th><th>Message</th></tr>
        <?php while ($row = $contacts->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        const url = this.getAttribute('href');
        const type = this.getAttribute('data-type');
        Swal.fire({
            title: `Are you sure?`,
            text: `You are about to delete/reject a ${type}. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>
</body>
</html>
