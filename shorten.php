<?php
	/**
	 * Shorten
	 *
	 * @author Gayatri Sharma
	 *
	 * Start the Session
	 */
	session_start();

	//includes Shortner file for DB Connection
	require_once 'classes/Shortener.php';

	/** 
     * @param Shortener $s
     */
	$s = new Shortener;

	// Check for URL entered
	if (isset($_POST['url'])) 
	{
    	$url = $_POST['url'];
    
    // Short code appended at the end of the current URL
    if ($code = $s->makeCode($url)) 
    {
        $_SESSION['user'] = "Generated! Your short URL is: <a href=\"http://localhost/php123/{$code}\">http://localhost/php123/{$code}</a>";
    } 
    else 
    {
        $_SESSION['user'] = "There was a problem.";
    }
}

	 /** 
     * Redirection to Index page
     */
    header('Location: index.php');