<?php if(!defined('APP_NAME')) exit;?>
<div id="Main">
<div class="adv">
    <img src="__PUBLICAPP__/images/banner.png">
</div>
<div class="yuncms-g">
    <div class="yuncms-u-17-24">
       <div class="box index-big">
           <div class="bock-tit">
           <h3>
               当前位置：<a href="{url()}">首页</a> >
               {loop $daohang $vo}
                     <a href="{$vo['url']}">{$vo['name']}</a> >
               {/loop}
           </h3>
           </div>
           {loop $alist $vo}
            <div class="arlist">
              <a style="color:{$vo['color']}" onFocus="this.blur()" title="{$vo['title']}" href="{$vo['url']}" target="_blank"><h2>{$vo['title']}</h2></a>
              <span>{date($vo['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;&nbsp;&nbsp;点击:{$vo['hits']}</span>
             <span class="tags"> TAGS:
              {for $i=0;$i<10;$i++}
                 {if !empty($vo['tags'][$i])} 
                    <a href="{url('default/index/search',array('type'=>'all','keywords'=>urlencode($vo['tags'][$i])))}">{$vo['tags'][$i]}</a>
                 {/if}
              {/for}</span>
              <p>{$vo['description']}......</p>
              <a class="detail" href="{url($vo['method'],array('id'=>$vo['id']))}">更多详细>></a>
           </div>
           {/loop}
           <div class="pagelist yuncms-u">{$page}</div>
       </div>
    </div>
    {include file="arightCom"}
</div>
</div>