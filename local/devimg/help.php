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
$title = 'OC '.$opt['sSystemStatus'].' System - Help';

// include layout
require_once('layout.php');

// start output buffer
ob_start();

// first layout
echo $html.'' .
		'<h3>Information / Help / FAQ</h3>';

// prolog
echo '<p>Here you get a short introduction and a little help for offline use. ' .
		'The main documentation and help page you\'ll find in our <a href="' .
		$opt['pWikiUrl'].'">Wiki</a> (parts may be in german). If you have questions or ' .
		'problems you may visit the <a href="'.$opt['pForumUrl'].'">' .
		'Forum</a>.</p>';

// security warning from SECURITY file
echo '<h3 class="red">SECURITY</h3>';
echo '<p class="redbold">To make this VM easy configurable and updatable some filesystem ' .
		'permissions of service configuration files are changed to be writable for the ' .
		'apache webserver.</p>' .
		'<p class="redbold">DO NOT MAKE THIS WEBSERVER DIRECTLY AVAILABLE FROM THE ' .
		'INTERNET TO AVOID DISTRIBUTION OF MALWARE!</p>';

// network
echo '<a name="network"></a><h3>Network Settings</h3>' .
		'<ul>' .
		'<li>If you keep network settings on DHCP or set it to get IP address via DHCP, ' .
		'ensure that you always get the same IP address to use the hostname entries ' .
		'correctly (see below)</li>' .
		'<li>If you use a static IP address, ensure that you do not conflict with IP addresses ' .
		'distributed via DHCP</li>' .
		'<li>To use the '.$opt['sSystemStatus'].' System you have to ajust your local ' .
		'nameresolution in your hostfile. Windows-User have to edit <span class="fspath">' .
		'%systemdirectory%\\drivers\\etc\\hosts</span> (as Administrator), Linux-User ' .
		'<span class="fspath">/etc/hosts</span> (as root) and Mac-User <span class="fspath">' .
		'/private/etc/hosts</span>.<br />' .
		'You have to add the following line:' .
		'<p class="code"><nobr>[ip.add.re.ss]	config.opencaching.de	' .
		'local.opencaching.de</nobr></p>' .
		'Where you have to replace [ip.add.re.ss] with the IP address you have given manually ' .
		'or obtained from DHCP (you can see it on the console after reboot).</li>' .
		'</ul>';

// ocxmlclient
echo '<a name="xmlclient"></a><h3>Get cache data from opencaching.de</h3>' .
		'<ul>' .
		'<li></li>' .
		'</ul>';

// demo system
echo '<a name="demo"><h3>Use as Demosystem</h3></a>' .
		'<ul>' .
		'<li>To use any features (i.e. maps, news, etc.), ensure that the VM has ' .
		'internetconnection</li>' .
		'</ul>';

// init of development system
echo '<a name="dev"></a><h3>Change to Development System</h3>' .
		'<ul>' .
		'<li><i>github-Name</i> and <i>Emailaddress</i> are used in commits to identify the commiter, they ' .
		'could be seen by everyone on github.com and in the git history of each clone</li>' .
		'<li><i>github URL of developer fork</i> is the URL of your fork (please use that one starting ' .
		'with <i>https://</i> to avoid problems)</li>' .
		'<li>Switching to development system will setup your master branch on the upstream ' .
		'master branch of "OpencachingDeutschland", their actual master will be pushed into ' .
		'your forks master</li>' .
		'</ul>';

// update config
echo '<a name="update"></a><h3>Update config</h3>' .
		'<ul>' .
		'<li>This config page checks if there is a newer version in the git repository. If it ' .
		'finds a newer version, there will be a link to the update page on top of each page ' .
		'until you updated the system. Not updating this system may end up in trouble if important ' .
		'configurations changed!<br />' .
		'The update process does not change anything automatically, you have to start the update ' .
		'manually on the update page, if the link is shown.</li>' .
		'<li><b>[checkUpdate:notCopied]</b>: if you get this error message and there is no ' .
		'link to update page, the system could not copy <span class="fspath">'.$opt['pApacheRoot'].
		$opt['pDocRoot'].$opt['pGitDevimgRoot'].'updates/update-dist.php</span> to the destination ' .
		'<span class="fspath">'.$opt['pConfigRoot'].'update.php</span>. Please reboot the VM to ' .
		'correct the permissions on destination and ensure, the source file exists.</li>' .
		'<li><b>[checkUpdate:cleanupFailed]</b>: if you get this error message and there is no ' .
		'link to update page, the system could not delete <span class="fspath">'.$opt['pConfigRoot'].
		'update.php</span>. Please reboot the VM to correct the permissions for the file.</li>' .
		'<li><b>[checkUpdate:checkFailed]</b>: if you get this error message and there is no ' .
		'link to update page, the system could not get the content of <span class="fspath">' .
		$opt['pLocalVersion'].'</span> or <span class="fspath">'.$opt['pApacheRoot'].
		$opt['pDocRoot'].$opt['pGitDevimgRoot'].'.version</span>. Please reboot the VM to correct ' .
		'the permissions for the files.</li>' .
		'</ul>';

// second layout
echo $html2;
ob_flush();

?>
