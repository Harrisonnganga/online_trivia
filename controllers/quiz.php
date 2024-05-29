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

$current_question = isset($_SESSION['current_question']) ? $_SESSION['current_question'] : 1;
$total_questions = totalquestion($conn);

if ($current_question > $total_questions) {
  header("Location: /result");
  exit();
}

// Fetch the current question
$query = "SELECT * FROM questions WHERE qid = '$current_question'";
$result = mysqli_query($conn, $query);
$question = mysqli_fetch_assoc($result);

// Fetch the answers for the current question
$query = "SELECT * FROM answers WHERE ans_id = '$current_question'";
$result = mysqli_query($conn, $query);
$answers = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selected_answer = $_POST['answer'];
  $query = "SELECT * FROM answers WHERE ans_id = '$current_question' AND aid = '$selected_answer' AND is_correct = 1";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $_SESSION['score'] += 4; // Increase score by 4 for each correct answer
  }
  $_SESSION['current_question']++;
  header("Location: /quiz");
  exit();
}

// Include the view file
 require "__DIR__ . '/../views/quiz.view.php";
