
# URL-Shortner-PHP-Script
Single Application Program for generating short URL

Prerequisites 
  a) Optionally you can run this from your current domain or find a short domain
  b) Apache
  c) PHP
  d) MySQL

Installation
2. Download a .zip file of the URL shortener PHP script files
3. Upload the contents of the .zip file to your web server
4. Update the database info in config.php
5. Run the SQL included in shorturls.sql. Many people use phpMyAdmin for this, if you can’t do it yourself contact your host.
6. Rename rename.htaccess to .htaccess


Using your personal URL shortener service

- To manually shorten URLs open in your web browser the location where you uploaded the files.
- To programmatically shorten URLs with PHP use the following code:
    $shortenedurl = file_get_contents('http://yourdomain.com/shorten.php?longurl=' . urlencode('http://' . $_SERVER['HTTP_HOST']  . '/' . $_SERVER['REQUEST_URI']));



