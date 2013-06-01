<?php
/***************************************************************************
 *  For license information see doc/license.txt
 *
 *  Unicode Reminder メモ
 ***************************************************************************/



/**
 * setNetworkConfig writes the given network settings into ifcfg file
 * 
 * @param bool $dhcp configures network using dhcp if true, requires array with settings if false
 * @param array $settings array containing the ip-, mask-, gw- and dns-information
 * @return bool true, if write was successful, false otherwise
 */
function setNetworkConfig($dhcp=true, $settings=array())
{
	global $opt;
	
	// DHCP or not
	$networkSettings = '';
	if ($dhcp === true)
	{
		// set settings to DHCP
		$networkSettings = "DEVICE=eth0\nBOOTPROTO=dhcp\nONBOOT=yes";
	}
	else
	{
		
		// default settings
		$networkSettings = "DEVICE=eth0\nBOOTPROTO=none\nONBOOT=yes\nTYPE=Ethernet";
		
		// check ip and mask
		if (isset($settings['ip']))
			$networkSettings .= "\nIPADDR=".$settings['ip'];
		if (isset($settings['mask']))
			$networkSettings .= "\nNETMASK=".$settings['mask'];
		
		// add gateway and dns if given
		if (isset($settings['gw']))
			$networkSettings .= "\nGATEWAY=".$settings['gw'];
		if (isset($settings['dns']))
			$networkSettings .= "\nDNS1=".$settings['dns'];
	}
	
	// get filehandle
	$fh = @fopen($opt['pIfcfgEth0'], 'w');
	
	// check handle
	if ($fh === false)
		return false;
	
	// write config
	$return = @fwrite($fh, $networkSettings);
	
	// close handle
	fclose($fh);
	
	// return
	if ($return !== false)
		return true;
	
	return false;
}


/**
 * restartNetwork executes the command to restart the network
 */
function restartNetwork()
{
	global $opt;
	
	// execute command
	exec($opt['cRestartNetwork']);
}


/**
 * setIssue collects the ip infomation and sets the info in the issue file
 * 
 * @return bool true, if write was successful, false otherwise
 */
function setIssue()
{
	global $opt;
	
	// get ip information
	$ip = system($opt['cGetIp']);
	
	// set text
	$loginText =
		"WELCOME TO THE OPENCACHING.DE DEVELOPER IMAGE\n" .
		"\n\n" .
		"For further configuration and documentation go to\n" .
		"\n" .
		"http://$ip\n" .
		"\n\n" .
		"For access to console or via ssh as user root use password \"dev\"\n" .
		"\n" .
		"i.e. ssh -l root $ip\n" .
		"\n\n" .
		"For help and support visit the forum \"forum.opencaching-network.org\"" .
		"\n";
	
	// write to file
	// get filehandle
	$fh = @fopen($opt['pEtcIssue'], 'w');
	
	// check handle
	if ($fh === false)
		return false;
	
	// write config
	$return = @fwrite($fh,$loginText);
	
	// close handle
	fclose($fh);
	
	// return
	if ($return !== false)
		return true;
	
	return false;
	
}


/**
 * checkUpdate checks if there is a new version and prepares the update
 * 
 * @return string HTML code with link to update, if there is an update, empty string otherwise
 */
function checkUpdate()
{
	global $opt;
	
	// get version
	$version = @file_get_contents($opt['pLocalVersion']);
	
	// check for updates
	$netversion = @file_get_contents($opt['pApacheRoot'].$opt['pDocRoot'].$opt['pGitDevimgRoot'].'.version');
	$updatable = '';
	if ($netversion !== false && $version !== false)
	{
		// check if newer version
		if((int)$netversion > (int)$version)
		{
			// set update link
			$updatable = '<p class="updatable">UPDATE AVAILABLE <a href="update.php">please update development system</a>!</p>';
			
			// copy update file
			$copied = @copy($opt['pApacheRoot'].$opt['pDocRoot'].$opt['pGitDevimgRoot'].'updates/update-dist.php', $opt['pConfigRoot'].'update.php');
			
			// check success
			if($copied === false)
				$updatable = '<p class="updatable">UPDATE AVAILABLE, but could not copy file!<br />Please check permissions in filesystem for update.<br />[checkUpdate:notCopied] <a class="updatehelp" href="help.php#update">-&gt; Help/FAQ</a></p>';
		}
		else if((int)$netversion == (int)$version && is_file($opt['pConfigRoot'].'update.php'))
		{
			$unlinked = @unlink($opt['pConfigRoot'].'update.php');
			// check result of cleanup
			if($unlinked === false)
				$updatable = '<p class="updatable">UPDATE cleanup failed!<br />Please please delete "'.$opt['pConfigRoot'].'update.php" manually.<br />[checkUpdate:cleanupFailed] <a class="updatehelp" href="help.php#update">-&gt; Help/FAQ</a></p>';
		}
	}
	else
		$updatable = '<p class="updatable">Check for UPDATE failed!<br />Please check permissions in filesystem or existence of files for update.<br />[checkUpdate:checkFailed] <a class="updatehelp" href="help.php#update">-&gt; Help/FAQ</a></p>';
	
	// return
	return $updatable;
}


/**
 * systemReboot() executes the command to reboot the vm
 * 
 * @return void
 */
function systemReboot()
{
	global $opt;
	
	// execute command
	system($opt['cSystemReboot']);
}


/**
 * systemShutdown() executes the command to shutdown the vm
 * 
 * @return void
 */
function systemShutdown()
{
	global $opt;
	
	// execute command
	system($opt['cSystemShutdown']);
}


/**
 * gitReturnValues() analyzes the return value of the given git command
 * 
 * @param string $gitCommand the git command that has been executed and that return value is analyzed
 * @param int $returnValue return value given by the system() method
 * @return string [OK] if command was successfully, [FAILED] otherwise
 */
function gitReturnValues($gitCommand, $returnValue)
{
	// switch $gitCommand
	switch ($gitCommand)
	{
		// git config
		case 'git config':
		case 'git remote':
		case 'git pull':
		case 'git push':
			if ($returnValue > 0)
				return '[FAILED]';
		break;
	}
	
	// return OK
	return '[OK]';
}



?>
