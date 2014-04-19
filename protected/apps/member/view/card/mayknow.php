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
            <li><a href="{url('card/index')}"><span>我的联系人</span></a></li>
            <li><a href="{url('card/search')}"><span>找人</span></a></li>
            <li class="selected"><a href="{url('card/mayknow')}"><span>可能认识的人</span></a></li>
            <li><a href="{url('card/invite')}"><span>邀请好友</span></a></li>
        </ul>
    </div>
    
    
    
    <br />
    
            
             
            <div class="page-main">
			<div class="search-box" id="search-box">
          <!--  ajax实现搜索-->
          <form target="_blank" id="search-form" action="{url('card/search')}">
                <input type="text" value="输入姓名、公司、学校、标签等关键词搜索，各条件间请用空格区分" id="searchText" class="search-txt" style="color: rgb(153, 153, 153); font-size: 12px;" name="keyword">
                <a id="searchBtn_composite" class="big-fresh" href="javascript:search-form.submit()">
                    <span>找&nbsp;&nbsp;人</span>
                </a>
                </form>
            </div>
				
                
                <div class="mayknow-list">
                    <div class="list-tab clearfix">
                        <a class="selected" data-type="0" href="#">全部</a>
                    </div>
                    <div id="J-mayknowCardWall">
                    	<div class="list-content">
                         {loop $mayknow $key $vo}
                            <div class="mayknow-card" id="friend{$vo['id']}"><div class="user-content"><a class="head" target="_blank" href="{url('profile/user',array('id'=>$vo['id']))}"><img alt="" src="{$vo['small']}" ></a><div class="user-info"><p class="title"><a class="name" target="_blank" href="{url('profile/user',array('id'=>$vo['id']))}">{$vo['uname']}</a><em title="二度人脉" class="degree-type degree-type2"></em></p><p class="position"><span title="{$vo['school']} · {$vo['major']}">{$vo['school']} · {$vo['major']}</span></p></div></div><div class="ft"><span class="relationship">共有{$vo['allcart']}个联系人</span><a  class="dj-btn-xs dj-btn-icon J_addBtn add-clicklog" href="javascript:void(0)" onclick="addfriend({$vo['id']})"><i class="icon-add"></i>加联系人</a></div><a  class="remove" href=""></a></div>
                     {/loop}
                   	 </div>
                    </div>
                    <a class="more" href="#">查看更多</a>
                </div>
            </div>
            <!-- 内容结束 -->
        </div>
</div>
</div>

            </div>
    </div>
</div>
<script>
$(function(){ 
	$('.search-txt').bind({ 
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
		function addfriend(id)
		{
			var node='friend'+id;
			$.ajax({
			  url: "{url('card/send')}",
			  data: {
				id: id,
			  },
				 success: function (data) {
					$("#"+node).remove();
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});

		}
	</script>

 {include file="footer"}