<?php

/**
 * Search for text in saved keys.
 */

// Require CloudMine class.
require '../class.cloudmine.php';

// Define AppID and API key.
define("APPID", "your-cloudmine-app-id");
define("APIKEY", "your-cloudmine-api-key");

// Create a new instance of the CloudMine object.
$cloudmine = new Cloudmine(APPID, APIKEY);

try {
	
	// Call the cloudmine search() method and pass the search query to use.
	$result = $cloudmine->search('[foo="barbar"]');
	
	var_dump($result);
	
}

catch (CloudMineException $ex) {
	echo "An error occured: " . $ex->getMessage();
}

?>

