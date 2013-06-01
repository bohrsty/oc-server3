<?php

/***************************************************************************
 *  For license information see doc/license.txt
 *
 *  Unicode Reminder メモ
 ***************************************************************************/


// include config
require_once('config.inc.php');
// include functions
require_once('functions.inc.php');


// title
$title = 'OC '.$opt['sSystemStatus'].' System - Initialize Data';

// include layout
require_once('layout.php');

// start output buffer
ob_start();

// first layout
echo $html;
ob_flush();

// use ocxmlclient
echo '<h3>Get cache data from opencaching.de</h3>';

// second layout
echo $html2;
ob_flush();

?>