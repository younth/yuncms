<div class="mem_feed_jiantou_a" style="right: 48px;">
       <span class="mem_jia_back">◆</span><span  class="mem_jia_border" style="color: #f9f9f9;">◆</span>
   </div>
 
       {if $total!=0}
       {loop $result $_k $_v}

<div class="mem_comlist">
        <div class="mem_comlist_a">        
            <a href="{url('profile/user',array('id'=>$_v['membermid']['id']))}"> <img width="40px" src="{$_v['avatar']}" /></a>
        </div>
                <div class="mem_comlist_b">
    <a href="{url('profile/user',array('id'=>$_v['membermid']['id']))}">{$_v['membermid']['uname']}</a>:&nbsp;{$_v['feed_content']}
    <h4 style="text-align: right;">
    
         {if $_v['membermid']['id']==$auth['id']}
        <a href="javascript:" class='delcomment' data-id={$_v['id']} data-oid={$_v['oid']} data-url={url('index/delfeed')}>删除</a>
        {else}
        <a href="javascript:void(0)" click="showReply({$_v['id']},'{$url_showreply}')" data-id={$_v['id']} data-oid={$id}  data-name="{$_v['membermid']['uname']}" class="comment_reply">回复</a>
        {/if}
    
    </h4>
    </div>
    </div>
 {/loop}
 {if $total>10}
       <a href="#">共{$total}条评论，查看剩余的{$remain}条</a>{/if}
        {/if}
<div class="mem_comlist"  style="border-bottom: none;"  id="show_new_comment_{$id}">
            <textarea id="post_comment_{$id}" class="emotion_{$id} mem_com_textarea"></textarea>
    <h3>
  
    <input type="checkbox" class="checkbox send-micro-blog" ><label class="checkbox g9">同时转发到我的状态</label>
    
    <a class="mem_com_submit" href="javascript:" onclick="postComment('{$id}')" style="color:#ffffff;" data-type=1>发布</a>
    <span class="mem_feed_face"><a href="javascript:void(0);" id="face_{$id}" ></a></span>
    </h3>
    <script type="text/javascript">
		// 绑定表情
		$('#face_{$id}').SinaEmotion($('.emotion_{$id}'),'{$id}');
    </script>
    
        <div id="show_com_error_{$id}" class="showerror"></div>
        </div>