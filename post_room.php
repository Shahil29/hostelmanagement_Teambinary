
<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $landlord_id = $_SESSION['user']['id'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO rooms (landlord_id, location, price, description, approved) 
            VALUES ('$landlord_id', '$location', '$price', '$description', 0)";
    if ($conn->query($sql) === TRUE) {
        echo "Room posted successfully. Awaiting admin approval.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
