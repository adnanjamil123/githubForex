$(document).ready(function() {
    var $ = jQuery;
    if($('body').hasClass('front')) {

        var setpopupcookie = $.cookie('marketing_popup');
        if(setpopupcookie==undefined) {
            var popup = '<div class="popUpMarketing"><div class="outer"><div class="inner">' +
                '<div class="warning">' +
                '<div class="row"><div class="btn-container col-md-12"><span class="close pointy" aria-hidden="true"></span></div>' +
                '<div class="col-md-12 popup-logo"><img src="https://www.onefinancialmarkets.com/themes/oneresponsivev2/assets/images/logo-ofm-10yrs-v1.png"> </div>' +
                '<div class="col-md-5 popup-devices"><img src="https://cdn-resources.onefinancialmarkets.com/sites/default/files/popupdevices-half.png"></div>' +
                '<div class="col-md-6"><div class="popup-text"><p class="lead">Develop your trading skills in a risk free environment, practise currency trading online and test your strategies in a real market conditions with no risk.</p><p class="lead">Trade risk free with $10,000 of virtual funds.</p>' +
                '<p><a href="/demo-account?lang=en?utm_source=website&utm_medium=banner&utm_campaign=demo_button" class="btn btn-demo">Open a Demo Account &#9658;</a></p><p class="lead"><strong>78% of retail investor accounts lose money when trading CFDs with this provider.</strong> You should consider whether you can afford to take the high risk of losing your money.</p></div></div>' +
                '</div></div></div></div></div>';

            if($(window).width() > 768) {

                $('body').delay(60000).queue(function (next){
                    $(this).append(popup);
                    $('#page-content').addClass('blur');
                    $('.popUpMarketing').show();
                    $('.popUpMarketing .warning').show(300,"swing");
                    $('button.close').click(function(e){
                        $('.popUpMarketing').hide();
                        $('#page-content').removeClass('blur');
                    });
                    $('.popUpMarketing .inner').click(function (e) {
                        $('.popUpMarketing').hide();
                        $('#page-content').removeClass('blur');
                    });
                    next();
                });
                $.cookie('marketing_popup', "true", { expires: 2, path: '/' });
            }
        }
    }
}
); 