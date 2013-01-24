---
layout: post
published: true
title: "Monsterwm : configuration et joyeusetés"
tags:
- config
- monsterwm
- tiling
---
Comme j'ai tendance à adorer le renouveau, je me suis mis en tête de tester autre chose que [WMFS](http://localhost:4000/2012/04/14/wmfs-exposition-de-ma-configuration.html), que je n'avais pas quitté depuis mon arrivée sur Archlinux. Un Tiling Window Manager, c'est certain.
**monsterwm** se présente comme « Tiny and monstrous ! ». Il n'a qu'un seul but : s'occuper de nos fenêtres. C'est ainsi qu'il n'inclut aucune barre d'emblée, et s'avère particulièrement léger.

Deux choix se présentent alors à nous : gardons cet aspect minimaliste de monsterwm (sans quelconque barre supérieure ou inférieure), ou justement lui en enrichir. J'ai choisi cette seconde option dans un simple soucis de confort d'utilisation. En effet, j'ai vite ressenti le besoin de pouvoir me situer visuellement parmi mes bureaux virtuels.

Concernant la configuration initale de monsterwm, je vous redirigerai volontiers vers mon [fichier de configuration personnel](https://github.com/Schoewilliam/configs/blob/master/monsterwm/config.h){: target="blank"}.

## Objectif ?
Afficher dans une sobre barre — ici `dzen2` — les bureaux disponibles, leur état (inoccupé/occupé et/ou actif), ainsi que l'agencement actuellement utilisé.

[![capture du coin supérieur droit de mon écran](/images/monster/dzen2.png){: class="align"}](/images/monster/dzen2.png)

À noter avant de continuer, que monsterwm fait du **tiling automatique** (à la manière de DWM, ou Awesome). C'est-à-dire qu'il propose plusieurs « layouts » (qu'on appellera *agencements* par soucis de chauvinisme inexpliqué) : 
- le « Common Tiling mode » ; une fenêtre maîtresse est positionnée à gauche, tandis que les autres sont empilées à droite.
- la Grille ; les fenêtres sont toutes dimensionnées et disposées de manière égale.
- le « Bottom Stack tiling mode » ; idem que le premier sus-cité, la fenêtre maîtresse se trouvant en haut.
- le plein écran ; que j'affectionne particulièrement ; chaque fenêtre occupe la totalité de l'écran.
- le *Floating Mode* ; pour se débarasser de l'agencement automatique.

## Exécution personnalisée
Afin de parvenir à notre objectif, il va falloir créer un fichier qui contiendra une boucle — dont j'ignore, pour être honnête, tous les détails — exécutée au préalable du gestionnaire de fenêtre. Cela nous permettant de récolter les données nécessaires pour l'affichage de l'état de nos bureaux.

Pour cela, au lieu de lancer "`monsterwm`" dans notre `.xinitrc` (ou autre moyen d'exécution de votre sessiong xorg), on exécutera ce fichier, que je nommerai personnellement `runmonster.exec` et qui aura pour contenu :

{% highlight bash %}
#!/usr/bin/env bash

# First define colors
norm_fg="#909090"
norm_bg="#1a1a1a"
sel_fg="#ffffff"
sel_bg="#3a3a3a" 
err_fg="#ffffff"
err_bg="#f2777a"

: "${wm:="monsterwm"}"
: "${ff:="/tmp/monsterwm.fifo"}"

[[ -p $ff ]] || mkfifo -m 600 "$ff"

while read -t 2 -r wmout || true; do
    # filter output to only what we want to match and parse
    if [[ $wmout =~ ^(([[:digit:]]+:)+[[:digit:]]+ ?)+.*$ ]]; then
        read -ra desktops <<< "$wmout" && unset r
            for desktop in "${desktops[@]}"; do
                # set values for
                # d - the desktop id
                # w - number of windows in that desktop
                # m - tiling layout/mode for that desktop
                # c - whether that desktop is the current (1) or not (0)
                # u - whether a window in that desktop has an urgent hint set (1) or not (0)
                IFS=':' read -r d w m c u <<< "$desktop"
                # Set the icon for desktops with windows
                ic=" "
                ((w)) && ic=" *"
                # name each desktop
                      case $d in
                        0) d="u " ;;
                        1) d="d " ;;
                        2) d="t " ;;
                        3) d="q " ;;
                        4) d="c " ;;
                        5) d="sx " ;;
                        6) d="sp " ;;
                      esac
                # we will also display the current desktop's tiling layout/mode
                      ((c)) && fg="$sel_fg" bg="$sel_bg" && case $m in
                          # name each layout/mode with a symbol
                          0) i=" [T]" ;;
                          1) i=" [$w]" ;;
                          2) i=" [b]" ;;
                          3) i=" [G]" ;;
                          4) i=" [F]" ;;
                      esac || fg="$norm_fg" bg="$norm_bg"
                      # if the desktop has an urgent hint its color should be err_fg/err_bg
                      ((u)) && fg="$err_fg" bg="$err_bg"
                      # print the desktop name
                      r+="^bg($norm_bg)^bg($bg)^fg($fg)$ic$d^fg($norm_fg)^bg($norm_bg)"
            done
    fi        
    printf "%s%s\n" "$r" "$i"
done < "$ff" | dzen2 -fg "#cccccc" -bg "#1a1a1a" -h 20 -fn "-*-envypn-medium-*-*--13-*-*-*-*-*-*-*" -ta l -w 300 -e "button2=stick" &
    
while :; do "$wm" || break; done | tee -a "$ff"
{% endhighlight %}

Ce fichier permet au passage d'attribuer un nom, un symbole, ou autre, à chacun de ces bureaux, et des pavages, en plus des choix de couleurs pour dzen2.

Mon `.xinitrc` aura donc l'apparence suivante :
{% highlight bash %}
# […]
setxkbmap -layout fr -variant bepo &
xsetroot -cursor_name "arrow" &
numlockx on &

runmonster.exec
{% endhighlight %}

## *voilà*

<a href="http://schoewilliam.deviantart.com/art/MonsterWM-January-2013-archlinux-346452273" target="_blank"><img src="/images/apropos/2013-01mini.png" class="align right"></a>

Si tout se déroule correctement, au prochain `$ startx`, une barre — dzen2 — se logera à la position et selon l'apparence définies, et vous permettra de vous situer **visuellement** parmi vos fenêtres, et vos bureaux virtuels.

Pour en savoir davantage, rendez-vous sur [le sujet dédié sur les forums d'Archlinux.org](https://bbs.archlinux.org/viewtopic.php?id=132122). C'est bien entendu à cet endroit que j'ai pu trouver bien des astuces, parmi lesquelles l'objet de ce billet.
