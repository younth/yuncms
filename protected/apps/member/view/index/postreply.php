<div class="mem_comlist">
        <div class="mem_comlist_a" >        
            <img width="40px" src="http://6.f1.dajieimg.com/group1/M00/38/00/CgpAmVKd2guAMAlrAAAAoLwQons885s.jpg" />
        </div>
<div class="mem_comlist_b">
    <a href="#">{$result['membermid']['uname']}</a>回复<a href="#">{$result['memberfmid']['uname']}</a>:{$result['feed_content']}</h4>
    <h4  style="text-align: right;"><a href="javascript:void(0)" onclick="showReply({$result['id']},'{$url_showreply}')">回复</a></h4>
    </div> 
        <div class="mem_feed_jiantou" mem_feed_jiantou id="feed_reply_{$result['id']}" style=" width: 400px; height: auto; float:right; background: #e6e6e6; display: none ">
            </div>
    </div>