 {include file="header"}
 {include file="index/nav"}
<!--内容-->
<div class="container_content clearfix">
    <div class="contentLeft">
      {if $corp_all==0}
     {include file="index/quick_follow"}
     {else}
    <div class="contentbodys">
      <div class="htitle clearfix">
        <span>正在关注{$corp_all}家公司</span>
        <em><a href="">查看关注公司动态</a></em>
      </div>
      <ul class="listUl">
      {loop $list $key $vo}
        <li>
          <span class="imgPhoto">
  <a href="{url('index/show',array('id'=>$vo['id']))}" target="_blank">
    <img alt="中国银行" height="50" src="{$path}{$vo['logo']}" width="45">
</a></span>
<div class="dText">
  <a href="" class="atitle" data-cid="23492" target="_blank" title="中国银行">{$vo['name']}</a>
  <div class="dInfor clearfix">
    <span class="fist_s">
      行业：
      <em title="{$vo['industry']}">{$vo['on_industry']}</em>
    </span>
    
    <span class="snature">
      性质：
      <em title="{$vo['quality']}">{$vo['quality']}</em>
    </span>
    <span class="sNoborder">
      规模：
      <em title="{$vo['scale']}">{$vo['scale']}</em>
    </span>
    <div class="clear"></div>
  </div>
  <div class="dIcon clearfix">
<!--      <span class="fist_s">
        0<em>个好友在该公司</em>
      </span>
    <span class="two_s">
      8625<em>位雇员</em>
    </span>
-->    <div class="clear"></div>
  </div>
</div>


          <div class="btnInfor">
             <a href="javascript:void(0)"  class="btniconc btnmargin" onclick="corp_remove_follow({$vo['id']})" id="corp{$vo['id']}"></a>
          </div>
        </li>
      {/loop}

      </ul>
      <div class="blank_10px"></div>
    </div>
    {/if}
</div>
     	
  <div class="contentRight" id="contentRight">
    <!--广告位-->
    <div class="adverimg ad_id" >
    	<img src="__PUBLICAPP__/images/ad.jpg" />
    </div>
    <div class="blank_15px"></div>
    <!--四种维度推荐-->
        
  


    <div class="contentbodyr" id="recommand_corps_body">
    <div class="htitle clearfix">
      <span>推荐关注</span>
      <a class="aicons" href="javascript:void(0);" id="change_recommand_corps">换一换</a>
    </div>
    <ul class="ullist clearfix" id="four_recommand_corps"><input type="hidden" value="2" id="four_current_page">
<input type="hidden" value="16734,23498,23497,770" id="except_ids">
    <li id="four_recommand_corp_16734">
    <span class="simgphoto">
          <a href="#" target="_blank">
      <img alt="#" height="50" src="{$small_photo}" width="45">
</a>
    </span>
    <div class="litexts">
      <a href="#" target="_blank" class="atitle">云作坊</a>
      <p>
        与你技能相同的人都在关注
      </p>
      <a class="aicon" href="###" onclick="corp_toggle('16734'); return false;"></a>
    </div>
  </li>
    
    <li id="four_recommand_corp_16734">
    <span class="simgphoto">
          <a href="#" target="_blank">
      <img alt="#" height="50" src="{$small_photo}" width="45">
</a>
    </span>
    <div class="litexts">
      <a href="#" target="_blank" class="atitle">云作坊</a>
      <p>
        与你技能相同的人都在关注
      </p>
      <a class="aicon" href="###" onclick="corp_toggle('16734'); return false;"></a>
    </div>
  </li>
    
    <li id="four_recommand_corp_16734">
    <span class="simgphoto">
          <a href="#" target="_blank">
      <img alt="#" height="50" src="{$small_photo}" width="45">
</a>
    </span>
    <div class="litexts">
      <a href="#" target="_blank" class="atitle">云作坊</a>
      <p>
        与你技能相同的人都在关注
      </p>
      <a class="aicon" href="###" onclick="corp_toggle('16734'); return false;"></a>
    </div>
  </li>

    <li id="four_recommand_corp_16734">
    <span class="simgphoto">
          <a href="#" target="_blank">
      <img alt="#" height="50" src="{$small_photo}" width="45">
</a>
    </span>
    <div class="litexts">
      <a href="#" target="_blank" class="atitle">云作坊</a>
      <p>
        与你技能相同的人都在关注
      </p>
      <a class="aicon" href="###" onclick="corp_toggle('16734'); return false;"></a>
    </div>
  </li>
    
</ul>
  </div>
      <div class="blank_15px"></div>
  </div>
</div>


			<div class="clear"></div>
		</div>
  {include file="footer"}