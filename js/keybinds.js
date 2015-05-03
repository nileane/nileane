/* Keybinds.js handles the Arrow Keys to navigate throughout the homepage screens
— William Dorffer */

Element.prototype.hasClass = function(className) {
    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
};

document.onkeydown = function(e) {
    e = e || window.event;
    switch(e.which || e.keyCode) {
        case 37: // left
              if (window.location.hash == '#rig') { // Press Left to go back to Homescreen from Right-hand screen
                  location = '#hom';
              } else if (window.location.hash == '#hom' || window.location.hash == '') { // Press Left to go to Left-hand screen
                  location = '#lef'
              }
        break;

        case 38: // up
            if (window.location.hash == '#bot') { // Press Up to go back to Homescreen from Bottom-hand screen
                location = '#hom';
            }
        break;

        case 39: // right
            if (window.location.hash == '#lef') { // Press Right to go back to Homescreen from Left-hand screen
                location = '#hom';
            } else if (window.location.hash == '#hom' || window.location.hash == '') {
                location = '#rig'; // Press Right to go to Right-hand screen
            }
        break;

        case 40: // down
            if (window.location.hash == '#hom' || window.location.hash == '') { // Press Down to go to Bottom Pane
                location = '#bot'
            }
        break;

        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
};
