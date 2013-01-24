---
layout: post
title: 'WMFS2 : ma configuration'
tags:
- config
- wmfs
- tiling
status: publish
type: post
published: true
---
WMFS, est un tiling window manager très simple à configurer, au point qu'on n'ait en général qu'à personnaliser le schéma de couleurs. Le plus gros du boulot se situera principalement autour des statusbars. On s'attardera d'ailleurs sur ces dernières dans la seconde partie de ce billet.

## Comportement et couleurs

WMFS tend davantage vers le **twm manuel**. C'est-à-dire que son *layout* (la disposition de son pavage) n'est pas fixe, et s'improvise au cours de l'utilisation. C'est un concept voilà très différent de celui de Awesome WM (par exemple), qui lui propose un certain nombre de disposition fixes.

On ne jouera pas au guide, le **[wiki](https://github.com/xorg62/wmfs/wiki)** s'en charge déjà très bien. En revanche donc, il faudrait savoir que la section `[themes]`…`[/themes]` du fichier principal `~/.config/wmfsrc` permet justement de mettre WMFS à son goût.

Du côté du lexique, **bars** désigne évidemment les barres d'informations, `tags` — ici — les boutons de chaque espace de travail, et enfin `client` désigne une fenêtre.  
Les options se terminant par `_statusline` permettent d'afficher, grâce à [la syntaxe spécifique](https://github.com/xorg62/wmfs/wiki/statusbar_fr){: target="blank"}, du contenu dans la zone souhaitée. C'est ainsi, par exemple, qu'un label « **··· Actif** » apparait sur mes clients qui ont le focus.

* Mon fichier wmfsrc est disponible en entier sur [mon dépôt git](https://github.com/Schoewilliam/configs/blob/master/wmfs/wmfsrc).

## Statusbars
Pour grossir le trait, avec la commande `$ wmfs -c status "testbar BLABLA"`, « BLABLA » apparaitra dans la zone *status* de la barre du nom « *testbar* ». Là où c'est intéressant, c'est qu'on peut donc s'en servir, pour afficher en temps réel, **le résultat d'un script conky** :

{% highlight bash %}
#!/bin/sh  
conky -c ~/.config/wmfs/scripts/conkyrc_top | while true; read line; do wmfs -c status "testbar $line"; done &
{% endhighlight %}

Évidemment l'idéal serait de lancer tout cela au démarrage de la session X.

Puisque conky nous permet de gratter facilement les informations dont on a besoin, grâce à ses fonctions,  il ne nous manque plus qu'à y coupler [la syntaxe](https://github.com/xorg62/wmfs/wiki/statusbar_fr) :

{% highlight bash %}
out_to_console yes
out_to_x no
background yes
update_interval 1
total_run_times 0
no_buffers yes

TEXT
^i[right;0;0;/home/william/.config/wmfs/icons/stat/clock.png] ^s[right;\#BBBBBB; Uptime:] ^s[right;\#BDE077; $uptime_short]\
^s[right;\#444444;   |   ]\
^i[right;0;0;/home/william/.config/wmfs/icons/stat/fs_01.png] ^s[right;\#BBBBBB; HDD:] ^s[right;\#A6D4E0; ${fs_used_perc /}% ] ^p[right;8;10;0;${fs_used_perc /};100;\#445544;\#A6D4E0;ckyhdd](1;spawn;urxvt -e df -h)\
^s[right;\#444444;   |   ]\
^i[right;0;0;/home/william/.config/wmfs/icons/stat/ship.png] ^s[right;\#BBBBBB; Kernel:] ^s[right;\#FDA53C; $kernel]\
^s[right;\#444444;   |   ]\
^i[right;0;0;/home/william/.config/wmfs/icons/stat/netdown.png] ^s[right;\#BBBBBB; IP:] ^s[right;\#E8DD9E; ${addr wlan0}](1;spawn;urxvt -e wicd-curses)\
^s[right;\#444444;   |   ]\
^i[right;0;0;/home/william/.config/wmfs/icons/stat/spkr_01.png] ^s[right;\#BBBBBB; Volume: ] ^s[right;\#A6D4E0;${exec amixer get Master | grep "Mono: P" | awk '{print $4}' | grep -oE "[[:digit:]]{1,}"%} ](1;spawn;urxvt -e alsamixer)  ^p[right;8;10;0;${exec amixer get Master | grep "Mono: P" | awk '{print $4}' | grep -oE "[[:digit:]]{1,}"};100;\#445544;\#A6D4E0;ckyhdd](1;spawn;urxvt -e alsamixer)\
^s[right;\#444444;   |   ]\
^i[right;0;0;/home/william/.config/wmfs/icons/stat/clock.png]\ ^s[right;\#CCCCCC; ${time %a %d %b}] ^s[right;\#A6D4E0; ${time %H:%M}   ]\
{% endhighlight %}

Voilà qui nous donne magnifiquement :
 
[![Status Top](/images/wmfs/wmfs-status1.png){: class="align"}](/images/wmfs/wmfs-status1.png)

C'est exact, puisque grâce à cette mystérieuse syntaxe, au-delà d'afficher des informations ô combien utiles, notre statusbar sera **interactive** aux clics de la souris.

[![MOC intégré à la statusbar de WMFS](/images/wmfs/wmfs-moc.png){: class="align"}](/images/wmfs/wmfs-moc.png)

(Dans le cas d'un script conky :)

{% highlight bash %}
${if_running mocp}\
${if_match "${exec mocp -Q %state}" == "PLAY"}^s[right;\#BDE077;{ ]^i[right;0;0;/home/william/.config/wmfs/icons/stat/pause.png](1;spawn;mocp -G)^s[right;\#BDE077; }]$endif\
${if_match "${exec mocp -Q %state}" == "PAUSE"}^s[right;\#FDA53C;{ ]^i[right;0;0;/home/william/.config/wmfs/icons/stat/play.png](1;spawn;mocp -G)^s[right;\#FDA53C; }]$endif\
${if_match "${exec mocp -Q %state}" == "STOP"}^s[right;\#A6D4E0;{ ]^i[right;0;0;/home/william/.config/wmfs/icons/stat/stop.png](1;spawn;mocp -p)^s[right;\#A6D4E0; }  ]$endif\
$endif\
{% endhighlight %}

**Littéralement**; on vérifie si *mocp* est lancé (**ligne 1**);  
si MOC est en mode PLAY, afficher l'image `~/.config/wmfs/icons/stat/pause.png` — cette même image, lancera la commande `mocp -G` (*toggle play/pause*) si elle est cliquée (**ligne 2**);  
enfin, on réitère pour les actions Pause, et Stop (**lignes 3 et 4**) en changeant les éléments nécessaires.

* La totalité de mes conky sur mon [**dépôt git**](https://github.com/Schoewilliam/configs/tree/master/wmfs/scripts)

On terminera sur la fonctionnalité phare de cette syntaxe : les **graphiques**, et **barres de progression**. On n'a que trois éléments à fournir : les couleurs, la valeur actuelle, et la valeur maximale. Notre cher WMFS se charge du reste.

{% highlight bash %}
^g[left;80;10;${cpu};100;\#333333;\#FDA53C;ckycpu](1;spawn;urxvt -e htop)
{% endhighlight %}

Sur le modèle `^g[{alignement};{largeur};{hauteur};{valeur actuelle};{valeur maximale};{couleur BG};{couleur FG};{ID du graphe}](1;spawn;{commande à lancer au clic})`.

## Capture finale

[![Capture finale](/images/captures/2012-04-14.png){: width="685px" class="align center"}](/images/captures/2012-04-14.png)

Puisqu'il aurait été évidemment un crime abominable, reconnu dans 20 pays occidentaux, de terminer ce petit billet sans même une capture d'écran.
