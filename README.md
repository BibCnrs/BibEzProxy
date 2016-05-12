# BibEzProxy
EzProxy for BibCnrs

## configuration
dans config et config/authorization
Il y a deux types de fichiers de configuration:
   * fournisseur: instructions EZProxy pour l'acc�s aux ressources. Ce sont souvent des �diteurs, mais aussi d'autres choses telles que des plateformes, des bases de donn�es, ... (comment - aspect technique)
   * portails: r�f�rencement de tous les fichiers fournisseurs � prendre en compte, sous la forme d'instruction EZProxy IncludeFile. (quoi - aspect contractuel)

Mettre chaque configuration fournisseur dans un fichier d�di�, portant le nom du fournisseur en toutes lettres, en lettres ASCII CamelCase.

Les fichiers de configuration fournisseurs sont r�partis en 3 cat�gories, dans des sous r�pertoires:
   * "oclc": ceux provenant de l'OCLC, tels quels. Ils devraient �tre mis � jour syst�matiquement lorsque leur contenu change sur le site de l'OCLC.
     A noter que les ressources concern�es ne sont pas limit�es � celles auquelles on a droit. Ce sont toutes les resources du fournisseur.
   * "other": provenant de l'OCLC mais adapt�s sp�cifiquement pour l'INIST, provenant directement du fournisseur, cr��s � l'INIST, ...
   * "inist": o� l'INIST est le fournisseur.

Mettre dans le fichier de configuration portail "common.txt" les inclusions de tous les fichiers qui ont vocation � figurer dans tous les portails (� priori les n�gociations nationales).

Mettre dans les fichiers de configuration des portails l'inclusion de "common.txt", plus celui de tous les fichiers sp�cifiques.

Mettre l'URL de la configuration OCLC en commentaire au d�but des fichiers de configuration provenant de l'OCLC (exemple: # http://www.oclc.org/support/services/ezproxy/documentation/db/jstor.en.html).

Suggestion:
Garder en commentaire dans les fichiers de configuration des portails l'inclusion des fournisseurs qui cessent d'�tre utilis�s, pour garder la trace de l'utilisation (quel portail, ...)
Conserver les configurations fournisseur inutilis�es, si elles ne proviennent pas de l'OCLC, ce qui �vite d'avoir � les recr�er en cas de nouvelle utilisation.
Trier les fournisseurs par ordre alphab�tique.
