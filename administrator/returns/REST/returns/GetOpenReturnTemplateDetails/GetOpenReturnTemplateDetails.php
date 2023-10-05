<?php
/**
 * Sample code for the GetOpenReturnTemplateDetails Canada Post service.
 * 
 * The GetOpenReturnTemplateDetails service is used to retrieve the information
 * you originally provided when you called Create Open Return Template to create
 * the template (e.g. the number of labels you specified for this template; the
 * receiver). This call also provides the number of remaining labels for this
 * template.
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
$service_url = 'https://ct.soa-gw.canadapost.ca/rs/' . $mailedBy . '/' . $mobo . '/openreturn/349641323786705649/details';

$curl = curl_init($service_url); // Create REST Request
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_CAINFO, realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../../../third-party/cert/cacert.pem'); // Signer Certificate in PEM format
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept:application/vnd.cpc.openreturn-v2+xml'));
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
	if ($xml->{'open-return-details'} ) {
		$openreturn = $xml->{'open-return-details'}->children('http://www.canadapost.ca/ws/openreturn-v2');
		if ( $openreturn->{'artifacts-remaining'} ) {
	        echo  'Artifacts Remaining: ' . $openreturn->{'artifacts-remaining'} . "\n";                 
			echo  'Service Code: ' . $openreturn->{'open-return'}->{'service-code'} . "\n";                 
			echo  'Receiver Address Line 1: ' . $openreturn->{'open-return'}->{'receiver'}->{'domestic-address'}->{'address-line-1'} . "\n";                 
			echo  'Receiver Postal Code: ' . $openreturn->{'open-return'}->{'receiver'}->{'domestic-address'}->{'postal-code'} . "\n";                 
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

