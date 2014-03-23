/** jquery.color.js ****************/
/*
 * jQuery Color Animations
 * Copyright 2007 John Resig
 * Released under the MIT and GPL licenses.
 */

(function(jQuery){

	// We override the animation for all of these color styles
	jQuery.each(['backgroundColor', 'borderBottomColor', 'borderLeftColor', 'borderRightColor', 'borderTopColor', 'color', 'outlineColor'], function(i,attr){
		jQuery.fx.step[attr] = function(fx){
			if ( fx.state == 0 ) {
				fx.start = getColor( fx.elem, attr );
				fx.end = getRGB( fx.end );	
			}
            if ( fx.start )
                fx.elem.style[attr] = "rgb(" + [
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[0] - fx.start[0])) + fx.start[0]), 255), 0),
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[1] - fx.start[1])) + fx.start[1]), 255), 0),
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[2] - fx.start[2])) + fx.start[2]), 255), 0)
                ].join(",") + ")";
		}
	});

	// Color Conversion functions from highlightFade
	// By Blair Mitchelmore
	// http://jquery.offput.ca/highlightFade/

	// Parse strings looking for color tuples [255,255,255]
	function getRGB(color) {
		var result;

		// Check if we're already dealing with an array of colors
		if ( color && color.constructor == Array && color.length == 3 )
			return color;

		// Look for rgb(num,num,num)
		if (result = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(color))
			return [parseInt(result[1]), parseInt(result[2]), parseInt(result[3])];

		// Look for rgb(num%,num%,num%)
		if (result = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(color))
			return [parseFloat(result[1])*2.55, parseFloat(result[2])*2.55, parseFloat(result[3])*2.55];

		// Look for #a0b1c2
		if (result = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(color))
			return [parseInt(result[1],16), parseInt(result[2],16), parseInt(result[3],16)];

		// Look for #fff
		if (result = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(color))
			return [parseInt(result[1]+result[1],16), parseInt(result[2]+result[2],16), parseInt(result[3]+result[3],16)];

		// Otherwise, we're most likely dealing with a named color
		return colors[jQuery.trim(color).toLowerCase()];
	}
	
	function getColor(elem, attr) {
		var color;

		do {
			color = jQuery.curCSS(elem, attr);

			// Keep going until we find an element that has color, or we hit the body
			if ( color != '' && color != 'transparent' || jQuery.nodeName(elem, "body") )
				break; 

			attr = "backgroundColor";
		} while ( elem = elem.parentNode );

		return getRGB(color);
	};
	
	// Some named colors to work with
	// From Interface by Stefan Petre
	// http://interface.eyecon.ro/

	var colors = {
		aqua:[0,255,255],
		azure:[240,255,255],
		beige:[245,245,220],
		black:[0,0,0],
		blue:[0,0,255],
		brown:[165,42,42],
		cyan:[0,255,255],
		darkblue:[0,0,139],
		darkcyan:[0,139,139],
		darkgrey:[169,169,169],
		darkgreen:[0,100,0],
		darkkhaki:[189,183,107],
		darkmagenta:[139,0,139],
		darkolivegreen:[85,107,47],
		darkorange:[255,140,0],
		darkorchid:[153,50,204],
		darkred:[139,0,0],
		darksalmon:[233,150,122],
		darkviolet:[148,0,211],
		fuchsia:[255,0,255],
		gold:[255,215,0],
		green:[0,128,0],
		indigo:[75,0,130],
		khaki:[240,230,140],
		lightblue:[173,216,230],
		lightcyan:[224,255,255],
		lightgreen:[144,238,144],
		lightgrey:[211,211,211],
		lightpink:[255,182,193],
		lightyellow:[255,255,224],
		lime:[0,255,0],
		magenta:[255,0,255],
		maroon:[128,0,0],
		navy:[0,0,128],
		olive:[128,128,0],
		orange:[255,165,0],
		pink:[255,192,203],
		purple:[128,0,128],
		violet:[128,0,128],
		red:[255,0,0],
		silver:[192,192,192],
		white:[255,255,255],
		yellow:[255,255,0]
	};
	
})(jQuery);

/** jquery.lavalamp.js ****************/
/**
 * LavaLamp - A menu plugin for jQuery with cool hover effects.
 * @requires jQuery v1.1.3.1 or above
 *
 * http://gmarwaha.com/blog/?p=7
 *
 * Copyright (c) 2007 Ganeshji Marwaha (gmarwaha.com)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Version: 0.1.0
 */

/**
 * Creates a menu with an unordered list of menu-items. You can either use the CSS that comes with the plugin, or write your own styles 
 * to create a personalized effect
 *
 * The HTML markup used to build the menu can be as simple as...
 *
 *       <ul class="lavaLamp">
 *           <li><a href="#">Home</a></li>
 *           <li><a href="#">Plant a tree</a></li>
 *           <li><a href="#">Travel</a></li>
 *           <li><a href="#">Ride an elephant</a></li>
 *       </ul>
 *
 * Once you have included the style sheet that comes with the plugin, you will have to include 
 * a reference to jquery library, easing plugin(optional) and the LavaLamp(this) plugin.
 *
 * Use the following snippet to initialize the menu.
 *   $(function() { $(".lavaLamp").lavaLamp({ fx: "backout", speed: 700}) });
 *
 * Thats it. Now you should have a working lavalamp menu. 
 *
 * @param an options object - You can specify all the options shown below as an options object param.
 *
 * @option fx - default is "linear"
 * @example
 * $(".lavaLamp").lavaLamp({ fx: "backout" });
 * @desc Creates a menu with "backout" easing effect. You need to include the easing plugin for this to work.
 *
 * @option speed - default is 500 ms
 * @example
 * $(".lavaLamp").lavaLamp({ speed: 500 });
 * @desc Creates a menu with an animation speed of 500 ms.
 *
 * @option click - no defaults
 * @example
 * $(".lavaLamp").lavaLamp({ click: function(event, menuItem) { return false; } });
 * @desc You can supply a callback to be executed when the menu item is clicked. 
 * The event object and the menu-item that was clicked will be passed in as arguments.
 */
(function($) {
    $.fn.lavaLamp = function(o) {
        o = $.extend({ fx: "linear", speed: 200, click: function(){} }, o || {});

        return this.each(function(index) {
            
            var me = $(this), noop = function(){},current=$('.menu>li>a.current>span', '#menu')
                $back = $('<li class="back"><div class="left"></div></li>').appendTo(me),
                $li = $(">li", this), curr = $("li.current", this)[0] || $($li[0]).addClass("current")[0];

            $li.not(".back").hover(function() {
                move(this);
				if($(this).attr('class')!='current')
				current.css('color','rgb(205,227,235)');
				else current.css('color','rgb(255,255,255)');
            }, noop);

            $(this).hover(noop, function() {
                move(curr);
				current.animate({color: 'rgb(255,255,255)'},400);
            });

            $li.click(function(e) {
                //setCurr(this);
				//$('.menu>li>a','#menu').is(".current").removeClass("current");
				//$(this).children('a').addClass("current");
                //return o.click.apply(this, [e, this]);
				$(this).children('a').blur();
            });

            setCurr(curr);

            function setCurr(el) {
                $back.css({ "left": el.offsetLeft+"px", "width": el.offsetWidth+"px" });
                curr = el;
            };
            
            function move(el) {
                $back.each(function() {
                    $.dequeue(this, "fx"); }
                ).animate({
                    width: el.offsetWidth,
                    left: el.offsetLeft
                }, o.speed, o.fx);
            };

            if (index == 0){
                $(window).resize(function(){
                    $back.css({
                        width: curr.offsetWidth,
                        left: curr.offsetLeft
                    });
                });
            }
            
        });
    };
})(jQuery);

/** jquery.easing.js ****************/
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright В© 2008 George McGinley Smith
 * All rights reserved.
 */

/*
 * jQuery Easing Compatibility v1 - http://gsgd.co.uk/sandbox/jquery.easing.php
 *
 * Adds compatibility for applications that use the pre 1.2 easing names
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */
/** apycom menu ****************/
jQuery(function() {
    var $ = jQuery;
    // retarder
    $.fn.retarder = function(delay, method){
        var node = this;
        if (node.length){
            if (node[0]._timer_) clearTimeout(node[0]._timer_);
            node[0]._timer_ = setTimeout(function(){ method(node); }, delay);
        }
        return this;
    };
    var ie6 = ($.browser.msie && $.browser.version.substr(0, 1) == '6');
    if (ie6) $('#menu').addClass('ie6');
    $('ul ul', '#menu').css({
        display: 'none',
        left: 0,
        top: 41
    });
	$('.menu li', '#menu').each(function(){
			if($('ul:first span',this).html())
				  $('a:first',this).addClass('parent');
	});
    $('.menu>li', '#menu').hover(function() {
        var ul = $('ul:first', this);
		var childcont=ul.find('span').html();
        if (ul.length && childcont) {
            if (!ul[0].hei) ul[0].hei = ul.height();
            ul.css({
                height: 30,
                overflow: 'hidden'
            }).retarder(400, 
            function(i) {
                $('#menu>ul>li.back').css('visibility','hidden');
                i.css('display', 'block').animate({
                    height: ul[0].hei
                },
                {
                    duration: 300,
                    complete: function() {
                        ul.css('overflow', 'visible')
                    }
                })
            })
        }
    },
    function() {
        var ul = $('ul:first', this);
        if (ul.length) {
            var css = {
                display: 'none',
                height: ul[0].hei
            };
            var a = $('a:first', this).css({
                background: 'none',
                borderColor: 'transparent'
            });
            if (ie6) a.css({
                borderColor: '#136fa0',
                filter: 'chroma(color=#136fa0)'
            });
            $('#menu>ul>li.back').css('visibility', 'visible');
            ul.stop().retarder(1, 
            function(i) {
                i.css(css)
            })
        }
    });
    $('ul ul li', '#menu').hover(function() {
        var ul = $('ul:first', this);
		var childcont=ul.find('span').html();
        if (ul.length && childcont) {
            if (!ul[0].wid) ul[0].wid = ul.width();
            ul.css({
                width: 0,
                overflow: 'hidden'
            }).retarder(100, 
            function(i) {
                i.css('display', 'block').animate({
                    width: ul[0].wid
                },
                {
                    duration: 300,
                    complete: function() {
                        ul.css('overflow', 'visible')
                    }
                })
            })
        }
    },
    function() {
        var ul = $('ul:first', this);
        if (ul.length) {
            var css = {
                display: 'none',
                width: ul[0].wid
            };
            ul.retarder(50, 
            function(i) {
                i.animate({
                    width: 0
                },
                {
                    duration: 100,
                    complete: function() {
                        $(this).css(css)
                    }
                })
            })
        }
    });
    $('#menu ul.menu').lavaLamp({
        speed: 400
    });
    var links = $('.menu>li>a', '#menu').css({
        background: 'none',
        borderBottom: 'none'
    });
    if (ie6) links.css({
        borderColor: '#171717',
        filter: 'chroma(color=#171717)'
    });
    else {
        links.css('borderColor', 'transparent').hover(function() {
            $(this).animate({
                color: 'rgb(255,255,255)'
            },
            800)
        },
        function() {
            $(this).animate({
                color: 'rgb(205,227,235)'
            },
            400)
        });
        $('.menu>li>a', '#menu').not(".current").children('span').css('color','rgb(205,227,235)').hover(function() {
            $(this).animate({
                color: 'rgb(255,255,255)'
            },
            800)
        },
        function() {
            $(this).animate({
                color: 'rgb(205,227,235)'
            },
            400)
        })
    }
});