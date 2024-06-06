<?php
require __DIR__ . '/../views/signup.view.php';
require_once "Database.php";
require_once "function.php";
session_start();

if (isset($_POST['signup'])) {
  $name = sanitize($_POST['name']);
  $email = sanitize($_POST['email']);
  $inputpassword = sanitize($_POST['password']);
  $password = md5($inputpassword);

  // Establish database connection
  $database = new Database();
  $conn = $database->getConnection();

  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

  if ($stmt === false) {
    $_SESSION['msg'] = "Prepare failed: " . $conn->error;
    $_SESSION['class'] = "text-bg-danger";
    header("Location: index.php");
    exit();
  }

  // Bind parameters
  $stmt->bind_param("sss", $name, $email, $password);

  // Execute statement
  if ($stmt->execute()) {
    $_SESSION['msg'] = "You have Signed Up Successfully";
    $_SESSION['class'] = "text-bg-success";
    header("Location: /dashboard");
    exit();
  } else {
    $_SESSION['msg'] = "Sign Up failed: " . $stmt->error;
    $_SESSION['class'] = "text-bg-danger";
    header("Location: index.php");
    exit();
  }

  // Close statement and connection
  $stmt->close();
  $conn->close();
}
?>
s