<div class="mem_repost">
    <h3>原文：</h3>
    <h3><strong><a href="#">{$result['member']['uname']}</a></strong>:"{$result['feed_content']}"</h3>
    <h3><textarea id="repost_content"  class='textarea emotion_repost'
                  style="width: 360px;"
                onfocus="this.style.borderColor='#FF6600'"
                onblur="this.style.borderColor='#7b7b7b'"
                  onkeydown='keyMsg(event)'></textarea></h3>
    <h3>
    <span class="mem_feed_face"><a href="javascript:void(0);" id="face_repost" ></a></span>
    <a class="mem_repost_submit" style="color:#ffffff" href="javascript:void(0)" onclick="postRepost({$result['id']})">转发</a>
    </h3>
    <script type="text/javascript">
		// 绑定表情
		$('#face_repost').SinaEmotion($('.emotion_repost'),'{$result["id"]}');
		
    </script>
</div>