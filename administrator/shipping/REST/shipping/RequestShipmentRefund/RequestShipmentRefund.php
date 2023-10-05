<?php
 /**
 * Sample code for the RequestShipmentRefund Canada Post service.
 * 
 * The RequestShipmentRefund service is used to request a refund for 
 * a shipment that has been transmitted. Making this call indicates 
 * that the previously printed label is spoiled or will otherwise not be used.
 * 
 * Note that these are �requests for refund�, as refunding a shipment requires 
 * proper verification before being actioned (i.e. ensure label has not been used, for example). 
 *
 * This sample is configured to access the Developer Program sandbox environment. 
 * Use your development key username and password for the web service credentials.
 * 
 **/

// Your username, password and customer number are imported from the following file    	
// CPCWS_Shipping_PHP_Samples\REST\shipping\user.ini
$userProperties = parse_ini_file(realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../user.ini');

// $username = $userProperties['username']; 
// $password = $userProperties['password'];
// $mailedBy = $userProperties['customerNumber'];
// $mobo = $userProperties['customerNumber'];

$username = "f0c0e47bb8bdaa6a"; 
$password = "f564ee137e96231fe92fb1";
$mailedBy = "0008193924";
$mobo = "0008193924";

$shipmentId = $_GET['shipmentId'];

// REST URL
// $service_url = 'https://ct.soa-gw.canadapost.ca/rs/' . $mailedBy . '/' . $mobo . '/shipment/340531309186521749/refund';
// $service_url = 'https://ct.soa-gw.canadapost.ca/rs/' . $mailedBy . '/' . $mobo . '/shipment/954221696415746476/refund';
$service_url = 'https://ct.soa-gw.canadapost.ca/rs/' . $mailedBy . '/' . $mobo . '/shipment/'. $shipmentId .'/refund';
// $service_url = 'https://soa-gw.canadapost.ca/rs/' . $mailedBy . '/' . $mobo . '/shipment/825321695927090169/refund';

// Create request xml
// $email = 'yanib33168@vip4e.com';
$email = 'user@host.com';


$xmlRequest = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<shipment-refund-request xmlns="http://www.canadapost.ca/ws/shipment-v8">
	<email>{$email}</email>
</shipment-refund-request>
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
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.cpc.shipment-v8+xml', 'Accept: application/vnd.cpc.shipment-v8+xml'));
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
	if ($xml->{'shipment-refund-request-info'} ) {
		$shipmentRefundRequestInfo = $xml->{'shipment-refund-request-info'}->children('http://www.canadapost.ca/ws/shipment-v8');
		echo 'Service Ticket ID: ' . $shipmentRefundRequestInfo->{'service-ticket-id'} . "\n";
		echo 'Service Ticket Date: ' . $shipmentRefundRequestInfo->{'service-ticket-date'} . "\n";
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

