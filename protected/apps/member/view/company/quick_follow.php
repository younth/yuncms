        <div class="gzbj">
        <p>
          你还没有关注任何公司！
          <span>关注业内热门公司，获得首页资讯推送，掌握行业全面动态！</span>
        </p>
      </div>


<div class="contentbodys">
    <form method="post" id="quick_follow" action="{url('index/follow')}" accept-charset="UTF-8">
      <ul class="ulistbox clearfix">
       {loop $quick_follow $key $vo}
        <li class="clearfix">
          <label>
            <input type="checkbox" value="{$vo['id']}" name="corps[]" checked="checked">
          </label>
          <span>
            <a href="{url('index/show',array('id'=>$vo['id']))}">
              <img width="45" height="50" src="{$path}{$vo['logo']}" alt="{$vo['name']}">
</a>          </span>
          <p>
            <a href="{url('index/show',array('id'=>$vo['id']))}">{$vo['name']}</a>
          </p>
        </li>     
	  {/loop}
            
      
      </ul>
    <div class="blank_10px"></div>
    <a href="javascript:void(0)" onclick="checkform();return false;" class="serchbtn"></a>
</form> 
 <script>
    function checkform(){
      var length = $('[name="corps[]"]:checked').length;
      if(length<1){
        $("#quick_follow").focus();
        alert("请至少选择一家公司");
        return false;
      }else{
        $("#quick_follow").submit();
        return true;
      }
    }
  </script>
    <div class="blank_30px"></div>
  </div>
