<?php
// installation paths
$dev_basepath = '/var/www/';
$dev_codepath = 'oc-server3/';
$dev_domain = 'local.opencaching.de';
$dev_baseurl = 'http://local.opencaching.de';

// common developer system settings
require('settings-dev.inc.php');

// database access
$opt['db']['servername'] = 'localhost';
$opt['db']['username'] = 'oc';
$opt['db']['password'] = 'dev';
$opt['db']['pconnect'] = true;

// database names
$opt['db']['placeholder']['db'] = 'ocdev';
$opt['db']['placeholder']['tmpdb'] = 'octmp';
$opt['db']['placeholder']['hist'] = 'ocdev';


/* News configuration
 *
 * filename to the include file containing the newscontent
 * (RSS format)
 * if no filename is given, the own news-code is used
 * (table news and newstopic.php)
 *
 * you have to correct entries in table sys_menu and
 * lang/de/stdtyle/lib/menu.php respectivly
 */
$opt['news']['include'] = 'http://blog.opencaching.de/feed/';
$opt['news']['count'] = 6;

?>