<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Assuming you have already established a MySQL database connection.
// Replace these variables with your actual database connection details.
$hostname = "localhost";
$username = "root";
$password = "";
$database = "test_joomla";

// Create a MySQL connection
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query to fetch data from the kuv9p_hikashop_address table (assuming you have a unique identifier like an ID)
$sql = "SELECT * FROM kuv9p_hikashop_address WHERE address_id = 3"; // Replace '1' with the actual ID you want to retrieve.
$sql2 = "SELECT * FROM kuv9p_hikashop_address WHERE address_id = 2"; // Replace '1' with the actual ID you want to retrieve.
$sql3 = "SELECT * FROM kuv9p_extensions WHERE element = 'canadapost'"; // Replace '1' with the actual ID you want to retrieve.
$sql4 = "SELECT * FROM kuv9p_preset_boxes"; // Replace '1' with the actual ID you want to retrieve.


// echo $sql;

$result = $mysqli->query($sql);

// Create a connection to the database
$connection = mysqli_connect($hostname, $username, $password, $database);


$result2 = $mysqli->query($sql2);

$result3 = $mysqli->query($sql3);
$result4 = mysqli_query($connection, $sql4);



if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();

    // Fill in the HTML form fields with the retrieved data
    echo '<script>';
    echo '</script>';
} else {
    echo "No records found";
}

if ($result2->num_rows > 0) {
    
    $row2 = $result2->fetch_assoc();

    // Fill in the HTML form fields with the retrieved data
    echo '<script>';
    echo '</script>';
} else {
    echo "No records found";
}

if ($result3->num_rows > 0) {
    
    $row3 = $result3->fetch_assoc();

    // echo $row3["params"];

    $decodedObject = json_decode($row3["params"]);

    $printerType = $decodedObject->printer_type;
    $addressCountry = $decodedObject->address_country;
    $NonDeliveryGoods = $decodedObject->non_delivery_of_goods;
    $ReasonForExport = $decodedObject->reason_for_export;
    $CountryOfOrigin = $decodedObject->country_of_origin;
    $ShipmentValue = $decodedObject->shipment_value;

    // Output the value of printer_type
    // echo $printerType;


    // Fill in the HTML form fields with the retrieved data
    echo '<script>';
    // echo 'document.getElementById("fname-shipping").value = "' . $row3["params"]["company_number"] . '";';
    echo '</script>';
} else {
    echo "No records found";
}


$presets = array();
while ($row4 = mysqli_fetch_assoc($result4)) {
    $presets[] = $row4; 
}


// Close the database connection
$mysqli->close();
?>

<div class="btn-toolbar" style="display: flex;" role="toolbar" aria-label="<?php echo JText::_('JTOOLBAR'); ?>"
    id="<?php echo $displayData['id']; ?>">

    <button class="btn btn-small button-apply btn-success" style="order: 1;" id="openModal">
        Ship</button>

    <button class="btn btn-small button-apply btn-info" style="order: 1;" id="refundButton">
        Refund Label</button>

    <button class="btn btn-small button-apply btn-secondary" style="order: 1;" id="endOfDayButton">
        End of Day</button>


        <style>
            /* Styling for the modal */
            body {
                font-family: Arial, sans-serif;
            }

            /* Modal styles */
            .custom-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.7);
                z-index: 1;
                overflow: auto; /* Enable scrolling */
            }

            .modal-content {
                background-color: #fff;
                margin: 5% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 1000px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                overflow-y: auto; /* Enable content scrolling */
                
            }

            /* Styling for the close button */
            .custom-close {
                color: #888;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .custom-close:hover {
                color: #000;
            }

            /* Modal header */
            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .modal-title {
                font-size: 24px;
                font-weight: bold;
            }

            /* Close button for modal header */
            .btn-close {
                background: none;
                border: none;
                font-size: 24px;
                font-weight: bold;
                cursor: pointer;
            }

            .btn-close:hover {
                color: #000;
            }

            /* Modal body */
            .modal-body {
                padding: 20px;
                padding-top: 0px;
            }

            /* Wizard section */
            .wizard-section {
                padding: 20px;
            }

            /* Form input styles */
            .custom-input {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            /* Form button styles */
            .custom-button {
                background-color: #007bff;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .custom-button:hover {
                background-color: #0056b3;
            }

            /* Radio button styles */
            .custom-radio {
                margin-right: 5px;
            }

            /* Select styles */
            .custom-select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            /* Container div styles */
            .container-div {
                background-color: #f7f7f7;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                margin-bottom: 15px;
            }

            /* Additional styles */
            .custom-select {
                height: 37px !important;
            }

            td > input {
                margin-bottom: 0px !important;
            }
    </style>

<div id="myModal" class="custom-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Canada Post</h1>
                <span class="custom-close" id="closeModal">&times;</span>
            </div>
            <div class="modal-body">
                <section class="wizard-section">
                <div class="row no-gutters">
                    <div class="col-lg-12 col-md-6">
                        <div class="form-wizard">
                            <form action="" method="post" role="form">
                                <fieldset class="wizard-fieldset show pb-5 mb-5">
                                            <div class="row text-start" style="display: flex; gap: 48px;">
                                                <div class="col-md-6 order-md-2">
                                                    <h5>Billing Address</h5>
                                                    <table class="table table-sm table-bordered address-table">
                                                        <tr>
                                                            <td><label for="first_name">First Name</label></td>
                                                            <td>
                                                                <input type="text" id="fname-billing" value="<?php echo $row2['address_firstname']; ?>"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Last Name">Last Name</label></td>
                                                            <td>
                                                                <input type="text" id="lname-billing" value="<?php echo $row2['address_lastname']; ?>"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Address">Address</label></td>
                                                            <td>
                                                                <input type="text" id="address1-billing"
                                                                    value="<?php echo $row2['address_street']; ?>" class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td><label for="Address Line 2">Address Line 2</label></td>
                                                            <td>
                                                                <input type="text" id="address2-billing"
                                                                    value="<?php echo $row2['address_street2']; ?>" class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Country">Country</label></td>
                                                            <td>
                                                                <!-- <select name="country_shipping" id="country-shipping"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <option value="<?php echo $row2['address_country']; ?>" selected> <?php echo $row2['address_country']; ?> </option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CH">Switzerland</option>
                                                                </select> -->

                                                                <select name="country_billing" id="country-billing" class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $row2['address_country'] = $row2['address_country']; // Replace this with the actual value of $row['address_country']
                                                                            $options = [
                                                                                "Canada" => "Canada",
                                                                                "United States" => "United States",
                                                                                "Switzerland" => "Switzerland",
                                                                                "Pakistan" => "Pakistan",
                                                                            ];

                                                                            foreach ($options as $value => $content) {
                                                                                $selected = ($row2['address_country'] === $value) ? 'selected' : '';
                                                                                echo '<option value="' . $value . '" ' . $selected . '>' . $content . '</option>';
                                                                            }
                                                                            ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Province/State">Province/State</label></td>
                                                            <td>
                                                                <select name="state_billing" id="state-billing"
                                                                    class="form-select border-0 state-dropdown">
                                                                    <option value="<?php echo $row2['address_state']; ?>" selected> <?php echo $row2['address_state']; ?> </option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Postal Address/Zip Code">Postal Address/Zip Code</label></td>
                                                            <td>
                                                                <input type="text" name="zip_code"
                                                                    id="zip-code-billing"
                                                                    class="form-control border-0" value="<?php echo $row2['address_post_code']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="City">City</label></td>
                                                            <td>
                                                                <input type="text" id="city-billing"
                                                                    class="form-control border-0" value="<?php echo $row2['address_city']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Shipping Address</h5>
                                                    <table class="table table-sm table-bordered address-table">
                                                        <tr>
                                                            <td><label for="First Name">First Name</label></td>
                                                            <td>
                                                                <input type="text" id="fname-shipping"
                                                                    class="form-control border-0" value="<?php echo $row['address_firstname']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Last Name">Last Name</label></td>
                                                            <td>
                                                                <input type="text" id="lname-shipping"
                                                                    class="form-control border-0" value="<?php echo $row['address_lastname']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Address">Address</label></td>
                                                            <td>
                                                                <input type="text" id="address1-shipping"
                                                                    class="form-control border-0"  value="<?php echo $row['address_street']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td><label for="Address Line 2">Address Line 2</label></td>
                                                            <td>
                                                                <input type="text" id="address2-shipping"
                                                                    class="form-control border-0" value="<?php echo $row['address_street2']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Country">Country</label></td>
                                                            <td>
                                                                <!-- <select name="country_shipping" id="country-shipping"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <option value="<?php echo $row['address_country']; ?>" selected> <?php echo $row['address_country']; ?> </option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CH">Switzerland</option>
                                                                </select> -->

                                                                <select name="country_shipping" id="country_shipping" class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                             $row['address_country'] =  $row['address_country']; // Replace this with the actual value of $row['address_country']
                                                                             $options = [
                                                                                "Canada" => "Canada",
                                                                                "United States" => "United States",
                                                                                "Switzerland" => "Switzerland",
                                                                                "Pakistan" => "Pakistan",
                                                                            ];

                                                                            foreach ($options as $value => $content) {
                                                                                $selected = ( $row['address_country'] === $value) ? 'selected' : '';
                                                                                echo '<option value="' . $value . '" ' . $selected . '>' . $content . '</option>';
                                                                            }
                                                                            ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Province/State">Province/State</label></td>
                                                            <td>
                                                                <select name="state_shipping" id="state-shipping"
                                                                    class="form-select border-0 state-dropdown">
                                                                    <option value="<?php echo $row['address_state']; ?>" selected> <?php echo $row['address_state']; ?> </option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Postal Address/Zip Code">Postal Address/Zip Code</label></td>
                                                            <td>
                                                                <input type="text" name="zip_code" id="zip-code-shipping"
                                                                    class="form-control border-0">
                                                                    value="<?php echo $row['address_post_code']; ?>"
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="City">City</label></td>
                                                            <td>
                                                                <input type="text" id="city-shipping"
                                                                    class="form-control border-0" value="<?php echo $row['address_city']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>


                                            <div class="form-check" style="
    display: flex;
    align-items: center;
">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="same_shipping_information" id="same_shipping_information">
                                                            <label class="form-check-label" for="same_shipping_information" style="
    margin-left: 5px;
    margin-bottom: 0px;
">
                                                                My Shipping information is the same as my billing information
                                                            </label>
                                                        </div>

                                            <div class="col-md-6 my-3">
                                                    <h5>Which Address Do You Want to Use as Shipping Label?</h5>
                                                    <div class="d-flex gap-3" style="
                                                                                    display: flex;
                                                                                    gap: 40px;
                                                                                    ">
                                                       
                                                        <div class="form-check"style="
    display: flex;
    justify-content: center;
    align-items: center;
">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_type" id="address_type2">
                                                            <label class="form-check-label" for="address_type2" style="
    margin-left: 5px;
    margin-bottom: 0px;
">
                                                                Billing Address
                                                            </label>

                                                            
                                                            <input class="form-check-input" type="radio"
                                                                name="address_type" id="address_type1">
                                                            <label class="form-check-label" for="address_type1" style="
    margin-left: 5px;
    margin-bottom: 0px;
">
                                                                Shipping Address
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="border-bottom border-primary border-2">

                                                <div class="form-check" style="
    display: flex;
    align-items: center;
">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="signature" id="signature">
                                                            <label class="form-check-label" for="signature" style="
    margin-left: 5px;
    justify-content: center;
    margin-bottom: 0px;
">
                                                                Signature
                                                            </label>

                                                            <input class="form-check-input" type="checkbox"
                                                                name="hold_for_pickup" id="hold_for_pickup" style="
    margin-left: 15px;
">
                                                            <label class="form-check-label" for="hold_for_pickup" style="
    margin-left: 5px;
    justify-content: center;
    margin-bottom: 0px;
">
                                                               Hold for Pickup
                                                            </label>
                                                        </div>

                                                        <hr class="border-bottom border-primary border-2">

                                                <div id="custom_form" style="display: none;">
                                                        <h3>Custom Form:</h3>
                                                        <div class="form-group col-md-12 box-details text-start mt-3">
                                                            <div class="d-flex gap-2 mb-3 single-box" style="display: flex;gap: 5px;flex-wrap: wrap;margin: 1% auto;">
                                                                <div>
                                                                    <label for="">Non-delivery of Goods</label>
                                                                    <!-- <select name="non_delivery" id="country-billing"
                                                                            class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <option value="<?php echo $NonDeliveryGoods; ?>" selected> <?php echo  $NonDeliveryGoods; ?> </option>
                                                                            <option value="RASE">Return at Sender's Expense</option>
                                                                            <option value="RTS">Return to Sender</option>
                                                                            <option value="ABAN">Abandon</option>
                                                                        </select> -->

                                                                        <select name="non_delivery" id="non_delivery_goods" class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $NonDeliveryGoods = $NonDeliveryGoods; // Replace this with the actual value of $NonDeliveryGoods
                                                                            $options = [
                                                                                "RASE" => "Return at Sender's Expense",
                                                                                "RTS" => "Return to Sender",
                                                                                "ABAN" => "Abandon"
                                                                            ];

                                                                            foreach ($options as $value => $content) {
                                                                                $selected = ($NonDeliveryGoods === $value) ? 'selected' : '';
                                                                                echo '<option value="' . $value . '" ' . $selected . '>' . $content . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                </div>
                                                                <div>
                                                                    <label for="">Reason for Export</label>
                                                                    <!-- <select name="reason_export" id="country-billing"
                                                                            class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <option value="<?php echo  $ReasonForExport; ?>" selected> <?php echo  $ReasonForExport; ?> </option>
                                                                            <option value="DOC">Document</option>
                                                                            <option value="SAM">Commercial Sample</option>
                                                                            <option value="REP">Repair or Warranty</option>
                                                                            <option value="SOG">Sale of Goods</option>
                                                                            <option value="OTH">Other</option>
                                                                        </select> -->
                                                                        <select name="reason_export" id="reason_export" class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $ReasonForExport = $ReasonForExport; // Replace this with the actual value of $ReasonForExport
                                                                            $options = [
                                                                                "DOC" => "Document",
                                                                                "SAM" => "Commercial Sample",
                                                                                "REP" => "Repair or Warranty",
                                                                                "SOG" => "Sale of Goods",
                                                                                "OTH" => "Other"
                                                                            ];

                                                                            foreach ($options as $value => $content) {
                                                                                $selected = ($ReasonForExport === $value) ? 'selected' : '';
                                                                                echo '<option value="' . $value . '" ' . $selected . '>' . $content . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                </div>
                                                                <div>
                                                                    <label for="">Country of Origin</label>
                                                                        <!-- <select name="origin_country" id="country-billing"
                                                                            class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <option value="<?php echo  $CountryOfOrigin; ?>" selected> <?php echo $CountryOfOrigin; ?> </option>
                                                                            <option value="CA">Canada</option>
                                                                            <option value="US">USA</option>
                                                                            <option value="PK">PAKISTAN</option>
                                                                        </select> -->

                                                                        <select name="origin_country" id="origin_country" class="form-select border-0 country-dropdown">
                                                                            <option value="">Select</option>
                                                                            <?php
                                                                            $CountryOfOrigin = $CountryOfOrigin; // Replace this with the actual value of $CountryOfOrigin
                                                                            $options = [
                                                                                "CA" => "Canada",
                                                                                "US" => "USA",
                                                                                "PK" => "PAKISTAN"
                                                                            ];

                                                                            foreach ($options as $value => $content) {
                                                                                $selected = ($CountryOfOrigin === $value) ? 'selected' : '';
                                                                                echo '<option value="' . $value . '" ' . $selected . '>' . $content . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                </div>
                                                                <div>
                                                                    <label for="">Shipment Value</label>
                                                                    <input type="number" placeholder="Shipment Value" value="<?php echo  $ShipmentValue; ?>" id="shipment_value"
                                                                        class="form-control">
                                                                </div>

                                                                <!-- Contact Phone number -->
                                                                <div>
                                                                    <label for="">Contact Phone number</label>
                                                                    <input type="number" placeholder="Contact Phone number" id="contact_phone_number"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>

                                                <hr class="border-bottom border-primary border-2">


                                                <h3>Preset Box Size And Weights*</h3>
                                                <div style="
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
">
                                                    
                                                    <br>
                                                    <?php foreach ($presets as $preset): ?>
                                                    <div class="form-check form-check" style="
    display: flex;
    justify-content: center;
    align-items: center;
">
                                                        <input class="form-check-input prefix-types" name="prefix_types" type="radio" value="<?php echo $preset['box_length'] . '-' . $preset['box_width'] . '-' . $preset['box_height'] . '-' . $preset['box_weight']; ?>" id="reverseCheck<?php echo $preset['id']; ?>">
                                                         
                                                        <label class="form-check-label" style="margin-left: 5px; margin-bottom: 0px;" for="reverseCheck<?php echo $preset['id']; ?>">
                                                            <strong><?php echo $preset['box_name']; ?>:</strong> <br>      
                                                            <?php
                                                                if ($preset['box_unit_type'] === "Metric") {
                                                                    echo $preset['box_length'] . ' x ' . $preset['box_width'] . ' x ' . $preset['box_height'] . ' CM (' . $preset['box_weight'] . ' KG)';
                                                                } else {
                                                                    echo $preset['box_length'] . ' x ' . $preset['box_width'] . ' x ' . $preset['box_height'] . ' INCH (' . $preset['box_weight'] . ' LBS)';
                                                                }
                                                                ?>
                                                        </label>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>

                                              
                                                            <!-- <button class="btn btn-primary switch-button" id="imperialBtn" style="
    margin-left: 5px;
    margin-bottom: 0px;
    margin-top: 5px;
" data-unit-type="imperial">Switch to Imperial</button>
                                                       
                                                            <button class="btn btn-primary switch-button" id="MetricBtn" style="
    margin-left: 5px;
    margin-bottom: 0px;
    margin-top: 5px;
    display:none;
" data-unit-type="metric">Switch to Metric</button> -->
                                                       
                                                
                                                <div class="form-group col-md-12 box-details text-start mt-3">
                                                    <div class="d-flex gap-2 mb-3 single-box" style="display: flex;gap: 5px;flex-wrap: wrap;margin: 1% auto;">
                                                        <div>
                                                            <label for="">Length <span class="metricspan">(CM)</span> <span class="imperialspan">(INCH)</span></label>
                                                            <input type="number" placeholder="Length" id="box-length"
                                                                class="form-control" style="width: 70px;">
                                                        </div>
                                                        <div>
                                                            <label for="">Width <span class="metricspan">(CM)</span> <span class="imperialspan">(INCH)</span></label>
                                                            <input type="number" placeholder="Width" id="box-width"
                                                                class="form-control" style="width: 70px;">
                                                        </div>
                                                        <div>
                                                            <label for="">Height <span class="metricspan">(CM)</span> <span class="imperialspan">(INCH)</span></label>
                                                            <input type="number" placeholder="Height" id="box-height"
                                                                class="form-control" style="width: 70px;">
                                                        </div>
                                                        <div>
                                                            <label for="">Weight <span id="metricweightspan">(KG)</span> <span id="imperialweightspan">(LB)</span></label>
                                                            <input type="number" placeholder="Weight" id="box-weight"
                                                                class="form-control" style="width: 70px;margin-top: 4px;">
                                                        </div>
                                                        <div>
                                                            <label for="">Insurance <span style="display: block;">(NUM)</span> <span style="display: none;">(LB)</span></label>
                                                            <input type="number" placeholder="Insurance"
                                                                id="box-insurance" class="form-control" value="100" style="width: 70px; margin-top: 4px;">
                                                        </div>

                                                        <button class="btn btn-primary switch-button" id="imperialBtn" style="
    margin-left: 5px;
    margin-bottom: 0px;
    margin-top: 43px;
    height: 30px;
" data-unit-type="imperial">Switch to Imperial</button>
                                                       
                                                            <button class="btn btn-primary switch-button" id="MetricBtn" style="
    margin-left: 5px;
    margin-bottom: 0px;
    margin-top: 43px;
    height: 30px;
    display:none;
" data-unit-type="metric">Switch to Metric</button>
                                                    </div>

                                                    
                                                </div>


                                               
                                             

                                                <div class="col-12 text-end">
                                                    <button class="btn btn-primary" type="button"
                                                        id="confirm-button">Get Rates</button>
                                                </div>
                                                <div class="col-md-4 my-2 py-2" id="parcel-type-parent"
                                                    style="display: none;">
                                                    <div id="parcel-types" style="display: flex;flex-wrap: wrap;"></div>
                                                </div>
                                                <!-- <div class="col-md-4 extra-fields" style="display: none;">
                                                    <label for="non-delivery-instruction">Non Delivery
                                                        Instructions</label>
                                                    <select name="non_delivery_instruction"
                                                        id="non-delivery-instruction" class="form-select">
                                                        <option>Return To Sender</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 extra-fields" style="display: none;">
                                                    <label for="reason-for-export">Reason For Export</label>
                                                    <select name="reason_for_export" id="reason-for-export"
                                                        class="form-select">
                                                        <option>Repair/Warranty</option>
                                                    </select>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <div id="receipt-div"></div>
                                                    <button class="btn btn-primary" type="button" style="display: none;"
                                                        id="shipment-button">Create Label</button>
                                                        <button class="btn btn-secondary" type="button" style="display: none;" id="print-pdf">Print</button>
                                                </div>

                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/jquery.js"></script>
            <script src="assets/js/script.js"></script>

    <script>


            // JavaScript to limit input length to 5 digits for each field individually
            const inputIds = ["box-length", "box-width", "box-height", "box-weight", "box-insurance"];
            
            inputIds.forEach((id) => {
                const inputField = document.getElementById(id);
                if (inputField) {
                    inputField.addEventListener('input', () => {
                        if (inputField.value.length > 5) {
                            inputField.value = inputField.value.slice(0, 5);
                        }
                    });
                }
            });


        //  CHECK BTNS:
        // Get the current URL
        var currentURL = window.location.href;

        console.log(currentURL);
        console.log(currentURL.indexOf('ctrl=order'));

        // Check if the URL contains "ctrl=order"
        if (currentURL.indexOf('ctrl=order') !== -1) {
            // Show the buttons if "ctrl=order" is present
            document.getElementById('openModal').style.display = 'inline';
            document.getElementById('refundButton').style.display = 'inline';
            document.getElementById('endOfDayButton').style.display = 'inline';
        } else {
            // Hide the buttons if "ctrl=order" is not present
            document.getElementById('openModal').style.display = 'none';
            document.getElementById('refundButton').style.display = 'none';
            document.getElementById('endOfDayButton').style.display = 'none';
        }


        // JavaScript to open and close the modal
        document.addEventListener("DOMContentLoaded", function () {
            const openModalButton = document.getElementById("openModal");
            const closeModalButton = document.getElementById("closeModal");
            const modal = document.getElementById("myModal");

            openModalButton.addEventListener("click", function () {
                modal.style.display = "block";
            });

            closeModalButton.addEventListener("click", function () {
                modal.style.display = "none";
            });

            window.addEventListener("click", function (event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });



            // MORE CODE
            document.getElementById("country_shipping_chzn").addEventListener("click", function () {
                let country = $("#country_shipping_chzn > a > span").text();

                if (country == 'Canada') {
                    country = "CA";
                } else if (country == 'United States') {
                    country = "US";

                } else if (country == 'Switzerland') {
                    country = "CH";
                } else if (country == 'Pakistan') {
                    country = "PK";
                }


                console.log('CHANGEDD COUNTRY');
                console.log(country);

                if (country!="CA") {
                    console.log('HERE');
                    $("#custom_form").show()
                }
                else{
                    console.log('HERE 2');
                    $("#custom_form").hide()
                }

                $.getJSON('statesNew.json',function(data){
                    let states = data.filter((state,i)=>{
                        if (country==state.country_code) {
                            return state;
                        }
                    })

                    $(".state-dropdown").html("<option value=''>Select</option>");
                    $(".state-dropdown").css("display", "block");
                    $("#state_shipping_chzn").css("display", "none");
                    $("#state_billing_chzn").css("display", "none");

                    if (states.length == 0) {
                        $(".state-dropdown").append("<option value='<?php echo $row["address_state"]; ?>' selected><?php echo $row['address_state']; ?></option>");
                    }

                    states.forEach((state)=>{
                        $(".state-dropdown").append(`<option value="${state.state_code}">${state.name}</option>`)
                    })
                })

            });

             // MORE CODE
             document.getElementById("country_billing_chzn").addEventListener("click", function () {
                let country = $("#country_billing_chzn > a > span").text();

                if (country == 'Canada') {
                    country = "CA";
                } else if (country == 'United States') {
                    country = "US";

                } else if (country == 'Switzerland') {
                    country = "CH";
                } else if (country == 'Pakistan') {
                    country = "PK";
                }

                if (country!="CA") {
                    console.log('HERE');
                    $("#custom_form").show()
                }
                else{
                    console.log('HERE 2');
                    $("#custom_form").hide()
                }

                $.getJSON('statesNew.json',function(data){
                    let states = data.filter((state,i)=>{
                        if (country==state.country_code) {
                            return state;
                        }
                    })

                    $(".state-dropdown").html("<option value=''>Select</option>");
                    $(".state-dropdown").css("display", "block");
                    $("#state_shipping_chzn").css("display", "none");
                    $("#state_billing_chzn").css("display", "none");

                    if (states.length == 0) {
                        $(".state-dropdown").append("<option value='<?php echo $row["address_state"]; ?>' selected><?php echo $row['address_state']; ?></option>");
                    }

                    states.forEach((state)=>{
                        $(".state-dropdown").append(`<option value="${state.state_code}">${state.name}</option>`)
                    })
                })

            });


            // document.getElementById("printer_type").addEventListener("click", function () {

            //     console.log('PRINTER CLICKED');

            // });

            $(".country-dropdown").on("change",function(){
              
                let country = $(this).val();

                console.log('CHANGED COUNTRY');
                console.log(country);
                $.getJSON('states.json',function(data){
                    let states = data.filter((state,i)=>{
                        if (country==state.country_code) {
                            return state;
                        }
                    })
                    $(".state-dropdown").html("<option value=''>Select</option>");
                    states.forEach((state)=>{
                        $(".state-dropdown").append(`<option value="${state.state_code}">${state.name}</option>`)
                    })
                })
            })

        });

        // MORE CODE
        $(document).ready(function(){
               
            var originalValues = {
                    length: $('#box-length').val(),
                    width: $('#box-width').val(),
                    height: $('#box-height').val(),
                    weight: $('#box-weight').val()
                };

            $(".prefix-types").on("change",function(){
                let values = $(this).val().split("-");
                $("#box-length").val(values[0])                
                $("#box-width").val(values[1])                
                $("#box-height").val(values[2])                
                $("#box-weight").val(values[3])       
                
                 // Define variables to store original values
                
            })



                // Define a variable to keep track of the current unit type
                var currentUnitType = 'imperial'; // Assuming the initial unit type is imperial
                

               // Function to toggle the button text
                function toggleSwitchButton() {
                    if (currentUnitType === 'metric') {

                        $('#MetricBtn').css('display', 'block');
                        $('#imperialBtn').css('display', 'none');
                        $('.metricspan').css('display', 'none');
                        $('.imperialspan').css('display', 'block');
                        $('#metricweightspan').css('display', 'none');
                        $('#imperialweightspan').css('display', 'block');
                       

                        $('.switch-button').text('Switch to Metric');

                    } else {

                        $('#MetricBtn').css('display', 'none');
                        $('#imperialBtn').css('display', 'block');
                        $('.metricspan').css('display', 'block');
                        $('.imperialspan').css('display', 'none');
                        $('#metricweightspan').css('display', 'block');
                        $('#imperialweightspan').css('display', 'none');

                        $('.switch-button').text('Switch to Imperial');
                    }
                }


            $('.switch-button').click(function () {

                event.preventDefault(); // Prevent page reload

                // Toggle the unit type and button text
                currentUnitType = currentUnitType === 'metric' ? 'imperial' : 'metric';
                toggleSwitchButton();

                var unitType = $(this).data('unit-type');

                // Assuming you have a button element with an id attribute
                var buttonId = $('.switch-button').attr('id');
             
                if (unitType === 'metric') {
                    // console.log('HEREE 2');
                    // Switch to metric units logic here
                    $('#box-length').val(convertToMetric($('#box-length').val()).toFixed(1));
                    $('#box-width').val(convertToMetric($('#box-width').val()).toFixed(1));
                    $('#box-height').val(convertToMetric($('#box-height').val()).toFixed(1));
                    $('#box-weight').val(convertToMetric($('#box-weight').val()).toFixed(1));
                } else {

                          

                    // console.log('here');
                    // console.log(originalValues);
                    // // Switch to imperial units logic here
                    $('#box-length').val(convertToImperial($('#box-length').val()).toFixed(1));
                    $('#box-width').val(convertToImperial($('#box-width').val()).toFixed(1));
                    $('#box-height').val(convertToImperial($('#box-height').val()).toFixed(1));
                    $('#box-weight').val(convertToImperial($('#box-weight').val()).toFixed(1));

                     // Reverting back original Values
                    // $('#box-length').val(originalValues.length);
                    // $('#box-width').val(originalValues.width);
                    // $('#box-height').val(originalValues.height);
                    // $('#box-weight').val(originalValues.weight);
                }
            });



            // Call the toggleSwitchButton function to set the initial button text
            toggleSwitchButton();

                // Function to convert from metric to imperial units
                function convertToImperial(metricValue) {
                    // console.log('metric Value ready to convert');
                    // console.log(metricValue);
                    // console.log('AFTER CONVERSION');
                    // console.log(Math.round(metricValue / 2.54.toFixed(1)));
                    // Implement conversion logic here
                    // For example, if metricValue is in centimeters, convert it to inches
                    return Math.round(metricValue / 2.54.toFixed(1));
                }

                // Function to convert from imperial to metric units
                function convertToMetric(imperialValue) {
                    // console.log('imperial Value ready to convert');
                    // console.log(imperialValue);
                    // console.log('AFTER CONVERSION');
                    // console.log(Math.round(imperialValue * 2.54.toFixed(1)));
                    // Implement conversion logic here
                    // For example, if imperialValue is in inches, convert it to centimeters
                    return Math.round(imperialValue * 2.54.toFixed(1));
                }


            $("#confirm-button").on("click",function(){

                var useBillingAddress = $('#address_type2').prop('checked');
                var useShippingAddress = $('#address_type1').prop('checked');

                if (!useBillingAddress && !useShippingAddress) {
                    alert('Please choose which address you want to use as a shipping label?');
                    return;
                }

                // Encode the PHP object as a JSON string and pass it to JavaScript
                var printerType = <?php echo json_encode($decodedObject); ?>;

                // Now, printerType is a JavaScript object that you can access its properties
                console.log(printerType);

                let weight = $("#box-weight").val();
                let length = $("#box-length").val();
                let width = $("#box-width").val();
                let height = $("#box-height").val();
                if (useShippingAddress) {
                   var zipCode = $("#zip-code-shipping").val();
                } else {
                    var zipCode = $("#zip-code-billing").val();
                }

                // alert('here');
                // alert(useShippingAddress);
                // alert(useBillingAddress);
                // alert(zipCode);

                let country = $(".country-dropdown").val();
                if (!weight || !length || !width || !height || !zipCode || !country) {
                    alert("Please Fill All the Required Fields");
                    return;
                }
                if (country == 'Canada') {
                    country = "CA";
                } else if (country == 'United States') {
                    country = "US";

                } else if (country == 'Switzerland') {
                    country = "CH";
                } else if (country == 'Pakistan') {
                    country = "PK";
                }

                $(".main-loader").fadeIn(300)
                $.ajax({
                    type:"GET",
                    url:"rating/REST/rating/GetRates/GetRates.php",
                    data:{
                        weight,length,width,height,zipCode,country
                    },
                    success:function(res){

                        $("#shipment-button").show();
                        
                        $(".main-loader").fadeOut(300)
                        res = JSON.parse(res);
                        if (res.status==500) {
                            $("#parcel-types").html("");
                            alert(res.data.message.description);
                            // alert("Something Went Wrong");
                            return;
                        }
                        res = res.data['price-quote'];
                        $("#parcel-types").html("");
                        $("#parcel-types").parent().show();
                        
                        if (!Array.isArray(res)) {   
                            parcelType = res;
                            // let days = dateDifference(parcelType["service-standard"]["expected-delivery-date"]);
                            let days = parcelType["service-standard"]["expected-transit-time"];
                            $("#parcel-types").append(`
                                <label for="parcel-type-0" class="card flex-row mb-2" style="cursor:pointer;border: 1px solid blue;border-radius: 10px;padding: 10px;margin: 10px;">
                                    <span class="px-3">
                                        <input type="radio" id="parcel-type-0" value="${parcelType["service-code"]}" name="parcel_type" id="parcel_type" class="form-radio parcel-type">
                                    </span>
                                    <div>
                                        <h5>${parcelType["service-name"]}</h5>
                                        <p>Estimated Delivery : ${days} days</p>
                                    </div>
                                    <div class="text-end">$${parcelType["price-details"]["due"]}</div>
                                </label>
                            `)
                            return;
                        }
                        res.forEach((parcelType,i)=>{
                            // let days = dateDifference(parcelType["service-standard"]["expected-delivery-date"]);
                            let days = parcelType["service-standard"]["expected-transit-time"];
                            $("#parcel-types").append(`
                                <label for="parcel-type-${i}" class="card flex-row mb-2" style="cursor:pointer;border: 1px solid blue;border-radius: 10px;padding: 10px;margin: 10px;">
                                    <span class="px-3">
                                        <input type="radio" id="parcel-type-${i}" value="${parcelType["service-code"]}" name="parcel_type" id="parcel_type" class="form-radio parcel-type">
                                    </span>
                                    <div>
                                        <h5>${parcelType["service-name"]}</h5>
                                        <p>Estimated Delivery : ${days} days</p>
                                    </div>
                                    <div class="text-end">$${parcelType["price-details"]["due"]}</div>
                                </label>
                            `)
                        })

                        console.log('COUNTRY:');
                        console.log(country);
                        
                        if (country!="CA") {
                            console.log('HERE');
                            $("#shipment-button,.extra-fields").show()
                            $("#custom_form").show()
                        }
                        else{
                            console.log('HERE 2');
                            $(".extra-fields").hide()
                            $("#custom_form").hide()
                            $("#shipment-button").show()
                        }
                    }
                })
            })
            $("#shipment-button").on("click",function(){

                let selectedParcelTypes = $(".parcel-type:checked");
                if (selectedParcelTypes.length==0) {
                    $("#parcel-type-parent").addClass("border border-danger")
                    $("#shipment-button").parent().append("<span class='text-danger'>Please Select One Parcel Type</span>")
                    return;
                }
                $("#parcel-type-parent").removeClass("border border-danger")
                $("#shipment-button").parent().find("span.text-danger").hide();

                // let printerType = $("#printer_type_chzn > a > span").text();

                let printerType = "<?php echo $printerType ?>";

                console.log(printerType);

              
                var useBillingAddress = $('#address_type2').prop('checked');
                var useShippingAddress = $('#address_type1').prop('checked');
                
                if (useBillingAddress) {
                    console.log('USING BILLING');
                    var weight = $("#box-weight").val(),length = $("#box-length").val(),width = $("#box-width").val(),height = $("#box-height").val(),zipCode = $("#zip-code-billing").val(),country = $(".country-dropdown").val();
                    var fname = $("#fname-billing").val(),lname = $("#lname-billing").val(),address1 = $("#address1-billing").val(),address2 = $("#address2-billing").val(),city = $("#city-billing").val();
                    var state = $("#state-billing").val();
                
                } else {
                    console.log('USING SHIPPING');
                    var weight = $("#box-weight").val(),length = $("#box-length").val(),width = $("#box-width").val(),height = $("#box-height").val(),zipCode = $("#zip-code-shipping").val(),country = $(".country-dropdown").val();
                    var fname = $("#fname-shipping").val(),lname = $("#lname-shipping").val(),address1 = $("#address1-shipping").val(),address2 = $("#address2-shipping").val(),city = $("#city-shipping").val();
                    var state = $("#state-shipping").val();
                }

                let parcelType = $(".parcel-type:checked").val();
                let signature = $('#signature').prop('checked');
                let holdForPackup = $("#hold_for_pickup").prop('checked');

                if (signature) {
                    signature = 'SO';
                }

                if (holdForPackup) {
                    holdForPackup = 'HFP';
                }

                // var state = $("#state-shipping").val();
                
                if (state == "Ontario ") {
                    state = "ON";
                }

             
                if (!weight || !length || !width || !height || !zipCode || !fname || !lname  || !address1 || !state || !city || !parcelType) {
                    alert("Please Fill All the Required Fields");
                    return;
                }

                if (country == 'Canada') {
                    country = "CA";
                } else if (country == 'United States') {
                    country = "US";
                }  else if (country == 'Switzerland') {
                    country = "CH";
                } else if (country == 'Pakistan') {
                    country = "PK";
                }
                
                // alert(zipCode)
                // return;

                var nonDeliveryGoods = $('#non_delivery_goods').val();
                var reasonExport = $('#reason_export').val();
                var originCountry = $('#origin_country').val();
                var shipmentValue = $('#shipment_value').val();
                var contactPhoneNumber = $('#contact_phone_number').val();

                if (country == "US") {
                    if (!nonDeliveryGoods) {
                        alert('Non Delivery Goods is Required Field.');
                        return;
                    }
                    if (!contactPhoneNumber) {
                        alert('Contact Phone Number is Required.');
                        return;
                    }
                }

                // Check if the weight and dimensions are in CM and KG
                if ($('#metricweightspan').css('display') === 'block') {
                    // Convert weight from KG to pounds (1 KG ≈ 2.20462 pounds)
                    var convertedweight = weight / 2.20462;

                    // Convert dimensions from CM to inches (1 CM ≈ 0.393701 inches)
                    var convertedlength = length * 0.393701;
                    var convertedwidth = width * 0.393701;
                    var convertedheight = height * 0.393701;
                } else {
                    var convertedweight = weight;
                    var convertedlength = length;
                    var convertedwidth = width;
                    var convertedheight = height;
                }

                console.log(convertedweight);

                // Calculate girth in inches
                let girth = convertedlength + (convertedheight * 2) + (convertedwidth * 2);

                // if (country === "CA") {
                //     // Check if weight is less than 0.2 lb and dimensions are within the specified range
                //     if (convertedweight < 0.2 || convertedlength < 9.1 || convertedwidth < 7.9 || convertedheight < 1.0) {
                //         alert("Dimensions are wrong for this parcel. Minimum requirements: Weight: 0.2 lb, Length: 9.1 in, Width: 7.9 in, Height: 1.0 in");
                //         return;
                //     } else {
                //         // Parcel meets the minimum requirements

                //         // Now check if weight is less than 66 lb and the sum of length and girth is less than 118 inches
                //         if (convertedweight > 66 || (convertedlength + girth) > 118) {
                //             alert("Parcel exceeds maximum values. Maximum requirements: Weight: 66 lb, Length + Girth: 118 in");
                //             return;
                //         } else {
                //             // Parcel meets the maximum requirements
                //             // You can continue with your code here
                //         }
                //     }
                // } else if (country === "US") {
                //         if (parcelType === "USA.EP") {
                //             // Check if weight is less than 0.2 lb and dimensions are within the specified minimum values
                //             if (weight > 0.2 || length < 8.3 || width < 5.5 || height < 0.2) {
                //             alert("Parcel does not meet minimum requirements for Expedited ParcelTM – USA. Minimum requirements:\nWeight: 0.2 lb\nLength: 8.3 in\nWidth: 5.5 in\nHeight: 0.2 in");
                //             return;    
                //             } else if (weight > 66 || length + width + height > 107.9) {
                //             alert("Parcel exceeds maximum values for Expedited ParcelTM – USA. Maximum requirements:\nWeight: 66 lb\nLength + Girth: 107.9 in");
                //             return;    
                //             } else {
                //             // Parcel meets the requirements for USA.EP
                //             // You can continue with your code here
                //             }
                //         } else if (parcelType === "USA.XP") {
                //             // Check if weight is less than 0.1 lb and dimensions are within the specified minimum values
                //             if (weight > 0.1 || length < 8.3 || width < 5.5 || height < 0.039) {
                //             alert("Parcel does not meet minimum requirements for XpresspostTM – USA. Minimum requirements:\nWeight: 0.1 lb\nLength: 8.3 in\nWidth: 5.5 in\nHeight: 0.039 in");
                //             return;   
                //             } else if (weight > 66 || length + width + height > 107.9) {
                //             alert("Parcel exceeds maximum values for XpresspostTM – USA. Maximum requirements:\nWeight: 66 lb\nLength + Girth: 107.9 in");
                //             return;    
                //             } else {
                //             // Parcel meets the requirements for USA.XP
                //             // You can continue with your code here
                //             }
                //         } else {
                //             // Unsupported parcel type for the US
                //             // alert("Unsupported parcel type for the US");
                //             // return;
                //         }
                //  } else {
                //         // Parcel is not going to Canada, so no need to check dimensions
                //         // You can continue with your code here
                //         if (parcelType === "INT.XP") {
                //                     // Check if weight is less than 0.2 lb and dimensions are within the specified minimum values
                //                     if (weight > 0.2 || length < 8.3 || width < 5.5 || height < 0.039) {
                //                     alert("Parcel does not meet minimum requirements for XpresspostTM – International . Minimum requirements:\nWeight: 0.2 lb\nLength: 8.3 in\nWidth: 5.5 in\nHeight: 0.039 in");
                //                     return;    
                //                     } else if (weight > 66 || length + width + height > 118) {
                //                     alert("Parcel exceeds maximum values for XpresspostTM – International . Maximum requirements:\nWeight: 66 lb\nLength + Girth: 118 in");
                //                     return;    
                //                     } else {
                //                     // Parcel meets the requirements for USA.EP
                //                     // You can continue with your code here
                //                     }
                //         } else {
                //             // Unsupported parcel type for the US
                //             // alert("Unsupported parcel type for the US");
                //             // return;
                //         }
                // }

                $(".main-loader").fadeIn(300);
                    $.ajax({
                        type: "get",
                        url: "shipping/REST/shipping/CreateShipment/CreateShipment.php",
                        data: {
                            weight, length, width, height, zipCode, fname, lname, address1, address2, state, city, parcelType, country, printerType,signature,holdForPackup,nonDeliveryGoods,contactPhoneNumber
                        },
                        success: function (res) {

                            // Split the response into lines
                            var lines = res.split('\n');

                            // Initialize variables to store error code and error message
                            var errorCode = null;
                            var errorMessage = null;
                            var responseStatus = null;

                            // Loop through the lines to find error code and message
                            for (var i = 0; i < lines.length; i++) {
                                var line = lines[i].trim();
                                if (line.startsWith("Error Code:")) {
                                    errorCode = line.split(":")[1].trim();
                                } else if (line.startsWith("Error Msg:")) {
                                    errorMessage = line.split(":")[1].trim();
                                }
                                else if (line.startsWith("HTTP Response Status:")) {
                                    responseStatus = line.split(":")[1].trim();
                                }
                            }

                            // alert(errorMessage);

                            if (errorCode === "2653") {
                                alert(errorMessage);
                                // TODO: Optional 
                                return;
                            }


                            res = JSON.parse(res);
                            res = res.data;
                            $(".main-loader").fadeOut(300);
                            
                            // Log the value before updating the HTML
                            // console.log("Shipment ID:", res['shipment-id']);
                            // console.log("Tracking PIN:", res['tracking-pin']);

                            localStorage.setItem('shipmentId', res['shipment-id']);



                          


                            // Ensure that the element with ID "receipt-div" exists
                            var receiptDiv = $("#receipt-div");
                            if (receiptDiv.length) {
                                receiptDiv.prepend(`
                                    <div class="card border border-primary border-2 rounded-2 mb-3 text-center">
                                        <div class="card-body">
                                            <h5 id="shipmentId">Your Shipment ID is: ${res['shipment-id']}</h5> 
                                            <h5 id="trackingPin">Your Tracking PIN is: ${res['tracking-pin']}</h5>
                                            
                                        </div>
                                    </div>
                                `);
                            } else {
                                console.log("Element with ID 'receipt-div' not found.");
                            }

                            $("#shipmentId").val(res['shipment-id']);
                            $("#trackingPin").val(res['tracking-pin']);
                            $("#print-pdf").show()

                        }
                    });
                
            });

            $("#print-pdf").on("click", function () {

                let shipmentId = $("#shipmentId").val();

                $.ajax({
                    type: "get",
                    url: "shipping/REST/shipping/GetShipment/GetShipment.php",
                    data: {
                        shipmentId
                    },
                    success: function (res) {

                       // Split the string into lines
                        const lines = res.split('\n');

                        // Initialize a variable to store the label value
                        let labelValue = null;

                        // Iterate through the lines
                        for (const line of lines) {
                            // Check if the line contains "label:"
                            if (line.includes("label:")) {
                                // Extract the value after "label:"
                                labelValue = line.split("label:")[1].trim();
                                break; // Exit the loop once the label value is found
                            }
                        }

                        // Open the labelValue URL in a new tab
                        if (labelValue) {
                            $("#myModal").hide();
                            window.open(labelValue, '_blank');
                        } else {
                            console.log("Label URL not found.");
                        }
                    }
                });

                 

                // // RequestShipmentRefund.php
                // $.ajax({
                //     type: "get",
                //     url: "shipping/REST/shipping/RequestShipmentRefund/RequestShipmentRefund.php",
                //     data: {
                //         shipmentId
                //     },
                //     success: function (res) {

                //        // Split the string into lines
                //         const lines = res.split('\n');

                //         // Initialize a variable to store the label value
                //         let labelValue = null;

                //         // Iterate through the lines
                //         for (const line of lines) {
                //             // Check if the line contains "label:"
                //             if (line.includes("label:")) {
                //                 // Extract the value after "label:"
                //                 labelValue = line.split("label:")[1].trim();
                //                 break; // Exit the loop once the label value is found
                //             }
                //         }

                //         // Open the labelValue URL in a new tab
                //         if (labelValue) {
                //             $("#myModal").hide();
                //             window.open(labelValue, '_blank');
                //         } else {
                //             console.log("Label URL not found.");
                //         }
                //     }
                // });

                // // VoidShipment.php
                //   $.ajax({
                //     type: "get",
                //     url: "shipping/REST/shipping/VoidShipment/VoidShipment.php",
                //     data: {
                //         shipmentId
                //     },
                //     success: function (res) {

                //         console.log(res);
                //     //    // Split the string into lines
                //     //     const lines = res.split('\n');

                //     //     // Initialize a variable to store the label value
                //     //     let labelValue = null;

                //     //     // Iterate through the lines
                //     //     for (const line of lines) {
                //     //         // Check if the line contains "label:"
                //     //         if (line.includes("label:")) {
                //     //             // Extract the value after "label:"
                //     //             labelValue = line.split("label:")[1].trim();
                //     //             break; // Exit the loop once the label value is found
                //     //         }
                //     //     }

                //     //     // Open the labelValue URL in a new tab
                //     //     if (labelValue) {
                //     //         $("#myModal").hide();
                //     //         window.open(labelValue, '_blank');
                //     //     } else {
                //     //         console.log("Label URL not found.");
                //     //     }
                //     }
                // });

                

                // GetArtifact.php
                //   $.ajax({
                //     type: "get",
                //     url: "returns/REST/returns/GetArtifact/GetArtifact.php",
                //     data: {
                //         shipmentId
                //     },
                //     success: function (res) {

                //         console.log(res);
                //     //    // Split the string into lines
                //     //     const lines = res.split('\n');

                //     //     // Initialize a variable to store the label value
                //     //     let labelValue = null;

                //     //     // Iterate through the lines
                //     //     for (const line of lines) {
                //     //         // Check if the line contains "label:"
                //     //         if (line.includes("label:")) {
                //     //             // Extract the value after "label:"
                //     //             labelValue = line.split("label:")[1].trim();
                //     //             break; // Exit the loop once the label value is found
                //     //         }
                //     //     }

                //     //     // Open the labelValue URL in a new tab
                //     //     if (labelValue) {
                //     //         $("#myModal").hide();
                //     //         window.open(labelValue, '_blank');
                //     //     } else {
                //     //         console.log("Label URL not found.");
                //     //     }
                //     }
                // });
            });

            $("#refundButton").on("click",function(){

                // Disable the button
                $("#refundButton").prop("disabled", true);

                var shipmentId = localStorage.getItem('shipmentId');
               
                // RequestShipmentRefund.php
                $.ajax({
                    type: "get",
                    url: "shipping/REST/shipping/RequestShipmentRefund/RequestShipmentRefund.php",
                    data: {
                        shipmentId
                    },
                    success: function (res) {

                        console.log(res);

                        // Split the response into lines
                        var lines = res.split('\n');

                        // Initialize variables to store error code and error message
                        var errorCode = null;
                        var errorMessage = null;
                        var responseStatus = null;
                        // var serviceTicketId = null;
                        // var serviceTicketDate = null;

                        // Loop through the lines to find error code and message
                        for (var i = 0; i < lines.length; i++) {
                            var line = lines[i].trim();
                            if (line.startsWith("Error Code:")) {
                                errorCode = line.split(":")[1].trim();
                            } else if (line.startsWith("Error Msg:")) {
                                errorMessage = line.split(":")[1].trim();
                            }
                            else if (line.startsWith("HTTP Response Status:")) {
                                responseStatus = line.split(":")[1].trim();
                            }
                            // else if (line.startsWith("Service Ticket ID:")) {
                            //     serviceTicketId = line.split(":")[1].trim();
                            // }
                            // else if (line.startsWith("Service Ticket Date:")) {
                            //     serviceTicketDate = line.split(":")[1].trim();
                            // }
                        }

                        // Check if the error code is 7291
                        if (errorCode === "7291") {
                            // Show a confirmation dialog
                            var confirmation = confirm("The shipment has not been transmitted. Do you want to Void it?");
                            
                            if (confirmation) {
                                
                                // VoidShipment.php
                                    $.ajax({
                                        type: "get",
                                        url: "shipping/REST/shipping/VoidShipment/VoidShipment.php",
                                        data: {
                                            shipmentId
                                        },
                                        success: function (res) {
                                            console.log(res);

                                            if (res.trim() === "HTTP Response Status: 404") {
                                                // Show an alert if the response is "HTTP Response Status: 404"
                                                alert("Shipment not voided.");
                                            } else {
                                                // Handle other response cases here
                                                // You can add additional checks or actions if needed
                                                // Example: alert("Shipment voided."); if the response is something else
                                                localStorage.removeItem('shipmentId');
                                                alert("Shipment voided.");


                                            }

                                        }
                                    });
                                // User clicked "OK" (Yes)
                            } else {
                                // User clicked "Cancel"
                                alert("Shipment not voided.");
                            }
                        } else if(errorCode === "7292"){
                            alert("A refund has already been requested for this shipment. Note that refund requests may take a few days to be processed.");
                        } else if(errorCode === "405"){
                            alert("No Shipment Id. Please Create Shipment First.");
                        } else {
                                // Split the response into parts based on spaces
                                var parts = res.split(' ');

                                // Initialize variables to store HTTP response status, service ticket ID, and service ticket date

                                // Loop through the parts to find the relevant information
                               // Initialize variables to store service ticket ID and date
                                    var serviceTicketId = null;
                                    var serviceTicketDate = null;

                                    // Loop through the lines to find service ticket ID and date
                                    for (var i = 0; i < lines.length; i++) {
                                        var line = lines[i].trim();
                                        if (line.startsWith("Service Ticket ID:")) {
                                            serviceTicketId = line.split(":")[1].trim();
                                        } else if (line.startsWith("Service Ticket Date:")) {
                                            serviceTicketDate = line.split(":")[1].trim();
                                        }
                                    }

                                localStorage.removeItem('shipmentId');
                                alert("Shipment Refunded! Service Ticket ID: " + serviceTicketId + " Service Ticket Date: " + serviceTicketDate);

                                // // Check if the HTTP response status is 200
                                // if (httpResponseStatus === "200") {
                                //     // Show an alert with the service ticket ID and date
                                //     alert("Shipment Refunded! Service Ticket ID: " + serviceTicketID + " Service Ticket Date: " + serviceTicketDate);
                                // } else {
                                //     // Handle other response statuses or errors here
                                //     alert("No Shipment. Please Create Shipment First.");
                                // }
                        }
                        // Enable the button after receiving the response
                        $("#refundButton").prop("disabled", false);
                    },
                    error: function () {
                        // Handle errors here if needed
                        // Enable the button in case of an error
                        $("#refundButton").prop("disabled", false);
                    }
                });
            })

            $("#endOfDayButton").on("click",function(){

                // Disable the button
                $("#endOfDayButton").prop("disabled", true);

                var shipmentId = localStorage.getItem('shipmentId');

                if (!shipmentId) {
                    alert("There was nothing to transmit. Please Create Shipment First.");
                    $("#endOfDayButton").prop("disabled", false);
                    return;
                }
               
               // TransmitShipments.php
               $.ajax({
                   type: "get",
                   url: "shipping/REST/shipping/TransmitShipments/TransmitShipments.php",
                   data: {
                       shipmentId
                   },
                   success: function (res) {
                       console.log(res);

                       // Split the response into lines
                       var lines = res.split('\n');

                        // Initialize variables to store error code and error message
                        var errorCode = null;
                        var errorMessage = null;
                        var responseStatus = null;
                        var manifestURL = null;

                        // Loop through the lines to find error code and message
                        for (var i = 0; i < lines.length; i++) {
                            var line = lines[i].trim();
                            if (line.startsWith("Error Code:")) {
                                errorCode = line.split(":")[1].trim();
                            } else if (line.startsWith("Error Msg:")) {
                                errorMessage = line.split(":")[1].trim();
                            } else if (line.startsWith("HTTP Response Status:")) {
                                responseStatus = line.split(":")[1].trim();
                            } else if (line.startsWith("manifest:")) {
                                manifestURL = line.split("/")[1].trim();
                            }
                        }

                        if(errorCode === "9122"){
                            // alert("All groups in the transmit request were empty or all shipments were excluded; there was nothing to transmit");
                            alert("There was nothing to transmit. Please Create Shipment First.");
                            
                        } else {
                            if (responseStatus == "200") {
                                alert("Shipment transmitted Successfully!");

                                // Split the string by spaces to get individual words
                                const words = res.split(' ');

                                console.log('Finding data:');
                                console.log(manifestURL);
                                console.log(res);
                                console.log('Words:');
                                console.log(words);
                                const manifestIndex = words.indexOf('200 manifest:');
                                console.log('manifestURL:');
                                console.log(words[words.length - 1]);
                                console.log('manifestURL 2:');
                                console.log(words[words.length - 2]);

                                // Find the word "manifest:" in the array

                                // If "manifest:" is found, get the URL part after it
                                if (words.length > 0) {
                                    
                                    if (words.length == 5) {
                                        var manifestURL = words[words.length - 1];
                                    } else {
                                        var manifestURL = words[words.length - 2];
                                        var manifestURL = manifestURL.replace(/\nmanifest:$/, '');
                                    }

                                    // check if the manifestURL contains manifest: at the end then remove it.
                                    console.log('FINAL MANIFEST URL');
                                    console.log(manifestURL);


                                    // Extract the last part of the URL
                                    const parts = manifestURL.split('/');
                                    const lastPart = parts[parts.length - 1].trim();
                                    console.log(lastPart);

                                    if (lastPart) {
                                            $.ajax({
                                                type: "get",
                                                url: "shipping/REST/shipping/GetManifest/GetManifest.php",
                                                data: {
                                                    lastPart,
                                                    manifestURL
                                                },
                                                success: function (response) {
                                                    console.log(response);

                                                    // Regular expression to match the artifact URL
                                                    var regex = /artifact: (https:\/\/[^ ]+)/;

                                                    // Use the regex to extract the artifact URL
                                                    var match = response.match(regex);

                                                    // Check if a match was found
                                                    if (match && match[1]) {
                                                        var artifactUrl = match[1];
                                                        console.log("Artifact URL:", artifactUrl);
                                                        if (artifactUrl) {
                                                            window.open(artifactUrl, '_blank');
                                                        } 
                                                    } else {
                                                        console.log("Artifact URL not found in the input string.");
                                                    }
                                                }
                                            });
                                    }

                                } else {
                                    console.log("Manifest URL not found in the string.");
                                }
                            }
                        }

                         // Enable the button after receiving the response
                        $("#endOfDayButton").prop("disabled", false);

                   },
                   error: function () {
                        // Handle errors here if needed
                        // Enable the button in case of an error
                        $("#endOfDayButton").prop("disabled", false);
                    }
               });

               // GetManifest.php
              

            })

            $("#zip-code-shipping").on("change",function(){

                let zipCode = $(this).val();
                let country = $('.country-dropdown').val();
                getCityFromPostalCode(zipCode, country).then(city => {
                    console.log(city);
                    if (city == null) {
                        $("#city-shipping").val("<?php echo $row['address_city']; ?>")
                    }
                    else {
                        $("#city-shipping").val(city)
                    }
                });
                
            })

            // country-billing
            $('#country_shipping_chzn').change(function() {
                console.log('IS CHANGING');
            })
        })
    </script>