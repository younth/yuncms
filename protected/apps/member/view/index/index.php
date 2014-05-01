{include file="header"}
<link href="__PUBLIC__/emotions/css/emotion.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/emotions/css/jquery.sinaEmotion.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/member/css/main.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script src="__PUBLICAPP__/js/main.js" type="text/javascript"></script>   
<script type="text/javascript" src="__PUBLIC__/emotions/js/jquery.sinaEmotion.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script type="text/javascript">
    //封面图效果
    hs.graphicsDir = "__PUBLIC__/images/graphics/";
    hs.showCredits = false;
    hs.outlineType = 'rounded-white';
    hs.restoreTitle = '关闭';
</script>
        

<!---获取链接的input---->
<div id="container_index">
<input type="hidden" value="0" id="iswater" />
<input type="hidden" value="{$url_postcomment}" id="com_url"/>
<input type="hidden" value="{$url_postfeed}" id="post_url" />
<input type="hidden" value="{$url_postreply}" id="reply_url" />
<input type="hidden" value="{$url_postrepost}" id="repost_url" />
<input type="hidden" value="{$url_loadwater}" id="water_url" />
<input type="hidden" value="{$url_mayknow}" id="mayknow_url" />
<div class="member_mian">
    <div class="member_mianbg">
        <div class="mem_left_all" id="mem_left_all">
        
   			<div class="ad" ><img src="__PUBLICAPP__/images/ad.jpg" /></div>
            
 <div class="mem_left pubfeed" id="index_publish">
     <div class="mem_post_feed">
         <h3>
             <strong>分享动态</strong>
             <span  id="remain_num">你还可以输入<strong>140</strong>字</span>
         </h3>
    <textarea class="textarea emotion_0" cols="58" rows="4" id='post_feed'  onkeydown='keyMsg(event)' data-content="向朋友分享你的新动态"></textarea>
    <div class="mem_post_feed_icon">
        <span>
            <span class="mem_feed_face"><a href="javascript:void(0);" id="face_0" ></a>
            </span>
            <span class="mem_feed_pic">
            <a href="javascript:void(0);" id="pic_show_link" onclick="showPic('{$url_showpic}')" ></a>
            </span>
            <span class="showerror"  style="display:none;"></span>
        </span>
        <a class="mem_feed_submit"  href="javascript:void(0)" onclick="postFeed()">发表</a>
    </div>
    
    <span id="post_msg_wait" style="display:none;"></span>
     </div>
</div>
<script type="text/javascript">
		// 绑定表情
		$('#face_0').SinaEmotion($('.emotion_0'),'0');
</script>
<div class="mem_left">
    <div class="mem_feed_con_head" id="show_new_feed">
        <em class="icons"></em><h3>新鲜事</h3>
        <div class="mem_feed_box">
                            <p data-filter="" class="result">{$feed_fiter}</p> <em class="pointer"></em>
                            <ul class="mem_feed_tabs">
                                <li style="display:none;">
                                    <a data-filter="" href="/feed/list">全部</a>
                                </li>
                                <li>
                                    <a data-filter="watch" href="/feed/list?filter=watch">联系人</a>
                                </li>
                                <li>
                                    <a data-filter="corpIndex" href="/corpfeed/list?filter=corpIndex">公司</a>
                                </li>
                                <li>
                                    <a data-filter="me" href="/feed/list?filter=me">我的新鲜事</a>
                                </li>
                            </ul>
                        </div>
    </div>
{loop $result $_k $_v}
    {if $_v['feed_type']==0}
    
<div class="mem_feed_con">
    <div class="feedlayout mem_clearfix">
        <div class="absolute pic"><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank"><img src="{$_v['avatar']}"></a></div>
        <h3><a href="{url('profile/user',array('id'=>$_v['member']['id']))}" target="_blank">{$_v['member']['uname']}</a>:&nbsp;&nbsp;{dobadword($_v['feed_content'])}</h3>
      
    {if !empty($_v['pic'])}<h3>
        <a href="{$_v['pic']['url']}" onClick="return hs.expand(this)"><img  title="点击查看大图" alt="" src="{$_v['pic']['thumb_url']}" class="zoom"/></a>
     </h3>
   {/if}
        <h3>
            <span class="mem_timeshow">{timeshow($_v['ctime'])}</span>
            <div id="feed_zan_num_{$_v['id']}" style="float: right;">
        <span  id="msg_zan_num_{$_v['id']}"> 
        {if $_v['is_zan']==1}
        <a href="javascript:void(0)" onclick="feedLoseZan({$_v['id']},'{$url_losezan}')" > 取消赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {else}
        <a href="javascript:void(0)" onclick="feedZan({$_v['id']},'{$url_zan}')" > 赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {/if}&nbsp;
        </span>
       &nbsp; <a href="javascript:void(0)" onclick="showComment({$_v['id']},'{$url_showcomment}')">评论{if $_v['comment_count']!=0} ({$_v['comment_count']}){/if}</a>&nbsp;&nbsp;
        <a href="javascript:void(0)" onclick="showRepost({$_v['id']},'{$url_showrepost}')" >转发{if $_v['repost_count']!=0} ({$_v['repost_count']}){/if}</a>
    </div>
        <div class="mem_feed_jiantou" id="feed_comment_{$_v['id']}">
               
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
        <a href="#"> 赞{if $_v['org_info']['praise_count']!=0}({$_v['org_info']['praise_count']}){/if}</a>&nbsp;
        <a href="#">评论{if $_v['org_info']['comment_count']!=0}({$_v['org_info']['comment_count']}){/if}</a>&nbsp;
        <a href="#">转发{if $_v['org_info']['repost_count']!=0}({$_v['org_info']['repost_count']}){/if}</a>
         </div>
        </h3>
            </div>       
    <h3>
            <span class="mem_timeshow">{timeshow($_v['ctime'])}</span>
    <div id="feed_zan_num_{$_v['id']}" style="float: right;">
        <span  id="msg_zan_num_{$_v['id']}"> 
        {if $_v['is_zan']==1}
        <a href="javascript:void(0)" onclick="feedLoseZan({$_v['id']},'{$url_losezan}')" > 取消赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {else}
        <a href="javascript:void(0)" onclick="feedZan({$_v['id']},'{$url_zan}')" > 赞{if $_v['praise_count']!=0} ({$_v['praise_count']}){/if}</a>
        {/if}&nbsp;
        </span>
       &nbsp; <a href="javascript:void(0)" onclick="showComment({$_v['id']},'{$url_showcomment}')">评论{if $_v['comment_count']!=0} ({$_v['comment_count']}){/if}</a>&nbsp;&nbsp;
        <a href="javascript:void(0)" onclick="showRepost({$_v['id']},'{$url_showrepost}')" >转发{if $_v['repost_count']!=0} ({$_v['repost_count']}){/if}</a>
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
<div class="mem_feed_con" id="mem_show_water" style="display: none">
</div>
</div>
    </div>
        <div class="mem_right_all">
            <div class="mem_right">
                <div class="mem_right_head">可能认识的人
                    
                    <a id="chang_may_know" onclick="memMayKnow()" class="mem_right_change" title="换一换" href="javascript:void(0);"></a>
                </div>
                <div class="mem_right_con" id="mem_mayknow">
                    
                </div>
            </div>
        </div>
</div>
<!---显示图片框的div-->
<div class="mem_pic_frame" id="show_pic_frame" style="">
    <div class="mem_feed_jiantou_a" style="margin-top:-8px; left: 7px;">
       <span class="mem_jia_back">◆</span><span  class="mem_jia_border" style="color: #e7e7e7;">◆</span>
   </div>
    <div class="show_repost_head" style="width:250px;" >
        上传图片
    <a href="javascript:void(0);" class="close_repost" onclick="closePic()">×</a>
    </div>
    <div class="mem_pic_con" id="show_pic_con">
    </div>
</div>
<!---显示转发框的div-->
<div class="show_repost" id="show_repost" style="display:none;">
</div>
<div class="show_repost_con" id="show_repost_con" style="display:none;">
    <div class="show_repost_head">
        转发动态
    <a href="javascript:void(0);" class="close_repost" onclick="closeRepost()">×</a>
    </div>
    <div id="show_repost_a" style="float: left">
    </div>
 </div>
</div>
{include file="footer"}