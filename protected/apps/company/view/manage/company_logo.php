<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公司管理面板</title>
</head>
<body>


<h1>企业LOGO</h1>
<h3>LOGO是网站形象的重要体现，上传LOGO尺寸请不要超过300×110像素，图片大小不超过 500KB，允许格式：jpg/gif/bmp/png</h3>

<form enctype="multipart/form-data" method="post" action="">
        <table class="table table-bordered">
             <tr>
              <td align="right"  width="100">上传logo图片：</td>
              <td>
                  <input type="file" name="logo" size="10">
                  <input type="hidden" name="oldheadpic" value="{$info['logo']}">
                
                   <div style="clear:both">
                     <img src="{$path}{$info['logo']}">  
                   </div>  
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center">
              <input type="submit" name="dosubmit" value="修改" class="btn btn-primary">
              </td>
            </tr>
        </table>
  </form>
  
</body>
</html>

