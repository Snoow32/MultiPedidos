// Barra das categorias.

var buttons = document.getElementsByClassName('category-button');
var headerHeight = document.getElementById('bk').offsetHeight;

for (var i = 0; i < buttons.length; i++) {
buttons[i].addEventListener('click', function() {
    for (var j = 0; j < buttons.length; j++) {
    buttons[j].classList.remove('btn-red');
    buttons[j].style.borderBottom = 'none';
    }

    this.classList.add('btn-red');
    this.style.borderBottom = '2px solid red';

    var categoryId = this.getAttribute('data-category-id');
    var categoryElement = document.getElementById('category-' + categoryId);
    if (categoryElement) {
    var categoryPosition = categoryElement.offsetTop - headerHeight;
    window.scrollTo({
        top: categoryPosition,
        behavior: 'smooth'
    });
    }
});
}

$(document).ready(function() {
    var headerHeight = $('.headerb').outerHeight();
    var barraCardapio = $('#barra-cardapio');
    var barraOffset = barraCardapio.offset().top;

    $(window).scroll(function() {
      var scrollTop = $(window).scrollTop();

      if (scrollTop >= barraOffset - headerHeight) {
        barraCardapio.addClass('descer').css('margin-top', headerHeight);
      } else {
        barraCardapio.removeClass('descer').css('margin-top', 0);
      }
    });
  });