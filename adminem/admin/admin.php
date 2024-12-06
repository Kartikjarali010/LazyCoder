<?php
include 'db_connect.php';

$sql = "SELECT patientName, age, healthConditions, contact, token FROM appointments";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Appointment Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1c1c1c, #333);
            color: #fff;
            overflow-x: hidden;
        }

        .container {
            padding: 50px;
            max-width: 800px;
            margin: auto;
            text-align: left;
        }

        .container h2 {
            font-size: 3em;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-in-out;
        }

        .appointment-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .appointment-table th, .appointment-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #444;
        }

        .appointment-table th {
            background-color: #0056b3;
            color: #fff;
        }

        .appointment-table tr:nth-child(even) {
            background-color: #2c2c2c;
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Admin - Appointment Management</h2>

        <table class="appointment-table">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Health Conditions</th>
                    <th>Contact</th>
                    <th>Token</th>  
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['patientName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['healthConditions']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['token']) . "</td>";  // Display token
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No appointments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close(); 
?>