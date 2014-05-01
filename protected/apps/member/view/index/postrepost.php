<script type="text/javascript">
		$(document).ready(function() {
                    $("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'none',
			});
                });
</script>
<div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="{url('profile/user',array('id'=>$result['member']['id']))}" target="_blank"><img src="{$result['avatar']}"></a></div>
        <h3><a href="{url('profile/user',array('id'=>$result['member']['id']))}">{$result['member']['uname']}</a></h3>
        <h3>{$result['feed_content']}</h3>
        <div class="mem_feed_jiantou">
            <div class="mem_feed_jiantou_a"><span class="mem_jia_back">◆</span><span  class="mem_jia_border">◆</span></div>
        <h4><a href="{url('profile/user',array('id'=>$result['org']['member']['id']))}">{$result['org']['member']['uname']}</a></h4>
        <h3>{dobadword($result['org']['feed_content'])}</h3>
            {if $result['pic']}
        <h3>
            <a rel="example_group" href="{$result['pic']['url']}"><img src="{$result['pic']['thumb_url']}" /> </a> </h3>
        {/if}
        <h3>
            <span class="mem_timeshow">{timeshow($result['org']['ctime'])}</span>
            <div style="float: right;">
                 <a href="#"> 赞{if $result['org']['praise_count']!=0}({$result['org']['praise_count']}){/if}</a>&nbsp;
        <a href="#">评论{if $result['org']['comment_count']!=0}({$result['org']['comment_count']}){/if}</a>&nbsp;
        <a href="#">转发{if $result['org']['repost_count']!=0}({$result['org']['repost_count']}){/if}</a>
            </div>
        </h3>
            </div>       
    <h3>
            <span class="mem_timeshow">{timeshow($result['ctime'])}</span>
    <div id="feed_zan_num_{$result['id']}" style="float: right;">
        <span  id="msg_zan_num_{$result['id']}"> 
       <a href="javascript:void(0)" onclick="feedZan({$result['id']},'{$url_zan}')" > 赞</a>&nbsp;
        </span>
       &nbsp; <a href="javascript:void(0)" onclick="showComment({$result['id']},'{$url_showcomment}')">评论</a>&nbsp;
        
        
       &nbsp; <a href="javascript:void(0)" onclick="showRepost({$result['id']},'{$url_showrepost}')" >转发</a>
     </div>
     <div class="mem_feed_jiantou" style=" display: none; height: auto; float: left; background: #f9f9f9;" id="feed_comment_{$result['id']}">
                <div style="width: 100%; height: auto; display: none; text-align: center; " id="comment_wait_{$result['id']}">
                    <img  height="10px" src="__PUBLIC__/member/images/mem_loading.gif"/>
                </div>
            </div>
        </h3>
       
</div>
</div>