---
layout: post
published: true
comments: true
title: "Quant aux open web apps, bilan d'expérience."
---
> « *Open web apps are essentially no different to standard websites or web apps. They are built using standard open web technologies (…) and can be accessed using a web browser. The main differences lie in their ability to be installed on devices and work offline, access to advanced APIs that allow interaction with device features such as camera, gyroscope and address book, (…). Generally, they provide users with an "app experience", while still being based on open, cross platform technologies.* »  
— [Mozilla Developer Network, Quickstart](https://developer.mozilla.org/en-US/Apps/Quickstart)

Il s'agit de faire du [web *la* plateforme](https://blog.mozilla.org/webdev/2012/09/14/apps-the-web-is-the-platform/). Je suis à mon habitude curieux et fort enthousiaste, alors j'ai essayé.


### Schoses, expérience d'un web tout à fait fonctionnel hors-ligne.

Avec [Schoses](http://schoses.schoewilliam.fr), petite application pour créer des listes plus ou moins sensées, j'ai touché au potentiel de petits moyens du web, tels que l'[*appcache*](https://developer.mozilla.org/en/docs/HTML/Using_the_application_cache), ou [*localstorage*](https://developer.mozilla.org/en-US/docs/Web/Guide/API/DOM/Storage#localStorage). Grâce à eux, bien qu'hébergé sur un serveur distant, Schoses fonctionne entièrement hors-ligne, se met à jour de manière absolument silencieuse aussitôt une connexion disponible, et stocke ses données du côté client.  
Au-delà de cet aspect, c'était encore une fois une belle occasion de s'essayer à la création d'interfaces agréables et fluides (ce qui implique alors les transitions et les animations CSS, ou encore des notions improvisées d'ergonomie).

[![Schoses running on a Geeksphone Peak](/images/openwebapps/schoses.png){: class="align inline" style="max-width:32.3%;"}](/images/openwebapps/schoses.png)
[![Schoses running on a Geeksphone Peak](/images/openwebapps/schoses2.png){: class="align inline" style="max-width:32.3%;"}](/images/openwebapps/schoses2.png)
[![Schoses running on a Geeksphone Peak](/images/openwebapps/schoses3.png){: class="align inline" style="max-width:32.3%;"}](/images/openwebapps/schoses3.png)

### Schmusic, expérience du web multimédia.

[![Schmusic running on a Geeksphone Keon](/images/openwebapps/schmusic.png){: class="align right" style="max-width:35%;"}](/images/openwebapps/schmusic.png)

[Schmusic](http://music.schoewilliam.fr) répond à une problématique simple : comment écouter ma musique de n'importe où ? Quand on admet que *le web est la plateforme*, la solution est évidente.  
Je passe le [fontionnement de la chose](/2013/08/02/music-schoewilliam-fr-résultat-dune-heure-d-ennui.html), mais grâce à une simple page web ([music.schoewilliam.fr](http://music.schoewilliam.fr/)), et [un manifest](https://github.com/Schoewilliam/music.schoewilliam/blob/master/manifest.webapp), je dispose de la meilleure expérience pour écouter ma musique depuis mon téléphone, n'importe quel appareil exécutant les open web apps, ou tout simplement tout navigateur web.  
On aborde alors un aspect important du principe : l'universalité du web. Comme il existe des navigateurs web pour toutes les plateformes, chaque open web app n'a à être développée qu'une fois pour être disponible au plus grand nombre.

### Shyhome, expérience du potentiel du web.

Shyhome est un écran d'accueil pour Firefox OS. Un écran d'accueil. Je suis peut-être toujours trop enthousiaste, mais me dire qu'il s'agit d'un écran d'accueil entièrement réalisé avec les technologies du web me fait trouver cela génial. Ces technologies ne se limitent plus à de simples pages, ou de simples applications tournant dans le navigateur.  
L'initiative *open web apps* fait du web une plateforme à un potentiel nouveau. Et l'interface [Gaia](https://github.com/mozilla-b2g/gaia), devéloppée pour Firefox OS m'impressionne pour ces raisons.

[![Shyhome, un écran d'accueil minimaliste pour Firefox OS](/images/openwebapps/shyhome.png){: class="align inline" style="max-width:32.3%;"}](/images/openwebapps/shyhome.png)
[![Shyhome, un écran d'accueil minimaliste pour Firefox OS](/images/openwebapps/shyhome2.png){: class="align inline" style="max-width:32.3%;"}](/images/openwebapps/shyhome2.png)
[![Shyhome, un écran d'accueil minimaliste pour Firefox OS](/images/openwebapps/shyhome3.png){: class="align inline" style="max-width:32.3%;"}](/images/openwebapps/shyhome3.png)

### Alors le web, c'est magique ?

Presque ! Je me laisse à rêver qu'il s'agit là du véritable espoir d'une plateforme vaste, sans limites, et surtout **ouverte**. Après avoir rejoint les *App Reviewers* du [Firefox Marketplace](https://marketplace.firefox.com/), je croise et teste chaque jour toujours davantage d'applications, aussi variées qu'innovantes, chacune voyant un succès croissant.  
Mon bilan d'expérience ne peut être plus enthousiaste.
