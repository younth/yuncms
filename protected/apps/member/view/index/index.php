{include file="header"}
<link href="__PUBLIC__/emotions/css/emotion.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/emotions/css/jquery.sinaEmotion.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/member/css/main.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script src="__PUBLICAPP__/js/main.js" type="text/javascript"></script>   
<script type="text/javascript" src="__PUBLIC__/emotions/js/jquery.sinaEmotion.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script type="text/javascript">
    //封面图效果
    hs.graphicsDir = "__PUBLIC__/images/graphics/";
    hs.showCredits = false;
    hs.outlineType = 'rounded-white';
    hs.restoreTitle = '关闭';
</script>
        

<!---获取链接的input,不建议采用这种方式---->
<div id="container_index">
<input type="hidden" value="0" id="iswater" />
<input type="hidden" value="{$url_postcomment}" id="com_url"/>
<input type="hidden" value="{$url_postfeed}" id="post_url" />
<input type="hidden" value="{$url_postreply}" id="reply_url" />
<input type="hidden" value="{$url_postrepost}" id="repost_url" />
<input type="hidden" value="{$url_loadwater}" id="water_url" />
<input type="hidden" value="{$url_mayknow}" id="mayknow_url" />
<div class="member_mian">
    <div class="member_mianbg">
        <div class="mem_left_all" id="mem_left_all">
        
   			<div class="ad" ><img src="__PUBLICAPP__/images/ad.jpg" /></div>
            
 <div class="mem_left pubfeed" id="index_publish">
     <div class="mem_post_feed">
         <h3>
             <strong>分享动态</strong>
             <span  id="remain_num">你还可以输入<strong>140</strong>字</span>
         </h3>
    <textarea class="textarea emotion_0" cols="58" rows="4" id='post_feed'  onkeydown='keyMsg(event)' data-content="向朋友分享你的新动态"></textarea>
    <div class="mem_post_feed_icon">
        <span>
            <span class="mem_feed_face"><a href="javascript:void(0);" id="face_0" ></a>
            </span>
            <span class="mem_feed_pic">
            <a href="javascript:void(0);" id="pic_show_link" onclick="showPic('{$url_showpic}')" ></a>
            </span>
            <span class="showerror"  style="display:none;"></span>
        </span>
        <a class="mem_feed_submit"  href="javascript:void(0)" onclick="postFeed()">发表</a>
    </div>
    
    <span id="post_msg_wait" style="display:none;"></span>
     </div>
</div>
<script type="text/javascript">
		// 绑定表情
		$('#face_0').SinaEmotion($('.emotion_0'),'0');
</script>
<div class="mem_left">
    <div class="mem_feed_con_head" id="show_new_feed">
        <em class="icons"></em><h3>新鲜事</h3>
        <div class="mem_feed_box">
                            <p class="result" data-type=1>全部</p> <em class="pointer"></em>
                            <ul class="mem_feed_tabs">
                               
                                <li>
                                    <a data-type=2  data-name="联系人"  href="javascript:;">联系人</a>
                                </li>
                               <!--  <li>
                                    <a data-filter="corpIndex" href="javascript:;">公司</a>
                                </li> -->
                                <li>
                                    <a data-type=3  data-name="我的新鲜事" href="javascript:;">我的新鲜事</a>
                                </li>
                            </ul>
                        </div>
    </div>
    
    
<!-- 瀑布流加载 -->
<div class="feed-more" id="mem_show_water" style="display:none;">
</div>
<div class="feed-more" id="show_feed_loading" style="display: none;">
	<img src="__PUBLIC__/images/loading_black.gif">
</div>
<script>loadwater();</script>


</div>
    </div>
        <div class="mem_right_all">
        
            <div class="mem_right">
            
                <div class="mem_right_head">可能认识的人
                    
                    <a id="chang_may_know" onclick="memMayKnow()" class="mem_right_change" title="换一换" href="javascript:void(0);"></a>
                </div>
                
                <div class="mem_right_con" id="mem_mayknow">
                    
                </div>
            </div>
            
        </div>
</div>
<!---显示图片框的div-->
<div class="mem_pic_frame" id="show_pic_frame" style="">
    <div class="mem_feed_jiantou_a" style="margin-top:-8px; left: 7px;">
       <span class="mem_jia_back">◆</span><span  class="mem_jia_border" style="color: #e7e7e7;">◆</span>
   </div>
    <div class="show_repost_head" style="width:250px;" >
        上传图片
    <a href="javascript:void(0);" class="close_repost" onclick="closePic()">×</a>
    </div>
    <div class="mem_pic_con" id="show_pic_con">
    </div>
</div>


</div>

<script>
//删除自己的心情
$(document).on('click','.delfeed',function(){
	var feed_id=$(this).data("id");//心情的id
	var delnode=$(this).parent().parent().parent().parent().parent();
	layer.confirm('确定删除该心情吗？', function(){ 
		  $.ajax({
		  type: "GET",
		  url: "{url('index/delfeed')}",
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
</script>
<script>
//转发
$(document).on('click', '.repost_feed',function(){
	var id=$(this).data('id');
	var url=$(this).data('url');
	url+="&id="+id;
    var i=$.layer({
        type: 2,
        title: '转发心情',
        shadeClose: false, //开启点击遮罩关闭层
        area : ['560px' , '360px'],
        offset : ['260px', '50%'],
        iframe: {src: url}
    });
});

$(document).on('click', '.mem_feed_tabs li',function(){
	//alert($(this).index());data-filter
	var now=$('a',this);
	var type=$('a',this).data('type');
	var name=$('a',this).data('name');
	var loading=$('#show_feed_loading');
	var now_name= $(".result").html();
	var now_type=$(".result").data("type");
	loading.show();
	 
	$(".mem_left .mem_feed_con").remove();
	//alert(type);
	  $.ajax({
		  type: "POST",
		  url: "{url('index/loadWater')}",
		  data: {
			  type: type,
		  },
			 success: function (data) {
					//如何显示数据
				 setTimeout(function(){
					 loading.hide();
					 now.attr("data-name",now_name);
					 now.attr("data-type",now_type);
					 now.html(now_name);
					 $(".result").html(name);
					 $(".result").attr("data-type",type);
					$('#mem_show_water').before(data);
				 
					 },400)
			
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});	
})
</script>

{include file="footer"}