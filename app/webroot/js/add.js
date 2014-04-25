$(function() {

  var tempoAddTipo = 300;

  $("#show-form-tipo-despesa").click(function(event) {
    event.preventDefault();
    if($(".add-tipo-receita").css('display') != 'none') {
      $("#show-form-tipo-receita").removeClass('is-active');
      $(".add-tipo-receita").toggle(tempoAddTipo);
    }
    var $link = $("#show-form-tipo-despesa");

    if ($link.hasClass('is-active')) {
      $link.removeClass('is-active');
    }else{
      $link.addClass('is-active')
    }

    $(".add-tipo-despesa").toggle(tempoAddTipo);
  });
  $("#show-form-tipo-receita").click(function(event) {
    event.preventDefault();
    if($(".add-tipo-despesa").css('display') != 'none') {

      $("#show-form-tipo-despesa").removeClass('is-active');
      $(".add-tipo-despesa").toggle(tempoAddTipo);
    }

    var $link = $("#show-form-tipo-receita");

    if ($link.hasClass('is-active')) {
      $link.removeClass('is-active');
    }else{
      $link.addClass('is-active')
    }

    $(".add-tipo-receita").toggle(tempoAddTipo);
  });

});