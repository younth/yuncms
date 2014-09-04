
$(function ($) { 
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#E6F1D8');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);
});

function CheckAll(form) { //复选框全选/取消
//    alert(form.elements.length);
	for (var i=0;i<form.elements.length;i++) { 
		var e = form.elements[i]; 
		if (e.Name != "chkAll"&&e.disabled!=true) 
		e.checked = form.chkAll.checked; 
	} 
  };
//  后台用到的删除函数，触发删除点击的时间，参数id和url
function del(url,id){
      if(confirm('删除将不可恢复~')){
			var delobj=$('#del_'+id).parent().parent();
			$.get(url, {id:id},
   				function(data){
					if(data==1){
              delobj.remove();
					}else alert(data);
   			});
			}
  }

