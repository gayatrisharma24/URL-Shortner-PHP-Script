<?php

/**
 * Class Shortener
 *
 * @author Gayatri Sharma
 */

class Shortener
{
	/**
     * 
     *
     * @var object
     */
	protected $db;

    /**
     * Construct for establishing database connection
     * @param Hostname
     * @param Username
     * @param Password
     * @param Database Name
     */
	public function __construct()
	{
		$this->db = new mysqli('localhost', 'root', 'satech@1234', 'shorturls');
	}

    /**
     * Generate Code
     * 
     * Converts Base for Alphanumeric Characters to generate a unique short code
     * 
     */
	protected function generateCode($num){
		return base_convert($num, 10, 36);
	}

	 /**
     * Make Code
     * 
     * Select, Inert, Update queries 
     * @param $url
     * 
     */
	public function makeCode($url)
	{
		$url = trim($url);
		if(!filter_var($url, FILTER_VALIDATE_URL))
		{
			return '';
		}

		$url = $this->db->escape_string($url);

		// Check if URL already exists
		$exists = $this->db->query("SELECT code FROM links WHERE url = '{$url}'");

		if($exists->num_rows)
		{
			return $exists->fetch_object()->code;
		}
		else
		{
			// Insert record without a code
			$this->db->query("INSERT INTO links (url, created) VALUES ('{$url}', NOW())");

			// Generate code based on inserted ID
			$code = $this->generateCode($this->db->insert_id);

			// Update the record with the generated code
			$this->db->query("UPDATE links SET code = '{$code}' WHERE url = '{$url}'");

			return $code;
		}
	}

	/**
     * Get URL
     * 
     * Fetching the new generated short URL
     *
     * @param $code
     * 
     */
	 public function getUrl($code){
	 	$code = $this->db->escape_string($code);

	 	$code = $this->db->query("SELECT url FROM links WHERE code = '$code'");

	 	if($code->num_rows){
	 		return $code->fetch_object()->url;
	 	}

	 	return '';
	 }
}
