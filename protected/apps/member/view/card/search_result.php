{if  $info}
<div class="icardm-con-tit"><div style="display:block;" class="num" id="allnumber">共找到<span>{$count}</span>条符合条件的结果：</div></div><div id="card-list-fragment"><ul class="icardm-list">
 {loop $info $key $vo}

 
<li uid="{$vo['id']}"><div class="head-pic"><a target="_blank" href="{url('profile/user',array('id'=>$vo['id']))}"> <img src="{$vo['avatar']}" ></a></div><div class="icardm-mail">
 {if $vo['isfriend']}
     {if $vo['isfriend']['status']==2}
     <a href="javascript:void(0)" id="single_mail" class="send-msg" username="{$vo['uname']}" uid="{$vo['id']}" title="发私信"></a>
     {else} <a href="javascript:;" class="addfriend" >加联系人</a>
     {/if}
 {else} 
 {if $vo['id']==$auth['id']}
 {else}
 <a href="javascript:;" class="addfriend" >加联系人</a>
 {/if}
{/if}

</div> <div class="icardm-list-c"><p class="sms"><a target="_blank" class="b search-cardtips" href="{url('profile/user',array('id'=>$vo['id']))}">{$vo['uname']}</a></p><p class="company">{$vo['major']} &nbsp;&nbsp;<span class="highlight"></span>{$vo['city']}</p><dl><dt>教育背景</dt><dd><span> {$vo['school']}&nbsp;{$vo['education']}  </span> </dd></dl> </div> </li>
{/loop}

</ul><div class="paging">
<span class="current">1</span>
 <a href="#">2</a>
 <a class="next" href="#"></a>
</div></div>
{else}
<div class="icardm-con-tit"> <div style="display:block;" class="num" id="allnumber">共找到<span>0</span>条符合条件的结果：</div></div>
<div id="search-null" class="search-null"> <p>没有找到符合条件的结果...更换条件重新搜索吧。</p></div>
{/if}