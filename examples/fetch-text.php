<?php

/**
 * Fetch the text value of a specific key.
 */

// Require CloudMine class.
require '../class.cloudmine.php';

// Define AppID and API key.
define("APPID", "your-cloudmine-app-id");
define("APIKEY", "your-cloudmine-api-key");

// Create a new instance of the CloudMine object.
$cloudmine = new Cloudmine(APPID, APIKEY);

try {
	
	// Call the fetchText() method and pass in the key whose value you want to fetch.
	$result = $cloudmine->fetchText(array("key-to-return"));
	
	var_dump($result);
	
}

catch (CloudMineException $ex) {
	echo "An error occured: " . $ex->getMessage();
}

?>