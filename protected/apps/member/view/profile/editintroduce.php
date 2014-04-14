{include file="header"}
<link href="__PUBLIC__/member/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/member/css/aboutme.css" media="screen" rel="stylesheet" type="text/css" />

<div id="jy-content-wrap" class="jy-content-wrap jy-profile-mini">
    <div class="jy-content-inner">
                <div class="jy-sub-title">
                    <h2 style="display:none;"></h2>
                </div>
            <div class="jy-content-shadow">

<div id="content">
    <div class="profile-edit">
        <h2>
            <span>
                <a href="{url('profile/index')}" class="green">返回我的档案</a>
            </span> <em></em> <i class="yahei">编辑关于我</i>
        </h2>
        <div class="about-me-wrap">
            <p class="tips">一段简要的自我描述，可让别人快速了解自己。</p>
            <form action="" method="post" id="J_sendForm">
                <div class="edit-content">
                    <div class="hd">关于我：</div>
                    <div class="bd">
                <textarea name="introduce" placeholder="添加关于自己职业经历、能力经验等描述信息（10-500字）" class="me-text J_checkInput">{$introduce}</textarea>
                        <p class="error-tips" style="display: none;">请添加10-500字的描述信息</p>
                    </div>
                    <div class="bd">
                        <div class="slide-content">
                            <a href="javascript:void(0)" class="slide-btn slide-up">
                                看看别人怎么写<em class="hander"></em>
                            </a>
                            <div class="example-box">
                                <dl class="example">
                                    <dt>示例一：</dt>
                                    <dd>
                                        从事财务工作6年，其中2年管理经验，4年的外资全盘账务处理经验。擅长精确核算收入、成本利润。对进出口医疗卫浴、IT、旅游等行业的税务政策及工作都非常熟悉。
                                    </dd>
                                </dl>
                                <dl class="example">
                                    <dt>示例二：</dt>
                                    <dd>
                                        多年来供职于大中型企业的市场策划部门，积累了丰富工作经验。对市场动态把握，整体市场策划与实施都有深入地研究。自修市场营销与管理本科课程，喜欢接受新的挑战并努力完成。
                                    </dd>
                                </dl>
                                <dl class="example last">
                                    <dt>示例三：</dt>
                                    <dd>
                                        从事互联网产品设计及运营8年，丰富的产品生命周期管理、产品架构设计、商业推广经验，独立带领中大型团队进行项目协作。熟悉社区、电子商务、支付生活消费类等产品。
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bd btn-box">
                        <a href="javascript:void(0);J_sendForm.submit();" class="big-fresh formValidateSubmit" id="J_formSubmit">
                            <span style="float:left;">保存</span>
                        </a>
                        <a href="{url('profile/index')}" class="big-normal" id="J_formCancel">
                            <span style="float:left;">取消</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
            </div>
    </div>
</div>
<script>
$(function(){
$(".slide-up").click(function(){
	$(".example-box").toggle();//切换显示
})
	
})
</script>
{include file="footer"}