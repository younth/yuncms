<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script language="javascript">
//封面图效果
hs.graphicsDir = "__PUBLIC__/images/graphics/";
hs.showCredits = false;
hs.outlineType = 'rounded-white';
hs.restoreTitle = '关闭';
KindEditor.ready(function(K) {
	K.create('#content', {
		allowFileManager : true,
		filterMode:false,
		uploadJson : "{url('news/UploadJson')}",
		fileManagerJson : "{url('news/FileManagerJson')}"
	});
	
		//调用Kindeditor的颜色拾取功能
		var colorpicker;
		K('#colorpicker').bind('click', function(e) {
			e.stopPropagation();
			if (colorpicker) {
				colorpicker.remove();
				colorpicker = null;
				return;
			}
			var colorpickerPos = K('#colorpicker').pos();
			colorpicker = K.colorpicker({
				x : colorpickerPos.x,
				y : colorpickerPos.y + K('#colorpicker').height(),
				z : 19811214,
				selectedColor : 'default',
				noColor : '无颜色',
				click : function(color) {
					K('#color').val(color);
					colorpicker.remove();
					colorpicker = null;
				}
			});
		});
		K(document).click(function() {
			if (colorpicker) {
				colorpicker.remove();
				colorpicker = null;
			}
		});
	
});

  $(function ($) { 
  //标题颜色
  $('#PickCoShow').click(function(){
      $('#picker').toggle();
	  if(''==$('#color').val()) $('#color').val("#FFFFFF");
  });
  $('#DelColor').click(function(){
	  $('#picker').hide();
	  $('#color').val('');
	  $('#color').css('background-color','#ffffff');
  });
   //表单验证
	var items_array = [
	    { name:"sort",min:6,simple:"类别",focusMsg:'选择类别'},
		{ name:"title",min:2,simple:"标题",focusMsg:'3-30个字符'},
		{ name:"method",simple:"模型/方法",focusMsg:'填写模型/方法'},
		{ name:"tpcontent",simple:"模板",focusMsg:'选择模板'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
  
</script>

<script type="text/javascript">
	//调用kindeditor的图片上传功能
	KindEditor.ready(function(K) {
		var editor = K.editor({
			allowFileManager : true,
			uploadJson : "{url('news/UploadJson')}",
			fileManagerJson : "{url('news/FileManagerJson')}"
		});
		K('#image').click(function() {
				editor.loadPlugin('image', function() {
					editor.plugin.imageDialog({
						showRemote : false,
						imageUrl : K('.url').val(),
						clickFn : function(url, title, width, height, border, align) {
							K('.url').val(url);
							editor.hideDialog();
					}
				});
			});
		});	
	});
</script>

<title>文章{$t_name}</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【资讯{$t_name}】</div>
        </div>
        <form enctype="multipart/form-data" action="" method="post" id="info" name="info">
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   >
          <tr>
            <td align="right" width="100">选择类别：</td>
            <td align="left">
               <select name="sort" id="sort">
                  <option selected="selected" value="">=请选择类别=</option>
                  {$option}
               </select>
             </td>
            <td class="inputhelp"><a href="{url('sort/add')}">点击添加栏目</a></td>
          </tr> 
          <?php if(!empty($places)) { ?>
          <tr>
            <td align="right">内容定位：</td>
            <td align="left">
            <?php
			  foreach ($places as $vo) {
				if(!empty($info['places'])){
				    if(in_array($vo['id'],explode(',',$info['places']))) $check='checked';
					else $check='';
				}
				echo '<input '.$check.' type="checkbox" name="places[]" value="'.$vo['id'].'">'.$vo['name'].'&nbsp;&nbsp;';
			  }
			 ?>
            </td>
            <td class="inputhelp"></td>
          </tr> 
          <?php } ?>
          <tr>
            <td align="right">标题：</td>
            <td align="left">
              <div>
               <input type="text" name="title" id="title" value="{$info['title']}" maxlength="60" size="30" >
               <a href="javascript:" title="点击选择颜色" id="colorpicker"><img src="__PUBLICAPP__/images/pick.gif" width="11" height="11" border="0" /></a>
               <input value="{$info['color']}" type="text" name="color" id="color" size="9">
              
              </div>
               <div id="picker"></div> 
              
            </td>
            <td class="inputhelp">可选择前台显示的标题字体颜色</td>
          </tr>
          <tr>
            <td align="right">状态：</td>
            <td align="left">
            {$info['recmd']}
                <input type="checkbox" name="ispass" value="1" <?php echo ($info['ispass']==1)?'checked':''; ?>> 审核
                <input type="checkbox" name="recmd" value="1" <?php echo ($info['recmd']==1)?'checked':''; ?> >推荐
            </td>
            <td class="inputhelp"></td>
          </tr> 
          <tr>
            <td align="right">封面图：</td>
            <td align="left"><input type="text" name="picture" readonly  size="20"  class="text_value url" value="{$info['picture']}">
            &nbsp;<?php echo $info['picture']=='NoPic.gif'||$info['picture']==""?'':'<a title="点击查看封面" href="'.$path.$info['picture'].'" onClick="return hs.expand(this)"><img src="'.$public.'/images/pic.png"></a>';?>
           &nbsp; <input type="button" id="image" value="选择图片" class="button_small" /></td>
            <td class="inputhelp">若不手动添加，则自动提取内容中第一张图片</td>
          </tr> 
          <tr>
            <td align="right">新闻来源：</td>
            <td align="left"><input type="text" name="origin" id="origin" size="20" value="{$info['origin']}"></td>
            <td class="inputhelp">若是转载内容，请在此注明，以避免知识产权纠纷</td>
          </tr>  
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" name="keywords" id="keywords" size="40" value="{$info['keywords']}"> </td>
            <td class="inputhelp">将被用来作为keywords标签，用英文逗号隔开，留空时将根据标题和SEO描述自动生成</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="70" rows="5" name="description" id="description">{$info['description']}</textarea></td>
            <td class="inputhelp">将被用来作description标签，用英文逗号隔开，留空时将根据内容自动生成</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;">{$info['content']}</textarea></td>

          </tr>
          <tr>
            <td align="right">前台模型/方法：</td>
            <td align="left"><input type="text" value="<?php echo $info['method']?$info['method']:"news/content" ?>" name="method" id="method" size="20"></td>
            <td class="inputhelp">默认为news模型中content方法</td>
          </tr>
          <tr>
            <td align="right">前台显示模板：</td>
            <td align="left">
             <select name="tpcontent" id="tpcontent">
               {$choose}
              </select>
             </td>
            <td class="inputhelp">默认为模板路径下news_content.php<br><a style="color:green" href="{url('set/tpchange')}"> 管理模板 </a></td>
          </tr> 
           
           <tr>
            <td align="right">排序：</td>
            <td align="left"><input name="norder" id="norder" type="text" value="0" size="4"  value="{$info['norder']}"/></td>
            <td class="inputhelp">排序值越大越靠前(不指定将按最新发表排序)</td>
          </tr> 
          <tr>
            <td align="right">点击：</td>
            <td align="left"><input name="hits" type="text" value="30" size="6" value="{$info['hits']}"/></td>
            <td class="inputhelp">不建议修改</td>
          </tr> 
          <tr>
            <td align="right">发表时间：</td>
            <td align="left"><input name="addtime" id="addtime" type="text" value="<?php echo $info['addtime']?$info['addtime']:date('Y-m-d H:i:s'); ?>" /></td>
            <td class="inputhelp">不建议修改</td>
          </tr> 
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="{$t_name}">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>

</form>
</div>
</body>
</html>