<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<link rel="stylesheet" href="__PUBLIC__/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
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
			uploadJson : "{url('link/UploadJson')}",
			fileManagerJson : "{url('link/FileManagerJson')}"
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

<title>链接{$t_name}</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置:【{$t_name}链接】</div>
        </div>

        <form enctype="multipart/form-data" action="" method="post" id="info" name="info" >
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   > 
          <tr>
            <td align="right"  width="100">链接类型：</td>
            <td align="left">
               <input name="type" type="radio" value="1" <?php echo $info['type']==1?"checked='checked'":NULL ?> />友情链接 &nbsp;
               <input name="type" type="radio" value="2" <?php echo $info['type']==2?"checked='checked'":NULL ?> />合作伙伴
            </td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">网站名称：</td>
            <td align="left"><input name="webname" id="webname" type="text" value="{$info['name']}" /></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">链接地址：</td>
            <td align="left"><input name="url" id="url" type="text" value="{$info['url']}" /></td>
            <td class="inputhelp">格式：http://www.yunstudio.net</td>
          </tr>
          <tr>
            <td align="right">上传LOGO：</td>
            <td align="left">
            <input type="text" name="picture" readonly  size="20"  class="text_value url" value="{$info['picture']}">
             &nbsp;<?php echo $info['picture']=='NoPic.gif'||$info['picture']==""?'':'<a title="点击查看logo" href="'.$path.$info['picture'].'" onClick="return hs.expand(this)"><img src="'.$public.'/images/pic.png"></a>';?>
           &nbsp; <input type="button" id="image" value="选择图片" class="button_small" />
            </td>
            <td class="inputhelp">直接填写Logo地址时不用上传，重复上传之前图片将被覆盖</td>
          </tr>
          <tr>
            <td align="right">LOGO地址：</td>
            <td align="left"><input name="logourl" id="logourl" type="text" value="{$info['logourl']}" /></td>
            <td class="inputhelp">本地上传时不用填写</td>
          </tr>
          <tr>
            <td align="right">网站所有者：</td>
            <td align="left"><input name="siteowner" id="siteowner" type="text" value="{$info['siteowner']}" /></td>
            <td class="inputhelp">对应加盟企业的是职位</td>
          </tr>
          <tr>
            <td align="right">网站简介：</td>
            <td align="left"><textarea name="info" id="info" cols="40" rows="5">{$info['info']}</textarea></td>
            <td class="inputhelp">对应加盟企业的是简介或者评语</td>
          </tr>
          <tr>
            <td align="right">排序：</td>
            <td align="left"><input name="norder" id="norder" type="text" value="{$info['norder']}" size="6"/></td>
            <td class="inputhelp">值越大越靠前(不指定将按最新发表排序)</td>
          </tr>
          <tr>
            <td align="right">通过审核：</td>
            <td align="left">
               <input name="ispass"  type="radio" value="1" <?php echo $info['ispass']==1?"checked='checked'":NULL ?> />是
               <input name="ispass" type="radio" value="0" <?php echo $info['ispass']==0?"checked='checked'":NULL ?> />否
            </td>
            <td class="inputhelp">未通过审核的链接将不显示</td>
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