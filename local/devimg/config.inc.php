<?php
/***************************************************************************
 *  For license information see doc/license.txt
 *
 *  Unicode Reminder メモ
 ***************************************************************************/

/*
 *  global config file, needs to be included in any script
 */

// constants
define('PHP_TAB',"\t");

// path for temporary files and folders
$opt['pTemp'] = '/temp/';

// DocumentRoot setting in apache configuration/vhost and paths for OC
$opt['pApacheRoot'] = '/var/www/';
$opt['pDocRoot'] = 'oc-server3/';
$opt['pGitDevimgRoot'] = 'local/devimg/';

// DocumentRoot and path settings for config page
$opt['pConfigRoot'] = '/var/www/config/';

// Domain and URL of the OC development page
$opt['pOcDomain'] = 'local.opencaching.de';
$opt['pOcUrl'] = 'http://'.$opt['pOcDomain'];

// Domain and URL of the config page
$opt['pConfigDomain'] = 'config.opencaching.de';
$opt['pConfigUrl'] = 'http://'.$opt['pConfigDomain'];

// path to ifcfg-file
$opt['pIfcfgEth0'] = '/etc/sysconfig/network-scripts/ifcfg-eth0';

// command for network restart
$opt['cRestartNetwork'] = 'sudo /sbin/service network restart';

// path to issue file
$opt['pEtcIssue'] = '/etc/issue';

// command to get the configured ip
$opt['cGetIp'] = 'ip addr | grep eth0 | grep inet | awk \'{print $2}\' | cut -d"/" -f1';

// path to indicator file, if exists, initialisation of gitrepo has been done
$opt['pInitDone'] = '/var/www/.init';

// path to local version file
$opt['pLocalVersion'] = '/var/www/.version';

// timeout to test internetconnection
$opt['internetTimeout'] = 3;

// web path to github repo
$opt['pGithubUpstream'] = 'github.com/OpencachingDeutschland/oc-server3';

// paths to configfiles in filesystem for httpd, php, mysqld, etc.
// files must be writable for apache-user (SECURITY RISK please consider "SECURITY" file)
// httpd
$opt['pLinuxHttpdDefault'] = '/etc/httpd/conf.d/000_default.conf';
$opt['pLinuxHttpdVhost'] = '/etc/httpd/conf.d/zzz_www.conf';
// php
$opt['pLinuxPhpDefault'] = '/etc/php.d/000_default.ini';
// mysqld
$opt['pLinuxMysqlDefault'] = '/etc/my.cnf';
// samba
$opt['pLinuxSambaDefault'] = '/etc/samba/smb.conf';

// command for reboot vm
$opt['cSystemReboot'] = 'sudo /sbin/reboot';
// command for shutdown vm
$opt['cSystemShutdown'] = 'sudo /sbin/shutdown -h now';

// get status of system (Demo or Development)
$opt['sSystemStatus'] = (!file_exists($opt['pInitDone'])) ? 'Demo' : 'Development';

// URL for forum
$opt['pForumUrl'] = 'http://forum.opencaching-network.org/';

// URL for userwiki
$opt['pWikiUrl'] = 'http://wiki.opencaching.de/';

?>
