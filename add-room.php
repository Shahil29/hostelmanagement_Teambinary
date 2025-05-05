<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'landlord') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $square_feet = $_POST['square_feet'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    $sql = "INSERT INTO rooms (square_feet, price, location, landlord_id, status) 
            VALUES (?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $square_feet, $price, $location, $_SESSION['user']['id']);
    $stmt->execute();

    $_SESSION['success'] = "Room submitted successfully!";
    header("Location: add-room.php");  // Stay on the same page after success
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List a New Room - UHMS</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="common.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="form-container">
    <h2>List a New Room</h2>
    <form method="POST">
    <input type="number" step="1" name="square feet" placeholder="" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="location" placeholder="Location" required>
        <button type="submit">Submit Room for Approval</button>
    </form>
</div>
<?php if (isset($_SESSION['success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '<?php echo $_SESSION['success']; ?>',
    confirmButtonColor: '#0056b3'
});
</script>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>

</body>
</html>
