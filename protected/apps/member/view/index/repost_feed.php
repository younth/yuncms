<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>
<link href="__PUBLICAPP__/css/main.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/emotions/css/emotion.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/emotions/css/jquery.sinaEmotion.css" />
<title>转发</title>
<script type="text/javascript" src="__PUBLIC__/emotions/js/jquery.sinaEmotion.js"></script>
</head>
<body>
<div class="transpondMain">
      <p class="g6">
        <span class="b" id="src-name">{$result['member']['uname']}:</span>
		<span id="span-content">{$result['feed_content']}</span>
		{if $photo}
		<span class="icon16 icon16-photo" id="pic_url_icon" style="display: inline-block;"></span>
		{/if}
      </p>
</div>
<div class="transTextarea">
	<div class="mem_post_feed repost_t">
         <h3>
             
             <span id="remain_num">你还可以输入<strong>140</strong>字</span>
         </h3>
         <br/>
    <textarea  id="repost_feed" class="textarea emotion_0"></textarea>
    <div class="mem_post_feed_icon">
        <span>
        <p class="g6 cmt-to-person">
            <input type="checkbox">
            <label class="checkbox g3">同时评论给{$result['member']['uname']}</label>
          </p>
            <span class="mem_feed_face"><a id="face_1" href="javascript:;"></a>
            </span>
			<script type="text/javascript">$('#face_1').SinaEmotion($('.emotion_0'),'0');</script>
            <span style="display:none;" class="showerror"></span>
        </span>
        <a  href="javascript:" class="mem_feed_submit">转发</a>
    </div>
    
    <span style="display:none;" id="post_msg_wait"></span>
     </div>     
</div>
<script>
	//ajax转发心情
$(function(){
	$("#repost_feed").focus().addClass('focus');//转发获得焦点
	$(document).on('click','.mem_feed_submit',function(){
		var content=$("#repost_feed").val();
		if(content==""){$(".showerror").show().html("内容不能为空");}
		var feed_id={$result['id']};
		var oid={$result['oid']};
		var fmid={$result['fmid']};
		//转发
		  $.ajax({
			  type: "POST",
			  url: "{url('index/repost_feed')}",
			  data: {
				content: content,
				feed_id:feed_id,
				oid:oid,
				fmid:fmid,
			  },
				 success: function (data) {
					 //alert(data);
					var i = parent.layer.getFrameIndex(window.name);
					layer.msg('转发心情成功~',1,-1);	
					//延迟执行
					setTimeout(function(){
							parent.layer.close(i);
						}, 500);					
				
				},
				  error: function (msg) {
						alert(msg);
				  }
			});
			
	});
})

</script>
</body>
</html>