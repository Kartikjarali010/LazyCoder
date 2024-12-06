<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Include the database connection file
include 'db_connect.php';

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed.");
}

// Prepare the SQL statement
$sql = "SELECT firstname, gmail, regdate FROM users";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #00C3FF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            color: #00C3FF;
        }
    </style>
</head>
<body>
    <h1>List of Users</h1>
    <table>
        <tr>
            <th>First Name</th>
            <th>Email</th>
            <th>Registration Date</th>
        </tr>
        <?php
        // Check if there are results
        if ($result->num_rows > 0) {
            // Fetch and display each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gmail']) . "</td>";
                echo "<td>" . htmlspecialchars($row['regdate']) . "</td>";
                echo "</tr>";
            }
        } else {
            // If no users found
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>