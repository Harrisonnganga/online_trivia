<?php
require_once "Database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Establish database connection
    $database = new Database();
    $conn = $database->getConnection();

    // Prepare SQL query
    $query = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute query and check for success
    if ($stmt->execute()) {
        echo "Your message has been sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
require __DIR__ . '/../views/contact.view.php';


