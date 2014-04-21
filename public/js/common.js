// JavaScript Document

$(function(){
	$("input[name=keyword]").bind({
		focus:function(){
			$(".find_people").addClass("find_bg");
			$(".find_people_button").addClass("find_btn_bg");
		},
		blur:function(){
		var $word=$("input[name=keyword]").val();
		 if($word.length>0){
		 $(".find_people_button").addClass("find_btn_bg");
		 }else {
			 $(".find_people").removeClass("find_bg");
			 $(".find_people_button").removeClass("find_btn_bg");
			 }
			}
		});
		
		//头像账号经过效果
		$(".user_name").hover(function(){
			$(this).addClass("user_bg font_hui");
			$(".user_item").css("display","block");
		},function(){
			$(this).removeClass("user_bg font_hui");
			$(".user_item").css("display","none");
			});
			
		$(".right_menu").hover(function(){
			//$(".right_menu li:first").css("display","block");
		},function(){
			//$(".right_menu li:first").css("display","none");
			});
	})


function copyToClipboard(maintext){
  if (window.clipboardData){
    window.clipboardData.setData("Text", maintext);
    }else if (window.netscape){
      try{
        netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
    }catch(e){
        layer.alert("该浏览器不支持一键复制！请手工复制文本框链接地址～");
    }

    var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
    if (!clip) return;
    var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
    if (!trans) return;
    trans.addDataFlavor('text/unicode');
    var str = new Object();
    var len = new Object();
    var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
    var copytext=maintext;
    str.data=copytext;
    trans.setTransferData("text/unicode",str,copytext.length*2);
    var clipid=Components.interfaces.nsIClipboard;
    if (!clip) return false;
    clip.setData(trans,null,clipid.kGlobalClipboard);
  }
  layer.alert('以下内容已经复制到剪贴板' + maintext, 1);
}