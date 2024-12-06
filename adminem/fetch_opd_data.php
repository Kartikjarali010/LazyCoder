<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';


ob_start();


if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}


$sql = "SELECT registration_no, department, patient_name, age, sex, address, contact_no, consultant, diagnosis, date, treatment, token 
        FROM opd_records 
        ORDER BY date DESC";


$result = $conn->query($sql);

$records = []; 


if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}


ob_end_clean();
header('Content-Type: application/json'); 


echo json_encode($records); 

$conn->close(); 
?>
