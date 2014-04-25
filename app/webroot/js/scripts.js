$(function() {


  $('.fecha').click(function(event) {
    $(this).parent().fadeOut(300);
  });

  var swi = true;

  $('.modo-edicao').click(function(event) {
    if (swi) {
      runGaleria();
      $('.switch-edit').css('background-position', '40px 0');
      swi = false;
    } else {
      stopGaleria();
      $('.switch-edit').css('background-position', '0 0');
      swi = true;
    }
  });

  // var max = -10
  // $('.card').each(function(index, el) {
  //   console.log($(this).height());
  //   max = Math.max($(this).height(), max);
  // });
  // $('.card').css('height', max);


  //validando os selects do formulario
  var selectReceita = $('#select-form-receita:first');
  console.log(selectReceita.validationMessage);
  console.log(selectReceita.validity);


});


  /*GALERIA DE CARDS*/

function stopGaleria(){

  $(".bloco-cards div").each(function() {
    var clone = $(this).clone();
    var fecha = clone.find('a');
    if(fecha.hasClass('fechacard')) {
      fecha.remove();
    }
    clone.css('cursor', 'auto');
    $(".static-cards").append(clone);
    $(this).remove();
  });

  $(".bloco-clone-cards div").each(function() {
    $(this).remove();
  });
}

function runGaleria(){
  $(".static-cards div").each(function() {
    var clone = $(this).clone();
    clone.append("<a href=\"javascript:void(0);\" class=\"fechacard\">x</a>");
    clone.css('cursor', 'move');
    $(".bloco-cards").append(clone);
    $(this).remove();
  });

  //EXCLUSÃO
  $('.fechacard').click(function(event) {
    var card = $(this).parent();
    var classe = card.attr('class').split(' ').join('.');
    var clone = $(".bloco-clone-cards ." + classe);
    var position = card.position();

    clone.css({
      "left": position.left,
      "top": position.top
    });

    clone.show();

    $(".bloco-clone-cards div").each(function() {
      var classeB = $(this).attr('class').split(' ').join('.');
      var cardB = $(".bloco-cards ." + classeB);
      
      var positionB = cardB.position();

      $(this).css({
        "left": positionB.left,
        "top": positionB.top,
        "display": "block"
      });
      $(this).show();
    });

    $(".bloco-cards div").each(function(index, el) {
      $(this).css('opacity', '0.001');
    });

    clone.animate({'opacity': '0.001'}, 600);

    var classeCard = card.attr('class').split(' ').join('.');
    card.remove();


    setTimeout(function(){

      $(".bloco-clone-cards div").each(function() {
        var classeC = $(this).attr('class').split(' ').join('.');
        if(classeCard == classeC)
            return;
        var cardC = $(".bloco-cards ." + classeC);
        
        console.log('classe', classeC);
        console.log('card', cardC);

        var positionC = cardC.position();

        console.log('position', positionC);

        $(this).animate({
            left: positionC.left,
            top: positionC.top}, 500);

      });
      clone.remove();
      setTimeout(function(){
        $(".bloco-cards div").each(function() {
          $(this).css('opacity', '1');
        });
        $(".bloco-clone-cards div").each(function() {
          $(this).hide();
        });
      }, 501);

    }, 601);
  });

  // ORDENAÇÃO
  $(".bloco-cards div").each(function(){

      var item = $(this);
      var item_clone = item.clone();
      item.data("clone", item_clone);

      var position = item.position();

      item_clone.css({
        "left": position.left,
        "top": position.top
      });

      $(".bloco-clone-cards").append(item_clone);
      item_clone.css({
        'width': item.width()+2,
        'height': item.height()+2,
        'display': 'none',
        'position': 'absolute',
        'z-index': 1
      });

  });

  $(".bloco-cards").sortable({
      revert:true,

      start: function(e, ui){
        console.log('start');

        $(".bloco-clone-cards div").each(function(){
          var classe = $(this).attr('class').split(' ').join('.');

          var card = $(".bloco-cards ." + classe);

          var position = card.position();

          $(this).css({
            "left": position.left,
            "top": position.top,
            'width': card.width()+2,
            'height': card.height()+2,
            'display': 'none'
          });
        });

        ui.helper.addClass("exclude-me");
        $(".bloco-cards div:not(.exclude-me)")
            .css("visibility", "hidden");

        $(".bloco-clone-cards div").css('display', 'block');

        ui.helper.data("clone").hide();
      },

      stop: function(e, ui){
        console.log('stop');

        $(".bloco-cards div.exclude-me").each(function(){
            var item = $(this);
            var clone = item.data("clone");
            var position = item.position();

            // console.log(position);
            clone.css("left", position.left);
            clone.css("top", position.top);
            clone.show();

            item.removeClass("exclude-me");
        });

        $(".bloco-cards div").css("visibility", "visible");
        $(".bloco-clone-cards div").css('display', 'none');
      },

      change: function(e, ui){
        console.log('change');
        $(".bloco-cards div:not(.exclude-me, .ui-sortable-placeholder)").each(function(){
            var item = $(this);
            var clone = item.data("clone");

            clone.stop(true, false);

            var position = item.position();
            clone.animate({
                left: position.left,
                top:position.top}, 500);
        });
      }
  });
}