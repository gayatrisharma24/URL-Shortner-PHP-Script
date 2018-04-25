<?php

//includes Shortner file for DB Connection
require_once 'classes/Shortener.php';

// Checks for the short url code generated
if (isset($_GET['code'])) 
{
	/** 
     * @param Shortener $s
     * @param $code
     */
    $s    = new Shortener;
    $code = $_GET['code'];
    
    if ($url = $s->getUrl($code)) 
    {
        header("Location: {$url}");
        die();
    }
}

     /** 
     * Redirection to Index page
     */
    header('location: index.php');