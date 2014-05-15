<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>基于yuncms的插件集合</title>
<style>

/*用span将上传的input覆盖，这样点击span实际上是点击的上传按钮*/
.btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px;*line-height:20px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
.btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
.progress { position:relative; margin-left:100px; margin-top:-24px; width:200px;padding: 1px; border-radius:3px;display:none;}
.progress .bar {background-color: green; display:block; width:0%; height:20px; border-radius: 3px; }
.progress .percent { position:absolute; height:20px; display:inline-block; top:3px; left:2%; color:#fff; }
.files{height:22px; line-height:22px; margin:10px 0}
.delimg{margin-left:20px; color:#090; cursor:pointer}
#showimg img{ width:20%;}
</style>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.form.js"></script>
</head>
<body>
<h1>php+ajax上传图片插件(支持多图片上传)</h1>

   		<div class="btn">
            <span>添加附件</span>
            <input id="fileupload" type="file" name="picture">
        </div>
        
        <div class="progress">
    		<span class="bar"></span><span class="percent">0%</span >
		</div>
        <div class="files"></div>
		<div id="showimg"></div>

<script>
$(function () {
	var bar = $('.bar');//进度条
	var percent = $('.percent');//进度数字
	var showimg = $('#showimg');//显示
	var progress = $(".progress");
	var files = $(".files");//显示文件
	var btn = $(".btn span");
	var url="{url('test/uploadimg')}";
	//wrap是包裹函数，给input包裹form表单，怎么不直接写html里面
	$("#fileupload").wrap("<form id='myupload' action='"+url+"' method='post' enctype='multipart/form-data'></form>");
	$("#fileupload").change(function(){
		//上传文件框触发事件，ajaxSubmit 异步提交
		$("#myupload").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		//showimg.empty();//清空showimg
				progress.show();//在form.js里面进行处理，显示进度的div
        		var percentVal = '0%';
        		bar.width(percentVal);//设置bar宽度，显示进度条
        		percent.html(percentVal);//显示初始的数字
				btn.html("上传中...");
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
        		var percentVal = percentComplete + '%';
        		bar.width(percentVal);//设置进度条的宽度，用于显示进度条
        		percent.html(percentVal);
    		},
			success: function(data) {
				files.append("<span class='showup'><b>"+data.name+"("+data.size+"k)</b> <span class='delimg' data-path='"+data.savepath+data.savename+"'>删除</span></span><br/>");
				showimg.append("<img src='{$path}"+data.newname+"'>");
				
				btn.html("添加附件");
			},
			error:function(xhr){
				btn.html("上传失败");
				bar.width('0')
				files.html(xhr.responseText);
			}
		});
		
	});
});

$(document).on("click",'.delimg',function(){
	//删除图片
	var bar = $('.bar');//进度条
	var path=$(this).data("path");
	var url="{url('test/delpic')}";
	var delnode=$(this).parent();
	$.ajax({
		  url: url,
		  data: {
			path: path,
		  },
			 success: function (data) {
				 //移除节点
				 //layer.msg('删除成功~',1,-1);
				 bar.width('0')
				 delnode.remove();
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});
})
</script>
</body>
</html>