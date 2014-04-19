{include file="header"}
<link href="__PUBLIC__/member/css/my_file.css" media="screen" rel="stylesheet" type="text/css" />

<div id="container_index">
  <div class="dj-content-shadow"> 
     <!-- 上传头像 -->
    <div id="upload_avatar_root"> </div>
    <div id="content">
      <div class="wrap clearfix other"> 
        <!-- 右侧 -->
        <div class="right">
          <div class="rigth-inner">
            <div id="J_visited" class="pannel">
              <div class="content visited-mod-content">
                <div class="hd">最近来访</div>
                <ul class="visited-list">
                 {loop $visit $key $vo}
                      <li>
                      <a nocardtips="true" href="{url('profile/user',array('id'=>$vo['id']))}" target="_blank" class="head"><img with="30" height="30" src="{$vo['avatar']}" alt=""></a>
                        <div class="info">
                          <p class="name"><a href="{url('profile/user',array('id'=>$vo['fid']))}" nocardtips="true" target="_blank" title="{$vo['uname']}">{$vo['uname']}</a></p>
                          <p><span title="{$vo['school']} · {$vo['major']}">{$vo['school']} · {$vo['major']}</span></p>
                        </div>
                        <em class="time">{date($vo['ctime'],m-d)}</em>
                     </li>
              {/loop}
                </ul>
                </ul>
                <p class="ft more-box"><a href="#" nocardtips="true" target="_blank">查看详情</a></p>
              </div>
            </div>
            <div id="J_othervisited" class="pannel"> </div>
            
            <!-- 最近来访 --> 
          </div>
        </div>
        <!-- 左侧 -->
        <div class="left">
          <div id="profile-guide"></div>
          <!-- 个人信息 -->
          <div class="pf-info-wrap">
            <div class="pf-info">
              <div class="pf-hd">  <img width="180" height="180" src="{$big}" alt=""></div>
              <div class="pf-bd">
                <div class="name-box">
                  <h2 class="pf-name"> {$info['uname']}</h2>
                </div>
                <div class="post-info">
                  <p class="post"> <span>{$info['major']}</span> <span>{$info['school']}</span> </p>
                  <p>学历 : {$edu}</p>
               	  <p>现居：{$info['city']}</p>
                  <p>籍贯：{$info['location']}</p>
                </div>
               <div class="btn-box">
               <!-----判断是否是好友--->
               
              
               {if $card==1}<!--接受邀请-->
               <a  href="javascript:" id="{$info['id']}"  class="dj-btn-agree change-card-accepted"></a>
                  <!---->
            {elseif $card==2}<!--发送私信-->
            <a href="javascript:"  class="dj-btn-send-mail" uid={$info['id']}></a>
            {elseif $card==3}<!--正在审核-->
            <a href="javascript:"  class="cardTips-tocarded"></a>
            {else}
             <a  href="javascript:" id="{$info['id']}"  class="dj-btn-change-message"></a>
               {/if}
              <!-- 评价暂时不做-->
              <!-- <a style="" id="appraise-mini-entrance" href="#" class="eva-invite-btn eva-invite-btn-male J_evaGiveBtn">给他评价</a>
        	<span id="eva-people-num"><span>0</span>人评价</span>-->
			</div>

               
              </div>
              <div class="pf-insignia"> <a href="http://www.dajie.com/profile/integrity/index" class="insignia mark100-gray" titles="完善档案即可点亮">不到100</a> </div>
            </div>
            <div class="pf-contacts">
              <div class="plain-bar"><a href="#contact"><span  class="slide-btn-connect ">联系方式</span> </a></div>
            </div>
          </div>
          <!-- 个人信息结束 -->
          <div id="left-widget-zone">
            <div class="content-box" id="dj-widget-personal-feed" style="">
              <div class="hd">
                <div class="title">
                    <h3>个人动态</h3>
                </div>
                
              </div>
              <div class="bd">
                <div class="feed-content" id="feedContent" style="height: 127px;">
                  <div id="feed">
                    <div class="show_feed_loading" id="show_feed_loading"> <img src=""> </div>
                    <div id="feed-wrapper" class="comment">
                      <ul id="feed-list">
                        <li id="li-128712673" minfeedid="128712422" maxfeedid="128712673" class="f-item clearfix" feedtype="10">
                          <div class="feedLayout clearfix">
                            <div class="pic absolute"> <a target="_blank" href="http://www.dajie.com/profile/29573604?f_fid=128712673&amp;f_type=10&amp;f_actorId=29573604&amp;f_category=userminifeed&amp;f_view=0"><img src="http://5.f1.dajieimg.com/n/avatar/T1mQYTB_bv1RXrhCrK_s.jpg"></a> </div>
                            <div class="topic clearfix">
                              <p class="large"> <a target="_blank" class="b" href="">{$auth['uname']}</a>：
                                
                                
                                
                                测试 </p>
                            </div>
                            <p class="contralBar"> <span class="floatright"> <a class="green del-f" data-index="false" data-id="128712673" href="javascript:void(0)">删除</a> <span class="dot-middle">.</span><a class="green favor-f" data-num="" data-id="128712673" data-type="micro_blog" href="javascript:void(0)">赞</a><span class="favor-num" data-id="128712673" data-type="micro_blog"></span> <span class="dot-middle">.</span> <a class="green forward-f" href="javascript:void(0)" data-id="128712673">转发 <span rel="0" id="128712673-cnt"></span> </a> </span> <span class="g9">5分钟前</span> </p>
                            <div class="reply-list">
                              <ul id="micro_blog-128712673-comments" class="list-box">
                              </ul>
                              <form method="post" id="micro_blog-128712673-form" action="/comment/create" >
                                <div class="reply-box replyNormal" id="micro_blog-128712673-replyarea">
                                  <ul>
                                    <li>
                                      <textarea name="displayContent" class="textarea g9 cmt" id="128712673-textarea" rel="128712673">添加评论...</textarea>
                                      <input type="hidden" value="" name="content">
                                      <div class="btn-box clearfix">
                                        <button type="submit" class="feedBtn send floatright active" id="128712673-btn">发布</button>
                                        <span onclick="show_face($(this), $('#micro_blog-128712673-form textarea'));" class="face-switch floatright"> <a href="javascript:void(0)"></a> </span>
                                        <input type="checkbox" class="checkbox send-micro-blog">
                                        <label class="checkbox g9">同时转发到我的状态</label>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </form>
                            </div>
                          </div>
                        </li>
                         
                      </ul>
                      
                    </div>
                  </div>
                </div>
                <a href="" class="slide-btn slide-down" hidefocus="true" style="display: block;"><span>查看更多</span></a> </div>
            </div>
              <div class="content-box" id="dj-widget-connection-appraise" style="">
              <div class="hd">
                <div class="title">
                  <h3>{if $info['sex']==1}他{else}她{/if}的专长</h3>
                </div>
              </div>
              
              
              <div class="record-bd" id="_bd">
                    <ul class="my-sp-other clearfix">
                    {loop $mytag $key $vo}
                            <li class="tagItem" tit="代码" tagid="8507">
                                <span class="my-label num-label" value="{$vo['name']}"><em class="J_more"></em><b class="J_hasWiki" value="{$vo['name']}" haswiki="true" title="">{$vo['name']}</b></span>
                            </li>
                       {/loop}    
                            
                            
                    </ul>
                <p class="edit-bar"></p>
            </div>   
            </div>
              
              
              
            <div class="content-box" id="aboutme" style="">
              <div class="hd">
                <div class="title">
                  <h3>档案资料</h3>
                </div>
              </div>
              <div class="bd">
                <input type="hidden" id="profile-gender" value="我">
                <!-- 关于我 -->
                <div class="record-content about-me ">
                  <div class="record-hd"> <em class="me"></em>
                    <h4>关于{if $info['sex']==1}他{else}她{/if}</h4>
                  </div>
                  <div class="record-bd line-bg">{$info['introduce']}
                     </div>
                </div>
                <!-- 我的专长 -->
                <!-- 教育经历 -->
                <div id="pf-edu-wrap" class="record-content exp-content ">
                  <div class="record-hd"><em class="edu"></em>
                    <h4>教育经历</h4>
                  </div>
                  <div class="record-bd edu-exp">
                    <dl class="exp-list" name="长沙理工大学" data-ids="0_13983450">
                      <dt>{date($info['start_time'],Y-m)}
                        至 {date($info['end_time'],Y-m)}</dt>
                      <dd>
                        <h4>{$info['major']}</h4>
                        <p class="ins-name"> <span>{$info['school']}·</span> <span>{$edu}</span> </p>
                        
                      </dd>
                    </dl>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <!-- 联系方式 -->
          <div class="contacts-info" id="contact">
            <dl>
              <dt>联系方式</dt>
              <dd> <em class="mobil"></em> <span>手机：</span> {$info['tel']}</dd>
              
              <dd> <em class="tencet"></em> <span>Q&nbsp;&nbsp;Q：</span> {$info['qq']}</dd>
           
              <dd> <em class="email"></em> <span>邮箱：</span>{$info['login_email']} </dd>
            </dl>
            <div class="photo"> <img src="{$middle}" alt=""> <em class="circle-mask"></em> </div>
             </div>
          <!-- 联系方式结束 --> 
        </div>
      </div>
    </div>

        <script>
        //添加联系人
		$(".dj-btn-change-message").click(function(){
			var $rece_id=$(this).attr("id");//接受人id
			var node=$(this);
			$.ajax({
			  url: "{url('card/send')}",
			  data: {
				id: $rece_id,
			  },
				 success: function (data) {
					//成功返回数据,不能用this
					  node.attr("class","cardTips-tocarded");
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});
			
		});
        //接受邀请
		$(".change-card-accepted").click(function(){
			var $send_id=$(this).attr("id");//申请人id
			var node=$(this);
			$.ajax({
			  url: "{url('card/accept')}",
			  data: {
				id: $send_id,
			  },
				 success: function (data) {
					//成功返回数据,不能用this
					  node.attr("class","dj-btn-send-mail");
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});
			
		});
		
//发送私信
$('.dj-btn-send-mail').on('click', function(){
    $.layer({
        type: 2,
        title: '发送私信',
        shadeClose: false, //开启点击遮罩关闭层
        area : ['560px' , '360px'],
        offset : ['260px', '540px'],
        iframe: {src: "{url('card/sendmsg',array('id'=>$info['id']))}"}
    });
});
		
</script>

{include file="footer"}