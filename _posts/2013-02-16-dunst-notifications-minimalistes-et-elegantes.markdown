---
layout: post
published: true
comments: true
title: ! 'dunst: notifications minimalistes et élégantes'
tags:
- dunst
- notifications
- config
---
On a découvert **dunst** récemment, qui est un daemon de notifications qui conviendra aux utilisateurs de Tiling Window Managers — en particulier — car d'un aspect magnifiquement simpliste et agréablement léger.  
Et lorsque les couleurs sont bien choisies, obtenir de très jolis résultats devient un véritable délice :3. Petite démonstration ?

[![démonstration de Dunst](/images/dunst/dunst.gif){: class="align center"}](/images/dunst/dunst.gif)

S'il y a plusieurs avantages à retenir je dirais successivement : affichage de **plusieurs notifications simultanément** (tel que sur l'image ci-dessus), **personnalisation poussée** (soit le choix des couleurs en fonction du niveau d'urgence de la notification, le choix de la taille, la position, et autres concernant le comportement), et la possibilité de **définir un délai d'inactivité**.

Concernant ce dernier point, c'est magique. Si défini à 40s dans le fichier de configuration (`dunstrc`), toutes les notifications qui apparaitront après un tel délai d'inactivité (du clavier et de la souris) ne disparaîtront pas. Elles resteront affichées à l'écran, jusqu'à votre retour (soit le délai par défaut d'affichage d'une notification après un nouveau signe d'activité).

Pour ce qui est de son fonctionnement, dunst écoute bien évidemment le fameux `notify-send`. Et l'on est d'ailleurs en mesure, via cette commande, de **choisir à la volée une couleur de fond/de texte**, tout comme une icône symbolique ; comme suit :

	$ notify-send "Personnalisation" "de belles couleurs en perspective" -h string:bgcolor:#3B6B29 -h string:fgcolor:#D9FFCB

qui donnerait…

[![notify-send permet le choix de couleurs à la volée](/images/dunst/notify-colors.png){: class="align center"}](/images/dunst/notify-colors.png)

Mon fichier de configuration `dunstrc` est donc à retrouver [sur Github](https://github.com/Schoewilliam/configs/blob/master/dunst/dunstrc){: target="_blank"}, si vous souhaitez retrouver mes couleurs ou mes choix de positionnement. 

Je vous invite enfin, bien évidemment, à consulter [la documentation](https://github.com/knopwob/dunst) qui n'est pas bien sorcière, je vous l'assure. À noter finalement, pour nos amis Archlinuxien, que son installation ne demandera pas davantage qu'un `pacman -S dunst` ; ou, pour les plus téméraires `yaourt -S dunst-git`.
