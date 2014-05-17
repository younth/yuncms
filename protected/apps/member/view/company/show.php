 {include file="header"}
 <link href="__PUBLICAPP__/css/company.css" media="screen" rel="stylesheet" type="text/css" />

<div id="container_index" style="padding-top: 160px; background-attachment: scroll; background-image: url(__PUBLICAPP__/images/corp_bg.jpg); background-position: 50% 0%; background-repeat: no-repeat no-repeat;">
<div class="companyHead">
  <div class="companyNameLogo">
    <a href=""><img alt="{$corp['name']}" height="100" src="{$path}{$corp['logo']}" width="144"></a>
  </div>
  <div class="companyTitle">
    <div class="divCompanyTitlte clearfix">
      <h1 id="htext">{$corp['name']}</h1>
        <div class="divCompanyInfor">
          <span><em class="corp_follower_count">{$all_fans}</em>正在关注</span>
          {if $is_follow==1}
          <a id="corp_add_follower" class="abtnYgz" href="javascript:void(0);"></a>
          {else}
              <a id="corp_add_follower" class="abtngz" href="javascript:void(0);" onclick=""></a>
              {/if}
            
        </div>
    </div>
  </div>
  
 
</div>

<div class="content-company">
	<div class="main-company">

    <!-- 公司单页广告(左上) START -->
    <div class="ad_pig ad_id" id=""></div>
    <!-- 公司单页广告(左上) END   -->

     <div class="detail-main-company">
     <div class="pro-detail-company">
        <span class="cell-pro-detail">行业：<span title="{$corp['on_industry']}">{$corp['on_industry']}</span></span>
        <span class="cell-pro-detail">性质：{$quality}</span>
        <span class="cell-pro-detail">地区：<span title="{$corp['address']}">{$corp['address']}</span></span>
        <span class="cell-pro-detail">规模：{$scale}</span>
        <span class="cell-pro-detail">网址：{$corp['websites']}</span>
      </div>
 <p class="intro-detail-company">{$info}<span class="more-intro-detail">更多</span></p>
    </div>
  
  <div class="detail-show-company none" style="display: none;">
      <div class="pro-show-detail">
        <span class="cell-pro-detail">行业：{$corp['on_industry']}</span>
        <span class="cell-pro-detail">性质：{$quality}</span>
        <span class="cell-pro-detail">地区：{$corp['address']}</span>
        <span class="cell-pro-detail">规模：{$scale}</span>
        <span class="cell-pro-detail">网址：{$corp['websites']}</span>
        <div class="clear"></div>
      </div>
      <p class="intro-show-detail">{$corp['introduce']}<span class="less-intro-detail">收起</span></p>
    </div>
  
		<div class="blank_15px"></div>
		<div class="employ_1">
	<div class="htitle clearfix">
		<span>最新动态</span>
	</div>
	<div class="employBody" id="employBodyFeed">
		<div class="blank_15px" id="feedsNotify15" style="display:none;"></div>
		<div class="pinfor" style="display:none;" id="feedsNotify">
			<span>您有 <span id="feedsCount">0</span> 条新动态，</span>
			<a href="javascript:void(0);">点击查看</a>
		</div>
		<!--内容   -->
		<div class="blank_15px"></div>
        
        <ul id="ulcontent" class="ulcontent">
            <li feedid="24010298" class="gtopR"> <span class="imgphoto_1"> <a href="" data-cid="6222958" title="北京天成锦琳投资上海有限公司"><img alt="Photo_2" height="50" src="http://static.tianji.com/images/new_companies/image/photo_2.jpg?1381227055" width="45"></a> </span>
              <div class="text1">
                <p class="ptitle"> <a href="" data-cid="6222958" target="_blank" title="北京天成锦琳投资上海有限公司">北京天成锦琳投资上海有限公司</a> <span>正在招聘</span> <a href="" class="amosta">该公司更多职位&gt;&gt;</a> </p>
                <p class="p_3"> 工作地点：上海&nbsp;&nbsp;&nbsp;月薪：10000以上&nbsp;&nbsp;&nbsp;工作经验：不限&nbsp;&nbsp;&nbsp;工作职能：金融 </p>
                <span class="dateTimes">54 分钟前</span> </div>
              <div class="clear"></div>
            </li>
            <li feedid="24005573" class="gtopR"> <span class="imgphoto_1"> <a href="" data-cid="5290868" title="三文同创科技(北京)有限公司"><img alt="Photo_2" height="50" src="" width="45"></a> </span>
              <div class="text1">
                <p class="ptitle"> <a href="" data-cid="5290868" title="三文同创科技(北京)有限公司">三文同创科技(北京)有限公司</a><span>最近更新了1位雇员信息</span> </p>
                <ul class="allPhotos">
                  <li> <a href="" class="roota" data-uid="55533968" target="_blank" title="吴文伟, 三文同创科技(北京)有限公司任技术总监(CTO)"><img alt="3401825" height="50" src="http://image.tianji.com/u/55533968/3401825.jpg" width="45"></a> </li>
                  <div class="clear"></div>
                </ul>
                <div class="clear"></div>
                <div class="sdivfor"> <span class="scontent"> <em>吴文伟</em> 成为了该公司的 技术顾问 </span> <span class="s_r"></span>
                  <div class="clear"></div>
                </div>
                <span class="dateTimes">昨天 21:29</span> </div>
              <div class="clear"></div>
            </li>
            <div class="clear"></div>
          </ul>
		
		<img alt="Loading" id="feedsLoad" page="3" src="" style="margin: 0px auto 30px 330px; display: none;">
		<script>
			$(function(){
				$(".more-intro-detail").click(function(){
					var obj=$(this).parent().parent();
					//alert(obj);
					//obj.css("display","none");
					obj.hide();
					$(".detail-show-company").show();
				})
				
				$(".less-intro-detail").click(function(){
					var obj=$(this).parent().parent();
					obj.hide();
					$(".detail-main-company").show();
				})
			});
		</script>
	</div>
</div>

		<div class="clear"></div>
	</div>
	<div class="sidebar-company">

    <!-- 公司单页广告(右上) START -->
    <div class="ad_pig ad_id" id=""></div>
    
    <div class="clear" style="_margin-bottom:-15px;"></div>
    <!-- 公司单页广告(右上) END   -->

    <!--guide_box star-->


   
    <!-- 公司单页广告(右中) SATRT -->
    <div class="ad_pig ad_id" id=""></div>
    <div class="clear" style="_margin-bottom:-15px;"></div>
    <!-- 公司单页广告(右中) END   -->
  
    


      <div class="mod-company">
        <div class="hd-mod-company">
          <h3 class="title-hd-company">最新粉丝</h3>
        </div>
        <div class="bd-mod-company">
          <ul class="l-fans-company">
          {loop $corp_fans $key $vo}
              <li class="li-fans-company">
                <span class="poster-fans-company"><a href=""  target="_blank" title="{$vo['uname']}"><img  height="50" src="{$vo['avatar']}" width="45"></a></span>
                <span class="name-fans-company"><a href=""  target="_blank" title="{$vo['uname']}">{$vo['uname']}</a></span>
              </li>
             {/loop}    
              
            <div class="clear"></div>
          </ul>
        </div>
      </div>

    
  </div>
	<div class="clear"></div>
</div>



<div class="send_messages sendPersonal" id="min_corp_card" style="display:none;">
  <span class="send_arrow png_ie6"> </span>
  <div class="send_center style_shadow claddMark png_ie6">
    <div class="claddTop">
    
      <div class="min_waited">
        <span class="waiting_img">
          <img alt="More_loading" src="http://static.tianji.com/images/news/more_loading.gif?1348809457">
        </span>
      </div>
      <div class="clear"></div>
    </div>
    <div class="claddBottom">
      <div class="clear"></div>
    </div>
    <div class="clear"></div>

  </div>
</div>



<!--user_Guide star -->
  	<div class="user_Guide">
	    <div class="Guide1 guide">
	      <div class="yun">
	        <span class="comPanyName"></span>
	        <a href="javascript:;" class="close"></a>
	        <input type="button" value="" class="step1Btn">
	        <div class="icoBtn">
	          <i class="active"></i>
	          <i></i>
	          <i></i>
	        </div>
	      </div>
	    </div>

	    <div class="Guide2 guide">
	      <div class="yun">
	       <span class="comPanyName"></span>
	        <a href="javascript:;" class="close"></a>
	        <input type="button" value="" class="step1Btn">
	        <div class="icoBtn">
	          <i></i>
	          <i class="active"></i>
	          <i></i>
	        </div>
	      </div>
	    </div>

	    <div class="Guide3 guide">
	      <div class="yun">
	      	<a href="javascript:;" class="close"></a>
	        <input type="button" value="" class="stepOver">
	        <div class="icoBtn">
	          <i></i>
	          <i></i>
	          <i class="active"></i>
	        </div>
	      </div>
	    </div>

	  

  	</div>

	<!--user_Guide end-->

	<!--user_Guide_addSkill start-->
	<div class="user_Guide_addSkill">
	    <a href="" target="_blank" class="user_Guide_addBtn"></a>
	</div>
	<!--user_Guide_addSkill end-->






			<div class="clear"></div>
		</div>
 
   {include file="footer"}