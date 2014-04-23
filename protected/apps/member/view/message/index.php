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
                <a class="green" href="/yuncms/index.php?yun=member/profile/index">返回我的档案</a>
            </span>
          <em></em><i>我的私信</i>
        </h2>

        <div class="msg-main  ">
<div class="fun-menu clearfix">
    <div class="menu-i">
        <a id="middleMenuBtn" data-num="1" href="/message/summary/unread" class="">
            未读私信(1)
        </a>
            <i class="pointer"></i>
    </div>
    <div class="menu-i selected">
        <a id="letterMenuBtn" class="" href="">
            全部私信
        </a>
    </div>

</div>            <div class="list-item msg-list">
                    <ul>
                            {loop $msg $key $vo}
                    		<li data-href="{url('message/content',array('id'=>$vo['list_id'],'name'=>$vo['user']['uname']))}" class="" id="{$vo['mid']}">
                                <div class="item-layout">
                                    <div class="pic">
                                        <a target="_blank" href="{url('profile/user',array('id'=>$vo['mid']))}">
                                            <img src="{$vo['user']['small']}">
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <p class="item-h">
                                            <a href="{url('profile/user',array('id'=>$vo['mid']))}" class="name b" target="_blank">
                                            {$vo['user']['uname']}
                                            </a>
                                        </p>

                                        <p class="desc"><img src="__PUBLICAPP__/images/reply2.png">{$vo['msg']}</p>
                                    </div>
                                    <input type="checkbox" class="checkbox">
                                    <span class="time g9" style="display: block;">{timeshow($vo['time'])}</span>
                                    <a data-name=" {$vo['user']['uname']}" class="del-btn" data-id="{$vo['mid']}" href="javascript:;" style="display: none;">x</a>
                                </div>
                            </li>
                      {/loop}
                    </ul>
                    <div class="all-mark">
                        <input type="checkbox" class="checkbox">
                        <span class="del-sel">删除</span>
                        <span class="dot-middle">.</span>
                        <span class="mark-sel">标记为已读</span>
                    </div>
            </div>
        </div>
    </div>
</div>
            </div>
    </div>
</div>
<script>
$(function(){ 
	$('.msg-list ul li').on({
	mousemove:function(){ 
		var id=$(this).attr('id');//获取当前data-id
		$(this).addClass("hover");
		$("#"+id+" span").css("display","none");
		$("#"+id+" a").css("display","inline");
		
	}, 
	mouseleave:function(){ 
	$(this).removeClass("hover");
		$(".time").css("display","block");
		$(".del-btn").css("display","none");
	} ,
	click:function(){
		//改变链接
		var url=$(this).data("href");
		window.location.href=url;
	}
	}); 
}) 

//ajax删除私信

$(document).on('click','.del-btn',function(){
	var id=$(this).data("id");//私信记录的id
	var name=$(this).data("name");//私信记录的id
	
	layer.confirm('确定删除与'+name+'所有私信记录吗？', function(){ 
		  $.ajax({
		  type: "GET",
		  url: "{url('member/message/delmsg')}",
		  data: {
			id: id,
		  },
			 success: function (data) {
				//
				layer.msg('不好意思，暂未开放~！',2,-1);
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});

	
	});
	
})

</script>

{include file="footer"}