{include file="header"}
 <link href="__PUBLICAPP__/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
 <link href="__PUBLICAPP__/css/message.css" media="screen" rel="stylesheet" type="text/css" />

<div id="dj-content-wrap" class="dj-content-wrap ">
    <div class="dj-content-inner">
            <div class="dj-content-shadow">
<div id="content" class="clearfix">
    <div class="msgcenter-box">
        <h2 class="title">
        <span>
                <a class="green" href="{url('message/index')}">返回我的私信</a>
            </span>
          <em></em><i>与{$name}的私信</i>
        </h2>

        <div class="msg-main  ">
            <div class="msg-tip clearfix">
                        <span class="p-time">发起于 2014-04-23 14:47:59</span>
             </div>


<div class="list-item terminal-list">

    <div class="day-list">
        <div class="day-box">
            <div class="day-box-i"></div>
<!--        <span class="day">
                今天
        </span>-->
        </div>
        <ul>
 {loop $msg $key $vo}
<li class="noborder" id="{$vo['id']}">
    <div class="item-layout">
        <div class="pic">
            <a href="{url('profile/user',array('id'=>$vo['mid']))}">
                <img src="{$vo['user']['small']}">
            </a>
        </div>
        <div class="item-content">
            <p class="item-h">
                <a href="{url('profile/user',array('id'=>$vo['mid']))}" class="name b">
                 {$vo['user']['uname']}
                </a>
            </p>

            <p class="desc"> {$vo['content']}</p>
        </div>
        <span class="time g9" style="display: block;">{timeshow($vo['ctime'])}</span>
        <a data-name=" {$vo['user']['uname']}" class="del-btn" data-id="{$vo['id']}" href="javascript:;" style="display: none;">x</a>
    </div>
</li>
{/loop}
        </ul>
    </div>

            <input type="hidden" value="1894448" id="earliestId"></div>
            
                        
		<div class="reply-box">
                    <textarea name="content"  class="input-txt" placeholder="最多只能输入1000个字..."></textarea>

                    <p class="action clearfix">
                        <a href="javascript:;" data-id="{$list_id}" class="dj-btn-main reply-btn">回信</a>
                    </p>

            </div>	
            
        </div>
    </div>
</div>
            </div>
    </div>
</div>
<script>
$(function(){ 
	$('.day-list ul li').on({
	mousemove:function(){
		var id=$(this).attr('id');//获取当前data-id
		//alert(id);return;
		$(this).addClass("hover");
		$(this).find("span").css("display","none");
		//$("#"+id+" span").css("display","none");
		$(this).find("a").css("display","inline");
		//$("#"+id+" a").css("display","inline");
		
	}, 
	mouseleave:function(){ 
	$(this).removeClass("hover");
		$(".time").css("display","block");
		$(".del-btn").css("display","none");
	} 
	}); 
}) 

//ajax删除私信
$(document).on('click','.del-btn',function(){
	var id=$(this).data("id");//私信记录的id
	var name=$(this).data("name");//私信记录的id
	var node="#"+id;
	layer.confirm('确定删除该私信记录吗？', function(){ 
		  $.ajax({
		  type: "GET",
		  url: "{url('member/message/del_detailmsg')}",
		  data: {
			id: id,
		  },
			 success: function (data) {
				$(node).remove();
				layer.msg('删除成功',2,-1);
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});

	});
})


//ajax回复私信
$(document).on('click','.reply-btn',function(){
	var id=$(this).data("id");//私信记录的id
	var content=$(".input-txt").val();//私信的内容
	var insert_node=$(".day-list ul");
		  $.ajax({
		  type: "GET",
		  url: "{url('member/message/reply_msg')}",
		  data: {
			id: id,
			content:content,
		  },
			 success: function (data) {
				 //这里最好添加一个动画效果
				 insert_node.append(data);
				 $(".input-txt").val("");//清空内容
				layer.msg('回复成功',1,-1);
				
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});

})

</script>

{include file="footer"}