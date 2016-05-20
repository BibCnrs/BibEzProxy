#
# Ce fichier de conf est commun a toutes les instances des ezproxy (ezproxyvie, ezproxybbs ...)
# Il regroupe tous les parametres qui sont identiques d'une communautÃ© Ã  une autre
#

# On ecoute sur fede-dev (cad les flux entrent par fede-dev)
Interface Any

# * "LoginPort -virtual" permet d'indiquer a ezproxy qu'il doit utiliser
#   le port 80 (ou 443) dans la rÃ©ecriture des urls mais qu'il ne doit pas Ã©couter dessus.
# * Un second LoginPort utilise pour Ã©couter est definit dans les fichiers de config
#   de chaque instance (car on doit avoir un port different par instance)

<?php if (getenv('env') == 'DEV') { ?>
XDebug 1000
<?php } ?>

# lance ezproxy en tant que user=$APPNAME_USER group=$APPNAME_GROUP
RunAs root:root

# ezproxy suffixera les urls par son nom de dommaine (ex: *.gate1.dev.inist.fr)
# http://www.usefulutilities.com/support/cfg/proxybyhostname.html
Option ProxyByHostname

## Parametrages des logs
# http://www.usefulutilities.com/support/cfg/logformat/
# %{X-FORWARDED-FOR}i permet de rÃ©cupÃ©rer l'adresse IP rÃ©elle du client en rendant transparent la traversÃ©e du reverse proxy
LogFormat %{X-FORWARDED-FOR}i %l %u %t "%r" %s %b
# on ignore les images pour eviter de charger inutilement les logs
LogFilter *.gif
LogFilter *.png
LogFilter *.jpg
LogFilter *.ico
# on enregistre le login dans les logs (%u)
Option LogUser

# Pour eviter des soucis avec les certificats wildcard (http://osdir.com/ml/education.ezproxy/2005-04/msg00012.html)
# A utiliser seulement lorsque l'on a des certificats qui ne sont pas wildcard (ce n'est pas notre cas)
#Option IgnoreWildcardCertificate

# Quelques reglages pour augmenter le nombre de serveurs qui seront lances
# http://pluto.potsdam.edu/ezproxywiki/index.php/EZproxy.cfg#.28MS.29_MaxSessions.2C_default_500
MaxVirtualHosts 3499
MaxSessions     3999
MaxVirtualHosts 3500

# Securing Your EZproxy Server
IntruderIPAttempts -interval=5 -expires=15 20
IntruderUserAttempts -interval=5 -expires=15 10
UsageLimit -enforce -MB=500 -interval=60 -expires=120 Global

# Options permettant de transmettre l'adress ip du client Ã  l'Ã©diteur.
# Cette option est nÃ©cessaire chez certains Ã©diteurs pour leur permettre de compter
# le nombre de tÃ©lÃ©chargement plus prÃ©cisÃ©ment et de ne pas couper l'accÃ¨s
# si un nombre trop important de tÃ©lÃ©chargement est dÃ©tectÃ©.
# C'est le cas avec http://www.ncbi.nlm.nih.gov/pmc/
Option AcceptX-Forwarded-For
Option X-Forwarded-For

# RÃ©glage d'un timeout important pour Ã©viter que des requÃªtes Ã©chouent sur des longues recherches
# (c'est le cas avec Web of Science)
ClientTimeout 300
RemoteTimeout 300

COOKIENAME <?php echo getenv('GATE_NAME'); ?>

## Parametrages des ports et des interfaces rÃ©seaux
# gate1.dev.inist.fr sera utilisÃ© pour les rÃ©Ã©critures d'url
Name <?php echo getenv('GATE_NAME'); ?>.<?php echo getenv('GATE_SUFFIX'); ?>

# On Ã©coute sur fede-dev.intra.inist.fr:50162 (pour http) et fede-dev.intra.inist.fr:50169 (pour https)
# cf http://www.usefulutilities.com/support/cfg/interface/
LoginPort 80
LoginPortSSL 443

Interface Any

<?php if ($proxy = str_replace('http://', '', getenv('http_proxy'))) { ?>
Proxy <?php echo $proxy;
}?>

<?php if ($proxySSL = str_replace('http://', '', getenv('https_proxy'))) { ?>
ProxySSL <?php echo $proxySSL;
}?>

Group <?php echo getenv('GATE_NAME'); ?>

IncludeFile ./<?php echo getenv('GATE_NAME'); ?>.txt
