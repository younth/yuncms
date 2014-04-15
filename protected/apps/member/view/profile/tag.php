{include file="header"}
<link href="__PUBLICAPP__/css/profile_common.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/skill.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLICAPP__/css/tag.css" media="screen" rel="stylesheet" type="text/css" />

<div id="jy-content-wrap" class="jy-content-wrap jy-profile-mini">
    <div class="jy-content-inner">
      <div class="jy-sub-title">
        <div class="jy-sub-title">
          <h2 style="display:none;"></h2>
        </div>
      </div>
      <div class="jy-content-shadow">

<div id="content">
    <div class="test-main">
      
        <div class="test-top">
            <div class="photo-box">
                <img src="{$middle_photo}" alt="{$auth['uname']}">
            </div>
            <div class="tit g-yahei">{$auth['uname']}，
                        秀出自己专长，方便大家快速了解自己
            </div>
            <div class="yxl-box">
                <div class="inner J_yxl" style="height: 31px;"></div>
            </div>
        </div>
        
        
        <div class="edit-special-wrap">
        
            	<div class="plus-tag tagbtn clearfix" id="myTags">
                 <h3 class="special-title">已添加：</h3>
           	{loop $mytag $key $vo}
				<a value="{$vo['id']}" title="{$vo['name']}" href="javascript:void(0);"><span>{$vo['name']}</span><em></em></a>
             {/loop}    
    			</div>

            
	<div class="plus-tag-add">
		<form id="" action="" class="login">
			<ul class="Form FancyForm">
				<li>
                	<label>输入标签</label>
					<input id="" name="" type="text" class="stext" maxlength="20" />
                    <button type="button" class="Button RedButton Button18">添加标签</button>
                     <p class="label-error" style="display: none;"></p>
				</li>
			</ul>
		</form>
	</div><!--plus-tag-add end-->
    
	<!--mycard-plus end-->
<div class="add-label">
                <h3 class="default-label-title">快速添加符合自己的技能标签：</h3>
                <div class="default-label-wrap">
                    <div class="label-animate-wrap">
                        
                        
                        <div id="mycard-plus">
		<div class="default-tag tagbtn">
			<div class="clearfix">
           	{tag:{table=(sort) field=(id,name,url,type) order=(norder desc) where=(type=5)  sort=(100038)}}
				<a value="[tag:id]" title="[tag:name]" href="javascript:void(0);"><span>[tag:name]</span><em></em></a>
             {/tag}    
			</div>
			<div class="clearfix" style="display:none;">
            {tag:{table=(sort) field=(id,name,url,type) order=(norder desc) where=(type=5)  sort=(100074)}}
				<a value="[tag:id]" title="[tag:name]" href="javascript:void(0);"><span>[tag:name]</span><em></em></a>
              {/tag}     
            </div>
			<div class="clearfix" style="display:none;">
              {tag:{table=(sort) field=(id,name,url,type) order=(norder desc) where=(type=5)  sort=(100075)}}
				<a value="[tag:id]" title="[tag:name]" href="javascript:void(0);"><span>[tag:name]</span><em></em></a>
              {/tag}     
            </div>
		</div>
		<div align="right"><a href="javascript:void(0);" id="change-tips" style="color:#3366cc;">换一换</a></div>
	</div>
                        
                        
                    </div>
                    
                </div>
            </div>
            
            
            <div class="bd btn-box">
                <a class="p-btn dj-btn-info dj-btn-xl" href="url('member/index/index')">确定</a>
                <a class="g9" href="url('member/index/index')">取消，进去首页</a>
            </div>
            
            
    </div>
</div>
            </div>
    </div>
</div>

<script type="text/javascript">
var FancyForm=function(){
	return{
		inputs:".FancyForm input, .FancyForm textarea",
		setup:function(){
			var a=this;
			this.inputs=$(this.inputs);
			a.inputs.each(function(){
				var c=$(this);
				a.checkVal(c)
			});
			a.inputs.live("keyup blur",function(){
				var c=$(this);
				a.checkVal(c);
			});
		},checkVal:function(a){
			a.val().length>0?a.parent("li").addClass("val"):a.parent("li").removeClass("val")
		}
	}
}();
</script>

<script type="text/javascript">
$(document).ready(function() {
	//调用函数
	FancyForm.setup();
});
</script>

<script type="text/javascript">
var searchAjax=function(){};
var G_tocard_maxTips=30;

$(function(){(
	function(){
		
		var a=$(".plus-tag");
		//live添加事件
		$("a em",a).live("click",function(){
			var c=$(this).parents("a"),b=c.attr("title"),d=c.attr("value");
			//alert(b);
			delTips(b,d)
		});
		
		hasTips=function(b){
			var d=$("a",a),c=false;
			d.each(function(){
				if($(this).attr("title")==b){
					c=true;
					return false
				}
			});
			return c
		};

		isMaxTips=function(){
			return	
			$("a",a).length>=G_tocard_maxTips
		};

		//增加tag,
		setTips=function(c,d){
			if(hasTips(c)){
				//已经有，不添加
				return false
			}if(isMaxTips()){
				alert("最多添加"+G_tocard_maxTips+"个标签！");
				return false
			}
			//添加tags
			var b=d?'value="'+d+'"':"";
			//c是新增tags的名称,b是其value=""  d是value值
			//这里通过ajax提交增加到数据库记录,$.ajax默认是get
			
					$.ajax({
					  url: "{url('profile/addtag')}",
					  data: {
						id: d,
						name:c,
					  },
						 success: function (data) {
							//成功返回数据，删除该公司
							delobj.remove();
						 },
						  error: function (msg) {
								alert(msg);
						  }
					});
				a.append($("<a "+b+' title="'+c+'" href="javascript:void(0);" ><span>'+c+"</span><em></em></a>"));
				searchAjax(c,d,true);
				return true
		};
		
		//删除tags,b是名称，c是value b是名称
		delTips=function(b,c){
			if(!hasTips(b)){
				return false
			}
			$("a",a).each(function(){
				var d=$(this);//当前的对象
				
				if(d.attr("title")==b){
					//这里通过ajax提交删除用户的标签
					
					$.ajax({
					  url: "{url('profile/deltag')}",
					  data: {
						id: c,
					  },
						 success: function (data) {
							//成功返回数据，删除该公司
							delobj.remove();
							  
						 },
						  error: function (msg) {
								alert(msg);
						  }
					});
					
					d.remove();
					return false
				}
			});
			searchAjax(b,c,false);
			return true
		};

		getTips=function(){
			var b=[];
			$("a",a).each(function(){
				b.push($(this).attr("title"))
			});
			return b
		};

		getTipsId=function(){
			var b=[];
			$("a",a).each(function(){
				b.push($(this).attr("value"))
			});
			return b
		};
		
		getTipsIdAndTag=function(){
			var b=[];
			$("a",a).each(function(){
				b.push($(this).attr("value")+"##"+$(this).attr("title"))
			});
			return b
		}
	}
	
)()});
</script>

<script type="text/javascript">
// 更新选中标签标签
$(function(){
	setSelectTips();
	$('.plus-tag').append($('.plus-tag a'));
});
var searchAjax = function(name, id, isAdd){
	setSelectTips();
};
// 自定义增加
(function(){
	//$b是添加按钮，$i是输入框
	var $b = $('.plus-tag-add button'),$i = $('.plus-tag-add input');
	//当按钮被松开时，发生 keyup 事件
	$i.keyup(function(e){
		//jQuery的event对象上有一个which的属性可以获得键盘按键的键值 ,调用不到
		//var keycode = event.which;
		//keyCode=13是回车键，回车键提交
		if(e.keyCode ==13){
			$b.click();
		}
	});
	$b.click(function(){
		var name = $i.val().toLowerCase();//转为小写
		if(name != '') setTips(name,-1);//自定义增加，value值为-1
		$i.val('');
		$i.select();//选中文本框
	});
})();
// 增加推荐标签
(function(){
	$('.default-tag a').live('click', function(){
		var $this = $(this),
				name = $this.attr('title'),
				id = $this.attr('value');
		setTips(name, id);
	});
	// 更新高亮显示
	setSelectTips = function(){
		var arrName = getTips();
		if(arrName.length){
			$('#myTags').show();
		}else{
			//直接显示
			//$('#myTags').hide();
		}
		$('.default-tag a').removeClass('selected');
		$.each(arrName, function(index,name){
			$('.default-tag a').each(function(){
				var $this = $(this);
				if($this.attr('title') == name){
					$this.addClass('selected');
					return false;
				}
			})
		});
	}

})();
// 换一换，更换tag
(function(){
	var $b = $('#change-tips'),
		$d = $('.default-tag div'),
		len = $d.length,
		t = 'nowtips';
	$b.click(function(){
		var i = $d.index($('.default-tag .nowtips'));
		i = (i+1 < len) ? (i+1) : 0;
		$d.hide().removeClass(t);
		$d.eq(i).show().addClass(t);
	});
	$d.eq(0).addClass(t);
})();
</script>

{include file="footer"}