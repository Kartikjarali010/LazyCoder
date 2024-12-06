<?php
include 'db_connect.php'; 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT registration_no, department, patient_name, age, sex, address, contact_no, consultant, diagnosis, date, treatment, token, severity 
        FROM opd_records 
        ORDER BY severity DESC, date DESC";

$result = $conn->query($sql);


if (!$result) {
    die("Query failed: " . $conn->error);  
}

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row; 
    }
} else {
    echo json_encode(["message" => "No records found in the database"]);  
    exit(); 
}

header('Content-Type: application/json');
echo json_encode($records);

$conn->close();
exit(); 
?>
