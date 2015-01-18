var allcolors = ['turquoise', 'vert', 'bleu', 'violet', 'jaune', 'orange', 'rouge'];
var colorpicked = allcolors[Math.floor(Math.random() * allcolors.length)];

var i,
    allLinks = document.getElementsByTagName("a"),
    total = allLinks.length;
for (i = 0; i < total; i++) {
    allLinks[i].classList.add(colorpicked);
}

var schcripts = ['/images/logos/schcript1.png', '/images/logos/schcript2.png', '/images/logos/schcript3.png', '/images/logos/schcript4.png', '/images/logos/schcript5.png'];
var pickedschcript = schcripts[Math.floor(Math.random() * schcripts.length)];

var schcript = document.createElement("img");
schcript.src = pickedschcript;
schcript.alt = "Schoewilliam";
document.getElementById("schtitle").appendChild(schcript);

