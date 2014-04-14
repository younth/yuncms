<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布动态</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
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
		uploadJson : "{url('manage/UploadJson')}",
		fileManagerJson : "{url('manage/FileManagerJson')}"
	});
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

  
</script>

<script type="text/javascript">
	//调用kindeditor的图片上传功能
	KindEditor.ready(function(K) {
		var editor = K.editor({
			allowFileManager : true,
			uploadJson : "{url('manage/UploadJson')}",
			fileManagerJson : "{url('manage/FileManagerJson')}"
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


</head>

<body>

        <form enctype="multipart/form-data" action="" method="post" id="info" name="info">
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   >
           
          <tr>
            <td align="right">标题：</td>
            <td align="left">
              <div>
               <input type="text" name="title" id="title" value="{$info['title']}" maxlength="60" size="30" >
              </div>
            </td>
          </tr>

          <tr>
            <td align="right">封面图：</td>
            <td align="left"><input type="text" name="picture" readonly  size="20"  class="text_value url" value="{$info['picture']}">
            &nbsp;<?php echo $info['picture']=='NoPic.gif'||$info['picture']==""?'':'<a title="点击查看封面" href="'.$path.$info['picture'].'" onClick="return hs.expand(this)"><img src="'.$public.'/images/pic.png"></a>';?>
           &nbsp; <input type="button" id="image" value="选择图片" class="button_small" /></td>
          </tr> 
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;">{$info['content']}</textarea></td>

          </tr>              
          <tr>
            <td align="right">前台显示模板：</td>
            <td align="left">
             <select name="tpcontent" id="tpcontent">
               {$choose}
              </select>
             </td>
          </tr> 
           
           <tr>
            <td align="right">排序：</td>
            <td align="left"><input name="norder" id="norder" type="text" value="0" size="4"  value="{$info['norder']}"/></td>
          </tr> 
          
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="{$t_name}">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>

</form>


</body>
</html>