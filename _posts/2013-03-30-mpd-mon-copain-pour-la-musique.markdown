---
layout: post
published: true
comments: true
title: "MPD, mon copain pour la musique."
---
Un petit problème se posait à moi il y a quelques jours ( semaines ? ) : mon poste A commençait à être limité quant à son espace disque. *Objectif* donc : transférer ma bibliothèque musicale sur un poste B ( soient l'équivalent de quelques 14Go ). *Souci* : pouvoir continuer d'écouter le contenu de cette bibliothèque depuis le poste A.  
**Solution** : utiliser la fonctionnalité implémentée par essence dans MPD ( Music Player Daemon ), qui permet le streaming de la musique.

[![NCMPC++ personnel](/images/mpd/ncmpcpp.png){: class="align center"}](/images/mpd/ncmpcpp.png)

À quoi ressemblerait donc mon installation ?
* Une instance MPD configurée sur le poste B pour émettre sa lecture dans un flux sur `http://192.168.2.x:8000` ( voir [cette section du Archwiki](https://wiki.archlinux.org/index.php/MPD/Tips_and_Tricks#HTTP_Streaming), décommenter quelques lignes suffit. )
* Une instance MPD sur le poste A pour lire ledit flux ( j'aurais pu utiliser n'importe quel lecteur audio qui puisse lire un flux HTTP ).
* Un client pour MPD ( ncmpc++ dans mon cas ) sur le poste A, qui sera connecté à l'instance MPD du poste B. ( `$ ncmpcpp -h 192.168.2.x -p 6600` )

En définitif, je suis en mesure de contrôler ma bibliothèque, ainsi que de l'écouter, depuis mon poste A favori sans avoir à manipuler le poste B, sur lequel est stockée cette bibliothèque.  
Rien d'exceptionnel, rien de complexe. Juste une astuce qui provoque un agréable coup de cœur.
