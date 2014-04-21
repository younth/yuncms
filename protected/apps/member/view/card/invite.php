 {include file="header"}
 <link href="__PUBLICAPP__/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
 <link href="__PUBLIC__/company/css/company.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/card.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/member/css/aboutme.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/member/css/invite.css" media="screen" rel="stylesheet" type="text/css" />
<div id="dj-content-wrap" class="dj-content-wrap dj-networks clearfix">
    <div class="dj-content-inner">
                <div class="dj-sub-title">
                    <h2>人&nbsp;脉<em>CONTACT</em></h2>
                </div>
            <div class="dj-content-shadow">
<div id="content">
<div id="maincolumn">
        <div id="content">
    <div class="nav2-box">
        <ul class="nav2">
            <li><a href="{url('card/index')}"><span>我的联系人</span></a></li>
            <li><a href="{url('card/search')}"><span>找人</span></a></li>
            <li class="selected"><a href="{url('card/invite')}"><span>邀请好友</span></a></li>
        </ul>
    </div>
            <div class="page-main">
                

				<div class="profile-edit">
        <h2>
            <span>
             
            </span> <em></em> <i class="yahei">复制链接邀请好友</i>
        </h2>
        <div class="about-me-wrap">
            <p class="tips">复制以下链接，通过QQ或MSN发送给好友，让大家一起来体验91频道吧！</p>
            <div class="i_copy_way">
      <input class="i_copy_link"  value="{url('default/index/index')}" type="text" readonly="">
      <div class="i_copylink_btn"><a href="javascript:void(0);" >复制邀请链接</a></div>
    </div>
            
        </div>
    </div>
                
                
            </div>
            <!-- 内容结束 -->
        </div>
</div>
</div>

            </div>
    </div>
</div>
<script>
$(function(){
  $(".i_copylink_btn").click(function(){
    var Url=$("#yao_txt").text();
    copyToClipboard(Url);
 });
});
</script>

 {include file="footer"}