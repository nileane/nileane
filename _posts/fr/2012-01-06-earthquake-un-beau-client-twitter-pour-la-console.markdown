---
layout: post
title: Earthquake, un client Twitter pour le terminal.
published: true
---
Dans la série applications coups de cœur, il y a <a href="https://github.com/jugyo/earthquake" title="Le Github de Earthquake" target="_blank">Earthquake <em>(le github pour tout savoir sur son mode d'emploi)</em></a>. Écrit en ruby, ce client Twitter pour le terminal, a tout pour plaire : élégance, fonctionnalités, et fabuleusement pratique.
J'en avais déjà testé un certain nombre (Tyrs, pour n'en citer qu'un), mais aucun ne proposait une telle fiabilité, et surtout, une mise à jour <strong>automatique</strong> de la timeline. Et comme si tout cela ne suffisait pas, Earthquake est extensible grâce à des <a href="https://github.com/jugyo/earthquake/wiki" target="_blank">plugins</a>.

[![Flux Earthquake](/images/earthquake.png){: class="align"}](/images/earthquake.png)

L'installation est simple comme deux lignes de commandes;

**On télécharge la source**

	$ git clone git://github.com/jugyo/earthquake.git

**Vérifions les dépendances**  
Il nous faudra ici les paquets `openssl` et `readline`.

**Et enfin**, on installe. :D
 
	$ gem install earthquake
	$ ./earthquake/bin/earthquake
