        <?php	
  
                                    
        // SQL query to select all rows from the kuv9p_preset_boxes table
        $sql = "SELECT * FROM kuv9p_preset_boxes WHERE id = 1"; // Replace '1' with the actual ID you want to retrieve.

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            // Fill in the HTML form fields with the retrieved data
            
        } else {
            echo "No records found";
        }


        // Assuming you have fetched the data from your database into $row
        $mockData = array();

        if ($row['box_length'] !== null) {
            $mockData['length'] = $row['box_length'];
        }

        if ($row['box_width'] !== null) {
            $mockData['width'] = $row['box_width'];
        }

        if ($row['box_height'] !== null) {
            $mockData['height'] = $row['box_height'];
        }

        if ($row['box_weight'] !== null) {
            $mockData['weight'] = $row['box_weight'];
        }

        if ($row['box_insurance'] !== null) {
            $mockData['overrideAmount'] = $row['box_insurance'];
        }

        if ($row['box_name'] !== null) {
            $mockData['boxName'] = $row['box_name'];
        }
?>