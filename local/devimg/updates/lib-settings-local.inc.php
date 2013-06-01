<?php
// installation paths
$dev_basepath = '/var/www/';
$dev_codepath = 'oc-server3/';
$dev_domain   = 'local.opencaching.de';
$dev_baseurl  = 'http://local.opencaching.de';

// database acccess
$dbserver = 'localhost';
$dbusername = 'oc';
$dbpasswd = 'dev';
$dbpconnect = false;
  
// database names
$dbname = 'ocdev';
$tmpdbname = 'octmp';
   
// common developer system settings
require("settings-dev.inc.php");
?>
