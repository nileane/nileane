---
layout: post
published: true
comments: true
title: Schmusic, résultat d'une petite heure d'ennui.
tags: ! '["php", "mpd", "icecast", "stream"]'
---
![music.schoewilliam.fr](/images/mpd/music.schoewilliam.png){: class="align right" style="border-radius:3px;"}

Je m'ennuyais, tout à fait. Alors je me suis dit que je devrais peut-être faire une jolie petite page statique pour mon stream *MPD* — dont je parle dans mon [billet d'hier](/2013/08/01/premières-joies-de-l-autohébergement.html).

[Le résultat](http://music.schoewilliam.fr){: target="_blank"} correspond à ce que j'avais imaginé, et dispose même d'une fonctionnalité supplémentaire à mon idée de base : l'affichage de l'artiste et du titre de la piste en cours de diffusion.

---

L'ensemble est plutôt simple. Il s'agit dans un premier temps, d'installer un serveur **icecast** en parallèle à l'instance **MPD**, et de configurer ce dernier pour émettre dans un stream icecast. `.mpdconf` :

	audio_output {
	    type            "shout"
	    encoding        "ogg"
	    name            "Now listening to..."
	    host            "localhost"
	    port            "8000"
	    mount           "/mpd.ogg"
	    password        "thispasswordcannotbehackedohyeah"
	    quality         "3.0"
	    format          "44100:16:2"
	    description     "My playlist of the day. Normal quality (3) OGG/Vorbis stream."
	}

Ainsi, après avoir lancé Icecast **puis** mpd, notre stream sera accessible à l'adresse [http://localhost:8000/mpd.ogg](http://localhost:8000/mpd.ogg).

---

## Les contrôles.

En ce qui concerne maintenant notre jolie page web, on utilisera la balise `<audio>` :

    <audio id="stream" preload="none">
    	<source type="audio/ogg" src="http://music.schoewilliam.fr:8000/mpd.ogg"></source>
    	<p>It looks like your browser cannot play this stream. You can instead play <a href="http://music.schoewilliam.fr:8000/mpd.ogg">http://music.schoewilliam.fr:8000/mpd.ogg</a> in a media player (such as VLC or MPlayer).</p>
    </audio>

Quant aux contrôles de lecture, s'agissant d'un stream, j'ai choisi de me contenter des boutons de volume, ainsi que d'un bouton central Play/Pause :

    <div id="controls">
    	<a href="#" onclick="document.getElementById('stream').volume-=0.2">Baisser le volume</a>
    	<a href="#" id="playbut">Play</a>
    	<a href="#" onclick="document.getElementById('stream').volume+=0.2">Augmenter le volume</a>
    </div>

Nous n'avons maintenant plus qu'à rendre le bouton Play/Pause fonctionnel, comme suit :

	<script type="text/javascript">
	var player = document.getElementById('stream'),
	    ctrl = document.getElementById('playbut');

	ctrl.onclick = function () {

	    // Update the Button
	    var pause = ctrl.innerHTML === 'Pause';
	    ctrl.innerHTML = pause ? 'Play' : 'Pause';

	    // Update the Audio
	    var method = pause ? 'pause' : 'play';
	    player[method]();

	    // Prevent Default Action
	    return false;
	};
	</script>

---

## Afficher le titre en cours.

Maintenant que nous avons un joli lecteur, on va l'agrémenter d'un petit plus fort pratique et agréable : l'affichage du titre (et de l'artiste) de la chanson en cours de diffusion sur le stream.  
J'ai pour cela récupéré [un script php](https://github.com/Schoewilliam/music.schoewilliam/blob/master/nowplaying.php) trouvé sur les internœuds, que j'ai personnellement appelé `nowplaying.php`.  
En bref, son rôle sera de parser la page [http://localhost:8000/status.xsl](http://localhost:8000/status.xsl) afin de récupérer les infos du stream.  

Si l'on jette un œil aux dernières lignes du script, que j'ai ajoutées —

	$current = ($radio_info['now_playing']['artist'] . ' · ' . $radio_info['now_playing']['track']);
	print $current;

— bien que le script permette d'afficher davantage, je ne choisis que d'afficher le nom de l'artiste (`$radio_info['now_playing']['artist']`), ainsi que le titre de la piste (`$radio_info['now_playing']['track']`). (à considérer donc si vous vous en servez.)

Nous voilà alors de retour sur notre jolie page web. On y appelle notre `nowplaying.php` de manière régulière avec du js (*jquery requis*). Et le tour est joué.

	<script type="text/javascript">
		$(document).ready(function() {
		    setInterval(function(){
			   $("#current-track").load("nowplaying.php");
		    }, 10000);
		});
	</script>

	<div>
	  Now playing : <span id="current-track"></span>
	</div>

---

[*And voilà*](http://music.schoewilliam.fr). Il n'y a plus qu'à s'amuser avec le CSS. Par ailleurs, ce concernant, j'ai choisi d'utiliser [Font Awesome](http://fontawesome.io/) pour les jolies petites icônes (Lecture, Volume{-,+}, …), qui rendent je l'admets plutôt bien.

Les sources de tout ceci sont à retrouver sur mon dépôt git [https://github.com/Schoewilliam/music.schoewilliam](https://github.com/Schoewilliam/music.schoewilliam).

Kashyyyk.
