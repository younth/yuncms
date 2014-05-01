<script src="__PUBLIC__/uploadspicture/js/jquery.form.js" type="text/javascript"></script>
<style type="text/css">
.demo{width:260px;}
.btn{float: left;height: 20px;position: relative;overflow: hidden;margin-left: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px;*line-height:20px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
.btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
.progress { position:relative; float: left;   width:200px;padding: 1px; border-radius:3px; display:none}
.bar {background-color: green; display:block; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; height:20px; display:inline-block; top:3px; left:2%; color:#fff }
.files{height:22px; width: 100px; line-height:22px; float:right; padding-top: 2px;}
.delimg{margin-left:20px; color:#090; cursor:pointer}
</style>
<div class="demo" id="feed_pic_content">
   		<div class="btn">
            <span>添加附件</span>
            <input id="fileupload" type="file" name="mypic">
        </div>
        <div class="files"></div><div class="progress">
        <span class="bar"></span><span class="percent">0%</span >
        </div>
        <div id="showimg" class="showimg" style="width:auto; float: left;  "></div>
</div>

<script type="text/javascript">
$(function () {
	var bar = $('.bar');
	var percent = $('.percent');
	var showimg = $('#showimg');
	var progress = $(".progress");
	var files = $(".files");
	var btn = $(".btn span");
	$("#fileupload").wrap("<form id='myupload' action='{$url_showpic}' method='post' enctype='multipart/form-data'></form>");
    $("#fileupload").change(function(){
		$("#myupload").ajaxSubmit({
			beforeSend: function() {
                            showimg.empty();
				progress.show();
        		var percentVal = '0%';
        		bar.width(percentVal);
        		percent.html(percentVal);
				btn.html("上传中...");
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
        		var percentVal = percentComplete + '%';
        		bar.width(percentVal);
        		percent.html(percentVal);
    		},
			success: function(data) {
//                                files.html(data);
				files.html("<span class='delimg' rel='"+data+"' onclick='deletePic()'>删除</span>");
				showimg.html("<img id='feed_post_picture' postval='__UPLOAD__/member/img/"+data+"'  src='__UPLOAD__/member/img/thumb_"+data+"'/>");
				btn.html("添加附件");
			},
			error:function(xhr){
				btn.html("上传失败");
				bar.width('0')
				files.html(xhr.responseText);
			}
		});
	});
	
	
        deletePic=function(){
           var imgCon  =$('#showimg').html();
            if(imgCon!==""){
                var pic = $(".delimg").attr("rel");
                    $.post("{$url_delpic}",{imagename:pic},function(msg){
                            if(msg==1){
                                    files.html("删除成功.");
                                    showimg.empty();
                                    progress.hide();
                            }else{
                                    alert(msg);
                            }
                    });
             }
             else{
                 return 1;
             }
        };
        //点击叉叉关闭
        closePic=function(){
                deletePic();
                $('#show_pic_con').html("");
                $('#show_pic_frame').fadeOut();
           };
           
});
</script>