<?php if(!defined('APP_NAME')) exit;?>
<div id="Main">
<div class="adv">
    <img src="__PUBLICAPP__/images/banner.png">
</div>
<div class="yuncms-g page">
       <div class="box yuncms-u page-con">
           <div class="bock-tit">
           <h3>
               当前位置：<a href="{url()}">首页</a> >
               {loop $daohang $vo}
                     <a href="{$vo['url']}">{$vo['name']}</a> >
               {/loop}
           </h3>
           </div>
           <h1 class="con-tit">{$info['title']}</h1>
           <div class="content">{$info['content']['content']}</div>
           <div class="pagelist yuncms-u">{$info['content']['page']}</div>
       </div>
</div>
</div>