<?php
session_start();
require_once "Database.php";
require_once "function.php";

if (!isset($_SESSION['login_active'])) {
  header("Location: index.php");
  exit();
}

// Establish database connection
$database = new Database();
$conn = $database->getConnection();

if (isset($_POST['answer-submit'])) {
  $score = 0;
  $total_questions = totalquestion($conn);
  foreach ($_POST['checkanswer'] as $question_id => $selected_answer) {
    $query = "SELECT * FROM answers WHERE ans_id = '$question_id' AND aid = '$selected_answer' AND is_correct = 1";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      $score += 4; // Increase score by 4 for each correct answer
    }
  }
  $_SESSION['score'] = $score;
  header("Location: result.php");
  exit();
}
?>
