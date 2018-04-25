
# URL-Shortner-PHP-Script
Single Application Program for generating short URL

Prerequisites

  a) Optionally you can run this from your current domain or find a short domain
  b) Apache
  c) PHP
  d) MySQL

Installation

- Download a .zip file of the URL shortener PHP script files
- Upload the contents of the .zip file to your web server
- Update the appropriate "Database Name", "Uername", "Password", "Database Host" in config.php
- Run the SQL included in shorturls.sql. Many people use phpMyAdmin for this, if you can’t do it yourself contact your host.
- Rename rename.htaccess to .htaccess
 


Using your personal URL shortener service

- To manually shorten URLs open in your web browser the location where you uploaded the files.
- To programmatically shorten URLs with PHP use the following code:
    $shortenedurl = file_get_contents('http://yourdomain.com/shorten.php?longurl=' . urlencode('http://' . $_SERVER['HTTP_HOST']  . '/' . $_SERVER['REQUEST_URI']));



