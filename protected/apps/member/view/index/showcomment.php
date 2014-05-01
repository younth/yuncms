<div class="mem_feed_jiantou_a" style="right: 48px;">
       <span class="mem_jia_back">◆</span><span  class="mem_jia_border" style="color: #f9f9f9;">◆</span>
   </div>
 
       {if $total!=0}
       {loop $result $_k $_v}
           {if $_v['feed_type']==3}
        
    <div class="mem_comlist" >
        <div class="mem_comlist_a" >        
            <a href="{url('profile/user',array('id'=>$_v['membermid']['id']))}"><img width="40px" src="{$_v['avatar']}" /></a>
        </div>
<div class="mem_comlist_b">
    <a href="{url('profile/user',array('id'=>$_v['membermid']['id']))}">{$_v['membermid']['uname']}</a>回复<a href="{url('profile/user',array('id'=>$_v['memberfmid']['id']))}">{$_v['memberfmid']['uname']}</a>:{$_v['feed_content']}
  ({timeshow($_v['ctime'])})
    <h4 style="text-align: right;"><a href="javascript:void(0)" onclick="showReply({$_v['id']},'{$url_showreply}')">回复</a></h4>
    </div> 
        <div class="mem_feed_jiantou" mem_feed_jiantou id="feed_reply_{$_v['id']}" style=" width: 400px; height: auto; float:right; background: #e6e6e6; display: none ">
            </div>
    </div>
 {else}
<div class="mem_comlist">
        <div class="mem_comlist_a">        
            <a href="{url('profile/user',array('id'=>$_v['membermid']['id']))}"> <img width="40px" src="{$_v['avatar']}" /></a>
        </div>
                <div class="mem_comlist_b">
    <a href="{url('profile/user',array('id'=>$_v['membermid']['id']))}">{$_v['membermid']['uname']}</a>:&nbsp;{$_v['feed_content']}
    <h4 style="text-align: right;">
    
         {if $_v['membermid']['id']==$auth['id']}
        <a href="javascript:" class='delcomment' data-id={$_v['id']} data-oid={$_v['oid']}>删除</a>
        {else}
        <a href="javascript:void(0)" onclick="showReply({$_v['id']},'{$url_showreply}')">回复</a>
        {/if}
    
    </h4>
    </div>
            
             <div class="mem_feed_jiantou" mem_feed_jiantou id="feed_reply_{$_v['id']}" style=" width: 400px; height: auto; float:right; background: #e6e6e6; display: none ">
            </div>
    </div>
  {/if}
 {/loop}
 {if $total>10}
       <a href="#">共{$total}条评论，查看剩余的{$remain}条</a>{/if}
        {/if}
<div class="mem_comlist"  style="border-bottom: none;"  id="show_new_comment_{$id}">
            <textarea id="post_comment_{$id}" class="emotion_{$id} mem_com_textarea"></textarea>
    <h3>
    <span class="mem_feed_face"><a href="javascript:void(0);" id="face_{$id}" ></a></span>
    <a class="mem_com_submit" href="javascript:" onclick="postComment('{$id}')" style="color:#ffffff;">评论</a>
  
    </h3>
    <script type="text/javascript">
		// 绑定表情
		$('#face_{$id}').SinaEmotion($('.emotion_{$id}'),'{$id}');
    </script>
    
        <div id="show_com_error_{$id}" class="showerror"></div>
        </div>
        
     <script>
//删除自己的评论
$(document).on('click','.delcomment',function(){
	var feed_id=$(this).data("id");//心情的id
	var oid=$(this).data("oid");//原来的id
	var delnode=$(this).parent().parent().parent();
	layer.confirm('确定删除该评论吗？', function(){ 
		  $.ajax({
		  type: "GET",
		  url: "{url('index/delfeed')}",
		  data: {
			id: feed_id,
			oid:oid,
		  },
			 success: function (data) {
				//评论数减一应该ajax体现
				layer.msg('删除评论成功！',1,-1);
				delnode.remove();
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});

	});
	
});
</script>