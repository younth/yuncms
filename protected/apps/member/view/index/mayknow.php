<input type="hidden" value="{$isNores}" id="isnores" />
{if empty($result[0])}
没有更多的可能认识的人
{else}
{loop $result $_k $_v}
     <div class="mem_mayknow" id="friend{$_v['id']}">
             <a class="mem_mayknow_head" target="_blank" href="{url('profile/user',array('id'=>$_v['id']))}">
                 <img alt="" src="{$_v['small']}" >
             </a>
             <div class="mem_mayknow_info">
                 <h3>
                     <a target="_blank" href="{url('profile/user',array('id'=>$_v['id']))}">{$_v['uname']}</a>
                     <span style="float: right" title="{$_v['school']} · {$_v['major']}">{$_v['school']} · {$_v['major']}
                     </span>
                     
                 </h3>
                <div class="mem_mayknow_position">
                     <span class="mem_mayknow_relationship">共有{$_v['allcart']}个联系人</span>
                    <a  class="mem_mayknow_add" href="javascript:void(0)" onclick="addfriend({$_v['id']})">
                 <i class="mem_mayknow_add_img"></i>加联系人</a>
                 </div>
             </div>
         
     </div>
{/loop}
{/if}
