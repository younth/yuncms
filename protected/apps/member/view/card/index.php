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
            <li><a href="{url('card/index')}"><span>找人</span></a></li>
            <li><a href="{url('card/mayknow')}"><span>可能认识的人</span></a></li>
            <li><a href="{url('card/invite')}"><span>邀请好友</span></a></li>
        </ul>
    </div>
            <div class="cart-wrap">
                
                <div class="card-right">
                    <div class="card-right-box">
                        <div class="card-right-head">
                    <span class="choses">
                        <label for="delall">
                            <input type="checkbox" id="delall">
                            全选  <input type="checkbox" id="no">
                            反选
                        </label>
                    </span>

                            <div class="chose-action">
                                <a href="javascript:void(0);" id="btn_copy" class="ngroup">修改分组</a><i>|</i><a style="" class="del last" href="javascript:void(0);" id="btn_del">解除关系<span allnum="5"></span></a>
                            </div>
                            <a href="javascript:void(0)" class="name-search"> </a>
                           
                        </div>
                        <div class="card-right-body">
                            <div class="card-list-wrap">
                            
                                <div class="card-list" id="card-list">
                                
                                
                                <dl id="a" class="card-group">
            <!--<dt><span>A</span><i class="line"></i></dt>-->
            	 {loop $mycard $key $vo}
                   <dd style="border-bottom: none"  class="" onclick="cardinfo({$vo['id']})">
                       <div class="user-box">
                        <span class="user-head" href="{url('profile/user',array('id'=>$vo['id']))}"><img width="30" height="30" alt="" src="{$vo['avatar']}"></span>
                        <div class="user-body"><p class="bold sms">
                            <span href="">{$vo['uname']}</span></p>
                            <p title="{$vo['school']} ·{$vo['major']}">{$vo['school']} · {$vo['major']}</p>
                        </div>
                      <a class="card-number" href="" title="{$vo['uname']}的联系人">  联系人数：{$vo['allcart']}</a></div>
                    <input type="checkbox" class="chekbox" id="{$vo['id']}">
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
	
	$("#delall").click(function(){
   		 $(".chekbox").attr("checked",'true');//全选
    });
	
	$("#no").click(function(){
   		 $("input:checkbox").removeAttr("checked");//全选
    });
	
	//解除关系
	$(".chekbox").click(function(){
		var $id=$(this).attr("id");//当前用户id
		//暂时不做
	});
	
var timer = null;
        var $keyboard = $(".keyboard");
        $(".name-search").mouseover(function (e) {
            var _left = $(this).offset().left - 120;
            var _top = $(this).offset().top + 25;
            clearTimeout(timer);
            $keyboard.css({'display': 'block', 'left': _left + 'px', 'top': _top + 'px'});
        });
        $(".name-search").mouseout(function (e) {
            timer = setTimeout(function () {
                $keyboard.css({'display': 'none'})
            }, 200);
        });
        $keyboard.mouseenter(function (e) {
            clearTimeout(timer);
            $keyboard.css({'display': 'block'});
        });
        $keyboard.mouseleave(function (e) {
            timer = setTimeout(function () {
                $keyboard.css({'display': 'none'})
            }, 200);
        });	
})
</script>

<script type="text/javascript">
function cardinfo(id){
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
    });}


</script>
 {include file="footer"}