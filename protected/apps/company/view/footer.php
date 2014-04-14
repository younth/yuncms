<?php if(!defined('APP_NAME')) exit;?>
<br />
 <div class="footer_login_panel">
       <div class="friendlink" >
                  <span> 友情链接：</span>
                  {link:{table=(link) field=(name,url,type) order=(norder desc,id desc) where=(ispass='1' AND type='1') limit=(10)}}
                    <a target="_blank" href="[link:url]">[link:name]</a>
                    {/link}
                    <a href="friendlink/more">更多>></a>
             </div>
 	   <div class="clear"></div>
 	   <div id="footer_bg">
                  <div id="footer"> 
                   {footnav:{table=(sort) field=(name,url,type) order=(norder desc) where=(type=5)  sort=(100066) limit=(10)}}
            <a target="_blank" href="[footnav:url]">[footnav:name]</a>  
           		  {/footnav}
            <br/>
               {$copyright}
            
                <br/>{$icp} &nbsp;&nbsp;{$beian}
                <a class="footer_icon" target="_blank" href="#"><img src="__PUBLIC__/images/beian.gif" /></a>
                  </div>
             </div>
  </div>   
   
   
</div>
        <script>
        //关注企业
  function corp_follow(cid){
	  var nowobj='corp'+cid;
    $.ajax({
      url: "{url('company/index/follow')}",
      data: {
        id: cid,
	  },
        //except_ids: $("#except_ids").val()
		 success: function (data) {
			//成功返回数据
			  $("#"+nowobj).replaceWith("<a href='' target='_blank' class='btniconin btnmargin'></a>");
		 },
		  error: function (msg) {
                alert(msg);
		  }
    });
  }


//取消企业关注
  function corp_remove_follow(cid){
	  //获得不到当前的节点啊,函数里面不能用this
	  var nowobj='corp'+cid;
	  var delobj=$("#"+nowobj).parent().parent();//删除当前删除的节点
    $.ajax({
      url: "{url('company/index/cancel_follow')}",
      data: {
        id: cid,
	  },
        //except_ids: $("#except_ids").val()
		 success: function (data) {
			//成功返回数据，删除该公司
			delobj.remove();
			  
		 },
		  error: function (msg) {
                alert(msg);
		  }
    });
  }


        </script>

</body>
</html>
