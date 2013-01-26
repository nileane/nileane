---
layout: post
published: true
title: Expérience avec Jekyll
tags:
- jekyll
- carnet
---
On a, il y a quelques jours, métamorphosé cet espace sur le web.  
Le principal motivateur de cette migration se trouve au cœur même du blog, ainsi que ma manière de le gérer.

[![Dr. Jekyll and Mr. Hyde](/images/drjekyllmrhyde.jpg){: class="align right" width="350px"}](http://en.wikipedia.org/wiki/File:Dr_Jekyll_and_Mr_Hyde_poster_edit2.jpg)

À raison d'un rythme de publication léger, et d'un classement linéaire (chronologique), la véritable machine qu'est Wordpress finit par logiquement paraitre surdimensionnée. J'ai donc opté pour le fameux **[Jekyll](https://github.com/mojombo/jekyll), générateur de blog statique, en ruby** !

## Avantages, tout ça.
Pour en expliquer le contexte ; les fichiers source sont en local, de là Jekyll génère un site **statique**, qu'il ne reste plus qu'à mettre à disposition sur le serveur (dans mon cas, à téléverser via FTP \*¹). Et qui dit statique, dit très léger, et très rapide à charger.  
Enfin, **comble des avantages : pouvoir rédiger ses articles en markdown, avec vim.**

**\*¹** *J'utilise par ailleurs pour ce téléversement via FTP, l'outil __glynn__. Son fonctionnement est simple : on exécute la commande `glynn` à la racine de notre source, entre les identifiants FTP, et glynn se charge du reste ; c'est-à-dire mettre à jour la génération statique, et la téléverser*.

Puisque statique, un tel blog ne peut intégrer de commentaires, si ce n'est en javascript. J'ai rapidement testé [Talkatv](http://talka.tv){: target="\_blank"}, maaaaais… non. Un peu radotant, et nécessite aux lecteures d'avoir à s'incrire sur l'instance. Ce sera donc, sous le conseil d'[Olivier](https://olivier.dossmann.net/) — que je salue — [**JSkomment**](http://code.google.com/p/jskomment/). Il se trouve être très efficace et simple, et juste parfait pour mon utilisation.

## Cela reste joli
Du moins, je l'espère. Question apparence, on m'a répondu « *Eh bien, tu n'as pas peur du minimalisme !* ». Voilà qui résume magnifiquement.  

[![capture d'écran Juin 2012](/images/captures/blog-solarized-mini.png){: class="align center"}](/images/captures/blog-solarized.png)

En bonus enfin, ci-dessus, la capture d'écran de l'un de mes premiers essais de Jekyll, datant de Juin 2012… Gare aux yeux, [ça pique](http://ethanschoonover.com/solarized){: target="blank"}.

Aussi, comme à mon habitude, tout est très loin d'être réservé. Les fichiers source de mon carnet sont à retrouver sur [**Github**](https://github.com/Schoewilliam/schoewilliam.legtux.org){: target="\_blank"}, y compris styles, structures, sources de mes billets (en markdown), et j'en passe. Libre aux langoustes de s'en inspirer !
