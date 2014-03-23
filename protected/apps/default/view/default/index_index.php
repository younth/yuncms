<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript" src="__PUBLICAPP__/js/jquery.KinSlideshow-1.2.1.min.js"></script>
<script type='text/javascript' src='__PUBLICAPP__/js/jquery.slider.pack.js'></script>
<script type='text/javascript' src='__PUBLICAPP__/js/jquery.easing.js'></script>
<script type="text/javascript">
//<![CDATA[
jQuery(function() {
	//首页大幻灯开始
	jQuery('#cycle-prev, #cycle-next').css({opacity: '0'});
	jQuery('.cycleslider-wrap').hover(function(){
		jQuery('#cycle-prev',this).stop().animate({left: '-31', opacity: '1'},200,'easeOutCubic');
		jQuery('#cycle-next',this).stop().animate({right: '-31', opacity: '1'},200,'easeOutCubic');	 
	}, function() {
		jQuery('#cycle-prev',this).stop().animate({left: '-50', opacity: '0'},400,'easeInCubic');
		jQuery('#cycle-next',this).stop().animate({right: '-50', opacity: '0'},400,'easeInCubic');		
	});
	
	jQuery(".cycleslider-wrap").fadeIn(1000);
	jQuery(".slider-wrap .loader").css({display: "none"});
	jQuery("#slider").cycle({
		fx:  "turnDown",
		speed:  "800", 
		timeout: "4000",
		easing:  "easeOutBounce",
		next:  "#cycle-next",
		prev:  "#cycle-prev",
		pager:  "#cycle-nav"
	});
	//首页大幻灯结束
	//焦点图
	$("#KinSlideshow").KinSlideshow({
			moveStyle:"right",
			titleBar:{titleBar_height:25,titleBar_bgColor:"#fff",titleBar_alpha:0.5},
			titleFont:{TitleFont_size:12,TitleFont_color:"#484848",TitleFont_weight:"normal"},
			btn:{btn_bgColor:"#FFFFFF",btn_bgHoverColor:"#1072aa",btn_fontColor:"#000000",btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#cccccc",btn_borderHoverColor:"#1188c0",btn_borderWidth:1}
	});
});
//]]>
</script>
<div id="Main">

<div class="slider-wrap col-width">
    <div class="cycleslider-wrap">
       <div id="slider" class="cycleslider">
           {newstop:{table=(news) field=(id,title,picture,method) place=(100) where=(ispass='1') limit=(10)}}
             <div class="cycle-slider"><a href="[newstop:url]"><img src="{$NewImgPath}[newstop:picture]" width="970" height="350" alt="[newstop:title]" /></a></div>
           {/newstop}
       </div>
        <a id="cycle-prev" href="#">Prev</a><a id="cycle-next" href="#">Next</a><div id="cycle-nav"></div>
    </div>
    <div class="loader"></div>
</div>

<div class="yuncms-g index-mid">
    <div class="yuncms-u-17-24">
       <div class="yuncms-g index-mid-top">
          <div class="yuncms-u-2-5 box" id="KinSlideshow">
           {recom:{table=(news) field=(id,title,picture,method) place=(101) where=(ispass='1' AND picture!='NoPic.gif') limit=(8)}}
              <a target="_blank" href="[recom:url]"><img src="{$NewImgPath}[recom:picture]" alt="[recom:title $len=20]" width="260" height="208" /></a>
            {/recom} 
          </div>
          <div class="yuncms-u-3-5">
             <div class="index-reg box">
              <ul class="bock-list">
                    {news:{table=(news) field=(id,title,color,addtime,method,description) where=(ispass='1') limit=(6)}}
                       {if $news_i==1} <!--通过计数器判断第一条显示为头条样式-->
                          <h1><a href="[news:url]">[news:title $len=20]</a></h1>
                          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[news:description]</p>
                       {else}
                          <li><a class="w280" style="color:[news:color]" title="[news:title]" target="_blank" href="[news:url]">[news:title $len=25]</a><span>{date($news['addtime'],Y-m-d)}</span></li>
                       {/if}
                    {/news} 
                </ul>
             </div>
          </div>
       </div>
       
     
       
       <div class="yuncms-u index-big">
           <div class="yuncms-g">
              
              
           </div>
       </div>
    </div>
    {include file="arightCom"}<!----公用的右侧，不是所有的公用--->
</div>
<div class="links box">
   <div class="bock-tit"><h2>友情链接</h2></div>
   <div class="link yuncms-u">
       {link:{table=(link) field=(name,url,type,picture,logourl) order=(norder desc,id desc) where=(ispass='1')}}
             {if $link['type']==1} <a  href="[link:url]" target="_blank">[link:name]</a>
             {elseif $link['type']==2} <a  href="[link:url]" target="_blank"><img src="[link:picturepath]" alt="[link:name]" ></a>
             {/if}
       {/link}
   </div>
</div>
</div>     