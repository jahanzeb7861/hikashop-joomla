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
                margin-bottom: 20px;
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
                                                                <input type="text" id="fname-shipping" value="<?php echo $row['address_firstname']; ?>"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Last Name">Last Name</label></td>
                                                            <td>
                                                                <input type="text" id="lname-shipping" value="<?php echo $row['address_lastname']; ?>"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Address">Address</label></td>
                                                            <td>
                                                                <input type="text" id="address1-shipping"
                                                                    value="<?php echo $row['address_street']; ?>" class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td><label for="Address Line 2">Address Line 2</label></td>
                                                            <td>
                                                                <input type="text" id="address2-shipping"
                                                                    value="<?php echo $row['address_street2']; ?>" class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Country">Country</label></td>
                                                            <td>
                                                                <select name="country_shipping" id="country-shipping"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <option value="<?php echo $row['address_country']; ?>" selected> <?php echo $row['address_country']; ?> </option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CH">Switzerland</option>
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
                                                                <input type="text" name="zip_code"
                                                                    id="zip-code-shipping"
                                                                    class="form-control border-0" value="<?php echo $row['address_post_code']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="City">City</label></td>
                                                            <td>
                                                                <input type="text" disabled id="city-shipping"
                                                                    class="form-control border-0" value="<?php echo $row['address_city']; ?>">
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
                                                                <input type="text" id="fname-billing"
                                                                    class="form-control border-0" value="<?php echo $row2['address_firstname']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Last Name">Last Name</label></td>
                                                            <td>
                                                                <input type="text" id="lname-billing"
                                                                    class="form-control border-0" value="<?php echo $row2['address_lastname']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Address">Address</label></td>
                                                            <td>
                                                                <input type="text" id="address1-billing"
                                                                    class="form-control border-0"  value="<?php echo $row2['address_street']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td><label for="Address Line 2">Address Line 2</label></td>
                                                            <td>
                                                                <input type="text" id="address2-billing"
                                                                    class="form-control border-0" value="<?php echo $row2['address_street2']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="Country">Country</label></td>
                                                            <td>
                                                                <select name="country_billing" id="country-billing"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <option value="<?php echo $row2['address_country']; ?>" selected> <?php echo $row2['address_country']; ?> </option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CH">Switzerland</option>
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
                                                                <input type="text" name="zip_code" id="zip-code-billing"
                                                                    class="form-control border-0">
                                                                    value="<?php echo $row2['address_post_code']; ?>"
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="City">City</label></td>
                                                            <td>
                                                                <input type="text" disabled id="city-billing"
                                                                    class="form-control border-0" value="<?php echo $row2['address_city']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-6 my-3">
                                                    <h5>Which Address Do You Want to Use as Shipping Label?</h5>
                                                    <div class="d-flex gap-3" style="
                                                                                    display: flex;
                                                                                    gap: 40px;
                                                                                    ">
                                                        <div class="form-check" style="
    display: flex;
    justify-content: center;
    align-items: center;
">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_type" id="address_type1">
                                                            <label class="form-check-label" for="address_type1" style="
    margin-left: 5px;
    margin-bottom: 0px;
">
                                                                Shipping Address
                                                            </label>
                                                        </div>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="border-bottom border-primary border-2">

                                                <h6>Preset Box Size And Weights*</h6>
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
                                                        <label class="form-check-label" style="
    margin-left: 5px;
    margin-bottom: 0px;
" for="reverseCheck<?php echo $preset['id']; ?>">
                                                            <?php echo $preset['box_length'] . ' x ' . $preset['box_width'] . ' x ' . $preset['box_height'] . ' INCH (' . $preset['box_weight'] . ' LBS)'; ?>
                                                        </label>

                                                        <!-- Add the "Switch to Metric" or "Switch to Imperial" button based on box_unit_type -->
                                                        <?php if ($preset['box_unit_type'] == 'Metric'): ?>
                                                            <button class="btn btn-primary switch-button" style="
    margin-left: 5px;
    margin-bottom: 0px;
" data-unit-type="imperial">Switch to Imperial</button>
                                                        <?php else: ?>
                                                            <button class="btn btn-primary switch-button" style="
    margin-left: 5px;
    margin-bottom: 0px;
" data-unit-type="metric">Switch to Metric</button>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>

                                                <!-- <div class="">
                                                    <h6>Preset Box Size And Weights*</h6>
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input prefix-types" name="prefix_types"
                                                            type="radio" value="8-6-4-10" id="reverseCheck1">
                                                        <label class="form-check-label" for="reverseCheck1">
                                                            8 x 6 x 4 INCH ( 10 LBS )
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input prefix-types" name="prefix_types"
                                                            type="radio" value="12-6-4-25" id="reverseCheck2">
                                                        <label class="form-check-label" for="reverseCheck2">
                                                            12 x 6 x 4 INCH ( 25 LBS )
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check">
                                                        <input class="form-check-input prefix-types" name="prefix_types"
                                                            type="radio" value="36-8-4-12" id="reverseCheck3">
                                                        <label class="form-check-label" for="reverseCheck3">
                                                            36 x 8 x 4 INCH ( 12 LBS )
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input prefix-types" name="prefix_types"
                                                            type="radio" value="24-4-4- 2" id="reverseCheck4">
                                                        <label class="form-check-label" for="reverseCheck4">
                                                            24 x 4 x 4 INCH ( 2 LBS )
                                                        </label>
                                                    </div>

                                                </div> -->

                                                <div class="form-group col-md-12 box-details text-start mt-3">
                                                    <div class="d-flex gap-2 mb-3 single-box" style="display: flex;gap: 5px;flex-wrap: wrap;margin: 4% auto;">
                                                        <div>
                                                            <label for="">Length</label>
                                                            <input type="text" placeholder="Length" id="box-length"
                                                                class="form-control">
                                                        </div>
                                                        <div>
                                                            <label for="">Width</label>
                                                            <input type="text" placeholder="Width" id="box-width"
                                                                class="form-control">
                                                        </div>
                                                        <div>
                                                            <label for="">Height</label>
                                                            <input type="text" placeholder="Height" id="box-height"
                                                                class="form-control">
                                                        </div>
                                                        <div>
                                                            <label for="">Weight</label>
                                                            <input type="text" placeholder="Weight" id="box-weight"
                                                                class="form-control">
                                                        </div>
                                                        <div>
                                                            <label for="">Insurance</label>
                                                            <input type="text" placeholder="Insurance"
                                                                id="box-insurance" class="form-control" value="100">
                                                        </div>
                                                    </div>
                                                </div>


                                                <h6>Custom Form:</h6>
                                                <div class="form-group col-md-12 box-details text-start mt-3">
                                                    <div class="d-flex gap-2 mb-3 single-box" style="display: flex;gap: 5px;flex-wrap: wrap;margin: 4% auto;">
                                                        <div>
                                                            <label for="">Non-delivery of Goods</label>
                                                            <select name="non_delivery" id="country-billing"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <!-- <option value="<?php echo $row2['address_country']; ?>" selected> <?php echo $row2['address_country']; ?> </option> -->
                                                                    <option value="Option 1">Option 1</option>
                                                                    <option value="Option 2">Option 2</option>
                                                                </select>
                                                        </div>
                                                        <div>
                                                            <label for="">Reason for Export</label>
                                                            <select name="reason_export" id="country-billing"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <!-- <option value="<?php echo $row2['address_country']; ?>" selected> <?php echo $row2['address_country']; ?> </option> -->
                                                                    <option value="Reason 1">Reason 1</option>
                                                                    <option value="Reason 2">Reason 2</option>
                                                                </select>
                                                        </div>
                                                        <div>
                                                            <label for="">Country of Origin</label>
                                                                <select name="origin_country" id="country-billing"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <!-- <option value="<?php echo $row2['address_country']; ?>" selected> <?php echo $row2['address_country']; ?> </option> -->
                                                                    <option value="Canada">Canada</option>
                                                                    <option value="USA">USA</option>
                                                                </select>
                                                        </div>
                                                        <div>
                                                            <label for="">Shipment Value</label>
                                                            <input type="text" placeholder="Shipment Value" id="box-weight"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 text-end">
                                                    <button class="btn btn-primary" type="button"
                                                        id="confirm-button">Confirm</button>
                                                </div>
                                                <div class="col-md-4 my-2 py-2" id="parcel-type-parent"
                                                    style="display: none;">
                                                    <div id="parcel-types"></div>
                                                </div>
                                                <div class="col-md-4 extra-fields" style="display: none;">
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
                                                </div>
                                                <div class="col-md-4">
                                                    <div id="receipt-div"></div>
                                                    <button class="btn btn-primary" type="button" style="display: none;"
                                                        id="shipment-button">Save Shipment</button>
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

                }

                $.getJSON('states.json',function(data){
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
            $(".prefix-types").on("change",function(){
                let values = $(this).val().split("-");
                $("#box-length").val(values[0])                
                $("#box-width").val(values[1])                
                $("#box-height").val(values[2])                
                $("#box-weight").val(values[3])                
            })

                // Define a variable to keep track of the current unit type
                var currentUnitType = 'imperial'; // Assuming the initial unit type is imperial
                

                // Function to toggle the button text
                function toggleSwitchButton() {
                    if (currentUnitType === 'metric') {
                        $('.switch-button').text('Switch to Metric');
                    } else {
                        $('.switch-button').text('Switch to Imperial');
                    }
                }



            $('.switch-button').click(function () {

                event.preventDefault(); // Prevent page reload

                // Toggle the unit type and button text
                currentUnitType = currentUnitType === 'metric' ? 'imperial' : 'metric';
                toggleSwitchButton();


                var unitType = $(this).data('unit-type');
                if (unitType === 'metric') {
                    // Switch to metric units logic here
                    $('#box-length').val(convertToMetric($('#box-length').val()));
                    $('#box-width').val(convertToMetric($('#box-width').val()));
                    $('#box-height').val(convertToMetric($('#box-height').val()));
                    $('#box-weight').val(convertToMetric($('#box-weight').val()));
                } else {
                    // Switch to imperial units logic here
                    $('#box-length').val(convertToImperial($('#box-length').val()));
                    $('#box-width').val(convertToImperial($('#box-width').val()));
                    $('#box-height').val(convertToImperial($('#box-height').val()));
                    $('#box-weight').val(convertToImperial($('#box-weight').val()));
                }
            });

            // Call the toggleSwitchButton function to set the initial button text
            toggleSwitchButton();

                // Function to convert from metric to imperial units
                function convertToImperial(metricValue) {
                    // Implement conversion logic here
                    // For example, if metricValue is in centimeters, convert it to inches
                    return metricValue / 2.54;
                }

                // Function to convert from imperial to metric units
                function convertToMetric(imperialValue) {
                    // Implement conversion logic here
                    // For example, if imperialValue is in inches, convert it to centimeters
                    return imperialValue * 2.54;
                }


            $("#confirm-button").on("click",function(){


                // Encode the PHP object as a JSON string and pass it to JavaScript
                var printerType = <?php echo json_encode($decodedObject); ?>;

                // Now, printerType is a JavaScript object that you can access its properties
                console.log(printerType);

                let weight = $("#box-weight").val();
                let length = $("#box-length").val();
                let width = $("#box-width").val();
                let height = $("#box-height").val();
                let zipCode = $("#zip-code-shipping").val();
                let country = $(".country-dropdown").val();
                if (!weight || !length || !width || !height || !zipCode || !country) {
                    alert("Please Fill All the Required Fields");
                    return;
                }
                $(".main-loader").fadeIn(300)
                $.ajax({
                    type:"GET",
                    url:"rating/REST/rating/GetRates/GetRates.php",
                    data:{
                        weight,length,width,height,zipCode,country
                    },
                    success:function(res){
                        
                        $(".main-loader").fadeOut(300)
                        res = JSON.parse(res);
                        if (res.status==500) {
                            $("#parcel-types").html("");
                            alert("Something Went Wrong");
                            return;
                        }
                        res = res.data['price-quote'];
                        $("#parcel-types").html("");
                        $("#parcel-types").parent().show();
                        
                        if (!Array.isArray(res)) {   
                            parcelType = res;
                            let days = dateDifference(parcelType["service-standard"]["expected-delivery-date"]);
                            $("#parcel-types").append(`
                                <label for="parcel-type-0" class="card flex-row mb-2" style="cursor:pointer">
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
                            let days = dateDifference(parcelType["service-standard"]["expected-delivery-date"]);
                            $("#parcel-types").append(`
                                <label for="parcel-type-${i}" class="card flex-row mb-2" style="cursor:pointer">
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
                        
                        if (country!="CA") {
                            $("#shipment-button,.extra-fields").show()
                        }
                        else{
                            $(".extra-fields").hide()
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

                let printerType =  $printerType;

                console.log(printerType);



                let weight = $("#box-weight").val(),length = $("#box-length").val(),width = $("#box-width").val(),height = $("#box-height").val(),zipCode = $("#zip-code-shipping").val(),country = $(".country-dropdown").val();
                let fname = $("#fname-shipping").val(),lname = $("#lname-shipping").val(),address1 = $("#address1-shipping").val(),address2 = $("#address2-shipping").val(),state = $("#state-shipping").val(),city = $("#city-shipping").val();
                let parcelType = $(".parcel-type:checked").val();
             
                if (!weight || !length || !width || !height || !zipCode || !fname || !lname  || !address1  || !address2  || !state || !city || !parcelType) {
                    alert("Please Fill All the Required Fields");
                    return;
                }
                $(".main-loader").fadeIn(300);
                    $.ajax({
                        type: "get",
                        url: "shipping/REST/shipping/CreateShipment/CreateShipment.php",
                        data: {
                            weight, length, width, height, zipCode, fname, lname, address1, address2, state, city, parcelType, country, printerType
                        },
                        success: function (res) {
                            res = JSON.parse(res);
                            res = res.data;
                            $(".main-loader").fadeOut(300);
                            
                            // Log the value before updating the HTML
                            console.log("Shipment ID:", res['shipment-id']);
                            console.log("Tracking PIN:", res['tracking-pin']);

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


                // RequestShipmentRefund.php
                $.ajax({
                    type: "get",
                    url: "shipping/REST/shipping/RequestShipmentRefund/RequestShipmentRefund.php",
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

                // GetManifest.php
                $.ajax({
                    type: "get",
                    url: "shipping/REST/shipping/GetManifest/GetManifest.php",
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
            });

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

        })
    </script>