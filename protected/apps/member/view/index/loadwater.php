{loop $result $_k $_v}
    {if $_v['feed_type']==0}
<div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank"><img src="{$_v['avatar']}"></a></div>
        <h3><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank">{$_v['uname']}</a>:&nbsp;&nbsp;{dobadword($_v['feed_content'])}</h3>
      
    {if !empty($_v['pic'])}
    <h3>
        <a href="{$path}{$_v['pic']['url']}" onClick="return hs.expand(this)"><img  title="点击查看大图" alt="" src="{$path}{$_v['pic']['thumb_url']}" class="zoom"/></a>
     </h3>
   {/if}
        <h3>
            <span class="mem_timeshow">{timeshow($_v['ctime'])}</span>
            <div id="feed_zan_num_{$_v['id']}" style="float: right;">
        <span  id="msg_zan_num_{$_v['id']}" >
         {if $_v['mid']==$auth['id']}
        <a href="javascript:" class='delfeed' data-id={$_v['id']} data-url={url('index/delfeed')}>删除</a><span class="dot-middle">.</span>
        {/if}
        {if $_v['is_zan']==1}
        <a href="javascript:void(0)" onclick="feedLoseZan({$_v['id']},'{$url_losezan}')" style="color:#999;"><span  class="digg">已赞</span>{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {else}
        <a href="javascript:void(0)" onclick="feedZan({$_v['id']},'{$url_zan}')" > 赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {/if}&nbsp;
        </span>
       &nbsp; <a href="javascript:void(0)" onclick="showComment({$_v['id']},'{$url_showcomment}')">评论{if $_v['comment_count']!=0} ({$_v['comment_count']}){/if}</a>&nbsp;&nbsp;
        <a href="javascript:void(0)" data-id={$_v['id']} data-url={$url_repost_feed} class="repost_feed">转发{if $_v['repost_count']!=0} ({$_v['repost_count']}){/if}</a>
    </div>
        <div class="mem_feed_jiantou" id="feed_comment_{$_v['id']}">
               <!-- 显示评论 -->
         </div>
        </h3>
    </div>

    
</div>
    {elseif $_v['feed_type']==2}
   	 <div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="{url('profile/user',array('id'=>$_v['mid']))}" target="_blank"><img src="{$_v['avatar']}"></a></div>
       <h3><a href="{url('profile/user',array('id'=>$_v['mid']))}" target="_blank">{$_v['uname']}</a>:&nbsp;&nbsp;{dobadword($_v['feed_content'])}</h3>
        <div class="mem_feed_jiantou show">
            <div class="mem_feed_jiantou_a"><span class="mem_jia_back">◆</span><span  class="mem_jia_border">◆</span></div>
        <h3><span class="yhstar"></span>
        <a href="{url('profile/user',array('id'=>$_v['org_info']['member']['id']))}" target="_blank">{$_v['org_info']['member']['uname']}</a>:&nbsp;&nbsp;{dobadword($_v['org_info']['feed_content'])}
        <span class="yhend"></span>
        <span class="originalBar">
          <a target="_blank" href="javascript:;" class="green">
          原文转发{if $_v['org_info']['repost_count']!=0}({$_v['org_info']['repost_count']}){/if}
          </a>|
          <a target="_blank" href="javascript:;" class="green">
          原文评论 {if $_v['org_info']['comment_count']!=0}({$_v['org_info']['comment_count']}){/if}
          </a>|
          <a target="_blank" href="javascript:;" class="green">
          原文赞{if $_v['org_info']['praise_count']!=0}({$_v['org_info']['praise_count']}){/if}
          </a>
        </span>
        </h3>
            {if !empty($_v['org_info']['pic'])}
            <h3>
     		        <a href="{$path}{$_v['org_info']['pic']['url']}" onClick="return hs.expand(this)"><img  title="点击查看大图" alt="" src="{$path}{$_v['org_info']['pic']['thumb_url']}" class="zoom"/></a>
     		
     		</h3>
  			 {/if}
            </div>       
    <h3>
            <span class="mem_timeshow">{timeshow($_v['ctime'])}</span>
    <div id="feed_zan_num_{$_v['id']}" style="float: right;">
        <span  id="msg_zan_num_{$_v['id']}">
        {if $_v['mid']==$auth['id']}
        <a href="javascript:" class='delfeed' data-id={$_v['id']} data-url={url('index/delfeed')}>删除</a><span class="dot-middle">.</span>
        {/if}
        {if $_v['is_zan']==1}
        <a href="javascript:void(0)" onclick="feedLoseZan({$_v['id']},'{$url_losezan}')" > 取消赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {else}
        <a href="javascript:void(0)" onclick="feedZan({$_v['id']},'{$url_zan}')" > 赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {/if}<span class="dot-middle">.</span>
        </span>
       <a href="javascript:void(0)" onclick="showComment({$_v['id']},'{$url_showcomment}')">评论{if $_v['comment_count']!=0} ({$_v['comment_count']}){/if}</a><span class="dot-middle">.</span>
     <a href="javascript:void(0)" data-id={$_v['id']} data-url={$url_repost_feed} class="repost_feed">转发{if $_v['repost_count']!=0} ({$_v['repost_count']}){/if}</a>
        
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
