#!/bin/bash

 #***************************************************************************
 #*  For license information see doc/license.txt
 #*
 #*  Unicode Reminder メモ
 #***************************************************************************

## correct filesystem permissions on startup

CONFIGSPERM="/etc/sysconfig/network-scripts/ifcfg-eth0 /etc/issue /etc/httpd/conf.d/000_default.conf /etc/httpd/conf.d/zzz_www.conf /etc/php.d/000_default.ini /etc/samba/smb.conf"
DIROWNER="/ocmaint /var/www"

# change permissions for "world"
for i in $CONFIGSPERM
do
  if [ -e $i ]
  then
    chmod o+rwx $i
  fi
done


# change owner of given dirs (or files) recursivly to apache
for i in $DIROWNER
do
  if [ -e $i ]
  then
    chown -R apache:apache  $i
  fi
done