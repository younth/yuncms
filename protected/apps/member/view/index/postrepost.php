<div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="#" target="_blank"><img src="http://6.f1.dajieimg.com/group1/M00/38/00/CgpAmVKd2guAMAlrAAAAoLwQons885s.jpg"></a></div>
        <h3><a href="">{$result['member']['uname']}</a></h3>
        <h3>{$result['feed_content']}</h3>
        <div class="mem_feed_jiantou">
            <div class="mem_feed_jiantou_a"><span class="mem_jia_back">◆</span><span  class="mem_jia_border">◆</span></div>
        <h4><a href="#">{$result['org']['member']['uname']}</a></h4>
        <h3>{dobadword($result['org']['feed_content'])}</h3>
            {if $result['pic']}
        <h3>
     <img src="{$result['pic']['thumb_url']}" />  </h3>
        {/if}
        <h3>
            <span class="mem_timeshow">{timeshow($result['org']['ctime'])}</span>
            <div style="float: right;">
        <a href="#"> 赞</a>&nbsp;
        <a href="#">评论</a>&nbsp;
        <a href="#">转发</a>
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