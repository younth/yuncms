<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript">
//<![CDATA[
jQuery(function() {
   $(".content").contents().find("img").each(function(){//限制内容中图片大小
       if($(this).width()>600){
         $(this).height($(this).height()*(600/$(this).width()));
         $(this).width(600);
         $(this).wrap("<a href=" + $(this)[0].src + " target=_blank></a>");
     }
  });
});
//]]>
</script>
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
           <h1 class="con-tit">{$info['title']}</h1>
           <p class="con-info">发布日期：{date($info['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;点击量：{$info['hits']}&nbsp;&nbsp; 信息来源：{$info['origin']} </p>
           <div class="yuncms-u content" id="content">
                {$info['content']['content']}<br>
             <span class="tags"> TAGS:
             <!----两层循环--->
              {for $i=0;$i<10;$i++}
                 {if !empty($info['tags'][$i])} 
                    <a href="{url('default/index/search',array('type'=>'all','keywords'=>urlencode($info['tags'][$i])))}">{$info['tags'][$i]}</a>
                 {/if}
              {/for}
            </span>
           </div>
           {loop $extinfo $vo}
                <div>{$vo['name']}:{$vo['value']}</div>
           {/loop}
           
           <div class="pagelist yuncms-u">{$info['content']['page']}</div>

           <ul class="next">
                 <li>上一篇：{if !empty($upnews)}<a href="{url($upnews['method'],array('id'=>$upnews['id']))}" onFocus="this.blur()">{$upnews['title']}</a>{else}没有了....{/if}</li>
                <li>下一篇：{if !empty($downnews)}<a href="{url($downnews['method'],array('id'=>$downnews['id']))}" onFocus="this.blur()">{$downnews['title']}</a>{else}没有了....{/if}</li>
           </ul>
       </div>
    </div>
    {include file="arightCom"}
</div>
</div>