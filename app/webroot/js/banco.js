$(function() {

  var tempoAddTipo = 300;

  $("#show-form-banco").click(function(event) {
    event.preventDefault();
    
    var $link = $("#show-form-banco");

    if ($link.hasClass('is-active')) {
      $link.removeClass('is-active');
    }else{
      $link.addClass('is-active')
    }

    $(".add-banco").toggle(tempoAddTipo);
  });

});