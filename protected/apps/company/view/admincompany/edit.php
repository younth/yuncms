<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<link rel="stylesheet" href="__PUBLIC__/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script charset="utf-8" src="__PUBLIC__/kindeditor/lang/zh_CN.js"></script>
<script language="javascript">
hs.graphicsDir = '__PUBLIC__/images/graphics/';
hs.wrapperClassName = 'wide-border';
hs.showCredits = false;
  $(function ($) { 
   //表单验证
	var items_array = [
		{ name:"webname",min:2,max:30,simple:"站点名称",focusMsg:'2-30个字符'},
/*		{ name:"url",type:'url',simple:"站点地址",focusMsg:'请输入合法的站点地址'}
*/	];

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
			uploadJson : "{url('admincompany/UploadJson')}",
			fileManagerJson : "{url('admincompany/FileManagerJson')}"
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
<title>编辑企业</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">你当前的位置：【编辑企业】</div>
		<div class="list_head_mr"></div>
		</div>


		<table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="" method="post" id="info" name="info">
            <tr>
               <td align="right">邮箱：</td>
               <td>{$info['login_email']}</td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">企业名称：</td>
               <td><input type="text" name="address" value="{$info['name']}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">所属行业：</td>
               <td>
               <select name="sort" id="sort">
                  <option selected="selected" value="">=请选择类别=</option>
                  {$option}
               </select>
               </td>
               <td class="inputhelp"></td>
            </tr>
          <tr>
            <td align="right">企业LOGO：</td>
            <td align="left">
            <input type="text" name="logo" readonly  size="20"  class="text_value url" value="{$info['logo']}">
             &nbsp;<?php echo $info['logo']=='NoPic.gif'||$info['logo']==""?'':'<a title="点击查看logo" href="'.$path.$info['logo'].'" onClick="return hs.expand(this)"><img src="'.$public.'/images/pic.png"></a>';?>
           &nbsp; <input type="button" id="image" value="选择图片" class="button_small" />
            </td>
            <td class="inputhelp">直接填写Logo地址时不用上传，重复上传之前图片将被覆盖</td>
          </tr>
            
            
            <tr>
               <td align="right">地址：</td>
               <td><input type="text" name="address" value="{$info['address']}"></td>
               <td class="inputhelp"></td>
            </tr>
            
            <tr>
               <td align="right">网址：</td>
               <td><input type="text" name="websites" value="{$info['websites']}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">简介：</td>
               <td> <textarea  name="introduce" rows="4" cols="70"> {$info['introduce']}</textarea></td>
               <td class="inputhelp"></td>
            </tr>
               <td align="right">是否激活：</td>
               <td>
                    <input name="is_active" type="radio" value="1" <?php echo ($info['is_active']==1)?'checked="checked"':''; ?> />激活 &nbsp;
                    <input name="is_active" type="radio" value="0" <?php echo ($info['is_active']==0)?'checked="checked"':''; ?> />冻结
                </td>
               <td class="inputhelp"></td>
            </tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td align="left" colspan="2"><input type="submit" value="修改" class="btn btn-primary btn-small"></td>
			</tr>
			</form>
		</table>
</div>
</body>
</html>