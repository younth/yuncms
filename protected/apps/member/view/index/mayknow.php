{loop $result $_k $_v}
<dl class="right_user_list" id="stranger_23872812">
			  <dd class="logo">
			    <a href="{url('profile/user',array('id'=>$_v['id']))}" hide_card="true" title="{$_v['uname']}"><img alt="Medium_logo" src="{$_v['small']}"></a>
			  </dd>
			  <dd class="name">
			    <a href="#" class="a_link" data-uid="23872812" title="{$_v['uname']}">{$_v['uname']}</a>
			    <a href="#" class="auther_icon hr_star_bg png_ie6 hr_star_11px1" target="_blank" original-title="职场V力 229分"></a>
			  </dd>
			  <dd class="promit_title">
			     {$_v['school']}
			  </dd>
			  <dd class="add_button">
			    <a href="javascript:;" class="apply_friend" data-uid={$_v['id']} data-url={url('card/addfriend')}>加为好友</a>
			  </dd>
			</dl>
			
{/loop}
<span class="more_btns"><a href="{url('card/search')}" title="更多">更多</a></span>