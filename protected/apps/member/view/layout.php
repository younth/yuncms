 {include file="header"}
<link href="__PUBLICAPP__/css/setting.css" media="screen" rel="stylesheet" type="text/css" />
<div class="dj-content-wrap dj-account" id="dj-content-wrap">
    <div class="dj-content-inner">
                <div class="dj-sub-title">
                    <h2>设&nbsp;置</h2>
                </div>
            <div class="dj-content-shadow">
<div id="content" class="clearfix">
<div id="maincolumn">
    <div id="setting">
<div id="navigation">
    <div class="tabs">
        <ul>
            <li {$nav_avatar}><a href="{url('member/setting/avatar')}"><span>我的头像</span></a></li>
            <li {$nav_modifypass}><a href="{url('member/setting/modifypassword')}"><span>修改密码</span></a></li>
            <li {$nav_nav_manage}><a href="{url('member/setting/management')}"><span>帐号管理</span></a></li>
			<li><a href="#"><span>隐私设置</span></a></li>
            <li><a href="#"><span>动态设置</span></a></li>
            <li><a href="#"><span>屏蔽设置</span></a></li>
			<li><a href="#"><span>推送设置</span></a></li>
        </ul>
    </div>
</div>
        <div class="room">
		{include file="$__template_file"}

        </div>
    </div>
</div>
</div>
            </div>
    </div>
</div>

  {include file="footer"}