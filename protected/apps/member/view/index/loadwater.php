{loop $result $_k $_v}
    {if $_v['feed_type']==0}
    
<div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank"><img src="{$_v['avatar']}"></a></div>
        <h3><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank">{$_v['member']['uname']}</a>:&nbsp;&nbsp;{dobadword($_v['feed_content'])}</h3>
      
    {if !empty($_v['pic'])}<h3>
        <a href="{$path}{$_v['pic']['url']}" onClick="return hs.expand(this)"><img  title="点击查看大图" alt="" src="{$path}{$_v['pic']['thumb_url']}" class="zoom"/></a>
     </h3>
   {/if}
        <h3>
            <span class="mem_timeshow">{timeshow($_v['ctime'])}</span>
            <div id="feed_zan_num_{$_v['id']}" style="float: right;">
        <span  id="msg_zan_num_{$_v['id']}" >
         {if $_v['member']['id']==$auth['id']}
        <a href="javascript:" class='delfeed' data-id={$_v['id']}>删除</a><span class="dot-middle">.</span>
        {/if}
        {if $_v['is_zan']==1}
        <a href="javascript:void(0)" onclick="feedLoseZan({$_v['id']},'{$url_losezan}')" style="color:#999;"><span  class="digg">已赞</span>{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {else}
        <a href="javascript:void(0)" onclick="feedZan({$_v['id']},'{$url_zan}')" > 赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {/if}&nbsp;
        </span>
       &nbsp; <a href="javascript:void(0)" onclick="showComment({$_v['id']},'{$url_showcomment}')">评论{if $_v['comment_count']!=0} ({$_v['comment_count']}){/if}</a>&nbsp;&nbsp;
        <a href="javascript:void(0)" data-id={$_v['id']} class="repost_feed">转发{if $_v['repost_count']!=0} ({$_v['repost_count']}){/if}</a>
    </div>
        <div class="mem_feed_jiantou" id="feed_comment_{$_v['id']}">
               <!-- 显示评论 -->
         </div>
        </h3>
    </div>

    
</div>
    {else}
    <div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank"><img src="{$_v['avatar']}"></a></div>
        <h3><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank">{$_v['member']['uname']}</a></h3>
        <h3>{$_v['feed_content']}</h3>
        <div class="mem_feed_jiantou">
            <div class="mem_feed_jiantou_a"><span class="mem_jia_back">◆</span><span  class="mem_jia_border">◆</span></div>
        <h4><a href="{url('profile/user',array('id'=>$_v['org_info']['member']['id']))}" target="_blank"">{$_v['org_info']['member']['uname']}</a></h4>
        <h3>{dobadword($_v['org_info']['feed_content'])}</h3>
            {if !empty($_v['org_info']['pic'])}<h3>
                 <a rel="example_group" href="{$_v['org_info']['pic']['url']}"><img  title="点击查看大图" alt="" src="{$_v['org_info']['pic']['thumb_url']}" /></a>
     </h3>
   {/if}
            <span class="mem_timeshow">{timeshow($_v['org_info']['ctime'])}</span>
            <div style="float: right;">
            <!-- 这是什么呢 -->
        <a href="javascript:"> 赞{if $_v['org_info']['praise_count']!=0}({$_v['org_info']['praise_count']}){/if}</a>&nbsp;
        <a href="javascript:">评论{if $_v['org_info']['comment_count']!=0}({$_v['org_info']['comment_count']}){/if}</a>&nbsp;
        <a href="javascript:">转发{if $_v['org_info']['repost_count']!=0}({$_v['org_info']['repost_count']}){/if}</a>
         </div>
        </h3>
            </div>       
    <h3>
            <span class="mem_timeshow">{timeshow($_v['ctime'])}</span>
    <div id="feed_zan_num_{$_v['id']}" style="float: right;">
        <span  id="msg_zan_num_{$_v['id']}">
        {if $_v['member']['id']==$auth['id']}
        <a href="javascript:" class='delfeed' data-id={$_v['id']}>删除</a><span class="dot-middle">.</span>
        {/if}
        {if $_v['is_zan']==1}
        <a href="javascript:void(0)" onclick="feedLoseZan({$_v['id']},'{$url_losezan}')" > 取消赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {else}
        <a href="javascript:void(0)" onclick="feedZan({$_v['id']},'{$url_zan}')" > 赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {/if}<span class="dot-middle">.</span>
        </span>
       <a href="javascript:void(0)" onclick="showComment({$_v['id']},'{$url_showcomment}')">评论{if $_v['comment_count']!=0} ({$_v['comment_count']}){/if}</a><span class="dot-middle">.</span>
        <a href="javascript:void(0)" click="showRepost({$_v['id']},'{$url_showrepost}')" class="repost_feed">转发{if $_v['repost_count']!=0} ({$_v['repost_count']}){/if}</a>
     </div>
     <div class="mem_feed_jiantou" style=" display: none; height: auto; float: left; background: #f9f9f9;" id="feed_comment_{$_v['id']}">
                <div style="width: 100%; height: auto; display: none; text-align: center; " id="comment_wait_{$_v['id']}">
                    <img  height="10px" src="__PUBLIC__/member/images/mem_loading.gif"/>
                </div>
            </div>
        </h3>
       
</div>
</div>
    {/if}
{/loop}