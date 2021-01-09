
'use strict';

/*
 * Basic toggle for dark and light themes
 */

// Document references
let btn = document.getElementById('twilight');
let query = window.matchMedia('(prefers-color-scheme: dark)');
let classList = document.documentElement.classList;

// Select the desired theme
let isDark = query.matches;
let storedTheme = localStorage.getItem('theme');
if (storedTheme !== null) {
  isDark = (storedTheme === 'dark');
}
classList.toggle('dark', isDark);
btn.innerText = isDark ? '🌙' : '☀️';

// Change the theme and optionally store it
let toggle = function (dark, store) {
  isDark = dark;
  classList.toggle('dark', isDark);
  btn.innerText = isDark ? '🌙' : '☀️';

  if (store) {
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  } else {
    localStorage.removeItem('theme');
  }
};

// Event listeners
query.addListener(e => toggle(e.matches, false));
btn.addEventListener('click', e => toggle(!isDark, true));
