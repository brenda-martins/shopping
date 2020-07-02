$(function () {
    const qtdItensCarrossel = $('.carrossel1 .item').length;
    var width = (parseInt($('.carrossel1 .item').outerWidth() + parseInt($('.carrossel1 .item').css('margin-right')))) * qtdItensCarrossel;
    $('.carrossel1').css('width', width);

    var numImages = 4;
    var marginPadding = 30;

    var ident = 0;
    var count = (qtdItensCarrossel / numImages) - 1;
    var slide = (numImages * marginPadding) + ($('.carrossel1 .item').outerWidth() * numImages);

    $('#forth').click(function () {
        if (ident < count) {
            ident++;
            $('.carrossel1').animate({ 'margin-left': '-=' + slide + 'px' }, '500');
        }
    });

    $('#back').click(function () {
        if (ident >= 1) {
            ident--
            $('.carrossel1').animate({ 'margin-left': '+=' + slide + 'px' }, '500');
        }
    });

});