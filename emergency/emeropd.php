<?php
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_no = $_POST['registration_no'];
    $department = $_POST['department'];
    $patient_name = $_POST['patient_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $consultant = $_POST['consultant'];
    $diagnosis = $_POST['diagnosis'];
    $date = $_POST['date'];
    $treatment = $_POST['treatment'];

    // Generate a random token
    $token = 'TOKEN-' . strtoupper(uniqid());

    // Prepare the SQL statement to insert the appointment into the database
    $stmt = $conn->prepare("INSERT INTO opd_records (registration_no, department, patient_name, age, sex, address, contact_no, consultant, diagnosis, date, treatment, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssssssssssss", $registration_no, $department, $patient_name, $age, $sex, $address, $contact_no, $consultant, $diagnosis, $date, $treatment, $token);

    // Execute the statement
    if ($stmt->execute()) {
        // Display success message
        echo "<script>alert('Record added successfully with Token: $token.'); window.location.href = '/empayment/index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>