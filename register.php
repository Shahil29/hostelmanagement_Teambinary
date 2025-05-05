<?php
include 'db.php';

$message = ""; // message to show on screen

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        $message = "<div class='popup error'>Email already registered. <a href='register.php'>Try again</a></div>";
    } else {
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            $message = "<div class='popup success'>Registration successful. <a href='login.php'>Login here</a> or <a href='index.php'>Go to Home</a></div>";
        } else {
            $message = "<div class='popup error'>Error: " . $conn->error . "</div>";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UHMS</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>

    <header>
        <h1>Register</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="register-form">
        <form action="register.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="student">Student</option>
                <option value="landlord">Landlord</option>
            </select>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Register</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 ULAB Hostel Management System</p>
    </footer>
</body>
</html>
