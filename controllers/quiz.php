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

$total_questions = totalquestion($conn);
$asked_questions = isset($_SESSION['asked_questions']) ? $_SESSION['asked_questions'] : [];

if (count($asked_questions) >= $total_questions) {
    // Save the score to the database
    $user_id = $_SESSION['user_id'];
    $score = $_SESSION['score'];
    $query = "INSERT INTO scores (user_id, score) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $user_id, $score);
    $stmt->execute();

    // Fetch top scores
    $query = "SELECT users.name, scores.score FROM scores JOIN users ON scores.user_id = users.id ORDER BY scores.score DESC";
    $result = $conn->query($query);

    // Redirect to result page
    require __DIR__ . '/../views/result.view.php';
    exit();
}

// Prepare the query to fetch a random question
$query = "SELECT * FROM questions ";
if (count($asked_questions) > 0) {
    $placeholders = implode(',', array_fill(0, count($asked_questions), '?'));
    $query .= "WHERE qid NOT IN ($placeholders) ";
}
$query .= "ORDER BY RAND() LIMIT 1";

$stmt = $conn->prepare($query);
if (count($asked_questions) > 0) {
    $stmt->bind_param(str_repeat('i', count($asked_questions)), ...$asked_questions);
}
$stmt->execute();
$result = $stmt->get_result();
$question = $result->fetch_assoc();

if (!$question) {
    die("No more questions available.");
}

$_SESSION['asked_questions'][] = $question['qid']; // Use the correct column name for question ID

$query = "SELECT * FROM answers WHERE ans_id = ?"; // Use 'ans_id' as the linking column
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $question['qid']);
$stmt->execute();
$result = $stmt->get_result();
$answers = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_answer = $_POST['answer'];
    $query = "SELECT * FROM answers WHERE ans_id = ? AND aid = ? AND is_correct = 1"; // Ensure correct column names
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $question['qid'], $selected_answer);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['score'] += 4; // Increase score by 4 for each correct answer
    }
    header("Location: /quiz");
    exit();
}

require __DIR__ . '/../views/quiz.view.php';
?>
