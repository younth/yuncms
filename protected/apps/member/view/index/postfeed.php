
<div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="#" target="_blank"><img src="{$data_org['avatar']}"></a></div>
    <h3><a href="">{$data_org['member']['uname']}</a></h3>
    <h3>{dobadword($data_org['feed_content'])}</h3>
   {if $picture}<h3>
        <a href="{$path}{$picture['url']}" onClick="return hs.expand(this)"><img  title="点击查看大图" alt="" src="{$path}{$picture['thumb_url']}"  class="zoom"/></a>
     </h3>
   {/if}
    <h3>      
        <span class="mem_timeshow">{timeshow($data_org['ctime'])}</span>
    <div id="feed_zan_num_{$data_org['id']}"  style="float: right;">
        <span  id="msg_zan_num_{$data_org['id']}">
        {if $data_org['member']['id']==$auth['id']}
        <a href="javascript:" class='delfeed' data-id={$_v['id']}>删除</a><span class="dot-middle">.</span>
        {/if}
        <a href="javascript:void(0)" onclick="feedZan({ $data_org['id']},'{$url_zan}')" > 赞</a>&nbsp;
        </span>
        <a href="javascript:void(0)" onclick="showComment({$data_org['id']},'{$url_showcomment}')">评论</a>&nbsp;
        
        
        <a href="javascript:void(0)" onclick="showRepost({$data_org['id']},'{$url_showrepost}')">转发</a>
    </div>
         <div class="mem_feed_jiantou" style=" display: none; height: auto; float: left;" id="feed_comment_{$data_org['id']}">
                <div style="width: 100%; height: auto; display: none; text-align: center; " id="comment_wait_{$data_org['id']}">
                    <img  height="10px" src="__PUBLIC__/member/images/mem_loading.gif"/>
                </div>
            </div>
     </h3>
</div>


