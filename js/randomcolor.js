var allcolors = ['turquoise', 'vert', 'bleu', 'violet', 'jaune', 'orange', 'rouge'];
var colorpicked = allcolors[Math.floor(Math.random() * allcolors.length)];

var i,
    allLinks = document.getElementsByTagName("a"),
    total = allLinks.length;
for (i = 0; i < total; i++) {
    allLinks[i].className = colorpicked;
}
