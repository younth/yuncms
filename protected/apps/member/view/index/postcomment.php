<div class="mem_comlist">
        <div class="mem_comlist_a">        
            <a href="{url('profile/user',array('id'=>$result['member']['id']))}"> <img width="40px" src="{$result['avatar']}" /></a>
        </div>
                <div class="mem_comlist_b">
    <a href="{url('profile/user',array('id'=>$result['member']['id']))}">{$result['member']['uname']}</a>:{$result['feed_content']}
    <h4 style="text-align: right;"><a href="javascript:void(0)" onclick="showReply({$result['id']},'{$url_showreply}')">回复</a></h4>
    </div>
            
             <div class="mem_feed_jiantou" mem_feed_jiantou id="feed_reply_{$result['id']}" style=" width: 400px; height: auto; float:right; background: #e6e6e6; display: none ">
            </div>
    </div>
              