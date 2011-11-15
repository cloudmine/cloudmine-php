<?php

/**
 * 
 * Class library for CloudMine API.
 * @author Mark J. Headd (@mheadd).
 *
 */

class Cloudmine {
	
	// Base URL for Cloudmine.
	const URL_BASE = "https://api.cloudmine.me/v1/app/";
	
	// Private class members.
	private $appid;
	private $apikey;
	
	/**
	 * 
	 * Class constructor.
	 * @param string $appid
	 * @param string $apikey
	 */
	public function __construct($appid, $apikey) {
		$this->appid = $appid;
		$this->apikey = $apikey;
	}
	
	/**
	 * 
	 * Fetch textual data.
	 * @param array $keys
	 */
	public function fetchText(Array $keys) {
		$key_list = implode(",", $keys);
		$url = self::URL_BASE . $this->appid . "/text?keys={$key_list}";
		return self::makeCurlCall("GET", $url);
	}
	
	/**
	 * 
	 * Fetch binary data.
	 */
	public function fetchBinary() {
		
		throw new NotImplementedException("This method has not yet been implemented.");	
		
	}
	
	/**
	 * 
	 * Search for data.
	 * @param string $query
	 */
	public function search($query) {
		
		$url = self::URL_BASE . $this->appid ."/search?q=" . $query;
		return self::makeCurlCall("GET", $url);
		
	}
	
	/**
	 * 
	 * Create an object holding textual data (essentially an alias for updateTextData()).
	 * @param string $key
	 * @param string $value
	 */
	public function createTextData($key, $value) {
		
		return self::updateTextData($key, $value, "PUT");
		
	}
	
	/**
	 * 
	 * Update an object holding text data.
	 * @param string $data
	 */
	public function updateTextData($key, $value, $method=NULL) {
		
		$data = json_encode(array($key => $value));
		$url = self::URL_BASE . $this->appid . "/text";
		$method = is_null($method) ? "POST" : "PUT";
		return self::makeCurlCall($method, $url, $data);
		
	}
	
	/**
	 * 
	 * Create an object holding binary data.
	 * @throws NotImplementedException
	 */
	public function createBinaryData() {

		throw new NotImplementedException("This method has not yet been implemented.");
		
	}
	
	/**
	 * 
	 * Update an object holding binary data.
	 * @throws NotImplementedException
	 */
	public function UpdateBinaryData() {
		
		throw new NotImplementedException("This method has not yet been implemented.");
		
	}
	
	/**
	 * 
	 * Update a user.
	 * @throws NotImplementedException
	 */
	public function editUser() {
		
		throw new NotImplementedException("This method has not yet been implemented.");
		
	}
	
	/**
	 * 
	 * Delete an object holding text or binart data.
	 * @throws NotImplementedException
	 */
	public function deleteData(Array $keys) {

		$key_list = implode(",", $keys);
		$url = self::URL_BASE . $this->appid . "/data?keys={$key_list}";
		return self::makeCurlCall("DELETE", $url);
		
	}
	
	/**
	 * 
	 * Make an HTTP request to the CloudMine API
	 * @param string $method
	 * @param string $url
	 * @param string $data
	 * TODO: Add Authorization header when '/user' is in the URL.
	 */
	private function makeCurlCall($method, $url, $data=NULL) {
		
		$headers = array("X-CloudMine-ApiKey: " . $this->apikey);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		// Set options for POST and PUT.
		if($method == "POST" || $method == "PUT") {
			if($method == "POST") {
				curl_setopt($ch, CURLOPT_POST, true);
			}
			else {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			}
			$header = array_push($headers, "Content-Type: application/json");
			$header = array_push($headers, "Content-Length: " . strlen($data));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		
		// Set options for DELETE.
		if($method == "DELETE") {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		}
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		
		if($info["http_code"] != "200") {
			throw new CloudMineException("Invlaid HTTP Response: " . $info["http_code"]);
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Class destrcutor.
	 */
	public function __destruct() {
		
		unset($this);
		
	}
	
}

// Exception classes.
class CloudMineException extends Exception {}

class NotImplementedException extends Exception {}

?>