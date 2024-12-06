<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'];
    $pass = $_POST['pass'];

    $stmt = $conn->prepare("SELECT id, firstname, pass FROM users WHERE gmail = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $firstname, $stored_password);
        $stmt->fetch();

        if ($pass === $stored_password) {
            $_SESSION['user_id'] = $id;
            $_SESSION['firstname'] = $firstname;

            if ($firstname === 'Admin') {
                header("Location: /adminem/admin/admin.php");
                exit();
            } else {
                header("Location: /options/index.html");
                exit();
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>