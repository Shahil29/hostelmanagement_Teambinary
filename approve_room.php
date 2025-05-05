<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("UPDATE rooms SET status = 'approved' WHERE id = $id");
}

header("Location: admin_panel.php");
exit();
?>
