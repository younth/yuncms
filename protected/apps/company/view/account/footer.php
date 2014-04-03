<?php if(!defined('APP_NAME')) exit;?>
  </div>
    <br /><br />
 <div class="footer_login_panel">
       <div class="friendlink" >
                  <span> 友情链接：</span>
                  {link:{table=(link) field=(name,url,type) order=(norder desc,id desc) where=(ispass='1' AND type='1') limit=(10)}}
                    <a target="_blank" href="[link:url]">[link:name]</a>
                    {/link}
                    <a href="friendlink/more">更多>></a>
             </div>
 	   <div class="clear"></div>
 	   <div id="footer_bg">
                  <div id="footer"> 
                   {footnav:{table=(sort) field=(name,url,type) order=(norder desc) where=(type=5)  sort=(100066) limit=(10)}}
            <a target="_blank" href="[footnav:url]">[footnav:name]</a>  
           		  {/footnav}
            <br/>
               {$copyright}
            
                <br/>{$icp} &nbsp;&nbsp;{$beian}
                <a class="footer_icon" target="_blank" href="#"><img src="__PUBLIC__/images/beian.gif" /></a>
                  </div>
             </div>
  </div>   
   
   
</div>
</body>
</html>
