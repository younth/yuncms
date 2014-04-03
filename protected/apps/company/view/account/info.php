 {include file="account/header"}
 <link href="__PUBLICAPP__/css/corp_reg.css" rel="stylesheet" type="text/css">

 <div class="dj-content-wrap ">
 <div class="dj-content-inner">
            <div class="dj-content-shadow">
<!-- content begin -->
<div class="p-wrap">
    <div class="i-title">
        <h2><i></i>完善公司信息</h2>
    </div>
    <div class="employment-content0">
        <div class="bd">
            <div class="form-main">
                <form id="jp-pageValidateForm" class="p-form" action="/express/recruit/corpdetail" method="post">
                    <input type="hidden" name="token" value="ZgyQsakCt2ARiSfxfkni8RgWuA7Rm5iN">
                    <fieldset id="jp-companyName-wrap">
                        <table class="dj-form-smart c-info-form">
                            <tbody>
                            <tr><th>公司名称：</th>
                                <td class="input"><p style="width:514px;overflow: hidden;" class="b f14">
                                    132 <a href="/express/recruit/corp" class="change_name">修改</a>
                                </p></td>
                                <input type="hidden" value="132" name="corpName">
                            </tr>
                            <tr>
                                <td colspan="2"><div class="p-tip-line">
                                    <span class="txt b g6 f14">请补充公司资料</span>
                                </div></td>
                            </tr>
                            <tr><th><em>*</em>公司性质：</th>
                                <td id="tdcorpQuality" class="input">
                                    <select reg="^.+$" class="select J_checkInput" style="width:160px;" name="corpQuality">
                                        <option value="">请选择</option>
                                            <option value="10">外资·合资</option>
                                            <option value="11">私营·股份制企业</option>
                                            <option value="12">国有企业</option>
                                            <option value="13">非营利·事业单位</option>
                                            <option value="14">其他</option>
                                    </select>
                                    <div style="display:none;" class="J_Error">请选择公司性质</div>
                                </td>
                            </tr>
                            <tr><th><em>*</em>所属行业：</th>
                                <td class="input">
                                    <input type="text" reg="^.+$" value="" id="industry-input" style="cursor:pointer" readonly="yes" class="text select-beauty J_checkInput">
                                    <input type="hidden" reg="^.+$" id="industry-hidden" class="J_checkInput" name="positionIndustry" value="">
                                    <a id="industry-link" href="javascript:void(0);"></a>
                                    <div style="display: none;" class="J_Error">请选择所属行业</div>
                                </td>
                            </tr>
                            <tr><th><em>*</em>公司规模：</th>
                                <td class="input" id="profession-linkup">
                                    <select reg="^.+$" class="select J_checkInput" style="width:160px" name="corpScale">
                                        <option value="">请选择</option>
                                            <option value="10">1 - 49人</option>
                                            <option value="11">50 - 99人</option>
                                            <option value="12">100 - 499人</option>
                                            <option value="13">500 - 999人</option>
                                            <option value="14">1000人以上</option>
                                    </select>
                                    <div style="display:none;" class="J_Error">请选择公司规模</div>
                                </td>
                            </tr>
                            <tr><th><em>*</em>所在地区：</th>
                                <td>
                                    <input type="text" reg="^.+$" value="" id="city-input" style="cursor:pointer" readonly="yes" class="text select-beauty J_checkInput">
                                    <input type="hidden" value="" id="city-hidden" name="corpCity">
                                    <a id="city-link" href="javascript:void(0);"></a>
                                    <div style="display:none;" class="J_Error">请选择所在地区</div>
                                </td>
                            </tr>
                            <tr><th><em>*</em>联系电话：</th>
                                <td class="input">
                                    <input type="text" blankclass="g9" blankvalue="区号" reg="^\d{3,4}$" class="text J_checkInput g9" name="zipcode" maxlength="4" value="" style="width:80px;margin-right:0" id="telZipcode"> -
                                    <input type="text" blankclass="g9" blankvalue="电话号码" reg="^\d{7,8}$" class="text J_checkInput g9" name="telephone" maxlength="10" value="" style="width:85px;margin-right:0" id="telephone"> -
                                    <input type="text" blankclass="g9" blankvalue="分机(选填)" blanksubmit="true" reg="numeric" name="extension" class="text J_checkInput g9" maxlength="10" value="" style="width:80px;">
                                    <div style="display:none;" class="J_Error">请输入3-4位国内区号和7-8位电话号码</div>
                                </td>
                            </tr>
                            <tr><th><em>*</em>公司地址：</th>
                                <td>
                                    <input type="text" value="" name="corpAddress" maxlength="100" class="text J_checkInput" reg="^.{1,100}$">
                                    <div style="display:none;" class="J_Error">请选填写公司地址</div>
                                </td>
                            </tr>
                            <tr><th>公司介绍：</th>
                                <td>
                                    <textarea id="c-info" name="corpIntro" blanksubmit="true" maxlength="1500" reg="^.{100,1500}$" class="J_checkInput J_showNumInput" style="width:500px"></textarea>
                                    <p class="g9">
                                        <i class="J_inputNum"><em class="J_nowNum">0</em>/<em class="J_sumNum">1500</em></i><br><span style="display:none;" class="J_Error f12">公司介绍应为100～1500字</span>
                                    </p>
                                </td>
                            </tr>
                            <tr class="last-tr">
                                <th>&nbsp;</th>
                                <td class="input" style="padding:10px 0 0 0">
                                    <a href="javascript:void(0);" class="big-fresh formValidateSubmit" id="J_formSubmit"><span>立即开通</span></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                <input name="_CSRFToken" type="hidden" value=""></form>
            </div>
        </div>
        <div class="ft"></div>
    </div>
</div>
<!-- content end -->
            </div>
    </div>
 </div>
 {include file="account/footer"}
