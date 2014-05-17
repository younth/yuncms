 {include file="header"}
<link href="__PUBLICAPP__/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/card.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/search.css" media="screen" rel="stylesheet" type="text/css" />
<div id="dj-content-wrap" class="dj-content-wrap dj-networks clearfix">
    <div class="dj-content-inner">
                <div class="dj-sub-title">
                    <h2>人&nbsp;脉<em>CONTACT</em></h2>
                </div>
            <div class="dj-content-shadow">
<div id="content">
        <div class="card-change-count" id="wrap">
    <div class="nav2-box">
        <ul class="nav2">
            <li><a href="{url('card/index')}"><span>我的联系人</span></a></li>
            <li class="selected"><a href="{url('card/search')}"><span>找人</span></a></li>
            <li ><a href="{url('card/invite')}"><span>邀请好友</span></a></li>
        </ul>
    </div>

            <input type="hidden" value="0" id="searchType">
            <input type="hidden" max="2000" value="35" id="myBuddyCnt">
            <input type="hidden" max="500" value="7" id="inviteBuddyCnt">
            <div class="search-chose" id="search_type_composite">
                <span>综合搜索</span>
            </div>            
            <!-- 搜索框 -->
            <div class="search-box" id="search-box">
                <input type="text" value="输入姓名、学校、标签等关键词搜索，各条件间请用空格区分" id="searchText" class="search-txt">
                <a id="searchBtn_composite" class="big-fresh" href="javascript:void(0);">
                    <span>找&nbsp;&nbsp;人</span>
                </a>
            </div>

    
</div>




            <!-- 可能认识的人 -->

            <div id="word-box" class="word-box">


<div class="mayknow-list">
                    <div class="list-tab clearfix">
                        <span class="selected">可能认识的人</span>
                    </div>
                    <div id="J-mayknowCardWall">
                    	<div class="list-content">
                        {if $mayknow}
                               {loop $mayknow $key $vo}
                            <div class="mayknow-card"><div class="user-content"><a class="head" target="_blank" href="{url('profile/user',array('id'=>$vo['id']))}"><img alt="" src="{$vo['small']}" ></a><div class="user-info"><p class="title"><a class="name" target="_blank" href="{url('profile/user',array('id'=>$vo['id']))}">{$vo['uname']}</a><em title="二度人脉" class="degree-type degree-type2"></em></p><p class="position"><span title="{$vo['school']} · {$vo['major']}">{$vo['school']} · {$vo['major']}</span></p></div></div><div class="ft"><span class="relationship">共有{$vo['allcart']}个联系人</span><a  class="dj-btn-xs dj-btn-icon J_addBtn add-clicklog" href="javascript:void(0)" onclick="addfriend({$vo['id']})"  id="friend{$vo['id']}"><i class="icon-add"></i>加联系人</a></div></div>
                     {/loop}
                      {else}    
                     <div id="search-null" class="search-null"> <p>没有找到符合条件的结果,再试试其他标签吧~</p></div>
                      {/if}            
                                        	 </div>
                    </div>
                    
                </div>



            </div>
                <!-- 搜索结果 -->
                <div id="icardm-add" class="icardm icardm-plus-tips" style="display: none;">
                    <div id="icardm-con" class="icardm-con">
<div class="icardm-con-tit">
    <div id="allnumber" class="num" style="display:block;">共找到<span>0</span>条符合条件的结果：</div>
</div>

<div class="search-null" id="search-null">
    <p>没有找到符合条件的结果...更换条件重新搜索吧。</p>
</div>
                    </div>
                </div>

                <!-- 搜索结果结束 -->
                <div id="loadingAction" class="loading" style="display:none">
                    <img alt="" src="__PUBLIC__/images/loading.gif">
                </div>

            
<!-- 给words添加class -->

<script>
$(function(){ 
	$('.search-txt').on({ 
	focus:function(){ 
			if (this.value == this.defaultValue){ 
				this.value=""; 
				} 
				}, 
	blur:function(){ 
	if (this.value == ""){ 
	this.value = this.defaultValue; 
	} 
	} 
	}); 
}) 
</script>

<script>
$(document).on( "keypress","#searchText", function (e) {
//e是事件对象
    if (e.keyCode == 13) {
            compositeSearch();//综合搜索
        }
    });

	var searchAjax = null;//定义空的对象
	var $searchText = $("#searchText");
	var $searchBtn_composite = $("#searchBtn_composite");
	var $resultBox = $("#icardm-con");//搜索结果 

	  $(document).on("click","#searchBtn_composite",  compositeSearch);//绑定事件
	  
	  function compositeSearch() {
        if (searchAjax != null) {
            searchAjax.abort();//提交ajax
        }
        var _val = $.trim($searchText.val());//去掉字符串首尾空格
        $searchText.val(_val);
        if (!!!_val || _val == '输入姓名、学校、标签等关键词搜索，各条件间请用空格区分') {
			//相当于未搜索
            $("#loadingAction").hide();
            // 更新界面组件
            $resultBox.empty();//清空搜索结果区域
            $resultBox.hide();
            return false;
        } else {	
            // 更改界面组件
            $resultBox.empty();//隐藏搜索结果区域
            $resultBox.hide();
            // 隐藏标签
            $("#word-box").hide();//隐藏可能认识的人
            $("#loadingAction").show();//显示加载图标
			
            searchAjax = $.ajax({
                type:'POST',
                url:"{url('card/search_result')}",
                dataType:"html",
                data:({'compositeSearchWord':_val}),
                success:function (callbackData) {
                    $("#loadingAction").hide();//成功之后隐藏加载图标
                    $("#icardm-add").show();//显示搜索结果div
                    $resultBox.empty();
                    $resultBox.append(callbackData);//将返回的数据加载到结果区
                    $resultBox.show();//显示结果

                    //控制锚点滚动,滚动动画效果
                    var _top = $(".search-box").offset().top;
                    if (navigator.userAgent.indexOf("Safari") > 0) {
                        $('body').animate({scrollTop:_top}, '300');
                    } else {
                        $('html').animate({scrollTop:_top}, '300');
                    }
					//翻页的效果
                    $(document).on( "click", ".paging a",function (e) {
                        e.preventDefault();
                        var $that = $(this);
                        //控制锚点滚动
                        setTimeout(function () {
                            var _top = $(".search-box").offset().top;
                            if (navigator.userAgent.indexOf("Safari") > 0) {
                                $('body').animate({scrollTop:_top}, '300');
                            } else {
                                $('html').animate({scrollTop:_top}, '300');
                            }
                            ;
                        }, 100);
                    });
                   
                },
				
                error:function () {
                    alert("出错了")
                    $("#loadingAction").hide();
                }
            });

        }
    }
</script>
<script>
		function addfriend(id)
		{
			var node='friend'+id;
			$.ajax({
			  url: "{url('card/addfriend')}",
			  data: {
				id: id,
			  },
				 success: function (data) {
					 //改变状态
					 $("#"+node).replaceWith("<a href='' target='_blank' class='dj-btn-xs dj-btn-icon J_addBtn add-clicklog cardTips-tocarded'><i class='icon-add'></i>等待确认</a>");
					
					 //移除节点
					//$("#"+node).remove();
				
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});

		}
</script>

<script>
	//添加好友，多个关系，可以不用函数
	$(document).on('click','.addfriend',function(){
		var $uid=$(this).parent().parent().attr("uid");//当前会员的id
		var node=$(this);//当前的节点
		//alert(node);return;
			  $.ajax({
			  type: "GET",
			  url: "{url('member/card/addfriend')}",
			  data: {
				id: $uid,
			  },
				 success: function (data) {
					if(data==1){
						layer.msg('发送成功，等待对方验证',2,-1);
						node.replaceWith('<span class="sented">等待对方确认</span>');
					}
					if(data==2){
						layer.msg('发送成功，你们已经互为联系人了~',2,-1);
						node.replaceWith('<a href="javascript:void(0)" id="single_mail" class="send-msg"  uid="'+$uid+'" title="发私信"></a>');
					}
					
					
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});
		
	});
</script>

</script>

</div>
</div>
            </div>
    </div>
</div>
 {include file="footer"}