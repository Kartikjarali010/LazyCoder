<?php
$servername = "sql112.infinityfree.com";
$username = "if0_37232855";
$password = "Shivansh123451";
$dbname = "if0_37232855_medisnap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>