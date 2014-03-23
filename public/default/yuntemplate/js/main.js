//第一种方式是定义jquery函数
function index_banner(){
  $("#index_banner").css("display","none");
 }
//第二种直接加载函数
$(function(){
	$(".adclose").click(function(){
			$("#index_banner").css("display","none");
		})
})