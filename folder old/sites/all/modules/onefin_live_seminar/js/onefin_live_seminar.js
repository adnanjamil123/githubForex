$(document).ready(function (){
    $('body').on('focus','.date-clear',function(){
        $(this).datepicker({dateFormat: 'd M yy'});
    });

    $('.menu-mlid-1950 > a').attr('href','#');
    $('.menu-mlid-1950').find('ul.menu').hide();
    $('.menu-mlid-1950').click(function(e){
       e.preventDefault();
       $(this).find('ul.menu').stop().slideToggle();
    });
});