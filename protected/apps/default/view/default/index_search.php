<?php if(!defined('APP_NAME')) exit;?>
<div id="Main">
       <div class="box search-con">
           <div class="bock-tit"><h3>一共找到 <font style="color:red"> {$count} </font> 个结果 </h3></div>
           {loop $list $vo}
            <div class="arlist">
              <a  onFocus="this.blur()" title="{$vo['title']}" href="{url($vo['method'],array('id'=>$vo['id']))}" target="_blank"><h2>
              <!------关键字加红---->
			  <?php echo str_replace($keywords,"<font style='color:red'>$keywords</font>",$vo['title']); ?></h2></a>
              <span>{date($vo['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;&nbsp;&nbsp;点击:{$vo['hits']}</span>
              <p><?php echo str_replace($keywords,"<font style='color:red'>$keywords</font>",$vo['description']); ?>......</p>
            </div>
          {/loop}
           <div class="pagelist yuncms-u">{$page}</div>
       </div>
</div>