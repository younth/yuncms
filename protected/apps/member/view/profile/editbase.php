{include file="header"}
<link href="__PUBLICAPP__/css/profile_common.css"  rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/base.css"  rel="stylesheet" type="text/css" />
<script src="__PUBLICAPP__/js/city.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
//通过调用新浪IP地址库接口查询用户当前所在国家、省份、城市、运营商信息
$.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js',function(){
        var province="{$info['province']}";
        var city=city="{$info['city2']}";
        
        //判断数据库是否存在所在城市，不存在则新浪调用
        if(!"{$info['province']}") province=remote_ip_info.province;  
        if(!"{$info['city2']}")  city= remote_ip_info.city;
                
        $("#mycitys").citys({
                p_val:province,
                c_val:city,
                p_name:"province",
                c_name:"city"
        });
        $("#location").citys({
                 p_val:"{$info['province1']}",
                 c_val:"{$info['city1']}",
                 p_name:"province1",
                 c_name:"city1"
         });
    });
});
</script>
<div id="jy-content-wrap" class="jy-content-wrap jy-profile-mini">
    <div class="jy-content-inner">
      <div class="jy-sub-title">
        
      </div>
      <div class="jy-content-shadow">

<div id="content">
    <div class="profile-edit card-edit">
        <h2>
            <span>
                <a href="{url('profile/index')}" class="green">返回我的档案</a>
            </span> <em></em> <i class="yahei">编辑基本信息</i>
        </h2>
        <div class="profile-avatar">
            <div class="imgout">
                <div class="imgin">
                    <img alt="唐娜" src="{$big_photo}">
                </div>
                <a style="display: block;" class="edit" href="{url('member/setting/avatar')}">修改头像</a>
            </div>
        </div>
      	<form id="card_form" action="" method="post">
            <table width="100%" class="form card-form">
                <tbody>
            <tr>
                <td class="label"><span>*</span>真实姓名:</td>
                <td class="aster"></td>
                <td class="input">
                    <input type="text" class="text J_checkInput" name="uname" value="{$auth['uname']}" >
                    <div style="display:none;" class="error" id="name_error">请填写真实姓名</div>
                    <div style="display:none;" class="red" id="name_background_error"><span style="vertical-align:middle;">请填写真实姓名。</span></div>
                </td>
            </tr>
            <tr>
                <td class="label"><span>*</span>性&#12288;&#12288;别:</td>
                <td class="aster"></td>
                <td class="input">
                    <input type="radio" <?php if($info['sex'] ==1) echo 'checked'; ?> name="gender" id="sex-1" class="checkbox" value="1"><label for="sex-1">&nbsp;男&nbsp;&nbsp;</label>
                    <input type="radio" <?php if($info['sex'] ==2) echo 'checked'; ?> name="gender" id="sex-2" class="checkbox" value="2"><label for="sex-2">&nbsp;女</label>
                </td>
            </tr>
            <tr>
                <td class="label"><span>*</span>所在城市:</td>
                <td class="aster"></td>
                <td id="livecity-linkup" class="input">
                    <span id="mycitys"></span>
                    <div style="display:none;" class="error">请正确选择所在城市</div>
                </td>
            </tr>
            <tr>
                <td class="label"><span>*</span>手机:</td>
                <td class="aster"></td>
                <td id="identityWrapper" class="input card-input-id">
                     <input type="text" class="text J_checkInput" value="{$info['tel']}" name="tel" id="tel" />
                     <div style="display:none;" class="error">请输入手机号码</div>        
                </td>
            </tr>
            <tr>
                <td class="label"><span>*</span>qq:</td>
                <td class="aster"></td>
                <td id="identityWrapper" class="input card-input-id">
                     <input type="text" class="text J_checkInput" value="{$info['qq']}" name="qq" id="qq" />
                     <div style="display:none;" class="error">请输入qq号</div>        
                </td>
            </tr>
            <tr>
                <td class="label"><span>*</span>家乡:</td>
                <td class="aster"></td>
                <td id="livecity-linkup" class="input">
                     <span id="location"></span>
                    <div style="display:none;" class="error">请正确选择所在城市</div>
                </td>
            </tr>       
            <tr>
                <td class="label">&nbsp;</td>
                <td class="aster"></td>
                <td class="input button">
                    <a href="javascript:void(0);card_form.submit();" class="big-fresh formValidateSubmit" id="J_formSubmit"><span style="float:left;">保存</span>
                    </a><span class="blank"></span><a href="{url('profile/index')}" class="big-normal" id="J_formCancel"><span style="float:left;">取消</span></a>
                </td>
            </tr>
            </tbody></table>
        </form>
    </div>
</div>
            </div>
    </div>
</div>

{include file="footer"}