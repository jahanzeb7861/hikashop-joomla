<?php
/**
 * Sample code for the CreateAuthorizedReturn Canada Post service.
 * 
 * The CreateAuthorizedReturn service is used to create a return shipping label 
 * when the sender address and approximate package weight are known. This type of 
 * label is typically emailed through a self-serve or service agent process to the
 * individual returning the item.
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
$service_url = 'https://ct.soa-gw.canadapost.ca/rs/' . $mailedBy . '/' . $mobo . '/authorizedreturn';

// Create CreateAuthReturn request xml
$contractId = '0042708517';

$xmlRequest = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<authorized-return xmlns="http://www.canadapost.ca/ws/authreturn-v2">
	<service-code>DOM.EP</service-code>
	<returner>
		<name>Bulma</name>
		<company>Capsule Corp.</company>
		<domestic-address>
			<address-line-1>502 MAIN ST N</address-line-1>
			<city>MONTREAL</city>
			<province>QC</province>
			<postal-code>H2B1A0</postal-code>
		</domestic-address>
	</returner>
	<receiver>
		<name>John Doe</name>
		<company>ACME Corp</company>
		<domestic-address>
			<address-line-1>123 Postal Drive</address-line-1>
			<city>Ottawa</city>
			<province>ON</province>
			<postal-code>K1P5Z9</postal-code>
		</domestic-address>
	</receiver>
	<parcel-characteristics>
		<weight>15</weight>
	</parcel-characteristics>
	<print-preferences>
		<encoding>PDF</encoding>
	</print-preferences>
	<settlement-info>
		<contract-id>{$contractId}</contract-id>
	</settlement-info>
</authorized-return>
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
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.cpc.authreturn-v2+xml', 'Accept: application/vnd.cpc.authreturn-v2+xml'));
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
	if ($xml->{'authorized-return-info'} ) {
		$authreturn = $xml->{'authorized-return-info'}->children('http://www.canadapost.ca/ws/authreturn-v2');
		if ( $authreturn->{'tracking-pin'} ) {
	        echo  'Tracking Pin: ' . $authreturn->{'tracking-pin'} . "\n";                 
			foreach ( $authreturn->{'links'}->{'link'} as $link ) {  
				echo $link->attributes()->{'rel'} . ': ' . $link->attributes()->{'href'} . "\n";
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

