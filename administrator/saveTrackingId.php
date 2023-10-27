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

// Check if 'id' and 'trackingId' are provided in the GET parameters
if (isset($_GET['id']) && isset($_GET['trackingId'])) {
    $id = $_GET['id'];
    $trackingId = $_GET['trackingId'];

    // Fetch the existing tracking numbers from the database
    $sqlSelect = "SELECT tracking_numbers, order_billing_address_id FROM kuv9p_hikashop_order WHERE order_id = $id";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existingTrackingNumbers = $row['tracking_numbers'];
        $billingAddressId = $row['order_billing_address_id'];

        // Fetch the billing address country
        $sqlSelectAddress = "SELECT address_country FROM kuv9p_hikashop_address WHERE address_id = $billingAddressId";
        $resultAddress = $conn->query($sqlSelectAddress);

        if ($resultAddress->num_rows > 0) {
            $rowAddress = $resultAddress->fetch_assoc();
            $addressCountry = $rowAddress['address_country'];

            // Check the country and format the tracking numbers accordingly
            if ($addressCountry === 'Canada') {
                // CANADA ONLY FORMAT
                $formattedTrackingNumbers = preg_replace('/\d{4}/', '$0 ', $trackingId);
            } else {
                // USA / INTERNATIONAL FORMAT
                $formattedTrackingNumbers = 'CA ' . preg_replace('/\d{3}/', '$0 ', $trackingId) . ' LA';
            }

            // Append the new formatted tracking numbers to the existing numbers
            $newTrackingNumbers = empty($existingTrackingNumbers) ? $formattedTrackingNumbers : $existingTrackingNumbers . ", " . $formattedTrackingNumbers;

            // Update the record with the new tracking numbers and set the order status to 'shipped'
            $sqlUpdate = "UPDATE kuv9p_hikashop_order
                         SET tracking_numbers = '$newTrackingNumbers', order_status = 'shipped'
                         WHERE order_id = $id";

            if ($conn->query($sqlUpdate)) {
                echo "Record updated successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Error: Billing address not found for the provided 'id'.";
        }
    } else {
        echo "Error: Record not found for the provided 'id'.";
    }
} else {
    echo "Error: 'id' and 'trackingId' not provided in the GET parameters.";
}

$conn->close();
?>