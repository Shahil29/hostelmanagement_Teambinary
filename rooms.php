<?php
include 'db.php'; // Include your database connection
session_start();

// Query to get the rooms data
$sql = "SELECT * FROM rooms WHERE status = 'approved'";
$result = $conn->query($sql);

$rooms = array();
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms - UHMS</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
    <header>
        <h1>Find a Room</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <section class="filters">
        <label for="location">Location:</label>
        <select id="location">
            <option value="all">All</option>
            <option value="Dhanmondi">Dhanmondi</option>
            <option value="Mohammadpur">Mohammadpur</option>
            <option value="Mirpur">Mirpur</option>
        </select>

        <label for="price">Max Price:</label>
        <select id="price">
            <option value="all">Any</option>
            <option value="5000-10000">10000 taka</option>
            <option value="10000-20000">15000 taka</option>
        </select>

        <button onclick="filterRooms()" class="btn">Apply Filters</button>
    </section>

    <section class="rooms" id="rooms-list">
        <?php
        foreach ($rooms as $room) {
            echo '<div class="room" data-location="' . $room['location'] . '" data-price="' . $room['price_range'] . '">
                    <h3>' . $room['room_type'] . ' - ' . $room['price'] . '/month</h3>
                    <p>Location: ' . $room['location'] . '</p>
                    <a href="booking.php?room_id=' . $room['id'] . '" class="btn">Book Now</a>
                  </div>';
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2025 ULAB Hostel Management System</p>
    </footer>

    <script>
        function filterRooms() {
            let location = document.getElementById("location").value;
            let price = document.getElementById("price").value;
            let rooms = document.querySelectorAll(".room");

            rooms.forEach(room => {
                let roomLocation = room.getAttribute("data-location");
                let roomPrice = room.getAttribute("data-price");

                if ((location === "all" || location === roomLocation) &&
                    (price === "all" || price === roomPrice)) {
                    room.style.display = "block";
                } else {
                    room.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>
