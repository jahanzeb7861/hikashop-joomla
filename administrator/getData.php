<?php
// Database connection settings (replace with your actual credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'test_joomla';

// Create a connection to the database
$connection = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$connection) {
    // If the connection fails, send an error response and exit
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Get the ID from the AJAX request (assuming you're using POST)
// $id = $_POST['id'];

// Read the raw input from the request body
$input = file_get_contents('php://input');

$data = json_decode($input, true);

if (json_last_error() === JSON_ERROR_NONE) {
    // Now, you can access the 'id' from the parsed data
    $id = $data['id'];

    // Perform any further processing with $id
} else {
    // Handle JSON decoding error
    echo json_encode(['error' => 'Invalid JSON data in request body']);
}

// echo $id;
// echo 2;


// Perform a database query to retrieve data based on the ID
// Replace 'your_table' with the actual table name in your database
$query = "SELECT * FROM kuv9p_preset_boxes WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    // Bind the ID parameter to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch the result as an associative array
            $data = mysqli_fetch_assoc($result);
            
            // Output the data as JSON
            echo json_encode($data);
        } else {
            // If no rows match the ID, send an error response
            echo json_encode(['error' => 'No data found for the given ID']);
        }
    } else {
        // If the prepared statement execution fails, send an error response
        echo json_encode(['error' => 'Query execution failed']);
    }
    
    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // If the prepared statement creation fails, send an error response
    echo json_encode(['error' => 'Statement preparation failed']);
}

// Close the database connection
mysqli_close($connection);