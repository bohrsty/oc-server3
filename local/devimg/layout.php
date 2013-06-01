<?php
/***************************************************************************
 *  For license information see doc/license.txt
 *
 *  Unicode Reminder メモ
 ***************************************************************************/

// check for updates
$updatable = checkUpdate();

// demo or development
$status = $opt['sSystemStatus'].' System';

// check navi
$navi = '';
if (basename($_SERVER['PHP_SELF']) != 'index.php')
{
	$navi = '<div id="navi">' .
				'<p class="navi">' .
				'<nobr>' .
				'<a class="abutton" href="help.php" title="Information, help and FAQ"><span class="button">Information and Help</span></a>&nbsp;' .
				'<a class="abutton" href="network.php" title="Configure Network Settings"><span class="button">Setup Network</span></a>&nbsp;' .
				'<a class="abutton" href="init.php" title="Get/update cache data from opencaching.de"><span class="button">Initialize/Update</span></a>&nbsp;';
	if (!file_exists($opt['pInitDone']))
		$navi .= '<a class="abutton" href="gitinit.php" title="Change configured Demo System to Development System"><span class="button">Switch System</span></a>&nbsp;';
	
	$navi .= '<a class="abutton" href="'.$opt['pOcUrl'].'" target="_blank" title="Access '.$status.'"><span class="button">OC Website</span></a>&nbsp;' .
				'<a class="abutton" href="/pma/index.php" target="_blank" title="Webbased MySQL administration tool"><span class="button">phpMyAdmin</span></a>&nbsp;' .
				'<a class="abutton" href="system.php" title="Manage VM"><span class="button">System</span></a>&nbsp;' .
				'</nobr>' .
				'</p>' .
				'</div>';
}

// html-layout (head)
$html = <<< EOH
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>$title</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<div id="head">
			<a id="logo" href="index.php"><img src="logo.png" title="Back to index..." alt="opencaching.de Logo" /></a>
			<h1>opencaching.de - $status</h1>
			$updatable
		</div>
		$navi
		<div id="content">
EOH;

// html-layout (foot)
$html2 = <<< EOH
		</div>
		<div id="foot">
			<p>driven by the opencaching community</p>
		</div>
	</body>
</html>
EOH;

?>
