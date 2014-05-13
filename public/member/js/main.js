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
	//转发心情
	$("#repost_feed").focus().addClass('focus');//转发获得焦点
	//赞鼠标经过的效果
	var digg=$(".digg");
	digg.hover(function(){
			$(this).html("取消赞");
		},function(){
			$(this).html("已赞");
	})
      memMayKnow();
	  //关闭广告
	  $(".close").on('click',function(){
	  	$(".ad").hide();
	  })
	  //显示个人图标
	  var icon=document.getElementById("medal");
	  var iconli=icon.getElementsByTagName("li");
	  var i=0;
	  for(i=0;i<iconli.length;i++){
	  	iconli[i].onmouseover=function(){
		  //原生js
		  var lispan=this.getElementsByTagName('span')[0];
		  var lidiv=this.getElementsByTagName('div')[0];
		  lispan.style.display="block";
		  lidiv.style.display="block";
			//$("span",this).show();
			//$("div",this).show();
		}
		iconli[i].onmouseout=function(){
			//jq:
			//$("span",this).hide();
			//$("div",this).hide();
			//原生js
		  var lispan=this.getElementsByTagName('span')[0];
		  var lidiv=this.getElementsByTagName('div')[0];
		  lispan.style.display="none";
		  lidiv.style.display="none";
			
			
		}
	  }
	  
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
                    var posturl=$('#post_url').val();//提交的url
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
	sub_comment.find("h3 >a").attr({'data-type':'3','data-repost_id':id});//设置评论的类型，此时是回复类型
	//下面相当于提交评论,不用单独ajax处理
});

//提交评论,可能是普通评论，回复评论
postComment=function(id){
	var content = $('#post_comment_'+id).val();
	var type=$('#post_comment_'+id).parent().find("h3 >a").data("type");//评论的类型
	var rid=$('#post_comment_'+id).parent().find("h3 >a").data("repost_id");//回复评论的id
	var selectNode=$('#post_comment_'+id).parent().find("h3 input")
	if (selectNode.is(':checked')) {//选中，则转发
		var is_repost=1;
	}else is_repost=0;
	var isEmotion=content.match(/\[.*?\]/g);
	if(content===""){
		$('#show_com_error_'+id).show().text('评论的内容不能为空!');
	}
	else{
		var url=$('#com_url').val();
		if(isEmotion!==null){
			var newcontent=AnalyticEmotion(content);
		}else newcontent=content;
		$.post(url,{content:newcontent,id:id,type:type,rid:rid,is_repost:is_repost},function(result){
			$('#show_new_comment_'+id).prepend(result);//插入元素之前
			$('.emotion_'+id).val('');
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
	var url=$("#container_index").data("loadurl");
	//alert(url);return;
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
			   	//loading.hide();//隐藏加载图标
			   	 $('#mem_show_water').before(result);
                $('#iswater').val(0);
				loading.hide();
			   },400)
            }
            });
            
        
     }
     
}

//删除自己的心情
$(document).on('click','.delfeed',function(){
	var feed_id=$(this).data("id");//心情的id
	var delnode=$(this).parent().parent().parent().parent().parent();
	var url=$(this).data('url');
	layer.confirm('确定删除该心情吗？', function(){ 
		  $.ajax({
		  type: "GET",
		  url: url,
		  data: {
			id: feed_id,
		  },
			 success: function (data) {
				//
				layer.msg('删除心情成功！',1,-1);
				delnode.remove();
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});

	});
});

//ajax切换心情类型
$(document).on('click', '.mem_feed_tabs li',function(){
	//点击之后再点击就不行了，这个js bug如何解决呢
	var url=$("#container_index").data("loadurl");
	var now=$('a',this);//当前节点
	var type=now.data('type');
	var name=now.data('name');
	var onnode=$(".result");
	var onname=onnode.data("name");//要显示
	var ontype=onnode.data("type");
	
	var loading=$('#show_feed_loading');
	loading.show();
	
	$(".mem_left .mem_feed_con").remove();
	  $.ajax({
		  type: "POST",
		  url: url,
		  data: {
			  type: type,
		  },
			 success: function (data) {
					//如何显示数据
				 setTimeout(function(){
					 loading.hide();
					 now.attr("data-name",onname);
					 now.attr("data-type",ontype);
					 now.html(onname);
					 
					 onnode.attr("data-name",name);
					 onnode.attr("data-type",type);
					 onnode.html(name);
					 $('#mem_show_water').before(data);
				},400)
			
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});	
})

//删除自己的评论
$(document).on('click','.delcomment',function(){
	var feed_id=$(this).data("id");//心情的id
	var oid=$(this).data("oid");//原来的id
	var url=$(this).data("url");
	var delnode=$(this).parent().parent().parent();
	layer.confirm('确定删除该评论吗？', function(){ 
		  $.ajax({
		  type: "GET",
		  url: url,
		  data: {
			id: feed_id,
			oid:oid,
		  },
			 success: function (data) {
				//评论数减一应该用ajax体现
				layer.msg('删除评论成功！',1,-1);
				delnode.remove();
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});

	});
});

//ajax转发心情,不涉及php代码，方便转移

	$(document).on('click','.mem_feed_submit',function(){
		var content=$("#repost_feed").val();
		var isEmotion=content.match(/\[.*?\]/g);
		if(isEmotion) var content=AnalyticEmotion(content);//判断有没有表情	
		//alert(content);return;
		if(content==""){$(".showerror").show().html("内容不能为空");$("#repost_feed").focus();return;}
		
		var feed_id=$(this).data('id');
		var oid=$(this).data('oid');
		var mid=$(this).data('mid');
		var url=$(this).data('url');//解决了url动态路径问题
		//ajax转发
		  $.ajax({
			  type: "POST",
			  url: url,
			  data: {
				content: content,
				feed_id:feed_id,
				oid:oid,
				mid:mid,
			  },
				 success: function (data) {
					 //alert(data);
					var i = parent.layer.getFrameIndex(window.name);
					layer.msg('转发心情成功~',1,-1);
					//做成ajax显示
					//延迟执行
					setTimeout(function(){
							parent.layer.close(i);
						}, 500);
				//parent操作父级页面			
				//parent.loadwater;
				},
				  error: function (msg) {
						alert(msg);
				  }
			});
			
	});


//可能认识的人，添加好友
$(document).on('click','.apply_friend',function(){
	   var rece_id=$(this).data('uid');
	   var url=$(this).data('url');
	   var delnode=$(this).parent().parent();
		$.ajax({
			  url: url,
			  data: {
				id: rece_id,
			  },
				 success: function (data) {
					 //移除节点
					 layer.msg('发送成功~',1,-1);	
					 delnode.remove();
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});
	   
	 })


var mayNum=0; 
//可能认识的人加载的函数
function memMayKnow(){
    var url=$('#j_pymk_right_change').data("url");
    $.post(url,{num:mayNum},function(data){
		if(data==0){
			mayNum=0;
			memMayKnow();//重新开始
		}
		else{
		   $('#pymk_div').html(data);
          mayNum++; 

		}
       
    });
}