<?php
session_start();
require_once "Database.php";
require_once "function.php";


if (!isset($_SESSION['login_active'])) {
    header("Location: /login");
    exit();
}

// Establish database connection
$database = new Database();
$conn = $database->getConnection();

$query = "SELECT u.name, s.score FROM scores s JOIN users u ON s.user_id = u.id ORDER BY s.score DESC LIMIT 10";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}


require __DIR__ . '/../views/dashboard.view.php';
