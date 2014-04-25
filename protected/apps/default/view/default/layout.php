<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{$title}</title>
    <meta name="keywords" content="{$keywords}">
    <meta name="description" content="{$description}">
    <link href="__PUBLICAPP__/css/login_new.css" media="screen" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
    <script>
    	$(function(){
			$(".services-con li:last-child").addClass("right_no");//给li最后一个增加class效果
			})
    </script>
  </head>
  <body>
   <div class="mianbody" id="tianji-popup-login">
      <div class="bg_panel">
        <div class="top_panel">
          <span class="logo png_ie6"></span>
          <div id="msform">
  <div class="pop-left-con">
  {include file="$__template_file"} 
  </div>
</div>

        </div>
      </div>
      <div class="more_panel">
        <div class="center_panel">
          <span class="title_one">超过<span class="color_1">1800万</span>大学生首选的职业社交平台</span>
          <ul class="row-fluid services-con style2">
          {advantage:{table=(fragment) field=(id,title,content) order=(id asc) limit=(4)}}
            <li>
	      <span class="why_go post0[advantage:id]"></span>
              <div class="p_cont">
                <h3>[advantage:title]</h3>
                <p>[advantage:content]</p>
              </div>
            </li>
            {/advantage}
          </ul>
        </div>
        <div class="clear"></div>
        <div class="why_go_panels">
          <div class="why_do">
            <h4>加盟企业</h4>
            {corp:{table=(link) field=(name,picture,siteowner,info,logourl) order=(norder desc,id desc) where=(ispass='1' AND type='2') limit=(6)}}
            <div class="people_one">
              <span class="poster poster01"><img src="[corp:picturepath]" /></span>
              <span class="nametwo"><a href="#">[corp:name]</a></span>
              <span class="nametitle">[corp:siteowner]</span>
              <span class="cont_mian">[corp:info]</span>
            </div>
             {/corp}
           
            
            
          </div>
        </div>
        <div class="firends_panel">
          <h3>入驻高校</h3>
          <ul>
           {school:{table=(link) field=(name,picture,siteowner,info,logourl) order=(norder desc,id desc) where=(ispass='1' AND type='3') limit=(10)}}
            <li class="postion01">
	      <a href="#" target="_blank" onfocus="this.blur()"> <img src="[school:picturepath]" /> </a>
	    	</li>
             {/school}
          </ul>
        </div>

        <div class="footer_login_panel">
             <div class="friendlink" >
                  <span class="margin">友情链接：</span>
                  {link:{table=(link) field=(name,url,type) order=(norder desc,id desc) where=(ispass='1' AND type='1') limit=(10)}}
                    <a target="_blank" href="[link:url]">[link:name]</a>
                    {/link}
                    <a href="#">更多>></a>
             </div>
  	  
 	         <div class="clear"></div>

	         <div id="footer_bg">
                  <div id="footer"> 
                   {footnav:{table=(sort) field=(name,url,type) order=(norder desc) where=(type=5)  sort=(100066) limit=(10)}}
            <a target="_blank" href="[footnav:url]">[footnav:name]</a>  
           		  {/footnav}
            <br/>
               {$copyright}
             
            
                <br/>{$icp} &nbsp;&nbsp;{$beian}&nbsp;&nbsp;<script>{$tongji}</script>
                <a class="footer_icon" target="_blank" href="#"><img src="__PUBLIC__/images/beian.gif" /></a>
        </div>
             </div>
             <!-- End comScore Tag -->
            <div>
            </div>	  
        </div>
      </div>
    </div>
    <!--[if IE 6]>
	<script language="JavaScript" type="text/javascript" src="__PUBLIC__/js/belatedPNG-min.js"></script>
	<script type="text/javascript">
          $(document).ready(function(){
            DD_belatedPNG.fix('.png_ie6');
          });
	</script>
    <![endif]-->
    <script>
	
	$(function(){ 
	var $login=$("#tianji-login-email_or_mobile");
	var $pwd=$("#account_password");
	
	$login.on({ 
	focus:function(){ 
			if (this.value == this.defaultValue){ 
				this.value=""; 
				} 
			$(this).addClass("focus");
		}, 
	blur:function(){ 
	if (this.value == ""){ 
		this.value = this.defaultValue; 
		} 
		$(this).removeClass("focus");
	} 
	}); 
	
		$pwd.on({ 
	focus:function(){ 
			$(this).addClass("focus");
		}, 
	blur:function(){ 
		$(this).removeClass("focus");
	} 
	}); 

}) 

    </script>
   </body>
</html>

