<?php
/***************************************************************************
 *  For license information see doc/license.txt
 *
 *  Unicode Reminder メモ
 ***************************************************************************/

// include config
include_once('config.inc.php');
// include functions
include_once('functions.inc.php');

// network configuration
// layout
$title = 'OC '.$opt['sSystemStatus'].' System - Systemcommands';

// include layout
require_once('layout.php');

// start output buffer
ob_start();

// first layout
echo $html;

// check reboot
if (isset($_GET['reboot']))
{
	echo 'VM is rebooting, see status on console...';
	ob_flush();
	flush();
	
	// execute command
	systemReboot();
	exit;
}
else if (isset($_GET['shutdown']))
{
	echo 'VM is going down NOW, see status on console...';
	ob_flush();
	flush();
	
	// execute command
	systemShutdown();
	exit;
}
else
{
	// default: buttons
	echo '<h3>System Commands</h3>' .
			'<script>
				<!--
					function userconfirm(type)
					{
						var yesno = confirm("Are you sure you want to " + type + " the VM?");
						if (!yesno)
						{
							window.location="system.php";
						}
						else
						{
							window.location="system.php?" + type;
						}
					}
				//-->
			</script>' .
			'<p class="pbutton"><a class="abutton" onclick="userconfirm(\'reboot\')" ' .
			'href="#"><span class="button">Reboot</span></a></p>' .
			'<p class="hint">Reboots the VM now</p>' .
			'<p class="pbutton"><a class="abutton" onclick="userconfirm(\'shutdown\')" ' .
			'href="#"><span class="button">Shutdown</span></a></p>' .
			'<p class="hint">Shuts the VM down now</p>' .
			'<noscript>' .
			'<p class="redbold">You cannot correctly use the buttons above without JavaScript enabled!</p>' .
			'<p>Using <a href="system.php?reboot"">Reboot</a> or <a href="system.php?shutdown">Shutdown</a> ' .
			'the VM will be rebooted/shutdown without confirmation!</p>' .
			'</noscript>';
	
	ob_flush();
	flush();
}

?>
