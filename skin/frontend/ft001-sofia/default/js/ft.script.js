var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;
var mobile = false;

document.observe("dom:loaded", function() {   

}); 

var equalHeight = function(){
   jQuery( "ul.products-grid" ).each(function() {
		var items = jQuery(this).find("li.item");
		var maxHeight = 0;
		items.each(
			function(){
				jQuery(this).css("height", "auto");
				maxHeight = Math.max(maxHeight, jQuery(this).height());
		});
		items.css("height",maxHeight+"px");
	});
};

function showMessage(message) {
	jQuery('body').append('<div class="alert"></div>');
	jQuery('.alert').slideDown(400);
	jQuery('.alert').html(message).append('<button></button>');
	jQuery('button').click(function () {
		jQuery('.alert').slideUp(400);
	});
	jQuery('.alert').slideDown('400', function () {
		setTimeout(function () {
			jQuery('.alert').slideUp('400', function () {
				jQuery(this).slideUp(400, function(){ jQuery(this).detach(); })
			});
		}, 7000)
	});
}

function setLocationAjax(url, id){
	url = url.replace("checkout/cart", "ajax/index");
	url += 'isAjax/1';
	jQuery('#ajax_loading' + id).css('display', 'block');
	try {
		jQuery.ajax({
			url:url,
			dataType:'json',
			success:function (data) {
				jQuery('#ajax_loading' + id).css('display', 'none');
				showMessage(data.message);
				if (data.status != 'ERROR' && jQuery('.block-mini-cart').length) {
					jQuery('.block-mini-cart').replaceWith(data.sidebar);
				}
			}
		});
	} catch (e) {
	console.log(e);
	}
}

jQuery(function($){
	$().UItoTop({scrollSpeed:400});
    $(window).resize(function(){
        sw = $(window).width();
        sh = $(window).height();
        var breakpoint = 959;
        mobile = (sw > breakpoint) ? false : true;
        
		$('.itemslider').each(function(index){
			var s = $(this).data('flexslider');
			if (s != null) s.flexAnimate(0);
		});
		
		$('.more-views .carousel').each(function(index){
			var flex = $(this).data('flexslider');
			if (flex != null) { 
				flex.flexAnimate(0);
				if(jQuery(window).width() <= 767) { var itemWidth = $('.product-view .product-img-box .more-views li').width();$('.product-view .product-img-box .more-views .carousel').css('width',itemWidth); }
				else { var itemWidth = $('.product-view .product-img-box .more-views li').width();$('.product-view .product-img-box .more-views .carousel').css('width',itemWidth*3);}
			}
		});
		
		setTimeout(function(){equalHeight();},100);
    });
    
    //ipad and iphone fix
    if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/android/i))) {
        jQuery("#mainNav li a").on({
            click: function () {
                if ( !jQuery(this).hasClass('touched') && jQuery(this).siblings('div') ) {
                    jQuery('#mainNav a').removeClass('touched');
                    jQuery(this).parents('li').children('a').addClass('touched');
                    jQuery(this).addClass('touched');
                    return false;
                }
            }
        });
        
        jQuery("#nav li a").on({
            click: function () {
                if ( !jQuery(this).hasClass('touched') && jQuery(this).siblings('ul') ) {
                    jQuery('#nav a').removeClass('touched');
                    jQuery(this).parents('li').children('a').addClass('touched');
                    jQuery(this).addClass('touched');
                    return false;
                }
            }
        });
        jQuery('.header-switch, .toolbar-switch').on({
            click: function (e) {
                jQuery(this).addClass('over');
                return false;
            }
        });

    }
	
	$('.mobile-nav li.parent > a').prepend('<em>+</em>');
	
	$('.mobile-nav li.parent > a em').click(function(){
		if ( $(this).text() == '+') {
			$(this).parent().parent().addClass('over');
			$(this).parent().next().show();
			$(this).text('-');
		}
		else {
			$(this).parent().parent().removeClass('over');
			$(this).parent().next().hide();
			$(this).text('+');
		}
		$(".header-wrapper").height($("header").height());
		return false;
	});

	$('.mobile-nav .nav-container .nav-top-title').click(function(){
		$(this).toggleClass('over').next().toggle();
		$(".header-wrapper").height($("header").height());
		return false;
	});
	
    $('#mainNav li').hover(
            function(){
                var docWidth = $(document).width();
                var div = $(this).children('div');
                var divWidth = div.actual('width') + parseInt(div.css('padding')) + 30;

                $(this).addClass('over');
                div.addClass('shown-sub');

                if ( divWidth + $(this).offset().left > docWidth  ) {
                    div.css('left', -($(this).offset().left + divWidth - docWidth)+'px' );
                } else {
                    div.css('left', '0px');
                }
            },
            function(){
                $(this).removeClass('over');
                $(this).children('div').removeClass('shown-sub').css('left', '-10000px');
            }
        );
    //product accordion
    $('h2.tab-heading a').click(function () {
        that = $(this).parent();
        $(".product-tabs-content").not(that.next()).hide();
        if(!$(that).next().is(':visible')) that.next().slideToggle();
        $('.product-tabs > li').removeClass('active');
        var idTab = $(that).attr('data-index');
        idTab = $.trim(idTab);
        //console.log("#"+idTab);
        $('#'+idTab).addClass('active');
        return false;
    });
	
	$('.ajax-add').live('click', function(){
        setLocationAjax($(this).attr('data-url'), $(this).attr('data-id'));
        return false;
    });

});

jQuery(document).ready(function() {
	jQuery(".block-layered-nav dt").click(
		function() {
		if(jQuery(this).next().is(":visible")) { jQuery(this).next().hide();jQuery(this).addClass('close'); }
		else {jQuery(this).next().show();jQuery(this).removeClass('close');}
		}
   );

	jQuery('div.product-view p.no-rating a, div.product-view .rating-links a').click(function(){
		jQuery('ul.product-tabs li').removeClass('active');
		jQuery('#product_tabs_review_tabbed').addClass('active');
		jQuery('.product-tabs-content').hide();
		jQuery('#product_tabs_review_tabbed_contents').show();
		jQuery('#product_tabs_review_tabbed').scrollToMe();
	        return false;
	    });
	
	if(jQuery(window).width() <= 767) { var itemWidth = jQuery('.product-view .product-img-box .more-views li').width();jQuery('.product-view .product-img-box .more-views .carousel').css('width',itemWidth); }
	else { var itemWidth = jQuery('.product-view .product-img-box .more-views li').width();jQuery('.product-view .product-img-box .more-views .carousel').css('width',itemWidth*3);}
});



;(function(a){a.fn.extend({actual:function(b,k){var c,d,h,g,f,j,e,i;if(!this[b]){throw'$.actual => The jQuery method "'+b+'" you called does not exist';}h=a.extend({absolute:false,clone:false,includeMargin:undefined},k);d=this;if(h.clone===true){e=function(){d=d.filter(":first").clone().css({position:"absolute",top:-1000}).appendTo("body");};i=function(){d.remove();};}else{e=function(){c=d.parents().andSelf().filter(":hidden");g=h.absolute===true?{position:"absolute",visibility:"hidden",display:"block"}:{visibility:"hidden",display:"block"};f=[];c.each(function(){var m={},l;for(l in g){m[l]=this.style[l];this.style[l]=g[l];}f.push(m);});};i=function(){c.each(function(m){var n=f[m],l;for(l in g){this.style[l]=n[l];}});};}e();j=/(outer)/g.test(b)?d[b](h.includeMargin):d[b]();i();return j;}});})(jQuery);
jQuery.fn.extend({
    scrollToMe: function () {
        var x = jQuery(this).offset().top - 100;
        jQuery('html,body').animate({scrollTop: x}, 500);
}});
/*
|--------------------------------------------------------------------------
| UItoTop jQuery Plugin 1.2 by Matt Varone
| http://www.mattvarone.com/web-design/uitotop-jquery-plugin/
|--------------------------------------------------------------------------
*/
(function($){
	$.fn.UItoTop = function(options) {

 		var defaults = {
    			text: 'To Top',
    			min: 200,
    			inDelay:600,
    			outDelay:400,
      			containerID: 'toTop',
    			containerHoverID: 'toTopHover',
    			scrollSpeed: 1200,
    			easingType: 'linear'
 		    },
            settings = $.extend(defaults, options),
            containerIDhash = '#' + settings.containerID,
            containerHoverIDHash = '#'+settings.containerHoverID;
		
		$('body').append('<a href="#" id="'+settings.containerID+'">'+settings.text+'</a>');
		$(containerIDhash).hide().on('click.UItoTop',function(){
			$('html, body').animate({scrollTop:0}, settings.scrollSpeed, settings.easingType);
			$('#'+settings.containerHoverID, this).stop().animate({'opacity': 0 }, settings.inDelay, settings.easingType);
			return false;
		})
		.prepend('<span id="'+settings.containerHoverID+'"></span>')
		.hover(function() {
				$(containerHoverIDHash, this).stop().animate({
					'opacity': 1
				}, 600, 'linear');
			}, function() { 
				$(containerHoverIDHash, this).stop().animate({
					'opacity': 0
				}, 700, 'linear');
			});
					
		$(window).scroll(function() {
            if (mobile) return;
			var sd = $(window).scrollTop();
			if(typeof document.body.style.maxHeight === "undefined") {
				$(containerIDhash).css({
					'position': 'absolute',
					'top': sd + $(window).height() - 50
				});
			}
			if ( sd > settings.min ) 
				$(containerIDhash).fadeIn(settings.inDelay);
			else 
				$(containerIDhash).fadeOut(settings.Outdelay);
		});
};
})(jQuery);
