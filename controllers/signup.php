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

  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
  if (mysqli_query($conn, $sql)) {
    $_SESSION['msg'] = "You have Signed Up Successfully";
    $_SESSION['class'] = "text-bg-success";
    header("Location: /dashboard");
    exit();
  } else {
    $_SESSION['msg'] = "Sign Up failed";
    $_SESSION['class'] = "text-bg-danger";
    header("Location: index.php");
    exit();
  }
}

