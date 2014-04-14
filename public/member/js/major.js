/* 
* citys
* Copyright (c) 2011 njamster http://www.njmaster.com/ 
* Date: 2011-06-06 
* citys在dom中创建省、市两级联动菜单，无数据库支持
*/ 
		/*
初始化时您可以定义选择哪些省市，如：
$(function(){
 $("#mycitys").citys({
 p_val:"江苏",
 c_val:"南京"
 });
});
具体参数：
p_name:省select的名字，如："my_province";
c_name:市select的名字，如："my_city";
p_width:省select的宽度，如150；
c_width:市select的宽度，如150，
p_val:省select的初始化值，如："江苏";
c_val:市select的初始化值，如："南京"
其中，p_name是省的select名字，在form获取中如下：my_province=request.form(p_name) 红色换成你定义的省级select的名字，市级获取同省级
	*/


(function($){
	var Citys = new Array();
	Citys[0] = new Array("哲学","哲学相关类"); 
	Citys[1] = new Array("经济学","经济学相关类|财政学相关类|保险相关类|金融相关类|贸易相关类"); 
	Citys[2] = new Array("历史学","历史学相关类"); 
	Citys[3] = new Array("法学","法学相关类|马克思主义理论相关类|社会学相关类|政治学相关类|公安学相关类"); 
	Citys[4] = new Array("教育学","教育学相关类|小学教育相关类|艺术教育相关类|人文教育相关类|科学教育相关类|社会教育相关类|体育学相关类"); 
	Citys[5] = new Array("文学","中国语言文学相关类|英语相关类|俄语相关类|德语相关类|法语相关类|西班牙语相关类|阿拉伯语相关类|日语相关类|韩语相关类|葡萄牙语相关类|意大利语相关类|其他外国语言文学相关类|新闻传播学相关类|艺术相关类"); 
	Citys[6] = new Array("理学","数学相关类|物理学相关类|化学相关类|生物科学相关类|地理科学相关类|地球物理学相关类|大气科学相关类|海洋科学相关类|力学相关类|电子相关类|信息科学相关类|材料科学相关类|环境科学相关类|心理学相关类|统计学相关类|天文学相关类|地质学相关类|系统科学相关类"); 
	Citys[7] = new Array("工学","地矿相关类|材料相关类|机械相关类|仪器仪表相关类|能源动力相关类|电气工程相关类|信息工程相关类|网络工程相关类|通信工程相关类|电子工程相关类|计算机相关类|土建相关类|水利相关类|测绘相关类|环境与安全相关类|化工与制药相关类|交通运输相关类|海洋工程相关类|轻工纺织食品相关类|航空航天相关类|武器相关类|工程力学相关类|生物工程相关类|农业工程相关类|林业工程相关类|公安技术相关类|光电相关类|电力电子相关类|生物医学工程相关类"); 
	Citys[8] = new Array("农学","植物生产相关类|草业科学相关类|森林资源相关类|环境生态相关类|动物生产相关类|动物医学相关类|水产相关类"); 
	Citys[9] = new Array("医学","基础医学相关类|预防医学相关类|临床医学与医学技术相关类|口腔医学相关类|中医学相关类|法医学相关类|护理学相关类|药学相关类|放射医学相关类|医学影像学相关类"); 
	Citys[10] = new Array("管理学","管理科学与工程相关类|工商管理相关类|市场营销相关类|财会管理相关类|人力资源管理相关类|旅游管理相关类|电子商务相关类|物流管理相关类|物业管理相关类|公共管理相关类|农业经济管理相关类|图书档案学相关类"); 
	$.fn.citys=function(options){
		var defaults = { 
			p_width:120,
			p_name:"province",
			p_val:"经济学", 
			c_width:120,
			c_name:"city",
			c_val:"经济学相关类" 
		} 
		var options = $.extend(defaults,options); 
		this.each(function(){
			var str='\
						<select name="'+options.p_name+'" id="'+options.p_name+'" style="width:'+options.p_width+'px;" >\
							<option value="">请选择</option>\
						</select>\
						<select name="'+options.c_name+'" id="'+options.c_name+'" style="width:'+options.c_width+'px;" >\
							<option value="">请选择</option>\
						</select>\
					';
			$(this).html(str);
			for(var i=0;i<Citys.length;i++){
				$("#"+options.p_name).append("<option value='"+Citys[i][0]+"'>"+Citys[i][0]+"</option>");
			};
			if(options.p_val!=""){
				$("#"+options.p_name+" option[value='"+options.p_val+"']").attr("selected","selected");
				var i=$("#"+options.p_name).get(0).selectedIndex;
				var arr=Citys[i-1][1].split("|");
				$("#"+options.c_name).empty().append("<option value=''>请选择</option>");
				for(var n=0;n<arr.length;n++){
					$("#"+options.c_name).append("<option value='"+arr[n]+"'>"+arr[n]+"</option>");
				}
				if(options.c_val!=""){
					$("#"+options.c_name+" option[value='"+options.c_val+"']").attr("selected","selected");
				}
			}
			$("#"+options.p_name).bind("change",function(){
				var i=$(this)[0].selectedIndex;
				if(i>0){
					var arr=Citys[i-1][1].split("|");
					$("#"+options.c_name).empty().append("<option value=''>请选择</option>");
					for(var n=0;n<arr.length;n++){
						$("#"+options.c_name).append("<option value='"+arr[n]+"'>"+arr[n]+"</option>");
					}
					if(options.c_val!=""){
						$("#"+options.c_name+" option[value='"+options.c_val+"']").attr("selected","selected");
					}
				}else{
					$("#"+options.c_name).empty().append("<option value=''>请选择</option>");
				}
			});
		});
	}
})(jQuery);
