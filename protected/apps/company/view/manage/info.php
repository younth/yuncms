<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公司管理面板</title>
 <link rel="stylesheet" href="__PUBLICAPP__/css/boxy.css" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery1.7.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/Selector.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/job.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/jquery.boxy.js"></script>

    <script type="text/javascript">
        $(function() {
			    // 职位类型选择器
    // value 表示选定的职位类型编号，字符串类型，编号间以逗号分隔    b+i就是类别  s+i就是子类类别
    // shown 需要展示项的编号
    // callback 表示回调
    // option 为json格式的可选项的集合
            $("#on_industry").click(function() {
                Boxy.job("{$info['industry']}", "0", function(val) {
                    //alert("你选择的是: " + val);
					$("#industry").val(val);
					//alert(val.text());
					//循环出所选的行业，然后显示出来
					var str="";
					$("#job-result li span").each(function() {
						//var $yun+=$yun+$(this).html();
						
						 str+=$(this).html()+"+";
                    });
					$("#on_industry").val(str);
					
                }, { title: "请选择行业类别" });
                return false;
            });
			
        });
    </script>

</head>
<body>

<h1>基本信息管理</h1>
<table border="0" cellspacing="0" cellpadding="0" class="form_box">
            <form action="" method="post">
			<tbody>
			  <tr>
				<th>公司名称：</th>
				<td><input type="text" name="name" value="{$info['name']}"></td>
			  </tr>
			  <tr>
				<th>公司性质：</th>
				<td>
                	<select  style="width:160px;" name="quality">
                        	<option value="0">请选择</option>
                            {$quality_option}
                   </select>
                </td>
			  </tr>
			  <tr>
				<th>所属行业：</th>
				<td><input  type="hidden" id="industry" value="{$info['industry']}" name="industry"><input type="text"  name="on_industry" id="on_industry" value="{$info['on_industry']}"> </td>
			  </tr>
			  <tr>
				<th>公司规模：</th>
				<td>
                                	<select  style="width:160px;" name="scale">
											<option value="">请选择</option>
                                            {$company_scale}
                   </select>

                </td>
			  </tr>
              
			  <tr>
				<th>联系电话：</th>
				<td><input type="text"  name="phone" value="{$info['phone']}"> </td>
			  </tr>
			  <tr>
				<th>公司网址：</th>
				<td><input type="text"  name="websites"  value="{$info['websites']}"> </td>
			  </tr>
			  <tr>
				<th>公司地址：</th>
				<td><input type="text"  name="address"  value="{$info['address']}"> </td>
			  </tr>
              
			  <tr>
				<th>公司介绍：</th>
				<td><textarea rows="5" cols="100" name="introduce">{$info['introduce']}</textarea> </td>
			  </tr>
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit"  value="确定">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
			</tbody>
            </form>
</table>

</body>
</html>

