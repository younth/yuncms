<?php
 if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script	language="javascript">
//封面图效果
hs.graphicsDir = "__PUBLIC__/images/graphics/";
hs.showCredits = false;
hs.outlineType = 'rounded-white';
hs.restoreTitle = '关闭';
$(document).ready(function() {
     jQuery.jqtab = function(tabtit,tab_conbox,shijian) {
        $(tab_conbox).find("li").hide();
        $(tabtit).find("li:first").addClass("btn-primary").show(); 
        $(tab_conbox).find("li:first").show();
        $(tabtit).find("li").bind(shijian,function(){
              $(this).addClass("btn-primary").siblings("li").removeClass("btn-primary"); 
              var activeindex = $(tabtit).find("li").index(this);
             $(tab_conbox).children().eq(activeindex).show().siblings().hide();
             return false;
        });
		  $('#getrule').click(function(){
		$('#rewrite').val($('#defrule').text());
     });
};
/*调用方法如下：*/
$.jqtab("#tabs","#tab_conbox","click");
});
</script>

<title>网站配置</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【网站配置】</div>
		<div class="list_head_mr"></div>
		</div>
        <ul class="tabs" id="tabs">
             <li class="btn btn-small">基本设置</li>
             <li class="btn btn-small">核心设置</li>
             <li class="btn btn-small">上传设置</li>
             <li class="btn btn-small">同步登陆</li>
        </ul>
        <form action="{url('set/index')}" method="post" id="info" name="info">
        <ul class="tab_conbox" id="tab_conbox">
           <li class="tab_con">
           <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
			<tr>
				<td align="right">站点名称：</td>
				<td><input id="sitename" class="regular-text" type='text' value="{$config['sitename']}" name="sitename" /></td>
				<td class="inputhelp"></td>
			</tr>
			<tr>
				<td align="right">网站地址：</td>
				<td><input class="regular-text" type='text' value="{$config['siteurl']}" name="siteurl" id="siteurl" /></td>
				<td class="inputhelp"></td>
			</tr>
			<tr>
				<td align="right">网站关键词：</td>
				<td><input class="regular-text" type='text' value="{$config['keywords']}" name="keywords" id="keywords" size="60"/></td>
				<td class="inputhelp"></td>
			</tr>
			<tr>
				<td align="right">网站描述：</td>
				<td><textarea name="description" id="description" cols="60" rows="5" class="regular-textarea">{$config['description']}</textarea></td>
				<td class="inputhelp"></td>
			</tr>
            <tr>
				<td align="right">联系电话：</td>
				<td><input class="regular-text" type='text' value="{$config['telephone']}" name="telephone" id="telephone" /></td>
				<td class="inputhelp"></td>
			</tr>
            <tr>
				<td align="right">QQ：</td>
				<td><input class="regular-text" type='text' value="{$config['QQ']}" name="QQ" id="QQ" /></td>
				<td class="inputhelp">多个QQ号用半角,隔开</td>
			</tr>
			<tr>
				<td align="right">站长邮箱：</td>
				<td><input class="regular-text" type='text' value="{$config['myemail']}" name="myemail" id="email" /></td>
				<td></td>
			</tr>
            <tr>
				<td align="right">公司地址：</td>
				<td><input class="regular-text" type='text' value="{$config['address']}" name="address" id="address" size="40"/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">ICP备案号：</td>
				<td><input class="regular-text" type='text' value="{$config['icp']}" name="icp" id="icp" /></td>
				<td></td>
			</tr>
            </table>
           </li>
           
           <li class="tab_con">
           <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
			<tr>
				<td align="right">调试模式：</td>
				<td><?php if($config['APP']['DEBUG']){ ?> 
				<input type="radio" name="APP[DEBUG]" value="true" checked="checked" />开启 
				<input type="radio" name="APP[DEBUG]" value="false" />关闭 
				<?php }else{?> 
				<input type="radio" name="APP[DEBUG]" value="true" />开启 
				<input type="radio" name="APP[DEBUG]" value="false" checked="checked" />关闭 
				<?php }?></td>
				<td class="inputhelp">开启调试模式将会显示详细错误信息</td>
			</tr>
           <tr>
          <td align="right">数据库永久链接：</td>
          <td><?php if($config['DB']['DB_PCONNECT']){ ?>
            <input type="radio" name="DB[DB_PCONNECT]" value="true"   checked="checked"/>开启
            <input type="radio" name="DB[DB_PCONNECT]" value="false" />关闭
            <?php }else{?>
            <input type="radio" name="DB[DB_PCONNECT]" value="true" />开启
            <input type="radio" name="DB[DB_PCONNECT]"  value="false"  checked="checked" />关闭
            <?php }?></td>
           <td class="inputhelp">开启后减少数据库链接获取和释放操作，但是将长期占用数据库链接资源</td>
        </tr>
        <tr>
          <td align="right">数据库缓存：</td>
          <td><?php if($config['DB']['DB_CACHE_ON']){ ?>
            <input type="radio" name="DB[DB_CACHE_ON]"  value="true"   checked="checked"/>开启
            <input type="radio" name="DB[DB_CACHE_ON]" value="false" />关闭
            <?php }else{?>
            <input type="radio" name="DB[DB_CACHE_ON]" value="true" />开启
            <input type="radio" name="DB[DB_CACHE_ON]"  value="false"  checked="checked" />关闭
            <?php }?></td>
          <td class="inputhelp">开启后减少数据库操作，但数据库更新在数据库缓存时间内将不能够实时显示。若设置永久缓存，更新后请<a href="{url('set/clear')}">清空数据库缓存</a></td>
        </tr>
        <tr>
          <td align="right">数据库缓存时间：</td>
          <td><input class="regular-text" type='text' value="{$config['DB']['DB_CACHE_TIME']}" name="DB[DB_CACHE_TIME]" size="7" />秒</td>
          <td class="inputhelp">0为不缓存,-1为永久缓存</td>
        </tr>
        <tr>
          <td align="right">模版缓存：</td>
          <td><?php if($config['TPL']['TPL_CACHE_ON']){ ?>
            <input type="radio" name="TPL[TPL_CACHE_ON]"  value="true"   checked="checked"/>开启
            <input type="radio" name="TPL[TPL_CACHE_ON]" value="false" />关闭
            <?php }else{?>
            <input type="radio" name="TPL[TPL_CACHE_ON]" value="true" />开启
            <input type="radio" name="TPL[TPL_CACHE_ON]"  value="false"  checked="checked" />关闭
            <?php }?></td>
          <td class="inputhelp">开启后减少模板标签编译过程，提高PHP运行速度，但是模板更改后需要<a href="{url('set/clear')}">清空模板缓存</a>后才可显示更新</td>
        </tr>
        <tr>
          <td align="right">静态缓存：</td>
          <td><?php if($config['APP']['HTML_CACHE_ON']){ ?>
            <input type="radio" name="APP[HTML_CACHE_ON]"  value="true"   checked="checked"/>开启
            <input type="radio" name="APP[HTML_CACHE_ON]" value="false" />关闭
            <?php }else{?>
            <input type="radio" name="APP[HTML_CACHE_ON]" value="true" />开启
            <input type="radio" name="APP[HTML_CACHE_ON]"  value="false"  checked="checked" />关闭
            <?php }?></td>
          <td class="inputhelp">开启后在静态缓存时间内将直接访问静态页，最大限度提高网站速度。如果设置缓存时间较长不能实时更新内容请<a href="{url('set/clear')}">清空静态缓存</a></td>
        </tr>
        <tr>
          <td align="right">URL规则：</td>
          <td>
             <textarea cols="70" rows="7" name="REWRITE" id="rewrite"><?php
				 if(!empty($config['REWRITE'])){
				    foreach ($config['REWRITE'] as $key => $value) {
					  echo $key.'='.$value."\r\n";
					}
				 }
                 ?></textarea>
                 <a href="javascript:void(0);" class="btn" id="getrule">默认规则</a>

                 <textarea id="defrule" style="display:none">index/search-<keywords>-<type>-<page>.html=default/index/search
index/search-<keywords>-<type>.html=default/index/search
<c>/<a>-<id>-<page>-<exsort>.html=default/<c>/<a>
<c>/<a>-<id>-<page>.html=default/<c>/<a>
index.html=default/index/index
<c>/<a>-<id>.html=default/<c>/<a>
<c>/<a>.html=default/<c>/<a></textarea>
                 
          </td>
          <td class="inputhelp">
            如果设置规则后导致网站链接无法访问，请检查：<br>
            1、您的规则格式是否正确。<br>
            2、您的主机是否支持URL重写。<br>
            3、Apache下.htaccess或是IIS下httpd.ini中的规则是否设置正确。<br>
            4、如果是nginx环境请<a href="http://www.yxcms.net/news/content_20.html" target="_blank">查看说明</a>。<br>
            5、系统放在二级目录下规则不会起效。
          </td>
        </tr>
        </table>
        </li>
           
       <li class="tab_con">
        <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
        <tr>
          <td align="right">编辑器上传大小：</td>
          <td><input class="regular-text" type='text' value="{$config['fileupSize']}" name="fileupSize" id="fileupSize" size="7"/>&nbsp;B以内</td>
          <td class="inputhelp">编辑器上传单个文件限制</td>
        </tr>
        <tr>
          <td align="right">图片上传大小：</td>
          <td><input class="regular-text" type='text' value="{$config['imgupSize']}" name="imgupSize" id="imgupSize" size="7"/>&nbsp;B以内</td>
          <td class="inputhelp">全站编辑器外图片单张上传限制</td>
        </tr>
        <tr>
          <td align="right">图片水印：</td>
          <td>
		  <?php if($config['ifwatermark']){ ?>
            <input type="radio" name="ifwatermark" id="ifwatermark" value="true"   checked="checked"/>开启
            <input type="radio" name="ifwatermark" value="false" />关闭
            <?php }else{?>
            <input type="radio" name="ifwatermark" value="true" />开启
            <input type="radio" name="ifwatermark" id="ifwatermark" value="false"  checked="checked" />关闭
            <?php }?>
            <select name="watermarkPlace" id="watermarkPlace" >
             <?php
			 $position[0]='随机';
			 $position[1]='顶端居左';
			 $position[2]='顶端居中';
			 $position[3]='顶端居右';
			 $position[4]='中部居左';
			 $position[5]='中部居中';
			 $position[6]='中部居右';
			 $position[7]='底端居左';
			 $position[8]='底端居中';
			 $position[9]='底端居右';
			 foreach ($position as $key => $vo) {
                echo ($config['watermarkPlace']==$key)?'<option selected value="'.$key.'">'.$vo.'</option>':'<option value="'.$key.'">'.$vo.'</option>';
             }
             ?>
           </select>
           </td>
          <td class="inputhelp">开启后所有上传图片将会做标记</td>
        </tr>
        <tr>
          <td align="right">水印图片：</td>
          <td><input class="regular-text" type='text' value="{$config['watermarkImg']}" name="watermarkImg" id="watermarkImg" /><a title="查看水印" href="./public/watermark/{$config['watermarkImg']}" onClick="return hs.expand(this)">查看水印</a></td>
          <td class="inputhelp">图片请选择png格式,水印图片路径：public/watermark/</td>
        </tr>
        <tr>
          <td align="right">图集缩略默认宽度：</td>
          <td><input class="regular-text" type='text' value="{$config['thumbMaxwidth']}" name="thumbMaxwidth" id="thumbMaxwidth" size="7"/>&nbsp;px</td>
          <td></td>
        </tr>
        <tr>
          <td align="right">图集缩略默认高度：</td>
          <td><input class="regular-text" type='text' value="{$config['thumbMaxheight']}" name="thumbMaxheight" id="thumbMaxheight" size="7"/>&nbsp;px</td>
          <td></td>
        </tr>
        <tr>
          <td align="right">文章封面默认宽度：</td>
          <td><input class="regular-text" type='text' value="{$config['coverMaxwidth']}" name="coverMaxwidth" id="coverMaxwidth" size="7"/>&nbsp;px</td>
          <td></td>
        </tr>
        <tr>
          <td align="right">文章封面默认高度：</td>
          <td><input class="regular-text" type='text' value="{$config['coverMaxheight']}" name="coverMaxheight" id="coverMaxheight" size="7"/>&nbsp;px</td>
          <td></td>
        </tr>
        </table>
           </li>
       <li class="tab_con">
        <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
			<tr>
				<td align="right">新浪微博KEY：</td>
				<td><input class="regular-text" type='text' value="{$config['sina_wb_akey']}" name="sina_wb_akey" id="sina_wb_akey" /></td>
				<td class="inputhelp"></td>
			</tr>
			<tr>
				<td align="right">新浪微博密匙：</td>
				<td><input class="regular-text" type='text' value="{$config['sina_wb_skey']}" name="sina_wb_skey" id="sina_wb_skey" size="60"/></td>
				<td class="inputhelp"></td>
			</tr>
       
        </table>
       </li>
     </ul>
      <table width="100%" border="0" cellpadding="0" >
		<tr>
			<td align="center" ><input type="submit" value="修改" class="btn btn-primary btn-small"></td>
		</tr>	
      </table>
     </form>
</div>
</body>
</html>