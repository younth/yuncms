
  <div class="mem_feed_jiantou_a" style="right: 25px;">
      <span class="mem_jia_back" style="">◆</span><span  class="mem_jia_border" style="color: #e6e6e6;">◆</span>
   </div>
        <div class="mem_comlist" style="width: 400px; height: auto; float:left; border-bottom: none; ">
            <textarea id="post_reply_{$id}" class="emotion_{$id} mem_com_textarea" data-name={$comment_uname}></textarea>
            <h3>
  <span class="mem_feed_face"><a href="javascript:;" id="face_{$id}" ></a></span>
  <a class="mem_com_submit" style="color:#ffffff" href="javascript:" onclick="postReply('{$id}','{$oid}')">评论</a>
            </h3>
    <script type="text/javascript">
		// 绑定表情
		$('#face_{$id}').SinaEmotion($('.emotion_{$id}'),'{$id}');
    </script>
        <div id="show_reply_error_{$id}" class="showerror" ></div>
        </div>