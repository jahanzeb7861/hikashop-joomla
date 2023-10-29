<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if 'id' parameter is provided in the POST request
    if (isset($_POST["id"])) {
        // Sanitize and get the 'id' value from the POST request
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

        // Create a database connection (replace with your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test_joomla";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL DELETE statement
        $sql = "DELETE FROM kuv9p_package_contents WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Row deleted successfully
            echo "Row deleted successfully";
        } else {
            // Error occurred while deleting the row
            echo "Error: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // 'id' parameter is missing in the POST request
        echo "Missing 'id' parameter";
    }
} else {
    // Invalid request method (not a POST request)
    echo "Invalid request method";
}
?>