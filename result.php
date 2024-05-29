<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section class="main-section">
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Quiz</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
            </li>
          </ul>
          <div class="d-flex">
            <a class="btn btn-danger" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card my-2 p-3 text-center">
            <div class="card-body">
              <h5 class="card-title py-2">Quiz Completed</h5>
              <p class="card-text">You answered <span id="correct-answers"><?php echo $score / 4; ?></span> questions correctly!</p>
              <p class="card-text">Your Score: <span id="score"><?php echo $score; ?></span>%</p>
              <a href="dashboard.php" class="btn btn-info">Go to Dashboard</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
