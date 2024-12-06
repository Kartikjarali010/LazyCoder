<?php
header('Content-Type: application/json');

include 'db_connect.php'; // Include the database connection

// Retrieve the token from the URL
$token = $_GET['token'] ?? '';

$response = [];

if (!empty($token)) {
    // Prepare the SQL statement to retrieve the appointment details
    $stmt = $conn->prepare("SELECT patientName, age, healthConditions, contact, token FROM appointments WHERE token = ?");
    if ($stmt === false) {
        $response['success'] = false;
        $response['message'] = 'Database prepare failed.';
        echo json_encode($response);
        exit();
    }

    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($patientName, $age, $healthConditions, $contact, $token);
        $stmt->fetch();

        $response['success'] = true;
        $response['patientName'] = $patientName;
        $response['age'] = $age;
        $response['healthConditions'] = $healthConditions;
        $response['contact'] = $contact;
        $response['token'] = $token;
    } else {
        $response['success'] = false;
        $response['message'] = 'No appointment found with this token.';
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = 'No token provided.';
}

$conn->close();

echo json_encode($response);
?>