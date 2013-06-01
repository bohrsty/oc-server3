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
$title = 'OC '.$opt['sSystemStatus'].' System - Networksettings';

// include layout
require_once('layout.php');

// start output buffer
ob_start();

// first layout
echo $html.'' .
		'<h3>Networksettings</h3>';

// check submitted
if (isset($_POST['submit']) && $_POST['submit'] == 'save')
{
	// check dhcp
	if (isset($_POST['dhcp']) && $_POST['dhcp'] == 'on')
	{
		echo '<p>Reset network to DHCP</p>';
		echo '<p>please reboot VM to get address from login-screen...</p>';
		ob_flush();
		flush();
		
		// execute network-config
		if (setNetworkConfig() !== false)
		{
			echo restartNetwork();
			ob_flush();
			flush();
		}
		
		// output
		echo $html2;
		ob_flush();
		flush();
		
		// stop script
		exit();
	}
	else
	{
		// check ip, mask and gw to be valid ip-addresses
		if (preg_match('/(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/',$_POST['ip'])
			&& preg_match('/(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/',$_POST['mask'])
			&& (preg_match('/(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/',$_POST['gw']) || $_POST['gw']=='')
			&& (preg_match('/(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/',$_POST['dns']) || $_POST['dns']=='')
			)
		{
			echo '<p>Set IP to '.$_POST['ip'].'</p>';
			echo '<p>please ajust your "/etc/hosts"-file and click <a href="'.$opt['pConfigUrl'].'">'.$opt['pConfigUrl'].'</a> to continue...</p>';
			ob_flush();
			flush();
			
			// collect network settings
			$networkSettings = array(
				'ip' => $_POST['ip'],
				'mask' => $_POST['mask'],
				'gw' => $_POST['gw'],
				'dns' => $_POST['dns']
			);
			
			// execute network-config
			if (setNetworkConfig(false,$networkSettings) !== false)
			{
				echo restartNetwork();
				ob_flush();
				flush();
			}
			
			// second layout
			echo $html2;
			ob_flush();
			flush();
			
			// stop script
			exit();
		}
		else
		{
			// error in ip, mask or gateway
			echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">' .
					'<table><tr><td class="redbold text" colspan="2">No valid IP or Netmask!' .
					'</td></tr>' .
					'<tr class="space"><td colspan="2"></td></tr>' .
					'<tr><td>IP-Address:</td><td><input type="text" name="ip" value="'.
					$_POST['ip'].'" /></td></tr>' .
					'<tr><td>Netmask:</td><td><input type="text" name="mask" value="'.
					$_POST['mask'].'" /></td></tr>' .
					'<tr><td>Gateway:</td><td><input type="text" name="gw" value="'.
					$_POST['gw'].'" /></td></tr>' .
					'<tr><td>Nameserver:</td><td><input type="text" name="dns" value="'.
					$_POST['dns'].'" /></td></tr>' .
					'<tr><td></td><td><input class="button" type="submit" name="submit" ' .
					'value="Save" /></td></tr></table>' .
					'</form>';
		}
	}
}
else
{
	// show form
	echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">' .
			'<table><tr><td>IP-Address:</td><td><input type="text" name="ip" /></td></tr>' .
			'<tr><td>Netmask:</td><td><input type="text" name="mask" /></td></tr>' .
			'<tr><td>Gateway:</td><td><input type="text" name="gw" /></td></tr>' .
			'<tr><td>Nameserver:</td><td><input type="text" name="dns" /></td></tr>' .
			'<tr class="space"><td colspan="2"></td></tr>' .
			'<tr><td colspan="2"><input type="checkbox" name="dhcp" />&nbsp;&nbsp;Reset ' .
			'network to DHCP (automaticaly obtain an IP address, if DHCP server present), ' .
			'<b>CAUTION</b>: disconnects you from this website, you have to reboot the VM ' .
			'and get the IP-address from console!</td></tr>' .
			'<tr><td></td><td><input class="button" type="submit" name="submit" value="Save" />' .
			'</td></tr></table>' .
			'</form>';
}

// second layout
echo $html2;
ob_flush();
 
?>
