#!/bin/bash

 #***************************************************************************
 #*  For license information see doc/license.txt
 #*
 #*  Unicode Reminder メモ
 #***************************************************************************

# sets the pre-loginscreen (/etc/issue) to the actual ip-values
# needs to be executed in /etc/sysconfig/network-scripts/ifup-post

I=/etc/issue

IP=$(ip addr | grep eth0 | grep inet | awk '{print $2}' | cut -d"/" -f1)


echo "WELCOME TO THE OPENCACHING-DEUTSCHLAND DEVELOPER IMAGE" > $I
echo "" >> $I
echo "" >> $I
echo "For further configuration and documentation go to" >> $I
echo "" >> $I
# is there an ip address?
if [ "x$IP" == "x" ]
then
  echo "  !!! No ip address, please check network settings. !!!" >> $I
else
  echo "http://$IP" >> $I
fi
echo "" >> $I
echo "" >> $I
echo "For access to console or via ssh as user root use password \"dev\"" >> $I
echo "" >> $I
# is there an ip address?
if [ "x$IP" == "x" ]
then
  echo "  !!! No ip address, please check network settings. !!!" >> $I
else
  echo "i.e. ssh -l root $IP" >> $I
fi
echo "" >> $I
echo "" >> $I
echo "For help and support visit the forum \"forum.opencaching-network.org\"" >> $I
echo "" >> $I