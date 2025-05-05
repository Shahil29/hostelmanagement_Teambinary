<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $login_role = $_POST['login_role'];

    $allowed_roles = ['admin', 'student', 'landlord'];
    if (!in_array($login_role, $allowed_roles)) {
        echo "<script>alert('Invalid role selected.'); window.location.href='login.php';</script>";
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $login_role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header('Location: admin_panel.php');
            } elseif ($user['role'] === 'landlord') {
                header('Location: landlord-dashboard.php');
            } else {
                header('Location: student_dashboard.php');
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('No user found with that email and role.'); window.location.href='login.php';</script>";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - UHMS</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="user.css">
</head>
<body>

<header>
    <h1>ULAB Hostel Management System</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<section class="form-container">
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Login As:</label>
<select name="login_role" required>
    <option value="student">Student</option>
    <option value="landlord">Landlord</option>
    <option value="admin">Admin</option>
</select>

        <button type="submit" name="login" class="btn">Login</button>
    </form>
</section>

<footer>
    <p>&copy; 2025 ULAB Hostel Management System</p>
</footer>

</body>
</html>
