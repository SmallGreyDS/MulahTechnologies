<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MulahTechnologies"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all data from Table 1
$sql = "SELECT `index`, `value` FROM table_input";
$result = $conn->query($sql);

// Create an associative array to store values from Table 1
$table1_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table1_data[$row['index']] = $row['value'];
    }
}

// Calculate values for Table 2
$alpha = $table1_data['A5'] + $table1_data['A20'];
$beta = $table1_data['A15'] / $table1_data['A7'];
$charlie = $table1_data['A13'] * $table1_data['A12'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tables</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1, h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Table 1</h1>
    <table>
        <thead>
            <tr>
                <th>Index #</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($table1_data)) {
                foreach ($table1_data as $index => $value) {
                    echo "<tr><td>" . $index . "</td><td>" . $value . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Table 2</h2>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Alpha</td>
                <td><?php echo $alpha; ?></td>
            </tr>
            <tr>
                <td>Beta</td>
                <td><?php echo number_format($beta, 2); // Formatting Beta to 2 decimal places ?></td>
            </tr>
            <tr>
                <td>Charlie</td>
                <td><?php echo $charlie; ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>  

<?php
// Close the database connection
$conn->close();
?>
