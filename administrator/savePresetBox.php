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
$sql = "INSERT INTO kuv9p_preset_boxes (box_name, box_length, box_width, box_height, box_unit_type, box_insurance, box_weight)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssss",
    $data['box_name'],
    $data['box_length'],
    $data['box_width'],
    $data['box_height'],
    $data['box_unit_type'],
    $data['box_insurance'],
    $data['box_weight']
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