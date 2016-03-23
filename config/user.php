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

# On commence par déléguer l'authentification/autorisation à ezticket
# Remarque : notez le parametre "gate=" qui permet à ezticket de revenir sur le bon ezproxy une fois l'authentification réussie
::CGI=<?php echo getenv('EZ_TICKET_URL') ?>?gate=<?php echo getenv('GATE_NAME'); ?>.<?php echo getenv('GATE_SUFFIX'); ?>&url=^U

# L'authentification par ticket (couplée au module ezticket ci-dessus)
::Ticket
AcceptGroups <?php echo getenv('GATE_NAME'); ?>

TimeValid 10
SHA512 <?php echo getenv('EZ_TICKET_SECRET') ?>

Expired; Deny expired.html
/Ticket
