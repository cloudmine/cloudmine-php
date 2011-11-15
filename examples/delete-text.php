<?php

/**
 * Delete a key value pair.
 */

// Require CloudMine class.
require '../class.cloudmine.php';

// Define AppID and API key.
define("APPID", "your-cloudmine-app-id");
define("APIKEY", "your-cloudmine-api-key");

// Create a new instance of the CloudMine object.
$cloudmine = new Cloudmine(APPID, APIKEY);

try {
	
	// Call the deleteData() method and pass in the ID of the key ot delete.
	$cloudmine->deleteData(array("key-to-delete"));
	
}

catch (CloudMineException $ex) {
	echo "An error occured: " . $ex->getMessage();
}

?>