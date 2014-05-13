{include file="header"}
<link href="__PUBLIC__/member/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/member/css/feedback.css" media="screen" rel="stylesheet" type="text/css" />

<div id="jy-content-wrap" class="jy-content-wrap jy-profile-mini">
    <div class="jy-content-inner">
                <div class="jy-sub-title">
                    <h2 style="display:none;"></h2>
                </div>
            <div class="jy-content-shadow">

<div id="content">
    <div class="profile-edit faq-content">
        <h2>
            <span>
            </span> <em></em> <i class="yahei">意见反馈</i>
        </h2>
        <div class="about-me-wrap">
        <p class="title">感谢使用91频道，你的反馈是对我们最大的鼓励和支持!</p>
        		<div class="faq-table">
                <form method="post" action="#" id="J_faqForm">
                    <input type="hidden" value="#" name="referer">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <th>内容：</th>
                            <td>
                                <textarea name="content"  class="faq-word formcheck" placeholder="请描述遇到的疑问或发现的问题（500字以内）。抱歉我们可能无法全部回复，但一定会认真阅读和处理。" maxlength="500"></textarea>
                                <p class="error-tips" style="display: none;">请输入1-500字</p>
                            </td>
                        </tr>
                        <tr>
                            <th>上传图片：</th>
                            <td>
                                <div class="btn-box">
                                    <a href="" class="dj-btn" id="J_upload">选择文件</a>
                                    <span class="tip">可上传3个文件，每个文件大小不超过2M。</span>
                                </div>
                                <ul class="up-list" id="J_uploadList"></ul>
                                <input type="hidden" name="photoUrl" id="J_uploadHidden">
                            </td>
                        </tr>
                        <tr>
                            <th>邮箱：</th>
                            <td>
                                <input type="text" value="{$auth['login_email']}" name="email" class="faq-mail formcheck" placeholder="请填入您的邮箱" maxlength="50">
                                <p class="error-tips">请输入正确的邮箱格式</p>
                            </td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <td>
                                <a href="#" class="dj-btn dj-btn-main J_enterForm">提交</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                <input type="hidden" name="_CSRFToken" value="#"></form>
            </div>
        </div>
    </div>
</div>
            </div>
    </div>
</div>
<script>
//ajax删除私信
$(document).on('click','.J_enterForm',function(){
	var content=$(".faq-word").val();
	var email=$(".faq-mail").val();
	//上传图片先不处理	
		  $.ajax({
		  type: "POST",
		  url: "{url('index/feedback')}",
		  data: {
			content: content,
			email:email,
		  },
			 success: function (data) {
				layer.msg('已收到您的反馈，我们会及时处理~',2,-1);
				setTimeout(function(){
				window.location.href="{url('member/index/index')}";
				//window.history.back(-1);
				},1000)
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});

	
})
</script>
{include file="footer"}