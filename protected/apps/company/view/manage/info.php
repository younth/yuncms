<h1>招聘公司信息</h1>
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
				<td><input type="text"  name="sort"> </td>
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
				<td><input type="text"  name="uname"> </td>
			  </tr>
              
			  <tr>
				<th>公司地址：</th>
				<td><input type="text"  name="address"> </td>
			  </tr>
              
			  <tr>
				<th>公司介绍：</th>
				<td><textarea rows="5" cols="100" name="introduce"></textarea> </td>
			  </tr>
			</tbody>
            </form>
</table>
