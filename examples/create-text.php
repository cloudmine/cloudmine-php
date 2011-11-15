<?php

/**
 * Save a key value pair with text data as the value.
 */

// Require CloudMine class.
require '../class.cloudmine.php';

// Define AppID and API key.
define("APPID", "your-cloudmine-app-id");
define("APIKEY", "your-cloudmine-api-key");

// Create a new instance of the CloudMine object.
$cloudmine = new Cloudmine(APPID, APIKEY);

try {
	
	// Call the createTextData() method and pass in a key value (objects are automatically JSON encoded).
	$result = $cloudmine->createTextdata((string) time(), array("foo" => "bar"));
	
	var_dump($result);
	
}

catch (CloudMineException $ex) {
	echo "An error occured: " . $ex->getMessage();
}

?>