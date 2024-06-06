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

// // Fetch top scores
$query = "SELECT users.name, scores.score FROM scores JOIN users ON scores.user_id = users.id ORDER BY scores.score DESC";
$result = mysqli_query($conn, $query);

require __DIR__ . '/../views/dashboard.view.php';



