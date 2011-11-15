<?php

/**
 * Update the text value of an existing key.
 */

// Require CloudMine class.
require '../class.cloudmine.php';

// Define AppID and API key.
define("APPID", "your-cloudmine-app-id");
define("APIKEY", "your-cloudmine-api-key");

// Create a new instance of the CloudMine object.
$cloudmine = new Cloudmine(APPID, APIKEY);

try {
	
	// Call the updateTextData() metod and pass in the id for an existing key and a new value.
	$result = $cloudmine->updateTextData("key-to-update", array("foo" => "barbar"));
	
	var_dump($result);
	
}

catch (CloudMineException $ex) {
	echo "An error occured: " . $ex->getMessage();
}

?>