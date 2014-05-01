/**
 * @author 夏の寒风
 * @time 2012-12-14
 */

//自定义hashtable
function Hashtable() {
    this._hash = new Object();
    this.put = function(key, value) {
        if (typeof (key) != "undefined") {
            if (this.containsKey(key) == false) {
                this._hash[key] = typeof (value) == "undefined" ? null : value;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    this.remove = function(key) { delete this._hash[key]; }
    this.size = function() { var i = 0; for (var k in this._hash) { i++; } return i; }
    this.get = function(key) { return this._hash[key]; }
    this.containsKey = function(key) { return typeof (this._hash[key]) != "undefined"; }
    this.clear = function() { for (var k in this._hash) { delete this._hash[k]; } }
}

var emotions = new Array();
var categorys = new Array();// 分组
var uSinaEmotionsHt = new Hashtable();

// 初始化缓存，页面仅仅加载一次就可以了
$(function() {
	var app_id = '1362404091';
	$.ajax( {
		dataType : 'jsonp',
		url : 'https://api.weibo.com/2/emotions.json?source=' + app_id,
		success : function(response) {
			var data = response.data;
			for ( var i in data) {
				if (data[i].category == '') {
					data[i].category = '默认';
				}
				if (emotions[data[i].category] == undefined) {
					emotions[data[i].category] = new Array();
					categorys.push(data[i].category);
				}
				emotions[data[i].category].push( {
					name : data[i].phrase,
					icon : data[i].icon
				});
				uSinaEmotionsHt.put(data[i].phrase, data[i].icon);
			}
		}
	});
});

//替换
function AnalyticEmotion(s) {
	if(typeof (s) != "undefined") {
		var sArr = s.match(/\[.*?\]/g);
		for(var i = 0; i < sArr.length; i++){
			if(uSinaEmotionsHt.containsKey(sArr[i])) {
				var reStr = "<img src=\"" + uSinaEmotionsHt.get(sArr[i]) + "\" height=\"22\" width=\"22\" />";
				s = s.replace(sArr[i], reStr);
			}
		}
	}
	return s;
}

(function($){
	$.fn.SinaEmotion = function(target,mid){
		var cat_current;
		var cat_page;
		$(this).click(function(event){
			event.stopPropagation();
			
			var eTop = target.offset().top + target.height() + 35;
			var eLeft = target.offset().left - 1;
			
			if($('#emotions_'+mid+' .categorys')[0]){
				$('#emotions_'+mid).css({top: eTop, left: eLeft});
				$('#emotions_'+mid).toggle();		
				return;
			}
//			alert(eTop+eLeft);
			$('body').append('<div class="emotions" id="emotions_'+mid+'"></div>');
//			alert('<div  id="emotions_'+mid+'"></div>');
			$('#emotions_'+mid).css({top: eTop, left: eLeft});
			$('#emotions_'+mid).html('<div>正在加载，请稍候...</div>');
			$('#emotions_'+mid).click(function(event){
				event.stopPropagation();
			});
//			alert(mid);
			$('#emotions_'+mid).html('<div class="mem_feed_jiantou_a" style="top:-14px;"><span class="mem_jia_back" >◆</span><span  class="mem_jia_border" style="color:#FFFFFF; ">◆</span></div><div style="float:right"><a href="javascript:void(0);" id="prev">&laquo;</a><a href="javascript:void(0);" id="next">&raquo;</a></div><div class="categorys"></div><div class="container"></div><div class="page"></div>');
			$('#emotions_'+mid+' #prev').click(function(){
				showCategorys(cat_page - 1);
			});
			$('#emotions_'+mid+' #next').click(function(){
				showCategorys(cat_page + 1);
			});
			showCategorys();
			showEmotions();
			
		});
		$('body,html').click(function(){
			$('#emotions_'+mid).remove();
		});
		$.fn.insertText = function(text){
			this.each(function() {
				if(this.tagName !== 'INPUT' && this.tagName !== 'TEXTAREA') {return;}
				if (document.selection) {
					this.focus();
					var cr = document.selection.createRange();
					cr.text = text;
					cr.collapse();
					cr.select();
				}else if (this.selectionStart || this.selectionStart == '0') {
                                    
                                    if($('.emotion_'+mid).val()=="向朋友分享你的新动态"){
                                        $('.emotion_'+mid).val("");
                                    }  
					var 
					start = this.selectionStart,
					end = this.selectionEnd;
					this.value = this.value.substring(0, start)+ text+ this.value.substring(end, this.value.length);
					this.selectionStart = this.selectionEnd = start+text.length;
                                      
                                        
                                        var n=$('#post_feed').val().replace(/[^\x00-\xff]/g, "xx").length;
                                        if((n%2)==1){
                                           n=n/2-0.5; 
                                        }
                                        else n=n/2;
                                        if(n>140){
                                           $('#remain_num').html("已超出<strong>"+(n-140)+"</strong>字");
                                        }
                                        else $('#remain_num').html("你还可以输入<strong>"+(140-n)+"</strong>字"); 
                                                                }else {
                                                                    this.value += text;
                                                                }
                                                        });        
                                        return this;
		};
		function showCategorys(){
			var page = arguments[0]?arguments[0]:0;
			if(page < 0 || page >= categorys.length / 5){
				return;
			}
			$('#emotions_'+mid+' .categorys').html('');
			cat_page = page;
			for(var i = page * 5; i < (page + 1) * 5 && i < categorys.length; ++i){
				$('#emotions_'+mid+' .categorys').append($('<a href="javascript:void(0);">' + categorys[i] + '</a>'));
			}
			$('#emotions_'+mid+' .categorys a').click(function(){
				showEmotions($(this).text());
			});
			$('#emotions_'+mid+' .categorys a').each(function(){
				if($(this).text() == cat_current){
					$(this).addClass('current');
				}
			});
		}
		function showEmotions(){
			var category = arguments[0]?arguments[0]:'默认';
			var page = arguments[1]?arguments[1] - 1:0;
			$('#emotions_'+mid+' .container').html('');
			$('#emotions_'+mid+' .page').html('');
			cat_current = category;
			for(var i = page * 72; i < (page + 1) * 72 && i < emotions[category].length; ++i){
				$('#emotions_'+mid+' .container').append($('<a href="javascript:void(0);" title="' + emotions[category][i].name + '"><img src="' + emotions[category][i].icon + '" alt="' + emotions[category][i].name + '" width="22" height="22" /></a>'));
			}
			$('#emotions_'+mid+' .container a').click(function(){
				target.insertText($(this).attr('title'));
				$('#emotions_'+mid).remove();
			});
			for(var i = 1; i < emotions[category].length / 72 + 1; ++i){
				$('#emotions_'+mid+' .page').append($('<a href="javascript:void(0);"' + (i == page + 1?' class="current"':'') + '>' + i + '</a>'));
			}
			$('#emotions_'+mid+' .page a').click(function(){
				showEmotions(category, $(this).text());
			});
			$('#emotions_'+mid+' .categorys a.current').removeClass('current');
			$('#emotions_'+mid+' .categorys a').each(function(){
				if($(this).text() == category){
					$(this).addClass('current');
				}
			});
		}
	};
})(jQuery);
