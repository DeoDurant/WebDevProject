<?php 
// Locks page until password and username are entered.

define('ADMIN_LOGIN','wally'); 
define('ADMIN_PASSWORD','mypass'); 
define('USER_LOGIN', 'choie');
define('USER_PASSWORD', 'llamas');

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
    || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN) 
    || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)
    || ($_SERVER['PHP_AUTH_USER'] != USER_LOGIN) 
    || ($_SERVER['PHP_AUTH_PW'] != USER_PASSWORD)) 
    { 
  header('HTTP/1.1 401 Unauthorized'); 
  header('WWW-Authenticate: Basic realm="Our Blog"'); 
  exit("Access Denied: Username and password required."); 
} 
 
?>
