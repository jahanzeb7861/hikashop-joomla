<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_plugins
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_joomla";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all rows from the kuv9p_preset_boxes table
$sql = "SELECT * FROM kuv9p_preset_boxes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output each row as a HTML div element
    while ($row = $result->fetch_assoc()) {
        $boxLength = $row["box_length"];
        $boxWidth = $row["box_width"];
        $boxHeight = $row["box_height"];
        $boxWeight = $row["box_weight"];
        $boxUnitType = $row["box_unit_type"];
        $boxId = $row["id"];
    }
} else {
    echo "No rows found in the kuv9p_preset_boxes table.";
}

// Close the database connection
$conn->close();



JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('bootstrap.tooltip');
$this->fieldsets = $this->form->getFieldsets('params');

$input = JFactory::getApplication()->input;

// In case of modal
$isModal  = $input->get('layout') === 'modal' ? true : false;
$layout   = $isModal ? 'modal' : 'edit';
$tmpl     = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task) {
		if (task === 'plugin.cancel' || document.formvalidator.isValid(document.getElementById('style-form'))) {
			Joomla.submitform(task, document.getElementById('style-form'));

			if (task !== 'plugin.apply') {
				if (self !== top ) {
					window.top.setTimeout('window.parent.location = window.top.location.href', 1000);
					window.parent.jQuery('#plugin" . $this->item->extension_id . "Modal').modal('hide');
				}
			}
		}
	};
");
?>

<form action="<?php echo JRoute::_('index.php?option=com_plugins&view=plugin&layout=' . $layout . $tmpl . '&extension_id=' . (int) $this->item->extension_id); ?>" method="post" name="adminForm" id="style-form" class="form-validate">
	<div class="form-horizontal">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_PLUGINS_PLUGIN')); ?>

		<div class="row-fluid">
			<div class="span9">
				<?php if ($this->item->xml) : ?>
					<?php if ($this->item->xml->description) : ?>
						<h2>
							<?php
							if ($this->item->xml)
							{
								echo ($text = (string) $this->item->xml->name) ? JText::_($text) : $this->item->name;
							}
							else
							{
								echo JText::_('COM_PLUGINS_XML_ERR');
							}
							?>
						</h2>
						<div class="info-labels">
							<span class="label hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_PLUGINS_FIELD_FOLDER_LABEL', 'COM_PLUGINS_FIELD_FOLDER_DESC'); ?>">
								<?php echo $this->form->getValue('folder'); ?>
							</span> /
							<span class="label hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_PLUGINS_FIELD_ELEMENT_LABEL', 'COM_PLUGINS_FIELD_ELEMENT_DESC'); ?>">
								<?php echo $this->form->getValue('element'); ?>
							</span>
						</div>
						<div>
							<?php
							$short_description = JText::_($this->item->xml->description);
							$this->fieldset = 'description';
							$long_description = JLayoutHelper::render('joomla.edit.fieldset', $this);
							if (!$long_description) {
								$truncated = JHtml::_('string.truncate', $short_description, 550, true, false);
								if (strlen($truncated) > 500) {
									$long_description = $short_description;
									$short_description = JHtml::_('string.truncate', $truncated, 250);
									if ($short_description == $long_description) {
										$long_description = '';
									}
								}
							}
							?>
							<p><?php echo $short_description; ?></p>
							<?php if ($long_description) : ?>
								<p class="readmore">
									<a href="#" onclick="jQuery('.nav-tabs a[href=\'#description\']').tab('show');">
										<?php echo JText::_('JGLOBAL_SHOW_FULL_DESCRIPTION'); ?>
									</a>
								</p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<div class="alert alert-error"><?php echo JText::_('COM_PLUGINS_XML_ERR'); ?></div>
				<?php endif; ?>

				<?php
				$this->fieldset = 'basic';
				$html = JLayoutHelper::render('joomla.edit.fieldset', $this);
				echo $html ? '<hr />' . $html : '';
				?>
			</div>
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
				<div class="form-vertical">
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('ordering'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('ordering'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('folder'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('folder'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('element'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('element'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php if (isset($long_description) && $long_description != '') : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'description', JText::_('JGLOBAL_FIELDSET_DESCRIPTION')); ?>
			<?php echo $long_description; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php
		$this->fieldsets = array();
		$this->ignore_fieldsets = array('basic', 'description');
		echo JLayoutHelper::render('joomla.edit.params', $this);
		?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>

	<!-- <div>
		<button type="button" id="addButton" class="btn btn-outline-primary">ADD</button>
        <button type="button" id="removeButton" class="btn btn-outline-danger">Remove</button>
	</div> -->

	<!-- REMOVE FUNCTIONALITY -->
	<!-- <script>
			// Get a reference to the "Remove" button
			var removeButton = document.getElementById("removeButton");

			// Add a click event listener to the "Remove" button
			removeButton.addEventListener("click", function () {
				// Find and remove input elements with the "checked" attribute
				var inputsWithCheckedAttribute = document.querySelectorAll('#attrib-preset_box input[type="checkbox"][checked]');
				inputsWithCheckedAttribute.forEach(function (input) {
					input.parentNode.parentNode.remove(); // Remove the entire control-group div
				});
			});
	</script> -->

	<!-- ADD FUCNTIOANLITY -->
	<!-- <script>
        // Get a reference to the "Add" button and the container div
        var addButton = document.getElementById("addButton");
        var presetBox = document.getElementById("attrib-preset_box");

        // Add a click event listener to the "Add" button
        addButton.addEventListener("click", function () {
            // Create a new control-group div
            var newControlGroup = document.createElement("div");
            newControlGroup.className = "control-group";

            // Create a control-label and label element
            var controlLabel = document.createElement("div");
            controlLabel.className = "control-label";
            var label = document.createElement("label");
            label.textContent = "New Input"; // You can set the label text as needed

            // Create a controls div and input element
            var controls = document.createElement("div");
            controls.className = "controls";
            var input = document.createElement("input");
            input.type = "checkbox";
            input.name = "new_checkbox"; // Set the name attribute as needed

            // Append the label to the control-label div and input to the controls div
            controlLabel.appendChild(label);
            controls.appendChild(input);

            // Append control-label and controls to the new control-group div
            newControlGroup.appendChild(controlLabel);
            newControlGroup.appendChild(controls);

            // Append the new control-group div to the container div
            presetBox.appendChild(newControlGroup);
        });

    </script> -->


	<!-- <script>
				// Get the 'presetBox' element by its ID
				var presetBox = document.getElementById("attrib-preset_box");

				// Create a form element
				var form = document.createElement("form");

				// Create a text input field for box details
				var inputBoxDetails = document.createElement("input");
				inputBoxDetails.type = "text";
				inputBoxDetails.placeholder = "Enter Box Details";
				inputBoxDetails.id = "boxDetails"; // You can set an ID for this input if needed
				inputBoxDetails.className = "form-control"; // Adding a Bootstrap class for styling

				// Create an 'ADD' button
				var addButton = document.createElement("button");
				addButton.type = "button";
				addButton.id = "addButton";
				addButton.className = "btn btn-outline-primary";
				addButton.textContent = "ADD";

				// Create a 'Remove' button
				var removeButton = document.createElement("button");
				removeButton.type = "button";
				removeButton.id = "removeButton";
				removeButton.className = "btn btn-outline-danger px-2";
				removeButton.textContent = "Remove";

				// Create a checkbox container (div with class "control-group")
				var checkboxContainer = document.createElement("div");
				checkboxContainer.className = "control-group";

				// Create a label element for the checkbox
				var labelElement = document.createElement("label");
				labelElement.textContent = inputBoxDetails.value; // Use the entered data as the label text


				// Append the input and buttons to the form
				form.appendChild(inputBoxDetails);
				form.appendChild(addButton);
				form.appendChild(removeButton);

				// Append the checkbox container to the 'presetBox' element
				presetBox.appendChild(checkboxContainer);

				// Append the input and buttons to the form
				form.appendChild(inputBoxDetails);
				form.appendChild(addButton);
				form.appendChild(removeButton);

				presetBox.appendChild(form);

			// 		// Function to remove the selected checkbox when the "Remove" button is clicked
			document.getElementById("removeButton").addEventListener("click", function () {
				// Get a reference to the parent container of the checkboxes
				var container = document.getElementById("attrib-preset_box");

				// Get a list of all checkboxes within the container
				var checkboxes = container.querySelectorAll('input[type="checkbox"]');

				// Loop through the checkboxes and remove the selected one(s)
				checkboxes.forEach(function (checkbox) {
					if (checkbox.checked) {
						// Remove the corresponding control-group div
						container.removeChild(checkbox.closest(".control-group"));
					}
				});
			});

			// // Function to add a new checkbox with the same layout when the "Add" button is clicked
			document.getElementById("addButton").addEventListener("click", function () {
				// Get a reference to the parent container of the checkboxes
				var container = document.getElementById("attrib-preset_box");

				// Create a new control-group div
				var newControlGroup = document.createElement("div");
				newControlGroup.className = "control-group";

				// Create a label element
				var newLabel = document.createElement("label");
				newLabel.className = "hasPopover control-label";
				newLabel.textContent = inputBoxDetails.value;; // You can set the label text as needed

				// Create an input element (checkbox)
				var newCheckbox = document.createElement("input");
				newCheckbox.type = "checkbox";
				newCheckbox.name = "jform[params][default_shipping_settings_new]"; // Set a unique name
				newCheckbox.value = "1";

				// Append the label and checkbox to the new control-group div
				newControlGroup.appendChild(newLabel);
				newControlGroup.appendChild(newCheckbox);

				// Append the new control-group div to the container
				// container.appendChild(newControlGroup);
				container.insertBefore(newControlGroup, container.firstChild);
			});

	</script> -->

			<!-- TEST -->
			<!-- <script>
							// Get the 'presetBox' element by its ID
					var presetBox = document.getElementById("attrib-preset_box");

					// Create a form element
					var form = document.createElement("form");

					// Create a dropdown/select element for unit selection
					var unitSystemDropdown = document.createElement("select");
					unitSystemDropdown.id = "unitSystemDropdown";
					unitSystemDropdown.className = "form-control";
					// Add options for Metric and Imperial units
					var metricOption = document.createElement("option");
					metricOption.value = "Metric";
					metricOption.textContent = "Metric (cm, kg)";
					var imperialOption = document.createElement("option");
					imperialOption.value = "Imperial";
					imperialOption.textContent = "Imperial (inch, lb)";
					unitSystemDropdown.appendChild(metricOption);
					unitSystemDropdown.appendChild(imperialOption);

					// Create a text input field for Length
					var lengthInput = document.createElement("input");
					lengthInput.type = "number";
					lengthInput.placeholder = "Length";
					lengthInput.className = "form-control";
					lengthInput.id = "lengthInput";

					// Create a text input field for Width
					var widthInput = document.createElement("input");
					widthInput.type = "number";
					widthInput.placeholder = "Width";
					widthInput.className = "form-control";
					widthInput.id = "widthInput";

					// Create a text input field for Height
					var heightInput = document.createElement("input");
					heightInput.type = "number";
					heightInput.placeholder = "Height";
					heightInput.className = "form-control";
					heightInput.id = "heightInput";

					// Create a text input field for Weight
					var weightInput = document.createElement("input");
					weightInput.type = "number";
					weightInput.placeholder = "Weight";
					weightInput.className = "form-control";
					weightInput.id = "weightInput";

					// Create a text input field for Default Insurance amount
					var overrideInput = document.createElement("input");
					overrideInput.type = "number";
					overrideInput.placeholder = "Override Insurance Amount";
					overrideInput.className = "form-control";
					overrideInput.id = "overrideInput";

					// Create a text input field for Box Name
					var boxNameInput = document.createElement("input");
					boxNameInput.type = "text";
					boxNameInput.placeholder = "Box Name (optional)";
					boxNameInput.className = "form-control";
					boxNameInput.id = "boxNameInput";

					// Create a 'SAVE BOX' button
					var saveBoxButton = document.createElement("button");
					saveBoxButton.type = "button";
					saveBoxButton.id = "saveBoxButton";
					saveBoxButton.className = "btn btn-primary";
					saveBoxButton.textContent = "SAVE BOX";

					// Event listener to create a new box when the "SAVE BOX" button is clicked
					saveBoxButton.addEventListener("click", function () {
					addShippingBox();
					});

					// Append the input fields, dropdown, and button to the form
					form.appendChild(unitSystemDropdown);
					form.appendChild(lengthInput);
					form.appendChild(widthInput);
					form.appendChild(heightInput);
					form.appendChild(weightInput);
					form.appendChild(overrideInput);
					form.appendChild(boxNameInput);
					form.appendChild(saveBoxButton);

					// Append the form to the 'presetBox' element
					presetBox.appendChild(form);

					// Function to add a new shipping box
					function addShippingBox() {
					// Get the selected unit system (Metric or Imperial)
					var unitSystem = document.getElementById("unitSystemDropdown").value;

					// Get the values entered by the user
					var length = parseFloat(document.getElementById("lengthInput").value);
					var width = parseFloat(document.getElementById("widthInput").value);
					var height = parseFloat(document.getElementById("heightInput").value);
					var weight = parseFloat(document.getElementById("weightInput").value);
					var overrideAmount = parseFloat(document.getElementById("overrideInput").value);
					var boxName = document.getElementById("boxNameInput").value;

					// Convert values to the selected unit system
					if (unitSystem === "Imperial") {
						// Convert values to Inch and Pound
						length = length * 2.54; // Convert cm to inch
						width = width * 2.54; // Convert cm to inch
						height = height * 2.54; // Convert cm to inch
						weight = weight * 0.453592; // Convert kg to pound
					}

					// Create a new control-group div
					var newControlGroup = document.createElement("div");
					newControlGroup.className = "control-group";

					// Create a label element
					var newLabel = document.createElement("label");
					newLabel.className = "hasPopover control-label";
					newLabel.textContent = boxName; // Set the label text as the box name

					// Create an input element (checkbox)
					var newCheckbox = document.createElement("input");
					newCheckbox.type = "checkbox";
					newCheckbox.name = "jform[params][shipping_boxes][]"; // Use an array for multiple boxes
					newCheckbox.value = JSON.stringify({
						length: length,
						width: width,
						height: height,
						weight: weight,
						insuranceAmount: overrideAmount || 100, // Default insurance amount is $100 Canadian
						unitSystem: unitSystem,
						boxName: boxName,
					});

					// Append the label and checkbox to the new control-group div
					newControlGroup.appendChild(newLabel);
					newControlGroup.appendChild(newCheckbox);

					// Append the new control-group div to the container
					presetBox.insertBefore(newControlGroup, presetBox.firstChild);
					}
			</script> -->

			<!-- TEST 2 FINAL -->
			<!-- <script>
				 // Get the 'presetBox' element by its ID
				 	var presetBox = document.getElementById("attrib-preset_box");

					// Create a new control-group div
					var newControlGroup = document.createElement("div");
					newControlGroup.className = "control-group";

					// Create a label element
					var newLabel = document.createElement("label");
					newLabel.id = "jform_params_default_shipping_settings_1-lbl";
					newLabel.htmlFor = "jform_params_default_shipping_settings_1";
					newLabel.className = "hasPopover control-label";
					newLabel.textContent = "8 X 6 X 4 INCH (10 LBS)";
					newLabel.title = "";
					newLabel.setAttribute("data-content", "Enable 8 X 6 X 4 INCH (10 LBS).");
					newLabel.setAttribute("data-original-title", "8 X 6 X 4 INCH (10 LBS)");

					// Create a div for the input container
					var newInputDiv = document.createElement("div");
					newInputDiv.className = "controls";

					// Create the input element
					var newInputRadio = document.createElement("input");
					newInputRadio.type = "checkbox";
					newInputRadio.name = "jform[params][default_shipping_settings_1]";
					newInputRadio.id = "jform_params_default_shipping_settings_1";
					newInputRadio.value = "1";
					newInputRadio.checked = true; // Make the checkbox selected by default

					// Append the label and checkbox to the new control-group div
					newInputDiv.appendChild(newInputRadio);
					newControlGroup.appendChild(newLabel);
					newControlGroup.appendChild(newInputDiv);

					// Insert the new control-group div before the form
					presetBox.insertBefore(newControlGroup, form);

				// Create a form element
				var form = document.createElement("form");

				// Function to create a field group with a label, input, and class names
				function createFieldGroup(inputType, labelText, inputPlaceholder, inputId, inputName, inputValue, dataContent) {
				// Create a field group container (div with class "control-group")
				var fieldGroup = document.createElement("div");
				fieldGroup.className = "control-group";

				// Create a label element
				var labelElement = document.createElement("label");
				labelElement.id = "jform_params_" + inputId + "-lbl";
				labelElement.htmlFor = "jform_params_" + inputId;
				labelElement.className = "hasPopover control-label";
				labelElement.textContent = labelText;
				labelElement.title = "";
				labelElement.setAttribute("data-content", dataContent);
				labelElement.setAttribute("data-original-title", labelText);

				// Create a div for the input container
				var inputDiv = document.createElement("div");
				inputDiv.className = "controls";

				// Create the input element
				var inputElement = document.createElement("input");
				inputElement.type = inputType;
				inputElement.name = inputName;
				inputElement.id = "jform_params_" + inputId;
				inputElement.placeholder = inputPlaceholder;
				inputElement.value = inputValue;

				// Append the label and input to the field group
				inputDiv.appendChild(inputElement);
				fieldGroup.appendChild(labelElement);
				fieldGroup.appendChild(inputDiv);

				return fieldGroup;
				}

				// Create a dropdown/select element for unit selection
				var unitSystemDropdown = document.createElement("select");
				unitSystemDropdown.className = "controls form-control"; // Set the class names
				unitSystemDropdown.id = "unitSystemDropdown";

				// Add a style with padding to the select element
				unitSystemDropdown.style.paddingBottom = "20px !important";

				// Add options for Metric and Imperial units
				var metricOption = document.createElement("option");
				metricOption.value = "Metric";
				metricOption.textContent = "Metric (cm, kg)";
				var imperialOption = document.createElement("option");
				imperialOption.value = "Imperial";
				imperialOption.textContent = "Imperial (inch, lb)";
				unitSystemDropdown.appendChild(metricOption);
				unitSystemDropdown.appendChild(imperialOption);

				// Create input fields with class names as described in the example
				var lengthFieldGroup = createFieldGroup("text", "Length", "Enter preset box length.", "preset_length", "jform[params][preset_length]", "8", "Enter preset box length.");
				var widthFieldGroup = createFieldGroup("text", "Width", "Enter preset box width.", "preset_width", "jform[params][preset_width]", "6", "Enter preset box width.");
				var heightFieldGroup = createFieldGroup("text", "Height", "Enter preset box height.", "preset_height", "jform[params][preset_height]", "4", "Enter preset box height.");
				var weightFieldGroup = createFieldGroup("text", "Weight", "Enter preset box weight.", "preset_weight", "jform[params][preset_weight]", "10", "Enter preset box weight.");
				var overrideFieldGroup = createFieldGroup("text", "Override Insurance Amount", "Enter override insurance amount.", "override_insurance", "jform[params][override_insurance]", "100", "Enter override insurance amount.");
				var boxNameFieldGroup = createFieldGroup("text", "Box Name", "Enter a name for the box (optional).", "box_name", "jform[params][box_name]", "", "Enter a name for the box (optional).");

				// Create a 'SAVE BOX' button
				var saveBoxButton = document.createElement("button");
				saveBoxButton.type = "button";
				saveBoxButton.id = "saveBoxButton";
				saveBoxButton.className = "btn btn-primary"; // Keep the existing class
				saveBoxButton.textContent = "SAVE BOX";

				// Event listener to create a new box when the "SAVE BOX" button is clicked
				saveBoxButton.addEventListener("click", function () {
				addShippingBox();
				});

				// Append the input fields, dropdown, and button to the form
				form.appendChild(unitSystemDropdown);
				form.appendChild(lengthFieldGroup);
				form.appendChild(widthFieldGroup);
				form.appendChild(heightFieldGroup);
				form.appendChild(weightFieldGroup);
				form.appendChild(overrideFieldGroup);
				form.appendChild(boxNameFieldGroup);
				form.appendChild(saveBoxButton);

				// Append the form to the 'presetBox' element
				presetBox.appendChild(form);

				// Function to add a new shipping box
				function addShippingBox() {
				// Get the selected unit system (Metric or Imperial)
				var unitSystem = document.getElementById("unitSystemDropdown").value;

				// Get the values entered by the user
				var length = parseFloat(document.getElementById("jform_params_preset_length").value);
				var width = parseFloat(document.getElementById("jform_params_preset_width").value);
				var height = parseFloat(document.getElementById("jform_params_preset_height").value);
				var weight = parseFloat(document.getElementById("jform_params_preset_weight").value);
				var overrideAmount = parseFloat(document.getElementById("jform_params_override_insurance").value);
				var boxName = document.getElementById("jform_params_box_name").value;

				// Convert values to the selected unit system
				if (unitSystem === "Imperial") {
					// Convert values to Inch and Pound
					length = length * 2.54; // Convert cm to inch
					width = width * 2.54; // Convert cm to inch
					height = height * 2.54; // Convert cm to inch
					weight = weight * 0.453592; // Convert kg to pound
				}

				// Create a new control-group div
				var newControlGroup = document.createElement("div");
				newControlGroup.className = "control-group";

				// Create a label element
				var newLabel = document.createElement("label");
				newLabel.className = "hasPopover control-label";
				newLabel.textContent = boxName; // Set the label text as the box name

				// Create an input element (checkbox)
				var newCheckbox = document.createElement("input");
				newCheckbox.type = "checkbox";
				newCheckbox.name = "jform[params][shipping_boxes][]"; // Use an array for multiple boxes
				newCheckbox.value = JSON.stringify({
					length: length,
					width: width,
					height: height,
					weight: weight,
					insuranceAmount: overrideAmount || 100, // Default insurance amount is $100 Canadian
					unitSystem: unitSystem,
					boxName: boxName,
				});

				// Append the label and checkbox to the new control-group div
				newControlGroup.appendChild(newLabel);
				newControlGroup.appendChild(newCheckbox);

				// Append the new control-group div to the container
				presetBox.insertBefore(newControlGroup, presetBox.firstChild);
				}
			</script> -->

			<!-- TEST 3 -->
			<script>
						setTimeout(() => {
							// Select the element with the specified ID
								var container = document.getElementById('jform_params_address_country_chzn');

								console.log(container);

								// Check if the text content of the selected element is "Canada"
								if (container && container.textContent.trim() === "Canada") {
								// Find the anchor tag with href="#attrib-preset_box_3" and hide it
								var anchorTag = document.querySelector('a[href="#attrib-preset_box_3"]');
								if (anchorTag) {
									anchorTag.style.display = 'none'; // Hide the anchor tag
									console.log("The value is Canada, and the anchor tag is hidden.");
								}
								} else {
								console.log("The value is not Canada");
								}
						}, 2000);



					 // Get the 'presetBox' element by its ID
				 	var presetBox = document.getElementById("attrib-preset_box");

					// Create a new control-group div
					// var newControlGroup = document.createElement("div");
					// newControlGroup.className = "control-group";

					<?php

						// Assuming you have a database connection established
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "test_joomla";

						// Create a connection
						$conn = new mysqli($servername, $username, $password, $dbname);

						// Check the connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}

						// SQL query to select all rows from the kuv9p_preset_boxes table
						$sql = "SELECT * FROM kuv9p_preset_boxes";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$boxLength = $row["box_length"];
								$boxWidth = $row["box_width"];
								$boxHeight = $row["box_height"];
								$boxWeight = $row["box_weight"];
								$boxUnitType = $row["box_unit_type"];
								$boxId = $row["id"];
								?>

							// Create a flex container div element
							var flexContainer = document.createElement("div");
							flexContainer.style.display = "flex";
							flexContainer.style.marginBottom = "20px";
							
							// Create a label element
							var newLabel = document.createElement("label");
							newLabel.id = "jform_params_default_shipping_settings_1-lbl";
							newLabel.htmlFor = "jform_params_default_shipping_settings_1";
							newLabel.className = "hasPopover control-label";

							// Check the value of $boxUnitType and append the appropriate unit
							if ("<?php echo $boxUnitType; ?>" === "Imperial") {
								newLabel.textContent = "<?php echo $boxLength . ' X ' . $boxWidth . ' X ' . $boxHeight . ' INCH (' . $boxWeight . ' LBS)'; ?>";
								newLabel.setAttribute("data-content", "Enable <?php echo $boxLength . ' X ' . $boxWidth . ' X ' . $boxHeight . ' INCH (' . $boxWeight . ' LBS)'; ?>");
							} else {
								newLabel.textContent = "<?php echo $boxLength . ' X ' . $boxWidth . ' X ' . $boxHeight . ' CM (' . $boxWeight . ' KG)'; ?>";
								newLabel.setAttribute("data-content", "Enable <?php echo $boxLength . ' X ' . $boxWidth . ' X ' . $boxHeight . ' CM (' . $boxWeight . ' KG)'; ?>");
							}

							newLabel.title = "";
							newLabel.setAttribute("data-original-title", newLabel.textContent);


							// newLabel.textContent = "<?php echo $boxLength . ' X ' . $boxWidth . ' X ' . $boxHeight . ' ' . $boxUnitType . ' (' . $boxWeight . ' LBS)'; ?>";
							// newLabel.title = "";
							// newLabel.setAttribute("data-content", "Enable <?php echo $boxLength . ' X ' . $boxWidth . ' X ' . $boxHeight . ' ' . $boxUnitType . ' (' . $boxWeight . ' LBS)'; ?>");
							// newLabel.setAttribute("data-original-title", "<?php echo $boxLength . ' X ' . $boxWidth . ' X ' . $boxHeight . ' ' . $boxUnitType . ' (' . $boxWeight . ' LBS)'; ?>");
							

							 // Append the label to the flex container
							 flexContainer.appendChild(newLabel);

							// var selectButton = document.createElement("button");
							// 	selectButton.type = "button";
							// 	selectButton.id = "<?php echo $boxId ?>";
							// 	selectButton.className = "btn btn-primary";
							// 	selectButton.textContent = "Select";
							// 	selectButton.addEventListener("click", function () {
							// 		// Handle the selection action here
							// 		selectShippingBox(this,<?php echo $boxId ?>); // Pass the button element as an argument to identify the box to select
							// 	});


								var removeButton = document.createElement("button");
									removeButton.type = "button";
									removeButton.className = "btn btn-sm btn-danger";
									removeButton.id = "<?php echo $boxId ?>";
									removeButton.textContent = "Remove";
									removeButton.style.paddingTop = "3px";
									removeButton.style.paddingBottom = "3px";
									removeButton.addEventListener("click", function () {
										removeShippingBox(this,<?php echo $boxId ?>); // Pass the button element as an argument to identify the box to remove
									});
										// Append the label to the flex container 
								// flexContainer.appendChild(selectButton);
								// Append the label to the flex container
								flexContainer.appendChild(removeButton);

								var presetBox = document.getElementById("attrib-preset_box");
								presetBox.appendChild(flexContainer);
								
								<?php
							}
						} else {
							echo "// No rows found in the kuv9p_preset_boxes table.";
						}
						?>


					// // 	// Create a label element
					// var newLabel = document.createElement("label");
					// newLabel.id = "jform_params_default_shipping_settings_1-lbl";
					// newLabel.htmlFor = "jform_params_default_shipping_settings_1";
					// newLabel.className = "hasPopover control-label";
					// newLabel.textContent = "8 X 6 X 4 INCH (10 LBS)";
					// newLabel.title = "";
					// newLabel.setAttribute("data-content", "Enable 8 X 6 X 4 INCH (10 LBS).");
					// newLabel.setAttribute("data-original-title", "8 X 6 X 4 INCH (10 LBS)");


					// var selectButton = document.createElement("button");
					// 	selectButton.type = "button";
					// 	selectButton.className = "btn btn-primary";
					// 	selectButton.textContent = "Select";
					// 	selectButton.addEventListener("click", function () {
					// 		// Handle the selection action here
					// 		selectShippingBox(this); // Pass the button element as an argument to identify the box to select
					// 	});


					// var removeButton = document.createElement("button");
					// removeButton.type = "button";
					// removeButton.className = "btn btn-danger";
					// removeButton.textContent = "Remove";
					// removeButton.addEventListener("click", function () {
					// 	removeShippingBox(this); // Pass the button element as an argument to identify the box to remove
					// });


					  // Replace the radio input with a "Select" button
					//   var selectButton = createSelectButton();
					// newControlGroup.replaceChild(selectButton, newCheckbox);
				

					// Create a div for the input container
					// var newInputDiv = document.createElement("div");
					// newInputDiv.className = "controls";
					// newControlGroup.appendChild(newInputDiv);
					// newControlGroup.appendChild(newLabel);
					// newControlGroup.appendChild(selectButton);
					// newControlGroup.appendChild(removeButton);

					// Insert the new control-group div before the form
					// presetBox.insertBefore(newControlGroup, form);

				// Create a form element
				var form = document.createElement("form");

				// Function to create a field group with a label, input, and class names
				function createFieldGroup(inputType, labelText, inputPlaceholder, inputId, inputName, inputValue, dataContent) {
				// Create a field group container (div with class "control-group")
				var fieldGroup = document.createElement("div");
				fieldGroup.className = "control-group";

				// Create a label element
				var labelElement = document.createElement("label");
				labelElement.id = "jform_params_" + inputId + "-lbl";
				labelElement.htmlFor = "jform_params_" + inputId;
				labelElement.className = "hasPopover control-label";
				labelElement.textContent = labelText;
				labelElement.title = "";
				labelElement.setAttribute("data-content", dataContent);
				labelElement.setAttribute("data-original-title", labelText);

				// Create a div for the input container
				var inputDiv = document.createElement("div");
				inputDiv.className = "controls";

				// Create the input element
				var inputElement = document.createElement("input");
				inputElement.type = inputType;
				inputElement.name = inputName;
				inputElement.id = "jform_params_" + inputId;
				inputElement.placeholder = inputPlaceholder;
				inputElement.value = inputValue;

				// Append the label and input to the field group
				inputDiv.appendChild(inputElement);
				fieldGroup.appendChild(labelElement);
				fieldGroup.appendChild(inputDiv);

				return fieldGroup;
				}

				// Create a dropdown/select element for unit selection
				var unitSystemDropdown = document.createElement("select");
				unitSystemDropdown.className = "controls form-control"; // Set the class names
				unitSystemDropdown.id = "unitSystemDropdown";

				// Add a style with padding to the select element
				unitSystemDropdown.style.paddingBottom = "20px !important";

				// Add options for Metric and Imperial units
				var metricOption = document.createElement("option");
				metricOption.value = "Metric";
				metricOption.textContent = "Metric (cm, kg)";
				var imperialOption = document.createElement("option");
				imperialOption.value = "Imperial";
				imperialOption.textContent = "Imperial (inch, lb)";
				unitSystemDropdown.appendChild(metricOption);
				unitSystemDropdown.appendChild(imperialOption);

				// Create input fields with class names as described in the example
				var lengthFieldGroup = createFieldGroup("text", "Length", "Enter preset box length.", "preset_length", "jform[params][preset_length]", "", "Enter preset box length.");
				var widthFieldGroup = createFieldGroup("text", "Width", "Enter preset box width.", "preset_width", "jform[params][preset_width]", "", "Enter preset box width.");
				var heightFieldGroup = createFieldGroup("text", "Height", "Enter preset box height.", "preset_height", "jform[params][preset_height]", "", "Enter preset box height.");
				var weightFieldGroup = createFieldGroup("text", "Weight", "Enter preset box weight.", "preset_weight", "jform[params][preset_weight]", "", "Enter preset box weight.");
				var overrideFieldGroup = createFieldGroup("text", "Override Insurance Amount", "Enter override insurance amount.", "override_insurance", "jform[params][override_insurance]", "100", "Enter override insurance amount.");
				var boxNameFieldGroup = createFieldGroup("text", "Box Name", "Enter a name for the box (optional).", "box_name", "jform[params][box_name]", "", "Enter a name for the box (optional).");

				// Create a 'SAVE BOX' button
				var saveBoxButton = document.createElement("button");
				saveBoxButton.type = "button";
				saveBoxButton.id = "saveBoxButton";
				// saveBoxButton.style.paddingTop = "3px";
				// saveBoxButton.style.paddingBottom = "3px";
				saveBoxButton.className = "btn btn-primary"; // Keep the existing class
				saveBoxButton.textContent = "ADD BOX";


				// Create a 'Edit BOX' button
				var editBoxButton = document.createElement("button");
				editBoxButton.type = "button";
				editBoxButton.id = "editBoxButton";
				editBoxButton.className = "btn btn-primary"; // Keep the existing class
				editBoxButton.textContent = "Edit Box";

				 // Event listener to create a new box when the "SAVE BOX" button is clicked
				 saveBoxButton.addEventListener("click", function () {
					addShippingBox();
				});

				 // Event listener to create a new box when the "SAVE BOX" button is clicked
				 editBoxButton.addEventListener("click", function () {
					editShippingBox();
				});

				// Append the input fields, dropdown, and button to the form
				form.appendChild(unitSystemDropdown);
				form.appendChild(lengthFieldGroup);
				form.appendChild(widthFieldGroup);
				form.appendChild(heightFieldGroup);
				form.appendChild(weightFieldGroup);
				form.appendChild(overrideFieldGroup);
				form.appendChild(boxNameFieldGroup);
				form.appendChild(saveBoxButton);
				// form.appendChild(editBoxButton);

				// Append the form to the 'presetBox' element
				presetBox.appendChild(form);


					// Function to create a "Remove" button
					function createRemoveButton() {
						var removeButton = document.createElement("button");
						removeButton.type = "button";
						removeButton.className = "btn btn-danger";
						removeButton.textContent = "Remove";
						removeButton.addEventListener("click", function () {
							removeShippingBox(this); // Pass the button element as an argument to identify the box to remove
						});
						return removeButton;
					}

					// Function to create a "Select" button for each preset
					function createSelectButton() {
						var selectButton = document.createElement("button");
						selectButton.type = "button";
						selectButton.className = "btn btn-primary";
						selectButton.textContent = "Select";
						selectButton.addEventListener("click", function () {
							// Handle the selection action here
							selectShippingBox(this); // Pass the button element as an argument to identify the box to select
						});
						return selectButton;
					}

					// Function to remove a shipping box
					function removeShippingBox(buttonElement, id) {

						localStorage.setItem('selectedRemoveId',id);
						console.log(id);

						// var controlGroup = buttonElement.parentElement; // Get the parent control-group div
						// var selectDropdown = controlGroup.querySelector("select"); // Find the associated dropdown

						// // Extract the ID or identifier for the selected preset (you may need to adjust this based on your data structure)
						// var selectedPresetId = selectDropdown.value;

						// Perform an AJAX request to your server-side script to delete the row from the database
						// Replace 'your_php_script.php' with the actual path to your server-side script
						var xhr = new XMLHttpRequest();
						xhr.open("POST", "removePresetBox.php", true);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						
						// Send the selectedPresetId to your server-side script
						xhr.send("id=" + id);

						xhr.onreadystatechange = function () {
							if (xhr.readyState === 4 && xhr.status === 200) {
								// The row has been successfully removed from the database
								// Now, you can remove the UI element
								// controlGroup.remove();
								location.reload();
							}
						};


						// var controlGroup = buttonElement.parentElement; // Get the parent control-group div
						// controlGroup.remove(); // Remove the selected box
					}


				// Function to add a new shipping box
				function addShippingBox() {
					// Get the selected unit system (Metric or Imperial)
					var unitSystem = document.getElementById("unitSystemDropdown").value;

					// Get the values entered by the user
					var length = parseFloat(document.getElementById("jform_params_preset_length").value);
					var width = parseFloat(document.getElementById("jform_params_preset_width").value);
					var height = parseFloat(document.getElementById("jform_params_preset_height").value);
					var weight = parseFloat(document.getElementById("jform_params_preset_weight").value);
					var overrideAmount = parseFloat(document.getElementById("jform_params_override_insurance").value);
					var boxName = document.getElementById("jform_params_box_name").value;

					// Convert values to the selected unit system
					if (unitSystem === "Imperial") {
						// Convert values to Inch and Pound
						length = length * 2.54; // Convert cm to inch
						width = width * 2.54; // Convert cm to inch
						height = height * 2.54; // Convert cm to inch
						weight = weight * 0.453592; // Convert kg to pound
					}

					if (!weight || !length || !width || !height || !overrideAmount) {
						alert("Please Fill All the Required Fields");
						return;
					}

					// Create a new control-group div
					var newControlGroup = document.createElement("div");
					newControlGroup.className = "control-group";

					// Create a label element
					var newLabel = document.createElement("label");
					newLabel.className = "hasPopover control-label";
					newLabel.textContent = length.toFixed(2) + " X " + width.toFixed(2) + " X " + height.toFixed(2) + " " + (unitSystem === "Imperial" ? "INCH" : "CM") + " (" + weight.toFixed(2) + " " + (unitSystem === "Imperial" ? "LBS" : "KG") + ")";

					// Create an input element (checkbox)
					var newCheckbox = document.createElement("input");
					newCheckbox.type = "radio";
					newCheckbox.name = "jform[params][shipping_boxes][]"; // Use an array for multiple boxes
					newCheckbox.value = JSON.stringify({
						length: length,
						width: width,
						height: height,
						weight: weight,
						insuranceAmount: overrideAmount || 100, // Default insurance amount is $100 Canadian
						unitSystem: unitSystem,
						boxName: boxName,
					});

					// Append the label and checkbox to the new control-group div
					newControlGroup.appendChild(newLabel);
					newControlGroup.appendChild(newCheckbox);

					// Append the new control-group div to the container
					presetBox.insertBefore(newControlGroup, presetBox.firstChild);
				
					// Create and append a "Remove" button for the new box
					var removeButton = createRemoveButton();
					newControlGroup.appendChild(removeButton);

					  // Replace the radio input with a "Select" button
					var selectButton = createSelectButton();
					newControlGroup.replaceChild(selectButton, newCheckbox);
				


					// Create an object with the data to be saved in the database
					var postData = {
						box_name: boxName,
						box_length: length,
						box_width: width,
						box_height: height,
						box_unit_type: unitSystem,
						box_insurance: overrideAmount || 100,
						box_weight: weight,
					};

					console.log(postData);

					// Send the data to the server for database insertion via AJAX
					var xhr = new XMLHttpRequest();
					xhr.open("POST", "savePresetBox.php", true); // Replace with your server-side script URL
					xhr.setRequestHeader("Content-Type", "application/json");
					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4 && xhr.status === 200) {
							// Handle the response from the server if needed
							console.log(xhr.responseText); // Log the server response
						}
					};
					xhr.send(JSON.stringify(postData));
				}

				function editShippingBox() {
						console.log('EDIT CHANGES');

						// Get the selected unit system (Metric or Imperial)
						var unitSystem = document.getElementById("unitSystemDropdown").value;

						// Get the values entered by the user
						var length = parseFloat(document.getElementById("jform_params_preset_length").value);
						var width = parseFloat(document.getElementById("jform_params_preset_width").value);
						var height = parseFloat(document.getElementById("jform_params_preset_height").value);
						var weight = parseFloat(document.getElementById("jform_params_preset_weight").value);
						var overrideAmount = parseFloat(document.getElementById("jform_params_override_insurance").value);
						var boxName = document.getElementById("jform_params_box_name").value;

						// Convert values to the selected unit system
						if (unitSystem === "Imperial") {
							// Convert values to Inch and Pound
							length = length * 2.54; // Convert cm to inch
							width = width * 2.54; // Convert cm to inch
							height = height * 2.54; // Convert cm to inch
							weight = weight * 0.453592; // Convert kg to pound
						}

						if (!weight || !length || !width || !height || !overrideAmount) {
							alert("Please Fill All the Required Fields");
							return;
						}

						var editPostData = {
								id: localStorage.getItem('selectedId'),
								box_name: boxName,
								box_length: length,
								box_width: width,
								box_height: height,
								box_unit_type: unitSystem,
								box_insurance: overrideAmount || 100,
								box_weight: weight,
							};

							console.log(editPostData);

							// Send the data to the server for database insertion via AJAX
							var xhr = new XMLHttpRequest();
							xhr.open("POST", "editPresetBox.php", true); // Replace with your server-side script URL
							xhr.setRequestHeader("Content-Type", "application/json");
							xhr.onreadystatechange = function () {
								if (xhr.readyState === 4 && xhr.status === 200) {
									// Handle the response from the server if needed
									console.log(xhr.responseText); // Log the server response
								}
							};
							xhr.send(JSON.stringify(editPostData));
							location.reload();
				}


				// Function to handle the selection action when the "Select" button is clicked
				// function selectShippingBox(buttonElement,$id) {
				// 	console.log("selected:");
				// 	console.log(buttonElement);

				// 	var buttonId = buttonElement.id;
				// 	// 1: Find id attribute value of buttonElement
				// 	var buttonId = buttonElement.id;

				// 	// 2: Using this id, find the database row from kuv9p_preset_boxes where id = matched_id
				// 	// Assuming you have a function to retrieve data from your database, you can use it here.
				// 	// Replace 'getPresetBoxData' with your actual database retrieval function.
				// 	var presetBoxData = getPresetBoxData($id);

				// 	if (presetBoxData) {
				// 		// 3: Set the corresponding row value to each input field value
				// 		document.getElementById("jform_params_preset_length").value = parseFloat(presetBoxData.length);
				// 		document.getElementById("jform_params_preset_width").value = parseFloat(presetBoxData.width);
				// 		document.getElementById("jform_params_preset_height").value = parseFloat(presetBoxData.height);
				// 		document.getElementById("jform_params_preset_weight").value = parseFloat(presetBoxData.weight);
				// 		document.getElementById("jform_params_override_insurance").value = parseFloat(presetBoxData.overrideAmount);
				// 		document.getElementById("jform_params_box_name").value = presetBoxData.boxName;
				// 	}
				// }

					function selectShippingBox(buttonElement, id) {

						localStorage.setItem('selectedId',id);

						console.log(id);

						
						// Make an AJAX request to the PHP file
						fetch('getData.php', {
							method: 'POST',
							body: JSON.stringify({ id }), // Send the ID as JSON in the request body
							headers: {
							'Content-Type': 'application/json',
							},
						})
							.then((response) => response.json())
							.then((data) => {
							if (data.error) {
								// Handle the error if the query fails
								console.error(data.error);
							} else {
								// Data retrieval was successful
								console.log('Selected Data:');
								console.log(data);

								// Set the corresponding input field values with the retrieved data
								document.getElementById("jform_params_preset_length").value = parseFloat(data.box_length);
								document.getElementById("jform_params_preset_width").value = parseFloat(data.box_width);
								document.getElementById("jform_params_preset_height").value = parseFloat(data.box_height);
								document.getElementById("jform_params_preset_weight").value = parseFloat(data.box_weight);
								document.getElementById("jform_params_override_insurance").value = parseFloat(data.box_insurance);
								document.getElementById("jform_params_box_name").value = data.box_name;
							}
							})
							.catch((error) => {
							console.error('Fetch error:', error);
							});
					}



				// This is a mock function, replace it with your actual database retrieval logic
					// function getPresetBoxData($id) {
					// 	console.log($id);
						
					// 		<?php	
					// 				// SQL query to select all rows from the kuv9p_preset_boxes table
					// 				  // Prepare a SQL statement with a placeholder for the ID
					// 	$sql = "SELECT * FROM kuv9p_preset_boxes WHERE id = ?";

					// 	// Create a prepared statement
					// 	$stmt = $conn->prepare($sql);


					// 	// Bind the ID parameter to the prepared statement
					// 	$stmt->bind_param("i", $id);

					// 	// Execute the prepared statement
					// 	$stmt->execute();

					// 	// Get the result
					// 	$result = $stmt->get_result();


					// 				if ($result->num_rows > 0) {
    
					// 					$row = $result->fetch_assoc();
					// 					// Fill in the HTML form fields with the retrieved data
										
					// 				} else {
					// 					echo "No records found";
					// 				}


					// 				// Assuming you have fetched the data from your database into $row
					// 				$mockData = array();

					// 				if ($row['box_length'] !== null) {
					// 					$mockData['length'] = $row['box_length'];
					// 				}

					// 				if ($row['box_width'] !== null) {
					// 					$mockData['width'] = $row['box_width'];
					// 				}

					// 				if ($row['box_height'] !== null) {
					// 					$mockData['height'] = $row['box_height'];
					// 				}

					// 				if ($row['box_weight'] !== null) {
					// 					$mockData['weight'] = $row['box_weight'];
					// 				}

					// 				if ($row['box_insurance'] !== null) {
					// 					$mockData['overrideAmount'] = $row['box_insurance'];
					// 				}

					// 				if ($row['box_name'] !== null) {
					// 					$mockData['boxName'] = $row['box_name'];
					// 				}
					// 		?>
				
					// 	return mockData;
					// }


							


			</script>


	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>

