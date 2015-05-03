/*!
 * This helps change the appearance of the home button upon scroll inside the side screens.
 */

$(function(){
  $("#body>section").scroll(function()
  {
    $("#homebutton").removeClass("topped").addClass("scrolled");
    var divTop = $('#homebutton').height();
    if($(this).scrollTop()<=divTop) {
        $("#homebutton").removeClass("scrolled").addClass("topped");
    }
  });
});
