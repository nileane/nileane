// Reading time - jQuery script that rounds it to the nearest whole number

$(document).ready(function() {
    $(".reading-time").text(function (index, value) {
      return Math.round(parseFloat(value));
    });
});
