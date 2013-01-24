---
layout: post
published: false
comments: false
title: Expérience avec Jekyll
---
On a, il y a quelques jours, métamorphosé notre espace sur le web.  
Le principal motivateur de cette migration se trouve au cœur même du blog, ainsi que ma manière de le gérer.

À raison d'un rythme de publication léger, et d'un classement linéaire (chronologique), la véritable machine qu'est Wordpress finit par logiquement paraitre surdimensionnée. J'ai donc opté pour le fameux **Jekyll, générateur de blog statique, en ruby** !

Pour en expliquer le contexte ; les fichiers source sont en local, de là Jekyll génère un site **statique**, qu'il ne reste plus qu'à mettre à disposition sur le serveur (dans mon cas, à téléverser via FTP \*¹). Et qui dit statique, dit très léger, et très rapide à charger.

**\*¹** *J'utilise par ailleurs pour ce téléversement via FTP, l'outil __glynn__. Son fonctionnement est simple : on exécute la commande `glynn` à la racine de notre source, entre les identifiants FTP, et glynn se charge du reste ; c'est-à-dire mettre à jour la génération statique, et la téléverser*.
