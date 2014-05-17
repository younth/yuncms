{include file="header"}
<link href="__PUBLIC__/member/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/member/css/feedback.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.form.js"></script>
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
        <p class="title">感谢使用91频道，您的反馈是对我们最大的鼓励和支持!</p>
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
                                   <a id="J_upload" class="dj-btn" href="">选择文件</a>
                                   <span class="tip">上传图片（最多5张），以便我们更好的理解，每个文件大小不超过2M。</span>
                                    <input id="fileupload" type="file" name="picture">
                                    
                                </div>
                                <ul class="up-list" id="J_uploadList">
                                </ul>
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
                                <a href="javascript:;" class="dj-btn dj-btn-main J_enterForm">提交</a>
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
//ajax反馈
$(document).on('click','.J_enterForm',function(){
	var content=$(".faq-word").val();
	var email=$(".faq-mail").val();
	//上传图片处理
	if(!content){
		$(".faq-word").parent().find("p").show();//选择提示的class
		$(".faq-word").focus();
		return;
	}
	if(!email){
		$(".faq-mail").parent().find("p").show();
		$(".faq-mail").focus();
		return;
	}
	var str = "";
	$("#J_uploadList li").each(function(){str+=$('a',this).data('name')+','});
	imgstr=str.substring(0,str.length-1);//去掉最后一个逗号
		  $.ajax({
		  type: "POST",
		  url: "{url('index/feedback')}",
		  data: {
			content: content,
			email:email,
			img:imgstr,
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
<script>
$(function () {
	//上传图片
	var percent = $('#J_upload');//进度数字
	var files = $('#J_uploadList');//显示ul
	var url="{url('index/uploadimg')}";
	//wrap是包裹函数，给input包裹form表单，怎么不直接写html里面
	$("#fileupload").wrap("<form id='myupload' action='"+url+"' method='post' enctype='multipart/form-data'></form>");
	var imgnum=0;
	$("#fileupload").change(function(){
		//上传文件框触发事件，ajaxSubmit 异步提交
		if(imgnum>1){
			alert('最多上传5张图片');return;	
		}
		$("#myupload").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		var percentVal = '0%';
        		percent.html(percentVal);//显示初始的数字
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
        		var percentVal = percentComplete + '%';
        		percent.html(percentVal);
    		},
			success: function(data) {
				imgnum++;//图片数量+1
				files.append("<li>"+data.name+"("+data.size+"k)<a data-name='"+data.newname+"' href='javascript:;' class='delimg'>删除</a> </li>");
				percent.html("添加附件");
			},
			error:function(xhr){
				percent.html("上传失败");
				files.html(xhr.responseText);
			}
		});
		
	});
	
});

$(document).on("click",'.delimg',function(){
	//删除图片
	var name=$(this).data("name");
	var url="{url('index/delfeedPic')}";
	var delnode=$(this).parent();
	$.ajax({
		  url: url,
		  data: {
			imagename: name,
		  },
			 success: function (data) {
				 //移除节点
				 delnode.remove();
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});
})

</script>
{include file="footer"}