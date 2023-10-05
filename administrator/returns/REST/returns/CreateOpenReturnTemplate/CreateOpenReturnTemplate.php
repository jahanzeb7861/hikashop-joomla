<?php
/**
 * Sample code for the CreateOpenReturnTemplate Canada Post service.
 * 
 * The CreateOpenReturnTemplate service is used to request creation of generic
 * labels for retrieval and printing. The sender address and parcel weight are
 * unknown. Each label has a unique barcode, but the rest of the data is the same.
 * The labels can be distributed as part of the original shipment, or sent to a
 * specific individual. 
 * 
 * This sample is configured to access the Developer Program sandbox environment. 
 * Use your development key username and password for the web service credentials.
 * 
 */

// Your username, password and customer number are imported from the following file    	
// CPCWS_Returns_PHP_Samples\REST\returns\user.ini
$userProperties = parse_ini_file(realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../user.ini');

$username = $userProperties['username']; 
$password = $userProperties['password'];
$mailedBy = $userProperties['customerNumber'];
$mobo = $userProperties['customerNumber'];

// REST URL
$service_url = 'https://ct.soa-gw.canadapost.ca/rs/' . $mailedBy . '/' . $mobo . '/openreturn';

// Create CreateOpenReturn request xml
$contractId = '0042708517';

$xmlRequest = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<open-return xmlns="http://www.canadapost.ca/ws/openreturn-v2">
	<max-number-of-artifacts>10</max-number-of-artifacts>
	<service-code>DOM.EP</service-code>
	<receiver>
		<domestic-address>
			<address-line-1>123 Postal Drive</address-line-1>
			<city>Ottawa</city>
			<province>ON</province>
			<postal-code>K1P5Z9</postal-code>
		</domestic-address>
	</receiver>
	<print-preferences>
		<output-format>8.5x11</output-format>
		<encoding>PDF</encoding>
	</print-preferences>
	<settlement-info>
		<contract-id>{$contractId}</contract-id>
	</settlement-info>
</open-return>
XML;

$curl = curl_init($service_url); // Create REST Request
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_CAINFO, realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../../../third-party/cert/cacert.pem'); // Signer Certificate in PEM format
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlRequest);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.cpc.openreturn-v2+xml', 'Accept: application/vnd.cpc.openreturn-v2+xml'));
$curl_response = curl_exec($curl); // Execute REST Request
if(curl_errno($curl)){
	echo 'Curl error: ' . curl_error($curl) . "\n";
}

echo 'HTTP Response Status: ' . curl_getinfo($curl,CURLINFO_HTTP_CODE) . "\n";

curl_close($curl);

// Example of using SimpleXML to parse xml response
libxml_use_internal_errors(true);
$xml = simplexml_load_string('<root>' . preg_replace('/<\?xml.*\?>/','',$curl_response) . '</root>');
if (!$xml) {
	echo 'Failed loading XML' . "\n";
	echo $curl_response . "\n";
	foreach(libxml_get_errors() as $error) {
		echo "\t" . $error->message;
	}
} else {	
	if ($xml->{'open-return-info'} ) {
		$openreturn = $xml->{'open-return-info'}->children('http://www.canadapost.ca/ws/openreturn-v2');
		if ( $openreturn->{'artifacts-remaining'} ) {
	        echo  'Artifacts Remaining: ' . $openreturn->{'artifacts-remaining'} . "\n";                 
			foreach ( $openreturn->{'links'}->{'link'} as $link ) {  
				echo $link->attributes()->{'rel'} . ': ' .$link->attributes()->{'href'} . "\n";
			}
		}
	}
	if ($xml->{'messages'} ) {					
		$messages = $xml->{'messages'}->children('http://www.canadapost.ca/ws/messages');		
		foreach ( $messages as $message ) {
			echo 'Error Code: ' . $message->code . "\n";
			echo 'Error Msg: ' . $message->description . "\n\n";
		}
	}
}

?>

