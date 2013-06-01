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
$title = 'OC '.$opt['sSystemStatus'].' System';

// include layout
require_once('layout.php');

// start output buffer
ob_start();

// first layout
echo $html;
ob_flush();

// help
echo '<p class="pbutton"><a class="abutton" href="help.php"><span class="button">Information ' .
		'and Help</span></a></p>' .
		'<p class="hint">Information, help and FAQ how to use this system, please read first</p>';

// network
echo '<p class="pbutton"><a class="abutton" href="network.php"><span class="button">Setup ' .
		'Network</span></a></p>' .
		'<p class="hint">Configure Network Settings <a class="helplink" href="help.php#network">' .
		'-&gt; Help/FAQ</a></p>';

// xmlclient
echo '<p class="pbutton"><a class="abutton" href="init.php"><span class="button">Initialize/' .
		'Update</span></a></p>' .
		'<p class="hint">Get/update cache data from opencaching.de <a class="helplink" ' .
		'href="help.php#xmlclient">-&gt; Help/FAQ</a></p>';

// check if init already done
if (!file_exists($opt['pInitDone']))
{
	echo '<p class="pbutton"><a class="abutton" href="gitinit.php"><span class="button">Switch ' .
			'System</span></a></p>' .
			'<p class="hint">Change configured Demo System to Development System <a ' .
			'class="helplink" href="help.php#dev">-&gt; Help/FAQ</a></p>';
}

// demo/development page
echo '<p class="pbutton"><a class="abutton" href="'.$opt['pOcUrl'].'" target="_blank"><span ' .
		'class="button">OC Website</span></a></p><p class="hint">Access ';
echo (!file_exists($opt['pInitDone'])) ? 'Demo System</p>' : 'Development System</p>';

// phpMyAdmin
echo '<p class="pbutton"><a class="abutton" href="/pma/index.php" target="_blank"><span ' .
		'class="button">phpMyAdmin</span></a></p>' .
		'<p class="hint">Webbased MySQL administration tool</p>';

// system commands
echo '<p class="pbutton"><a class="abutton" href="system.php"><span class="button">System</span>' .
		'</a></p>' .
		'<p class="hint">Manage VM (i.e. reboot, shutdown)</p>';

// second layout
echo $html2;
ob_flush();

?>