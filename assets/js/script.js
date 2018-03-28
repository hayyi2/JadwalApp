$(document).on("click","[side-nav-toggle]",function() {
	if ($('body').hasClass('active-side-nav')) {
		$('body').removeClass('active-side-nav');
	}else{
        $('body').addClass('active-side-nav');
	}
});
$(document).ready(function(){
    var min = false;
    if ($(window).width() < 576) {
        if ($('body').hasClass('active-side-nav')) {
            $('body').removeClass('active-side-nav');
            min = true;
        }
    }
    $(window).resize(function(){
        if ($(window).width() < 576) {
            if ($('body').hasClass('active-side-nav')) {
        		$('body').removeClass('active-side-nav');
                min = true;
        	}
        }else if (min) {
            min = false;
            if (!$('body').hasClass('active-side-nav')){
                $('body').addClass('active-side-nav');
        	}
        }
    });
    $(document).on('change', '[toggle-show]', function(event) {
        var el = $(this);
        var target = $(el.attr('toggle-show'));

        $(el.attr('toggle-show')).each(function(){
            if ($(this).hasClass('hide')) {
                $(this).removeClass('hide');
            }else{
                $(this).addClass('hide');
            }
        });
    });
});