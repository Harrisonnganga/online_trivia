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

$current_question = isset($_SESSION['current_question']) ? $_SESSION['current_question'] : 1;
$total_questions = totalquestion($conn);

if ($current_question > $total_questions) {
  header("Location: result.php");
  exit();
}

$query = "SELECT * FROM questions WHERE qid = '$current_question'";
$result = mysqli_query($conn, $query);
$question = mysqli_fetch_assoc($result);

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
  header("Location: quiz.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
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
          <div class="card my-2 p-3">
            <div class="card-body">
              <h5 class="card-title py-2">Q.<?php echo $question['qid'] . " " . $question['question']; ?></h5>
              <form method="POST" action="">
                <?php foreach ($answers as $answer) : ?>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" value="<?php echo $answer['aid']; ?>" required>
                    <label class="form-check-label">
                      <?php echo $answer['answer']; ?>
                    </label>
                  </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary mt-3">Next</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
