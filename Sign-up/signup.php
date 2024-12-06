<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $gmail = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE gmail = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "An account with this email address already exists.";
    } else {

        $stmt = $conn->prepare("INSERT INTO users (firstname, gmail, pass) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("sss", $firstname, $gmail, $pass);

        if ($stmt->execute()) {
            echo "Registration successful! You can now <a href='/Sign-in/index.html'>sign in</a>.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>