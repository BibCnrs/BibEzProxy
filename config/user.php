# For more information on this file and the options for user
# authentication, see:
#      http://www.oclc.org/us/en/support/documentation/ezproxy/usr/
#
# Lines starting with # are comments
#
# This file may be updated while EZproxy is running without the need to
# stop and restart the program.
#
# This file contains three fields separated by colons (:) of the form
#
#      username:password:options
#
#
# A basic entry consists of a username and password, such as
#
#      someuser:somepass
#
# To create an administrative user, place :admin after the password.
# For example, the following line would create a username of rdoe with
# a password of keepsafe that has administrative access to the EZproxy server.
#
rdoe:keepsafe:admin

# For more information on this file and the options for user
# authentication, see:
#      http://www.usefulutilities.com/support/usr/

# On commence par dÃ©lÃ©guer l'authentification/autorisation Ã  ezticket
# Remarque : notez le parametre "gate=" qui permet Ã  ezticket de revenir sur le bon ezproxy une fois l'authentification rÃ©ussie
<?php
require("./utils/ezproxyticket.php");
$ezproxy = new EZproxyTicket("http://ezproxy.yourlib.org:2048", "shhhh", "someuser");
?>

# L'authentification par ticket (couplÃ©e au module ezticket ci-dessus)
#::Ticket
#AcceptGroups bibliovie+shs+admin
#TimeValid 10
#MD5 secret
#Expired; Deny expired.html
#/Ticket
