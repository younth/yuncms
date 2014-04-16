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
            <li class="selected"><a href="#"><span>我的联系人</span></a></li>
            <li><a href="#"><span>找人</span></a></li>
            <li><a href="#"><span>可能认识的人</span></a></li>
            <li><a href="#"><span>发现好友</span></a></li>
            <li><a href="#"><span>邀请好友</span></a></li>
        </ul>
    </div>
            <div class="cart-wrap">
                
                <div class="card-right">
                    <div class="card-right-box">
                        <div class="card-right-head">
                    <span class="choses">
                        <label for="delall">
                            <input type="checkbox" id="delall">
                            全选
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
                   <dd style="border-bottom: none" gid="1"  class="" onclick="cardinfo({$vo['id']})">
                       <div class="user-box">
                        <span class="user-head" href="{url('profile/user',array('id'=>$vo['id']))}"><img width="30" height="30" alt="" src="{$vo['avatar']}"></span>
                        <div class="user-body"><p class="bold sms">
                            <span href="">{$vo['uname']}</span></p>
                            <p title="{$vo['school']} ·{$vo['major']}">{$vo['school']} · {$vo['major']}</p>
                        </div>
                      <a class="card-number" href="" title="{$vo['uname']}的联系人">  联系人数：{$vo['allcart']}</a></div>
                    <input type="checkbox" class="chekbox">
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
        <div id="ltips" class="prompt-box lay-litter-tips top" style="display:none;">
            <div class="shadow">
                <div class="prompt-main"><span class="pointer"></span>

                    <div class="con">
                        <p>要解除关系吗？</p>
                    </div>
                    <div class="btn">
                        <button class="fresh">确定</button>
                        &nbsp;&nbsp;
                        <button class="normal">取消</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="display:none;" class="prompt-box lay-change-card top" id="lay-change-card">
            <div class="shadow">
                <div class="prompt-main"><span class="pointer"></span>

                    
                    <div class="btn">
                        <span style="display:none;" class="red" id="no-group-alert">请选择分组</span>
                        <button class="fresh">确定</button>
                        &nbsp;&nbsp;
                        <button class="normal">取消</button>
                        <input type="button" style="display:none" class="icard-change-sub" id="icard-change-sub">
                    </div>
                </div>
            </div>
        </div>
        <div id="lay_del_group" class="prompt-box lay-litter-tips" style="display:none;">
            <div class="shadow">
                <div class="prompt-main"><span class="pointer"></span>

                    <div class="con">
                        <p>要删除分组吗？</p>
                    </div>
                    <div class="btn">
                        <button class="fresh">确定</button>
                        &nbsp;&nbsp;
                        <button class="normal">取消</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="display:none;" class="prompt-box" id="lay-viewmark">
            <div class="shadow">
                <div class="prompt-main"><span class="pointer"></span><a href="javascript:void(0)" class="remove floatright">关闭</a>

                    <div class="con"></div>
                </div>
            </div>
        </div>
        <div style="display:none;" id="lay-remark">
            <table width="100%" class="form smail-con" id="lay-remark-con">
                <tbody>
                <tr>
                    <td style="padding-bottom:5px;">
                        <p class="smail-name" id="lay-remark-name">对&nbsp;<span class="smail-to" id="lay-remark-to"></span>&nbsp;的备注</p>
                    </td>
                </tr>
                <tr>
                    <td>
                <span class="smail-wrap lay-remark-check">
                    <textarea blanksubmit="true" reg="^.{2,100}$" name="content" rows="" cols="" class="textarea" id="lay-remark-val"></textarea>
                    <em style="display:none;"><i>内容为2-100字</i></em>
                </span>
                        <input type="button" style="display:none;" class="lay-remark-submit" id="lay-remark-submit">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div id="lay_remove_from_group" class="prompt-box lay-litter-tips" style="display:none;">
            <div class="shadow">
                <div class="prompt-main"><span class="pointer"></span>

                    <div class="con">
                        <p>从本组移除？</p>
                    </div>
                    <div class="btn">
                        <button class="fresh">确定</button>
                        &nbsp;&nbsp;
                        <button class="normal">取消</button>
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
<div style="display:none;" id="smail">
    <form onsubmit="return false" id="message-form">
        <table width="100%" class="form" id="smail-con">
            <colgroup>
                <col width="60">
                <col width="*">
            </colgroup>
            <tbody>
            <tr>
                <td style="padding-bottom:20px;" colspan="2">
                    <p id="smail-name">给&nbsp;<span id="smail-to"></span>&nbsp;写站内信</p>
                </td>
            </tr>
            <tr>
                <td class="label-m b g9">主题：</td>
                <td>
                    <span class="input_wrap">
                        <input type="text" style="width: 376px; border: 1px solid rgb(204, 204, 204);" reg=".+" maxlength="30" name="title" class="text ipt" id="textfield">
                        <em style="display: none; position: absolute; left: 0px; top: 0px; border: 1px solid rgb(255, 0, 0); width: 376px; height: 18px; padding: 2px; margin: 0px; background: none repeat-x scroll 18px center rgb(255, 255, 255); overflow: hidden; color: rgb(153, 153, 153); line-height: 16px; font-size: 12px; font-style: normal; font-weight: 400;">主题不能为空</em>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label b g9">内容：</td>
                <td>
                    <span class="input_wrap">
                        <textarea style="border: 1px solid rgb(204, 204, 204);" reg="^.{1,500}$" name="content" rows="" cols="" id="textarea" class="textarea"></textarea>
                        <em style="display: none; position: absolute; left: 0px; top: 0px; border: 1px solid rgb(255, 0, 0); width: 380px; height: 90px; padding: 0px; margin: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); overflow: hidden;"><i style="background: none repeat-x scroll 86px center rgb(255, 255, 255); color: rgb(153, 153, 153); line-height: 16px; font-size: 12px; font-style: normal; font-weight: 400; padding: 0px 0px 20px; margin: 0px; display: inline;">请输入1~500个字符</i></em>
                    </span>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button type="submit" id="button" class="default inputCheckNormalSubmit">
                        <span><span>发送</span></span></button>
                </td>
            </tr>
            <input type="hidden" name="uids" id="buddyUids">
            </tbody>
        </table>
    <input type="hidden" name="_CSRFToken" value="ZBhkShLiXtOMI9bi0CYvvDTYgmNmMBIHFOhWhGtQ"></form>
</div><!-- 弹出字母弹层 -->
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
		})
	
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