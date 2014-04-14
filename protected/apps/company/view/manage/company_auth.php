<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公司管理面板</title>
</head>
<body>


<h1>营业执照</h1>
<h3>营业执照只作为网站核实贵公司真实性的材料，不在任何页面显示，我们不会以任何形式公布您的执照信息！
通过网站核实后的营业执照不能删除，如需要删除请与网站客服人员联系！</h3>

<form enctype="multipart/form-data" method="post" action="">
        <table class="table table-bordered">
             <tr>
              <td align="right"  width="100">上传营业执照副本：</td>
              <td>
                  <input type="file" name="license" size="10">
                  <input type="hidden" name="oldheadpic" value="{$info['license']}">
                
                   <div style="clear:both">
                     <img src="{$path}{$info['license']}">  
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

