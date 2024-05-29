<?php
require "views/result.view.php";

session_start();
require_once "Database.php";
require_once "function.php";

if (!isset($_SESSION['login_active'])) {
  header("Location: index.php");
  exit();
}

if (!isset($_SESSION['user_id'])) {
  die("User ID not set in session.");
}

if (!isset($_SESSION['score'])) {
  die("Score not set in session.");
}

// Establish database connection
$database = new Database();
$conn = $database->getConnection();

$user_id = $_SESSION['user_id'];
$score = $_SESSION['score'];

$query = "INSERT INTO scores (user_id, score) VALUES ('$user_id', '$score')";
mysqli_query($conn, $query);

unset($_SESSION['current_question']);
unset($_SESSION['score']);

