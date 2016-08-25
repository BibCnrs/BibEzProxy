# BibEzProxy

Gestion des EzProxy pour les domaines de BibCnrs. Un EzProxy par domaine.

## Développement

- Copier les clés ezproxy dans `env/insb.env` et `env/inshs.env` en respectant le formalisme décrit dans `env/env.dist`
- Ajouter `nameserver 127.0.0.1` au début de votre fichier `/etc/resolv.conf` (si la ligne n'est pas déjà présente)
- Taper `make run-dev`

Les ezproxy sont alors en ligne sur les noms de domaines suivants :
- `*.insb.bib.cnrs-dev.fr`
- `*.inshs.bib.cnrs-dev.fr`

## Configuration

Dans config et config/authorization, il y a deux types de fichiers de configuration:
- fournisseur : instructions EZProxy pour l'accès aux ressources. Ce sont souvent des éditeurs, mais aussi d'autres choses telles que des plateformes, des bases de données, ... (comment - aspect technique)
- portails: référencement de tous les fichiers fournisseurs à prendre en compte, sous la forme d'instruction EZProxy IncludeFile. (quoi - aspect contractuel)

Mettre chaque configuration fournisseur dans un fichier dédié, portant le nom du fournisseur en toutes lettres, en lettres ASCII CamelCase.

Les fichiers de configuration fournisseurs sont répartis en 3 catégories, dans des sous répertoires:
- "oclc": ceux provenant de l'OCLC, tels quels. Ils devraient être mis à jour systématiquement lorsque leur contenu change sur le site de l'OCLC. A noter que les ressources concernées ne sont pas limitées à celles auquelles on a droit. Ce sont toutes les resources du fournisseur.
- "other": provenant de l'OCLC mais adaptés spécifiquement pour l'INIST, provenant directement du fournisseur, créés à l'INIST, ...
- "inist": où l'INIST est le fournisseur.

Mettre dans le fichier de configuration portail "common.txt" les inclusions de tous les fichiers qui ont vocation à figurer dans tous les portails (à priori les négociations nationales).

Mettre dans les fichiers de configuration des portails l'inclusion de "common.txt", plus celui de tous les fichiers spécifiques.

Mettre l'URL de la configuration OCLC en commentaire au début des fichiers de configuration provenant de l'OCLC (exemple: # http://www.oclc.org/support/services/ezproxy/documentation/db/jstor.en.html).

Suggestion, recommendations :
- Garder en commentaire dans les fichiers de configuration des portails l'inclusion des fournisseurs qui cessent d'être utilisés, pour garder la trace de l'utilisation (quel portail, ...)
- Conserver les configurations fournisseur inutilisées, si elles ne proviennent pas de l'OCLC, ce qui évite d'avoir à les recréer en cas de nouvelle utilisation.
- Trier les fournisseurs par ordre alphabétique.
