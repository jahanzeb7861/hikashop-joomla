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
// $data = json_decode(file_get_contents("php://input"), true);

// Check if an 'id' is provided in the JSON data
if (isset($_GET['id'])) {
    // $id = $data['id'];
    // $trackingId = $data['trackingId'];
    $id = $_GET['id'];
    $trackingId = $_GET['trackingId'];
    
    // Prepare and execute an SQL statement to update the data in the table
    $sql = "UPDATE kuv9p_hikashop_order
            SET tracking_numbers = '$trackingId', order_status = 'shipped'
            WHERE order_id = $id";
    
    if ($conn->query($sql)) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Error: 'id' not provided in the JSON data.";
}

$conn->close();
?>