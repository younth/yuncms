<?php if(!defined('APP_NAME')) exit;?>
<div class="yuncms-u-7-24 ">
       {if !empty($sortlist)}  <!--子栏目列表-->
       <div class="block box">
          <div class="bock-tit"><h2>{$sorts[$id]['name']}</h2></div>
          <ul class="bock-list">
            {loop $sortlist $key $vo}  
               <li><a class="w180" title="{$vo['name']}"  href="{$vo['url']}">{$vo['name']}</a></li>
             {/loop}
          </ul>
       </div>
       {/if}
       
       <div class="block box">
          <div class="bock-tit"><h2>公告信息</h2></div>
          <div class="bock-con">{piece:welcome}</div>
       </div>
       
       <div class="block box">
          <div class="bock-tit"><h2>热门图集</h2></div>
          <ul class="bock-listp yuncms-u">
              {hot:{table=(photo) field=(id,title,picture,method) order=(hits desc,id desc) where=(ispass='1') limit=(4)}}
               <li><a class="box" target="_blank"  title="[hot:title]" href="[hot:url]" ><img  src="{$PhotoImgPath}thumb_[hot:picture]" alt="[hot:title]" width="120" height="91"></a><h2 style="color:[hot:color]">[hot:title]</h2></li>
              {/hot}
          </ul>
       </div>
       
       <div class="block box">
          <div class="bock-tit"><h2>推荐图集</h2></div>
          <ul class="bock-listp yuncms-u">
             {recmd:{table=(photo) field=(id,title,picture,method) order=(recmd desc,id desc) where=(ispass='1') limit=(4)}}
               <li><a class="box" target="_blank" title="[recmd:title]" href="[recmd:url]" ><img  src="{$PhotoImgPath}thumb_[recmd:picture]" alt="[recmd:title]" width="120" height="91"></a><h2 style="color:[recmd:color]">[recmd:title]</h2></li>
             {/recmd}
          </ul>
       </div>
    </div>