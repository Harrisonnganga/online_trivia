<?php
require __DIR__ . '/../views/login.view.php';
require_once "Database.php";
require_once "function.php";
session_start();

if (isset($_SESSION['login_active'])) {
    header("Location: /dashboard");
    exit();
} else {
    if (isset($_POST['login'])) {
        $email = sanitize($_POST['email']);
        $inputpassword = sanitize($_POST['password']);
        $password = md5($inputpassword);

        // Establish database connection
        $database = new Database();
        $conn = $database->getConnection();

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['login_active'] = true;
                $_SESSION['user_id'] = $row["id"];
                $_SESSION['user_name'] = $row["name"];
                $_SESSION['msg'] = "Welcome " . $_SESSION['user_name'];
                $_SESSION['class'] = "text-bg-success";
                header("Location: /dashboard");
                exit();
            }
        } else {
            $_SESSION['msg'] = "Check Email & Password";
            $_SESSION['class'] = "text-bg-danger";
            header("Location: /login");
            exit();
        }
    }
}
?>
