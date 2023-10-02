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

// Check if an 'id' is provided in the JSON data
if (isset($data['id'])) {
    $id = $data['id'];
    
    // Prepare and execute an SQL statement to update the data in the table
    $sql = "UPDATE kuv9p_preset_boxes
            SET box_name = ?, box_length = ?, box_width = ?, box_height = ?, box_unit_type = ?, box_insurance = ?, box_weight = ?
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssi",
        $data['box_name'],
        $data['box_length'],
        $data['box_width'],
        $data['box_height'],
        $data['box_unit_type'],
        $data['box_insurance'],
        $data['box_weight'],
        $id
    );

    if ($stmt->execute()) {
        echo "Data updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the database connection
    $stmt->close();
} else {
    echo "Error: 'id' not provided in the JSON data.";
}

$conn->close();
?>