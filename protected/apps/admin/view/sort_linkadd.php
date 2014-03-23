<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script language="javascript">
  $(function ($) { 
	 //表单验证
	var items_array = [
		{ name:"sortname",simple:"栏目名称",focusMsg:'填写栏目名称'},
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>    
          <form action="{url('sort/linkadd')}"  method="post" id="info">
          <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">  
          <tr>
            <td align="right" width="200">所属类别：</td>
            <td align="left">
             <select name="parentid" id="parentid">
               <option selected="selected" value="0" >=作为顶级分类=</option>
                  <?php 
                      if(!empty($list)){
                      foreach($list as $vo){
                          $space = str_repeat('├┈┈┈', $vo['deep']-1);                     
                             $option.= '<option value="'.$vo['id'].'">'.$space.$vo ['name'].'</option>';
                        }
                        echo $option;
                     }
                  ?>
             </select>
            </td>
            <td align="left" class="inputhelp">支持无限分类</td>
          </tr> 
          
          <tr>
            <td align="right">自定义名称：</td>
            <td align="left">
              <input type="text" name="sortname" id="sortname">
            </td>
            <td align="left" class="inputhelp">请填写要添加栏目的名称</td>
          </tr>
          <tr>
            <td align="right">是否外链：</td>
            <td align="left">
              <input name="ifout" type="radio" value="1" checked>是&nbsp;<input name="ifout" type="radio" value="0" checked="checked">否
            </td>
            <td align="left" class="inputhelp"></td>
          </tr> 
          <tr>
            <td align="right">链接地址：</td>
            <td align="left">
              <input type="text" value="" name="url" id="url">
            </td>
            <td align="left" class="inputhelp">外链请以http://格式开头。<br>站内地址格式：应用/控制器/方法,键=值/键=值/键=值...</td>
          </tr>           
          <tr>
            <td align="right">排序：</td>
            <td align="left">
              <input type="text" name="norder" id="norder" value="0" size="10">
            </td>
            <td align="left" class="inputhelp">请以数字表示分类的排序（值越小越靠前）</td>
          </tr> 
          <tr>
            <td align="right">是否前台显示：</td>
            <td align="left"><input name="ifmenu"  type="radio" value="1" />是 <input name="ifmenu" type="radio" value="0" checked="checked" />否</td>
            <td class="inputhelp">选择是否在前台各种导航菜单中显示</td>
          </tr>           
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">
              
              <input type="submit" value="添加" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </table>
          </form>         