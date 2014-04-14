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
	Citys[0] = new Array("北京","北京"); 
	Citys[1] = new Array("上海","上海"); 
	Citys[2] = new Array("天津","天津"); 
	Citys[3] = new Array("重庆","重庆"); 
	Citys[4] = new Array("河北","石家庄|邯郸|邢台|保定|张家口|承德|廊坊|唐山|秦皇岛|沧州|衡水"); 
	Citys[5] = new Array("山西","太原|大同|阳泉|长治|晋城|朔州|吕梁|忻州|晋中|临汾|运城"); 
	Citys[6] = new Array("辽宁","沈阳|大连|鞍山|抚顺|本溪|丹东|锦州|营口|阜新|辽阳|盘锦|铁岭|朝阳|葫芦岛"); 
	Citys[7] = new Array("吉林","长春|吉林|四平|辽源|通化|白山|松原|白城|延边"); 
	Citys[8] = new Array("黑龙江","哈尔滨|齐齐哈尔|牡丹江|佳木斯|大庆|绥化|鹤岗|鸡西|黑河|双鸭山|伊春|七台河|大兴安岭"); 
	Citys[9] = new Array("江苏","南京|镇江|苏州|南通|扬州|盐城|徐州|连云港|常州|无锡|宿迁|泰州|淮安"); 
	Citys[10] = new Array("浙江","杭州|宁波|温州|嘉兴|湖州|绍兴|金华|衢州|舟山|台州|丽水"); 
	Citys[11] = new Array("安徽","合肥|芜湖|蚌埠|马鞍山|淮北|铜陵|安庆|黄山|滁州|宿州|池州|淮南|巢湖|阜阳|六安|宣城|亳州"); 
	Citys[12] = new Array("福建","福州|厦门|莆田|三明|泉州|漳州|南平|龙岩|宁德"); 
	Citys[13] = new Array("江西","南昌|景德镇|九江|鹰潭|萍乡|新馀|赣州|吉安|宜春|抚州|上饶"); 
	Citys[14] = new Array("山东","济南|青岛|淄博|枣庄|东营|烟台|潍坊|济宁|泰安|威海|日照|莱芜|临沂|德州|聊城|滨州|菏泽"); 
	Citys[15] = new Array("河南","郑州|开封|洛阳|平顶山|安阳|鹤壁|新乡|焦作|濮阳|许昌|漯河|三门峡|南阳|商丘|信阳|周口|驻马店|济源"); 
	Citys[16] = new Array("湖北","武汉|宜昌|荆州|襄樊|黄石|荆门|黄冈|十堰|恩施|潜江|天门|仙桃|随州|咸宁|孝感|鄂州");
	Citys[17] = new Array("湖南","长沙|常德|株洲|湘潭|衡阳|岳阳|邵阳|益阳|娄底|怀化|郴州|永州|湘西|张家界"); 
	Citys[18] = new Array("广东","广州|深圳|珠海|汕头|东莞|中山|佛山|韶关|江门|湛江|茂名|肇庆|惠州|梅州|汕尾|河源|阳江|清远|潮州|揭阳|云浮"); 
	Citys[19] = new Array("甘肃","兰州|嘉峪关|金昌|白银|天水|酒泉|张掖|武威|定西|陇南|平凉|庆阳|临夏|甘南"); 
	Citys[20] = new Array("陕西","西安|宝鸡|咸阳|铜川|渭南|延安|榆林|汉中|安康|商洛"); 
	Citys[21] = new Array("内蒙古","呼和浩特|包头|乌海|集宁|通辽|赤峰|呼伦贝尔盟|阿拉善盟|哲里木盟|兴安盟|乌兰察布盟|锡林郭勒盟|巴彦淖尔盟|伊克昭盟"); 
	Citys[22] = new Array("广西","南宁|柳州|桂林|梧州|北海|防城港|钦州|贵港|玉林|南宁|柳州|贺州|百色|河池"); 
	Citys[23] = new Array("四川","成都|绵阳|德阳|自贡|攀枝花|广元|内江|乐山|南充|宜宾|广安|达川|雅安|眉山|甘孜|凉山|泸州"); 
	Citys[24] = new Array("贵州","贵阳|六盘水|遵义|安顺|铜仁|黔西南|毕节|黔东南|黔南"); 
	Citys[25] = new Array("云南","昆明|大理|曲靖|玉溪|昭通|楚雄|红河|文山|思茅|西双版纳|保山|德宏|丽江|怒江|迪庆|临沧");
	Citys[26] = new Array("西藏","拉萨|日喀则|山南|林芝|昌都|阿里|那曲"); 
	Citys[27] = new Array("海南","海口|三亚"); 
	Citys[28] = new Array("宁夏","银川|石嘴山|吴忠|固原"); 
	Citys[29] = new Array("青海","西宁|海东|海南|海北|黄南|玉树|果洛|海西"); 
	Citys[30] = new Array("新疆","乌鲁木齐|石河子|克拉玛依|伊犁|巴音郭勒|昌吉|克孜勒苏柯尔克孜|博尔塔拉|吐鲁番|哈密|喀什|和田|阿克苏"); 
	Citys[31] = new Array("香港","香港"); 
	Citys[32] = new Array("澳门","澳门"); 
	Citys[33] = new Array("台湾","台北|高雄|台中|台南|屏东|南投|云林|新竹|彰化|苗栗|嘉义|花莲|桃园|宜兰|基隆|台东|金门|马祖|澎湖"); 
	$.fn.citys=function(options){
		var defaults = { 
			p_width:120,
			p_name:"province",
			p_val:"江苏", 
			c_width:120,
			c_name:"city",
			c_val:"南京" 
		} 
		var options = $.extend(defaults,options); 
		this.each(function(){
			var str='\
						<select name="'+options.p_name+'" id="'+options.p_name+'" style="width:'+options.p_width+'px;" >\
							<option value="">选择省份</option>\
						</select>\
						<select name="'+options.c_name+'" id="'+options.c_name+'" style="width:'+options.c_width+'px;" >\
							<option value="">选择市/县</option>\
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
				$("#"+options.c_name).empty().append("<option value=''>选择市/县</option>");
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
					$("#"+options.c_name).empty().append("<option value=''>选择市/县</option>");
					for(var n=0;n<arr.length;n++){
						$("#"+options.c_name).append("<option value='"+arr[n]+"'>"+arr[n]+"</option>");
					}
					if(options.c_val!=""){
						$("#"+options.c_name+" option[value='"+options.c_val+"']").attr("selected","selected");
					}
				}else{
					$("#"+options.c_name).empty().append("<option value=''>选择市/县</option>");
				}
			});
		});
	}
})(jQuery);
