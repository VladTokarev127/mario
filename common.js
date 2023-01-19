$(document).ready(function(){ 
	$('.nav-toggler').click(function() {
		$('.collapse').slideToggle();
	});

	$(window).resize(function () {
		if ($(window).width()>991) {
			$('.collapse').removeAttr('style');
		}
	});
    
    
    $('#game').focus( function() {
        $('.js-pausemario').show();
        $('.js-unpausemario').hide();
        
        if( $('.js-startmario').is(':visible') ) {
            $('.js-startmario').hide();
            $('.js-stopmario').show();
            $('.js-starttourney').hide();
        
        } else if( $('.js-starttourney').is(':visible') ) {
            $('.js-starttourney').hide();
            $('.js-stoptourney').show();
        
        }
        
    }); 


    $(window).focus( function() {
        $('.js-pausemario').hide(); 
        
        if( !$('.js-startmario').is(':visible') ) {
            $('.js-unpausemario').show();
        }
    });
    
    $('.js-startmario').click(function() {  $('.js-starttourney').hide(); $('#game').focus(); })
    $('.js-starttourney').click(function() {  $('.js-startmario').hide(); $('#game').focus(); })
    
    $('.js-stopmario').click(function() { 
        // $('#game').attr('src',$('#game').attr('src') ); 
        $('.js-stopmario, .js-unpausemario').hide(); 
        $('.js-startmario, .js-starttourney').show(); 
    });    
    
    $('.js-stoptourney').click(function() { 
        $('#game').attr('src',$('#game').attr('src') ); 
        $('.js-stopmario, .js-stoptourney, .js-unpausemario').hide(); 
        $('.js-startmario, .js-starttourney').show(); 
    });
    
    
    $('.js-unpausemario').click(function() {  $('#game').focus();})
    $('.js-pausemario').click(function() {  $(window).focus(); })
    
    
    $('#game').load(function(){
        $(this).contents().find("body").on('click', function(event) {  $('#game').focus(); });
    });
});

