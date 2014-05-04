/* 
 * 首页主要的js函数
 * by jever
 * 2014.4.5
 */
$(document).ready(function(){
	
	//发布心情获得焦点效果
    var feedpub=$("#post_feed");
	feedpub.on({ 
	focus:function(){ 
			$(this).addClass("focus");
		}, 
	blur:function(){ 
		$(this).removeClass("focus");
	} 
	}); 
	//赞鼠标经过的效果
	
	var digg=$(".digg");
	digg.hover(function(){
			$(this).html("取消赞");
		},function(){
			$(this).html("已赞");
	})
      memMayKnow();
    //心情发布框默认文本消除显示
    var post_feed_text=$("#post_feed").data('content');
    $('#post_feed').val(post_feed_text);
    $('#post_feed').focus(function(){
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
                var pic_url=$('#feed_post_picture').data('picture');
                var thumb_pic_url='thumb_'+pic_url;
				var subbtn=$('.mem_feed_submit');
                var n=content.replace(/[^\x00-\xff]/g, "xx").length;
                if(n>140){
                     $('.showerror').html("长度超出限制！").show();
                   
                }
                else{
                    var posturl=$('#post_url').val();
                    var isEmotion=content.match(/\[.*?\]/g);
                    if(content==="" || content===post_feed_text){
                            $('.showerror').html("发表的内容不能为空！").show(); 
                            
                    }
                    else{
                            subbtn.html('正在发布');
                            if(isEmotion!=null){
                                var content=AnalyticEmotion(content);
                            }
                            $.post(posturl,{content:content,pic_url:pic_url,thumb_pic_url:thumb_pic_url},function(result){
                                if(result){
                                             $('#show_pic_frame').remove();
                                             $('#show_new_feed').after(result);
                                             $('#post_feed').val('');//清空
                                            /* $('#post_msg_wait').text('发布成功！');
                                             setTimeout(function(){
                                                 $('#post_msg_wait').hide('slow');
                                             },2000);    */ 
											 layer.msg('发布成功~',1,-1);	
											 subbtn.html('发布');
                                     }
                                 }
                            );
							
							
                    }	
                }
	};
        
        //显示相应的评论列表
        showComment=function(id,url){
            $('#feed_comment_'+id).toggle();
			
            $.post(url,{id:id},function(result){
                $('#feed_comment_'+id).html(result);
				var comment=$('#post_comment_'+id);
				comment.focus().addClass('focus');
				
				comment.on({ 
				focus:function(){ 
						$(this).addClass("focus");
					}, 
				blur:function(){ 
					$(this).removeClass("focus");
				} 
				});

                limitComment(id);
                 
            });
        };
        
        //显示评论回复框，也是作为评论的一部分处理
        showReply=function(id,url){
            $('#feed_reply_'+id).toggle();
            $.post(url,{id:id},function(result){
                //$('#feed_reply_'+id).html(result);//显示评论回复框
				//用评论框
                var reply=$('#post_comment_'+id);
				var name=reply.data('name');
				reply.focus().addClass('focus');
				reply.val("回复"+name+":");//回复框信息
				reply.on({ 
				focus:function(){ 
						$(this).addClass("focus");
					}, 
				blur:function(){ 
					$(this).removeClass("focus");
				} 
				});
								
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
                   $('#show_pic_con').show();
                   $('#show_pic_con').html(result);
              });
          };


//评论的回复绑定事件
$(document).on('click','.comment_reply',function(){
	var id=$(this).data("id");//心情的id
	var oid=$(this).data("oid");//原来的id
	var name=$(this).data("name");
	var reply=$('#post_comment_'+oid);//回复框
	reply.focus().addClass('focus');
	reply.val("回复"+name+":");//回复框信息
	var sub_comment=$("#show_new_comment_"+oid);
	//.attr({width:"50",height:"80"});
	sub_comment.find("h3 >a").attr({'data-type':'3','data-repost_id':id});//设置评论的类似，此时是回复类型
	//下面相当于提交评论,不用单独ajax处理
});

//提交评论,可能是普通评论，回复评论
postComment=function(id){
	var content = $('#post_comment_'+id).val();
	var type=$('#post_comment_'+id).parent().find("h3 >a").data("type");//评论的类型
	var rid=$('#post_comment_'+id).parent().find("h3 >a").data("repost_id");//回复评论的id
	var isEmotion=content.match(/\[.*?\]/g);
	if(content===""){
		$('#show_com_error_'+id).show().text('评论的内容不能为空!');
	}
	else{
		var url=$('#com_url').val();
		if(isEmotion!==null){
			var newcontent=AnalyticEmotion(content);
		}else newcontent=content;
		$.post(url,{content:newcontent,id:id,type:type,rid:rid},function(result){
			$('#show_new_comment_'+id).prepend(result);//插入元素之前
			$('.emotion_'+id).val('');
		});
	}
};
       //提交回复
	postReply=function(id,oid){
		var content = $('#post_reply_'+id).val();
		var isEmotion=content.match(/\[.*?\]/g);//心情
		if(content==""){
			$('#show_reply_error_'+id).show().text('回复的内容不能为空!');
		}
		else{
			var url=$('#reply_url').val();
			if(isEmotion!=null){
				var newcontent=AnalyticEmotion(content);
			}else newcontent=content;
			$.post(url,{content:newcontent,id:id,oid:oid},function(result){
				//alert(result);
				$('#show_new_comment_'+oid).after(result);
                                //$('#feed_reply_'+id).hide('slow');
			});
		}
	};
        //提交转发
	postRepost=function(id){
		var content = $('#repost_content').val();
		var isEmotion=content.match(/\[.*?\]/g);
		if(content===""){
			$('#show_repost_error').show().text("评论的内容不能为空!");
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


        $(window).scroll(function(){  
         //此方法是在滚动条滚动时发生的函数
         // 当滚动到最底部以上100像素时，加载新内容
         var iswater=$('#iswater').val();
            if(iswater==0){
                var $doc_height,$s_top,$now_height;
                $doc_height = $(document).height();        //这里是document的整个高度
                $s_top = $(this).scrollTop();            //当前滚动条离最顶上多少高度
                $now_height =$(this).height();
                var $height=$doc_height - $s_top - $now_height;
                if($height<5){ 
                    loadwater();
                }
             }
             else if(iswater==2){
                 $('#mem_show_water').html("已加载全部");
             }
             else{
                 $('#mem_show_water').html('<a href="javascript:void(0)" onclick="loadwater()">点击加载更多</a>').show();
             }
         });
         
         
         
});



//瀑布流加载的函数
var $num = 0;
var $list=-1;//第一列不重复显示

function loadwater(){
    var url=$('#water_url').val();
	var loading=$('#show_feed_loading');
    loading.show();
	var type=$(".mem_feed_box .result").data("type");//当前的类型
	//alert(type);
    $num++;
    if($num%5==0){
        $('#iswater').val(1);//开启加载
    }else{
        $list++;
		//第一次加载，$list=0
		//是否要传输当前的类型，瀑布流都需要加载
         $.post(url,{list:$list,type:type},function(result){
             if(result==0){
                 $('#iswater').val(2);  
                 $('#mem_show_water').html("已全部加载").show();
                 loading.hide();
             }
             else{
			 	//测试时候使用settimeout延迟显示效果
               setTimeout(function(){
			   	$('#mem_show_water').hide();
			   	loading.hide();//隐藏加载图标
			   	 $('#mem_show_water').before(result);
                $('#iswater').val(0);
				
			   },400)
            }
            });
            
        
     }
     
}
var mayNum=0; 

//可能认识的人加载的函数
function memMayKnow(){
    var url=$('#mayknow_url').val();
    $.post(url,{num:mayNum},function(data){
        $('#mem_mayknow').html(data);
        if(mayNum==2){
             mayNum=0;
        }
        else{
            if($('#isnores'),val()!=null)
            {
                mayNum=0;
            }
           mayNum++; 
        }
    });
}





