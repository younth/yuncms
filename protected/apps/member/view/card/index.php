 {include file="header"}
<link href="__PUBLICAPP__/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/card.css" media="screen" rel="stylesheet" type="text/css" />
<div id="dj-content-wrap" class="dj-content-wrap dj-networks clearfix">
    <div class="dj-content-inner">
                <div class="dj-sub-title">
                    <h2>人&nbsp;脉<em>CONTACT</em></h2>
                </div>
            <div class="dj-content-shadow">
<div id="content">
<div id="maincolumn">
        <div id="content">
    <div class="nav2-box">
        <ul class="nav2">
            <li class="selected"><a href="{url('card/index')}"><span>我的联系人</span></a></li>
            <li><a href="{url('card/search')}"><span>找人</span></a></li>
            <li><a href="{url('card/invite')}"><span>邀请好友</span></a></li>
        </ul>
    </div>
            <div class="cart-wrap">
                
                <div class="card-right">
                    <div class="card-right-box">
                        <div class="card-right-head">
                    <span class="choses">
                        <label for="CheckedAll">
                            <input type="checkbox" id="CheckedAll">
                            全选 
                        </label>
                    </span>

                            <div class="chose-action">
                                <a href="javascript:void(0);" id="btn_copy" class="ngroup">修改分组</a><i>|</i><a style="" class="del last" href="javascript:void(0);" id="btn_del">解除关系<span allnum="5"></span></a>
                            </div>
                           
                        </div>
                        <div class="card-right-body">
                            <div class="card-list-wrap">
                            
                                <div class="card-list" id="card-list">
                                
                                
                                <dl id="a" class="card-group">
            <!--<dt><span>A</span><i class="line"></i></dt>-->
            	 {loop $mycard $key $vo}
                   <dd style="border-bottom: none"  class="" onclick="cardinfo({$vo['id']})" id="card{$vo['id']}">
                       <div class="user-box">
                        <span class="user-head" href="{url('profile/user',array('id'=>$vo['id']))}"><img width="30" height="30" alt="" src="{$vo['avatar']}"></span>
                        <div class="user-body"><p class="bold sms">
                            <span href="">{$vo['uname']}</span></p>
                            <p title="{$vo['school']} ·{$vo['major']}">{$vo['school']} · {$vo['major']}</p>
                        </div>
                      <a class="card-number" href="javascript:void(0)" title="{$vo['uname']}的联系人">  联系人数：{$vo['allcart']}</a></div>
                    <input type="checkbox" class="chekbox" id="{$vo['id']}" name="items">
                </dd>
                 {/loop}
        </dl>
<!--        <dl id="x" class="card-group">
            <dt><span>X</span><i class="line"></i></dt>
        </dl>
        <dl id="y" class="card-group">
            <dt><span>Y</span><i class="line"></i></dt>
        </dl>
        <dl id="z" class="card-group">
            <dt><span>Z</span><i class="line"></i></dt>
        </dl>
-->

</div>
                            </div>
                            <div class="card-defult" id="J_cardInfo">
                               
                            </div>
                            <!-- 人脉为空时 引导位 -->
                            <div id="root">

                            </div>
                            <!-- 引导结束 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 字母弹层 -->
        <div id="keyboard" class="keyboard">
            <span>A</span>
            <a href="#b">B</a>
            <a href="#c">C</a>
            <span>D</span>
            <span>E</span>
            <a href="#f">F</a>
            <a href="#g">G</a>
            <a href="#h">H</a>
            <span>I</span>
            <span>J</span>
            <span>K</span>
            <a href="#l">L</a>
            <span>M</span>
            <a href="#n">N</a>
            <a href="#o">O</a>
            <a href="#p">P</a>
            <span>Q</span>
            <span>R</span>
            <a href="#s">S</a>
            <a href="#t">T</a>
            <span>U</span>
            <span>V</span>
            <a href="#w">W</a>
            <a href="#x">X</a>
            <a href="#y">Y</a>
            <a href="#z">Z</a>
</div>
<!-- 弹出字母弹层 -->
</div>
</div>
            </div>
    </div>
</div>
<script>
$(function(){
	
	$("dl dd").hover(function(){
		$(this).addClass("hover");
	},
	function(){
		$(this).removeClass("hover");
		});
	
     //全选
     $("#CheckedAll").click(function(){
/*			if(this.checked){				 //如果当前点击的多选框被选中
				 $('input[type=checkbox][name=items]').attr("checked", true );
			}else{								
			     $('input[type=checkbox][name=items]').attr("checked", false );
			}
			this.checked  返回的是布尔值
*/	$('input[type=checkbox][name=items]').attr("checked",this.checked);
 });	
	 	//除了CheckedAll 按钮之外的其他按钮
	 $('input[type=checkbox][name=items]').click(function(){
		 //flag=false 说明至少有一个未被选中 true 全部被选中
			   var flag=true;
			   //循环复选组框，未被选中的flag=false
               $('input[type=checkbox][name=items]').each(function(){
					if(!this.checked){
						 flag = false;
					}
			   });

				$('#CheckedAll').attr('checked',flag);
/*			   if( flag ){
					 $('#CheckedAll').attr('checked', true );
			   }else{
					 $('#CheckedAll').attr('checked', false );
			   }
*/	 });

</script>

<script type="text/javascript">
function cardinfo(id){
	var node="#card"+id;
	$(node).addClass("checked").siblings().removeClass("checked");//去除兄弟节点的选中效果
	 var $rightCard = $("#J_cardInfo");
  $.ajax({
	  type: "GET",
      url: "{url('member/card/loadcard')}",
	  dataType: "html",
      data: {
        id: id,
	  },
		 success: function (data) {
			// alert(data);
			$rightCard.removeClass("card-defult").addClass("card-info-wrap");
				//$rightCard.attr("class","card-info-wrap");
			  	$rightCard.html(data);
				var colorArr = ['#61cccd','#2b9bd7','#ff9960','#99999f'];
				$('#personalTags span').each(function (index) {
                        var colorIndex = index % colorArr.length,
                                color = colorArr[colorIndex];

                        $(this).css({'color':color});
                    });

		 },
		  error: function (msg) {
                alert(msg);
		  }
    });
}


</script>
<script>
	//解除关系
	$(document).on('click','#delfriend',function(){
		var $uid=$(this).attr("uid");//放在最外边
		var $rightCard = $("#J_cardInfo");//名片区域
		var nowobj="card"+$uid;
		var delnode=$("#"+nowobj);
		layer.confirm('确定解除关系吗？', function(){ 
			  $.ajax({
			  type: "GET",
			  url: "{url('member/card/delfriend')}",
			  data: {
				id: $uid,
			  },
				 success: function (data) {
					//
					layer.msg('删除好友成功！',2,-1);
					delnode.remove();
					$rightCard.empty().attr("class","card-defult");//删除右侧的名片显示
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});

		
		});
		
	});
	
//发送私信
$(document).on('click', '.send-msg',function(){
	var id=$(this).data('id');//接受者id
	//参数传不到url....构造url
	var url="{url('message/sendmsg')}";
	url+="&id="+id;
    var i=$.layer({
        type: 2,
        title: '发送私信',
        shadeClose: false, //开启点击遮罩关闭层
        area : ['560px' , '360px'],
        offset : ['260px', '540px'],
        iframe: {src: url}
    });
});


</script>
 {include file="footer"}