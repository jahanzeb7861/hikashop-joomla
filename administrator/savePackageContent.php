<?php
// Assuming you have a MySQL database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_joomla";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Parse the JSON data sent from the client
$data = json_decode(file_get_contents("php://input"), true);

// Prepare and execute an SQL statement to insert the data into the table
$sql = "INSERT INTO kuv9p_package_contents (sku_number, tariff_code, description, unit_weight, value_per_unit, country_of_origin, province_of_origin)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssss",
    $data['sku_number'],
    $data['tariff_code'],
    $data['description'],
    $data['unit_weight'],
    $data['value_per_unit'],
    $data['country_of_origin'],
    $data['province_of_origin']
);

if ($stmt->execute()) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>