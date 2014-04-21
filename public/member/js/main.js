/* 
 * 首页主要的js函数
 * by jever
 * 2014.4.5
 */
$(document).ready(function(){
    //心情发布框默认文本消除显示
    var post_feed_text="发表心情吧！";
    $('#post_feed').val(post_feed_text);
    $('#post_feed').focusin(function(){
         if($(this).val()===post_feed_text)
         {
             $(this).val("");
         }
    });
    $('#post_feed').blur(function(){
         if($(this).val()==="")
         {
             $(this).val(post_feed_text);
         }
    });
    
    //心情发布框文本数字提示函数
    $('#post_feed').bind('input propertychange keyup',function(){
       
        var n=$(this).val().replace(/[^\x00-\xff]/g, "xx").length;
        if((n%2)===1){
           n=n/2-0.5; 
        }
        else n=n/2;
        if(n>140){
           $('#remain_num').html("已超出<strong>"+(n-140)+"</strong>字");
        }
        else $('#remain_num').html("你还可以输入<strong>"+(140-n)+"</strong>字"); 
    });
    
    //心情发布框文本数字提示函数
    limitComment=function(id){
        $('#post_comment_'+id).bind('input propertychange keyup',function(){
            var n=$(this).val().replace(/[^\x00-\xff]/g, "xx").length;
            if((n%2)===1){
               n=n/2-0.5; 
            }
            else n=n/2;
            if(n>140){
                var text=$(this).val().toString();
                $(this).val(text.substring(0,140));
            }
        });
    };
    
    
    
    //中括号替换成表情链接函数
    function AnalyticEmotion(s) {
	if(typeof (s) !== "undefined") {
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
    /*by *jever
        上面的是引用新浪网站上的表情图标；
        下面是自己写个动态个地方的键盘事件及提交函数，基本用的是post方法，包括提交原创，评论，转发和回复的数据。
        */
	//发布原创动态键盘按键事件处理函数
	keyMsg=function(event){
	  if((event.ctrlKey && event.keyCode === 13) || (event.altKey && event.keyCode === 83)) {
			  postFeed();
	  }
	};
	//发布评论键盘按键事件处理函数
	keyCom=function(event,mid){
		if((event.ctrlKey && event.keyCode === 13) || (event.altKey && event.keyCode === 83)) {
			postcom(mid);
		  }
	};
        //转发动态键盘按键处理函数
        keyTran=function(event,mid){
            if((event.ctrlKey && event.keyCode === 13) || (event.altKey && event.keyCode === 83)) {
			posttran(mid,o_mid);
		  }
        };
        //回复评论键盘按键处理函数
        keyReply=function(event,mid){
            if((event.ctrlKey && event.keyCode === 13) || (event.altKey && event.keyCode === 83)) {
			postreply(mid);
		  }
        };
        
	//提交原创消息
	postFeed=function(){
                var content=$('#post_feed').val();
                var pic_url=$('#feed_post_picture').attr('postval');
                var thumb_pic_url=$('#feed_post_picture').attr('src');
                var n=content.replace(/[^\x00-\xff]/g, "xx").length;
                if(n>140){
                     $('.showerror').html("长度超出限制！").show();
                     setTimeout(function(){
                            $('.showerror').hide('slow');
                     },2000);
                }
                else{
                    var posturl=$('#post_url').val();
                    var isEmotion=content.match(/\[.*?\]/g);
                    if(content==="" || content===post_feed_text){
                            $('.showerror').html("发表的内容不能为空！").show(); 
                            setTimeout(function(){
                                $('.showerror').hide('slow');
                            },2000);
                    }
                    else{
                            $('#post_msg_wait').show();
                            $('#post_msg_wait').text('正在发布，请稍后...');
                            if(isEmotion!==null){
                                var content=AnalyticEmotion(content);
                            }
                            $.post(posturl,{content:content,pic_url:pic_url,thumb_pic_url:thumb_pic_url},function(result){
                                if(result){
                                             $('#show_pic_frame').remove();
                                             $('#show_new_feed').after(result);
                                             $('#post_feed').val('');
                                             $('#post_msg_wait').text('发布成功！');
                                             setTimeout(function(){
                                                 $('#post_msg_wait').hide('slow');
                                             },2000);     
                                     }
                                 }
                            );
                    }	
                }
	};
        
        //显示相应的评论列表
        showComment=function(id,url){
            $('#feed_comment_'+id).toggle();
            $('#comment_wait_'+id).show();
            $.post(url,{id:id},function(result){
                $('#feed_comment_'+id).html(result);
                limitComment(id);
                 $('#comment_wait_'+id).hide();
            });
        };
        
        //显示回复框
        showReply=function(id,url){
            $('#feed_reply_'+id).toggle();
            $.post(url,{id:id},function(result){
                $('#feed_reply_'+id).html(result);
            });
        };
        
        //显示转发框
        showRepost=function(id,url){
               var scrHeight=$(window).scrollTop();
               var bodyHeight=document.body.scrollHeight;
               var winWidth=$(window).width();
               var repostWidth=$('#show_repost_con').width();
               var repostLeft=(winWidth-repostWidth)/2;
               var topHeight=180+scrHeight;
               $('#show_repost_con').css({"left":repostLeft,"top":topHeight});
               $('#show_repost').css({height:bodyHeight});
               $('#show_repost').show();
               $('#show_repost_con').fadeIn('slow');
               $.post(url,{id:id},function(result){
                   $('#show_repost_a').html(result);
               });
        }
        
        //关闭转发框
        closeRepost=function(){
                $('#show_repost_con').fadeOut('slow');  
                $('#show_repost').hide();
           };
        
        
        
        //弹出添加图片的框
          showPic=function(url){
              var loc=$('#pic_show_link').position();
              $('#show_pic_frame').css({left:loc.left,top:loc.top+25}).fadeIn(400);
              $.post(url,function(result){
                  $('#show_pic_con').html(result).show();
              });
          };
          //点击边框外隐藏
//	$(document).bind('click',function(e){
//                var target = $(e.target);
//                if( target.closest("#pic_show_link").length == 1 ||  target.closest("#post_feed").length==1)
//                        return;
//                if( target.closest("#show_pic_frame").length == 0 ){
//                        $('#show_pic_frame').fadeOut(400);
//                }
//	});
        
	//提交评论
	postComment=function(id){
		var content = $('#post_comment_'+id).val();
		var isEmotion=content.match(/\[.*?\]/g);
		if(content===""){
			$('#show_com_error_'+id).show().text('评论的内容不能为空!!');
                        setTimeout(function(){
                                $('#show_com_error_'+id).hide('slow');
                            },2000);
		}
		else{
			var url=$('#com_url').val();
			if(isEmotion!==null){
				var newcontent=AnalyticEmotion(content);
			}else newcontent=content;
			$.post(url,{content:newcontent,id:id},function(result){
				$('#show_new_comment_'+id).after(result);
				$('.emotion_'+id).val('');
			});
		}
	};
        //提交回复
	postReply=function(id,oid){
		var content = $('#post_reply_'+id).val();
		var isEmotion=content.match(/\[.*?\]/g);
		if(content===""){
			$('#show_reply_error_'+id).show().text('回复的内容不能为空!!');
                        setTimeout(function(){
                                $('#show_reply_error_'+id).hide('slow');
                            },2000);
		}
		else{
			var url=$('#reply_url').val();
			if(isEmotion!==null){
				var newcontent=AnalyticEmotion(content);
			}else newcontent=content;
			$.post(url,{content:newcontent,id:id,oid:oid},function(result){
				$('#show_new_comment_'+oid).after(result);
                                $('#feed_reply_'+id).hide('slow');
			});
		}
	};
        //提交转发
	postRepost=function(id){
		var content = $('#repost_content').val();
		var isEmotion=content.match(/\[.*?\]/g);
		if(content===""){
			$('#show_repost_error').show().text("评论的内容不能为空!!");
		}
		else{
			var url=$('#repost_url').val();
			if(isEmotion!==null){
				var newcontent=AnalyticEmotion(content);
			}else newcontent=content;
			$.post(url,{content:newcontent,id:id},function(result){
                                 $('#show_new_feed').after(result);
				$('#show_repost_con').fadeOut();
                                $('#show_repost').hide();
			});
		}
	};
        
        //赞
        feedZan=function(id,url){
            $.post(url,{id:id},function(result){
                $('#msg_zan_num_'+id).html(result);
            });
        };
        
        //取消赞
        feedLoseZan=function(id,url){
            $.post(url,{id:id},function(result){
                 $('#msg_zan_num_'+id).html(result);
            });
        };
        
        //心情分类鼠标放上去的效果
        $(".mem_feed_box").mouseover(function(){
            $(this).addClass("mem_feed_tabs_hover");
            $(".mem_feed_tabs").show();
        });
        
        $(".mem_feed_box").mouseout(function(){
            $(this).removeClass("mem_feed_tabs_hover");
            $(".mem_feed_tabs").hide();
        });


         setInterval(function(){
             ajaxGetNotify();    //或者把该函数代码写在这里，
           }, parseInt(120) * 1000);
         function ajaxGetNotify(){
                  $.get('/notify/getNotifyCount',
                    {},
                    function(data){
                        $('#review_num').text(data.review_count);
                        $('#letter_num').text(data.letter_count);
                        if(data.num != 0){
                            $('#all_notify').html("<em>"+data.num+"</em>");
                        }else{
                            $('#all_notify').html("");
                        }
                    },
                    'json'
                );
            }
});

function loadAds(url){
     $.get(url,function(data){
         $('#mem_left_all').prepend(data).fadeIn('slow');
     });
}
 //每隔一段时间ajax加载提醒




