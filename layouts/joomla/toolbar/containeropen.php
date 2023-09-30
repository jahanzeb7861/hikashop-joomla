<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
// TODO CHANGE HERE
//  echo $displayData['id']; 
//  echo $displayData['id']; 
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

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        /* Styling for the close button */
        .close {
            color: #888;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }


        /* Styling for the modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

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

        .modal-body {
            padding: 20px;
        }

        .wizard-section {
            padding: 20px;
        }


        /* Form input styles */
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Form button styles */
        button[type="button"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="button"]:hover {
            background-color: #0056b3;
        }

        /* Radio button styles */
        .form-check-input[type="radio"] {
            margin-right: 5px;
        }

        /* Select styles */
        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Add more styles as needed for specific elements within your form */

        /* Example: Style a container div within the modal */
        .container-div {
            background-color: #f7f7f7;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        select {
            height: 37px !important;
        }

    </style>


    


    <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">Canada Post</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    <span class="close" id="closeModal">&times;</span>
                </div>
                <div class="modal-body">
                    <section class="wizard-section">
                        <div class="row no-gutters">
                            <div class="col-lg-12 col-md-6">
                                <div class="form-wizard">
                                    <form action="" method="post" role="form">
                                        <fieldset class="wizard-fieldset show pb-5 mb-5">
                                            <h3>Enter Details</h3>
                                            <div class="row text-start">
                                                <div class="col-md-6">
                                                    <h5>Shipping Address</h5>
                                                    <table class="table table-sm table-bordered address-table">
                                                        <tr>
                                                            <td>First Name</td>
                                                            <td>
                                                                <input type="text" id="fname-shipping" value="john"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Last Name</td>
                                                            <td>
                                                                <input type="text" id="lname-shipping" value="doe"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                <input type="text" id="address1-shipping"
                                                                    value="test address1" class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td>Address Line 2</td>
                                                            <td>
                                                                <input type="text" id="address2-shipping"
                                                                    value="test address2" class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Country</td>
                                                            <td>
                                                                <select name="country_shipping" id="country-shipping"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CH">Switzerland</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Province/State</td>
                                                            <td>
                                                                <select name="state_shipping" id="state-shipping"
                                                                    class="form-select border-0 state-dropdown">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Postal Address/Zip Code</td>
                                                            <td>
                                                                <input type="text" name="zip_code"
                                                                    id="zip-code-shipping"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Print Type</td>
                                                            <td>
                                                                <select name="printer_type" id="printer_type"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <option value="8.5x11">8.5x11</option>
                                                                    <option value="4x6">4x6</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>
                                                                <input type="text" disabled id="city-shipping"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Billing Address</h5>
                                                    <table class="table table-sm table-bordered address-table">
                                                        <tr>
                                                            <td>First Name</td>
                                                            <td>
                                                                <input type="text" id="fname-billing"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Last Name</td>
                                                            <td>
                                                                <input type="text" id="lname-billing"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                <input type="text" id="address1-billing"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td>Address Line 2</td>
                                                            <td>
                                                                <input type="text" id="address2-billing"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Country</td>
                                                            <td>
                                                                <select name="country_billing" id="country-billing"
                                                                    class="form-select border-0 country-dropdown">
                                                                    <option value="">Select</option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CH">Switzerland</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Province/State</td>
                                                            <td>
                                                                <select name="state_billing" id="state-billing"
                                                                    class="form-select border-0 state-dropdown">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Postal Address/Zip Code</td>
                                                            <td>
                                                                <input type="text" name="zip_code" id="zip-code-billing"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>
                                                                <input type="text" disabled id="city-billing"
                                                                    class="form-control border-0">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6 my-3">
                                                    <h5>Which Address Do You Want to Use as Shipping Label?</h5>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_type" id="address_type1">
                                                            <label class="form-check-label" for="address_type1">
                                                                Shipping Address
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_type" id="address_type2">
                                                            <label class="form-check-label" for="address_type2">
                                                                Billing Address
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="border-bottom border-primary border-2">

                                                <div class="">
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


                                                </div>

                                                <div class="form-group col-md-12 box-details text-start mt-3">
                                                    <div class="d-flex gap-2 mb-3 single-box">
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
                                                <div class="col-12 text-end">
                                                    <button class="btn btn-primary" type="button"
                                                        id="confirm-button">Confirm</button>
                                                </div>
                                                <div class="col-md-4 my-2 py-2" id="parcel-type-parent"
                                                    style="display: none;">
                                                    <div id="parcel-types"></div>
                                                    <!-- <button class="btn btn-primary" type="button" style="display: none;" id="select-parcel">Continue</button> -->
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

                                            </div>

                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


        <!-- <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Simple Modal</h2>
            <p>This is a simple modal created with HTML and CSS.</p>
        </div> -->
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
            // console.log(document.getElementById("country-billing"));

            document.getElementById("country_shipping_chzn").addEventListener("click", function () {
                console.log('CLICKED');
                // modal.style.display = "none";
                // console.log(document.getElementsByClassName("chzn-single"));
                // console.log($("#country_shipping_chzn > a > span").text());

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
                    states.forEach((state)=>{
                        // console.log(state);
                        $(".state-dropdown").append(`<option value="${state.state_code}">${state.name}</option>`)
                        console.log( $(".state-dropdown"));
                    })
                })

            });


            document.getElementById("printer_type").addEventListener("click", function () {

                console.log('PRINTER CLICKED');

            });

            $(".country-dropdown").on("change",function(){
                // alert(2);
              
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

            // $(".country_shipping_chzn").on("change",function(){
                
            //     let country = $(this).val();

            //     $.getJSON('states.json',function(data){
            //         let states = data.filter((state,i)=>{
            //             if (country==state.country_code) {
            //                 return state;
            //             }
            //         })
            //         $(".state-dropdown").html("<option value=''>Select</option>");
            //         states.forEach((state)=>{
            //             $(".state-dropdown").append(`<option value="${state.state_code}">${state.name}</option>`)
            //         })
            //     })
            // })

            $("#confirm-button").on("click",function(){
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

                let printerType = $("#printer_type_chzn > a > span").text();

                let weight = $("#box-weight").val(),length = $("#box-length").val(),width = $("#box-width").val(),height = $("#box-height").val(),zipCode = $("#zip-code-shipping").val(),country = $(".country-dropdown").val();
                let fname = $("#fname-shipping").val(),lname = $("#lname-shipping").val(),address1 = $("#address1-shipping").val(),address2 = $("#address2-shipping").val(),state = $("#state-shipping").val(),city = $("#city-shipping").val();
                let parcelType = $(".parcel-type:checked").val();
                // let isShippingAddress = $("#address_type1").is(":checked");
                // console.log(isShippingAddress);
                // if (isShippingAddress) {
                //     var name = 
                // }
                if (!weight || !length || !width || !height || !zipCode || !fname || !lname  || !address1  || !address2  || !state || !city || !parcelType) {
                    alert("Please Fill All the Required Fields");
                    return;
                }
                $(".main-loader").fadeIn(300);
                
                // $.ajax({
                //     type:"get",
                //     url:"shipping/REST/shipping/CreateShipment/CreateShipment.php",
                //     data:{
                //         weight,length,width,height,zipCode,fname,lname,address1,address2,state,city,parcelType,country
                //     },
                //     success:function(res){
                //         res = JSON.parse(res);
                //         res = res.data;
                //         $(".main-loader").fadeOut(300);
                //         console.log(res['shipment-id']);
                //         $("#shipment-button").parent().find("#receipt-div").prepend(`
                //             <div class="card border border-primary border-2 rounded-2 mb-3 text-center">
                //                 <div class="card-body">
                //                     <h5>Your Shippment ID is:</h5>
                //                     ${res['shipment-id']}
                //                     <h5>Your Tracking PIN is:</h5>
                //                     ${res['tracking-pin']}
                //                 </div>
                //             </div>
                //         `)
                //     }
                // })

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

            // $("#print-pdf").on("click",function(){
            //     // $("#receipt-div");
            // });

            $("#print-pdf").on("click", function () {

                // let shipmentId = '123';
                let shipmentId = $("#shipmentId").val();

                $.ajax({
                    type: "get",
                    url: "shipping/REST/shipping/GetShipment/GetShipment.php",
                    data: {
                        shipmentId
                    },
                    success: function (res) {
                        // res = JSON.parse(res);
                        // console.log(res);
                        // res = res.data;


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
                        // res = JSON.parse(res);
                        // console.log(res);
                        // res = res.data;


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
                        // res = JSON.parse(res);
                        // console.log(res);
                        // res = res.data;


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

                // var receiptDiv = document.getElementById("receipt-div");

                // if (receiptDiv) {
                //     var printWindow = window.open('', '', 'width=600,height=600');
                //     printWindow.document.open();
                //     printWindow.document.write('<html><head><title>Print</title></head><body>');
                //     printWindow.document.write(receiptDiv.innerHTML);
                //     printWindow.document.write('</body></html>');
                //     // printWindow.document.close();
                //     printWindow.print();
                //     // printWindow.close();
                // } else {
                //     console.log("Element with ID 'receipt-div' not found.");
                // }
  
            });

            $("#zip-code-shipping").on("change",function(){

                let zipCode = $(this).val();
                let country = $('.country-dropdown').val();
                getCityFromPostalCode(zipCode, country).then(city => {
                    $("#city-shipping").val(city)
                });
                
            })

        })

    </script>