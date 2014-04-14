{include file="header"}
<link href="__PUBLICAPP__/css/profile_common.css" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/edu.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/selectschool.css" media="screen" rel="stylesheet" type="text/css" />
<script src="__PUBLICAPP__/js/selectschool.js" type="text/javascript"></script>
<script src="http://common.cnblogs.com/script/jquery.js" type="text/javascript"></script>
<script src="http://files.cnblogs.com/technology/school.js" type="text/javascript"></script>
<!--调用时间-->
<script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcore.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcalendar.min.js"></script>
<script type="text/javascript">
J(function(){
    J('#startdate').calendar();
	J('#enddate').calendar();
});
</script>

<script src="__PUBLICAPP__/js/major.js" type="text/javascript"></script>
    <script type="text/javascript">
$(function(){
    $("#major-select").citys({
            p_val:"{$major1}",
            c_val:"{$major2}",
            p_name:"province",
            c_name:"city"
    });
});

</script>
<!--专业类别的样式-->
<div id="jy-content-wrap" class="jy-content-wrap jy-profile-mini">
    <div class="jy-content-inner">
      <div class="jy-sub-title">
        <div class="jy-sub-title">
          <h2 style="display:none;"></h2>
        </div>
      </div>
      <div class="jy-content-shadow">

<div id="content">
    <div class="profile-edit">
        <h2>
            <span>
                <a href="{url('profile/index')}" class="green">返回我的档案</a>
            </span> <em></em> <i class="yahei">编辑教育经历</i>
        </h2>
       <form id="edu_form" action="" method="post">
            <table width="100%" class="form">
                <colgroup>
                    <col width="230">
                    <col width="19">
                </colgroup>
                <tbody>
                <tr>
                    <td class="label"><span>*</span>学校名称:</td>
                    <td class="aster"></td>
                    <td class="input">
                        <div class="matchbox">
                            <div class="clearfix">
                                <input type="text" name="school" maxlength="40" autocomplete="off" class="text J_checkInput" id="school-name" value="{$info['school']}" onclick="pop()">
                                    <div id="choose-box-wrapper">
                                        <div id="choose-box">
                                            <div id="choose-box-title">
                                                    <span>选择学校</span>
                                            </div>
                                            <div id="choose-a-province">
                                            </div>
                                            <div id="choose-a-school">
                                            </div>
                                            <div id="choose-box-bottom">
                                                    <input type="botton" onclick="hide()" value="关闭" />
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div style="display:none;" class="error">请填写学校名称</div>
                    </td>
                </tr>
                <tr>
                    <td class="label"><span>*</span>专业名称:</td>
                    <td class="aster"></td>
                    <td class="input">
                        <input type="text" value="{$info['major']}" id="majorname-input" maxlength="15" name="majorName" class="text J_checkInput">
                        <div style="display:none;" class="error">请填写专业名称</div>
                    </td>
                </tr>
                <tr>
                    <td class="label"><span>*</span>专业类别:</td>
                    <td class="aster"></td>
                    <td class="input" id="major-linkup">
                        <span id="major-select"></span>                      
                        <div style="display:none;" class="error">请选择专业类别</div>
                    </td>
                </tr>
                <tr>
                    <td class="label"><span>*</span>学&#12288;&#12288;历:</td>
                    <td class="aster"></td>
                    <td class="input">
                        <select class="J_checkInput" name="education" id="education-select">
                            <option value="">请选择</option>
                                <option <?php if($info['education'] == 1 ) echo 'selected'; ?> value="1">博士研究生</option>
                                <option <?php if($info['education'] == 2 ) echo 'selected'; ?> value="2">硕士研究生</option>
                                <option <?php if($info['education'] == 3 ) echo 'selected'; ?> value="3">本科</option>
                                <option <?php if($info['education'] == 4 ) echo 'selected'; ?> value="4">专科</option>
                                <option <?php if($info['education'] == 5 ) echo 'selected'; ?> value="5">其他</option>
                        </select>
                        <div style="display:none;" class="error">请选择学历</div>
                    </td>
                </tr>
                <tr>
                    <td class="label"><span>*</span>就读时间:</td>
                    <td class="aster"></td>
                    <td class="input">
                        <input type="text" class="text year J_checkInput" id="startdate" placeholder="入学时间" readonly name="start_time" value="{date("Y-m-d",$info['start_time'])}">                 
                               <label>&nbsp;&nbsp;至&nbsp;&nbsp;</label>
                        <input type="text" class="text year" id="enddate" placeholder="入学时间" readonly name="end_time" value="{date("Y-m-d",$info['end_time'])}">                        
                        <div style="display:none;" class="error">请填写正确就读时间</div>
                    </td>
                </tr>
                <tr>
                    <td class="label">&nbsp;</td>
                    <td class="aster"></td>
                    <td class="bd btn-box">
                        <a href="javascript:void(0);edu_form.submit();" class="big-fresh formValidateSubmit" id="J_formSubmit"><span style="float:left;">保存</span>
                        </a><span class="blank"></span>
                        <a href="{url('profile/index')}" class="big-normal" id="J_formCancel"><span style="float:left;">取消</span></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
            </div>
    </div>
</div>

{include file="footer"}