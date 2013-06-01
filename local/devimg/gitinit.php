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

// layout
$title = 'OC '.$opt['sSystemStatus'].' System - Initialize Git';

// include layout
require_once('layout.php');

// start output buffer
ob_start();

// first layout
echo $html .
		'<h3>Switch to Development System</h3>';
ob_flush();

// check submitted
if (isset($_POST['submit']) && $_POST['submit'] == 'Initialize')
{
	// check name and email
	if ($_POST['gitname'] != '' && $_POST['email'] != '' && $_POST['gitfork'] != '')
	{
		// clear POST and get vars
		$initConfig['gitName'] = escapeshellarg($_POST['gitname']);
		$initConfig['gitEmail'] = escapeshellarg($_POST['email']);
		$initConfig['gitFork'] = escapeshellarg($_POST['gitfork']);
		
		// setup gitconfig
		echo '<p>Configuring git...<br />';
		ob_flush();
		
		// set opening pre-tag
		echo '<pre>';
		ob_flush();
		
		// set name
		$command = 'sudo git config --system user.name '.$initConfig['gitName'];
		echo 'Executing: '.$command . PHP_EOL;
		ob_flush();
		system($command, $returnValue);
		echo PHP_TAB . gitReturnValues('git config', $returnValue) . PHP_EOL . PHP_EOL;
		ob_flush();
		unset($command, $returnValue);
		
		// set emailaddress
		$command = 'sudo git config --system user.email '.$initConfig['gitEmail'];
		echo 'Executing: '.$command . PHP_EOL;
		ob_flush();
		system($command, $returnValue);
		echo PHP_TAB . gitReturnValues('git config', $returnValue) . PHP_EOL . PHP_EOL;
		ob_flush();
		unset($command, $returnValue);
		
		// MacOS workaround
		$command = 'sudo git config --system core.trustctime false';
		echo 'Executing: '.$command . PHP_EOL;
		ob_flush();
		system($command, $returnValue);
		echo PHP_TAB . gitReturnValues('git config', $returnValue) . PHP_EOL . PHP_EOL;
		ob_flush();
		unset($command, $returnValue);
		
		// set closing pre-tag
		echo '</pre>';
		ob_flush();
		
		// wait a second
		sleep(1);
		
		// init git
		echo '<p>Changing git to developer fork...<br />';
		ob_flush();
		
		// set opening pre-tag
		echo '<pre>';
		ob_flush();
		
		// reset origin
		$command = 'cd '.$opt['pApacheRoot'].$opt['pDocRoot'].' && git remote add upstream https://'.$opt['pGithubUpstream'];
		echo 'Executing: '.$command . PHP_EOL;
		ob_flush();
		system($command, $returnValue);
		echo PHP_TAB . gitReturnValues('git remote', $returnValue) . PHP_EOL . PHP_EOL;
		ob_flush();
		unset($command, $returnValue);
		
		// set upstream
		$command = 'cd '.$opt['pApacheRoot'].$opt['pDocRoot'].' && git remote set-url origin '.$initConfig['gitFork'];
		echo 'Executing: '.$command . PHP_EOL;
		ob_flush();
		system($command, $returnValue);
		echo PHP_TAB . gitReturnValues('git remote', $returnValue) . PHP_EOL . PHP_EOL;
		ob_flush();
		unset($command, $returnValue);
		
		// update from upstream
		$command = 'cd '.$opt['pApacheRoot'].$opt['pDocRoot'].' && git pull --rebase upstream master';
		echo 'Executing: '.$command . PHP_EOL;
		ob_flush();
		system($command, $returnValue);
		echo PHP_TAB . gitReturnValues('git pull', $returnValue) . PHP_EOL . PHP_EOL;
		ob_flush();
		unset($command, $returnValue);
		
		// push into origin
		$command = 'cd '.$opt['pApacheRoot'].$opt['pDocRoot'].' && git push origin master';
		echo 'Executing: '.$command . PHP_EOL;
		ob_flush();
		system($command, $returnValue);
		echo PHP_TAB . gitReturnValues('git push', $returnValue) . PHP_EOL . PHP_EOL;
		ob_flush();
		unset($command, $returnValue);
		
		// set closing pre-tag
		echo '</pre>';
		ob_flush();
		
		// wait a second
		sleep(1);
				
		// set init done and version
		$fhversion = @fopen($opt['pLocalVersion'],'w');
		$fhinitdone = @fopen($opt['pInitDone'],'w');
		$localVersion = @file_get_contents($opt['pApacheRoot'].$opt['pDocRoot'].$opt['pGitDevimgRoot'].'.version');
		
		// check files
		if ($fhversion === false || $localVersion === false || $fhinitdone === false)
			die('Cannot finish init of development fork, please check filesystem permissions!');
		
		// write init config
		fwrite($fhinitdone,serialize($initConfig));
		fclose($fhinitdone);
		
		// write version
		fwrite($fhversion,$localVersion);
		fclose($fhversion);
		
				
		// done
		echo '<p>Switch done.</p>';
		ob_flush();
	}
	else
	{
		// error in input
		echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
		echo '<table><tr><td class="redbold text" colspan="2">github-Name, Emailaddress or github URL not given!</td></tr>';
		echo '<tr class="space"><td colspan="2"></td></tr>';
		echo '<tr><td>git-Name:</td><td><input type="text" name="gitname" value="'.$_POST['gitname'].'" /></td></tr>';
		echo '<tr><td>Emailaddress:</td><td><input type="text" name="email" value="'.$_POST['email'].'" /></td></tr>';
		echo '<tr><td>github URL of developer fork:</td><td><input type="text" name="gitfork" value="'.$_POST['gitfork'].'" /></td></tr>';
		echo '<tr class="space"><td colspan="2"></td></tr>';
		echo '<tr><td></td><td><input class="button" type="submit" name="submit" value="Initialize" /></td></tr></table>';
		echo '</form>';
  	}
}
else
{
	// show form
	echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
	echo '<table><tr><td>git-Name:</td><td><input type="text" name="gitname" /></td></tr>';
	echo '<tr><td class="text">Emailaddress:</td><td><input type="text" name="email" /></td></tr>';
	echo '<tr><td>github URL of developer fork:</td><td><input type="text" name="gitfork" /></td></tr>';
	echo '<tr class="space"><td colspan="2">(Please use the git URL starting with "https://" to avoid problems!)</td></tr>';
	echo '<tr class="space"><td colspan="2"></td></tr>';
	echo '<tr><td colspan="2">The information above will be used for your commits (are visible to the public on github.com) and to initialize this system with your fork on github.com.</td></tr>';
	echo '<tr><td></td><td><input class="button" type="submit" name="submit" value="Initialize" /></td></tr></table>';
	echo '</form>';
}

// second layout
echo $html2;
ob_flush();

?>
