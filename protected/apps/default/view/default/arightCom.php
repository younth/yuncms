<?php if(!defined('APP_NAME')) exit;?>
<div class="yuncms-u-7-24 ">
       <!--演示调用当前栏目下的子栏目-->
       {if !empty($sortlist)}  
       <div class="block box">
          <div class="bock-tit"><h2>{$sorts[$id]['name']}</h2></div>
          <ul class="bock-list">
            {loop $sortlist $key $vo}  
               <li><a class="w180" title="{$vo['name']}"  href="{$vo['url']}">{$vo['name']}</a></li>
            {/loop}
          </ul>
       </div>
       {/if}
       
        <!--演示调用固定栏目下的子栏目-->
       <div class="block box">
          <div class="bock-tit"><h2>{$sorts[100034]['name']}</h2></div>
          <ul class="bock-list">
            {loop $sorts $key $vo}  
              {if (strpos($vo['path'],'100001,')!==false)}
                {if ($vo['deep']- $sorts[100001]['deep'])==1}
                  <li><a class="w180" title="{$vo['name']}"  href="{$vo['url']}">{$vo['name']}</a></li>
                {elseif ($vo['deep']- $sorts[100001]['deep'])==2}
                  <li><a class="w180" title="{$vo['name']}"  href="{$vo['url']}">|--{$vo['name']}</a></li>
                {elseif ($vo['deep']- $sorts[100001]['deep'])==3}
                  <li><a class="w180" title="{$vo['name']}"  href="{$vo['url']}">|--|--{$vo['name']}</a></li>
                 {/if}
              {/if}
            {/loop}
          </ul>
       </div>
       
       <div class="block box">
          <div class="bock-tit"><h2>公告信息</h2></div>
          <div class="bock-con">{piece:announce}</div>
       </div>
       
       <div class="block box">
          <div class="bock-tit"><h2>热门文章</h2></div>
          <ul class="bock-list">
            {hot:{table=(news) field=(id,title,color,addtime,method) order=(hits desc,id desc) where=(ispass='1') limit=(7)}}
                     <li><a class="w180" style="color:[hot:color]" title="[hot:title]" target="_blank" href="[hot:url]">[hot:title $len=25]</a><span>{date($hot['addtime'],Y-m-d)}</span></li>
           {/hot}
          </ul>
       </div>
       
       <div class="block box">
          <div class="bock-tit"><h2>推荐文章</h2></div>
          <ul class="bock-list">
           {recmd:{table=(news) field=(id,title,color,addtime,method) order=(recmd desc,id desc) where=(ispass='1') limit=(7)}}
                     <li><a class="w180" style="color:[recmd:color]" title="[recmd:title]" target="_blank" href="[recmd:url]">[recmd:title $len=25]</a><span>{date($recmd['addtime'],Y-m-d)}</span></li>
           {/recmd}
          </ul>
       </div>
</div> 