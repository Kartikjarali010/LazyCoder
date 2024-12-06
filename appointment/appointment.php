<?php
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $patientName = $_POST['patientName'];
    $age = $_POST['age'];
    $healthConditions = $_POST['healthConditions'];
    $contact = $_POST['contact'];
    $token = $_POST['token'];  // Get the token
    $stmt = $conn->prepare("INSERT INTO appointments (patientName, age, healthConditions, contact, token) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sisss", $patientName, $age, $healthConditions, $contact, $token);

    if ($stmt->execute()) {
        $redirectUrl = "opd.html?patientName=" . urlencode($patientName) .
                       "&age=" . urlencode($age) .
                       "&healthConditions=" . urlencode($healthConditions) .
                       "&contact=" . urlencode($contact) .
                       "&token=" . urlencode($token);

        header("Location: $redirectUrl");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.<br>";
}

$conn->close();
?>