<?php
/*
 * 会员模块的接口文件
 * */
class memberApi extends baseApi{
	
	//获取前台的栏目
  public function getdefaultMenu(){
    return array('name'=>'会员中心','yun'=>'member/index/index');   
  }

  //获取会员管理模块后台管理的栏目
  public function getadminMenu(){
		return array(
              array('name'=>'会员组列表','url'=>url('member/admingroup/index')),
			  array('name'=>'会员列表','url'=>url('member/adminmember/index')),
			  array('name'=>'待激活用户','url'=>url('member/adminmember/active')),
			  array('name'=>'群发邮件','url'=>url('member/adminmember/sendAll')),
			  array('name'=>'群发私信','url'=>url('member/adminmember/send_allmsg')),
			);
  } 
  
  //会员的权限检测，返回1没有权限，返回2未登陆有权限，返回数组登陆有权限
  public function powerCheck(){
	 $cookie_auth=get_cookie('auth');//读取cookie的值，登陆的时候存入的cookie
     if(empty($cookie_auth)) $group_id=1;//1代表未登录组
     else{
        $memberinfo=explode('\t',$cookie_auth); //分割数组
        //print_r($memberinfo);
        $auth['id']=$memberinfo[0];//会员的id
        $auth['uname']=$memberinfo[1];//账号
        $auth['lasttime']=$memberinfo[2];//上次登录时间
        $auth['groupid']=$memberinfo[3];//会员组id
        $auth['login_email']=$memberinfo[4];//会员email
        $auth['is_active']=$memberinfo[5];//会员email
        $group_id=$auth['groupid'];
     }
      $notallow=model('memberGroup')->find("id={$group_id}");//会员组信息
      //print_r($notallow);
      if(empty($notallow['notallow'])) return $group_id==1?2:$auth;
      else{
        $flog=2;
        $rules=explode('|',$notallow['notallow']);//对会员权限的处理
        foreach ($rules as $rule) {
          $power=explode(',',$rule);
          //R匹配
          $reds=explode('/',$power[0]);
          if(!empty($reds[0]) && $reds[0]==APP_NAME) $flog=1;
          if(!empty($reds[1]) && 1==$flog && $reds[1]!=CONTROLLER_NAME) $flog=2;
          if(!empty($reds[2]) && 1==$flog && $reds[2]!=ACTION_NAME) $flog=2;
          //参数匹配判断
          if(!empty($power[1]) && 1==$flog){
            $items=explode('/',$power[1]);
            if(!empty($items)){
              foreach ($items as $value) {
                 $gets=explode('=',$value);
                 if(!empty($gets[1]) && 1==$flog && $_GET[$gets[0]]!=$gets[1]) $flog=2;
              }
            }
          }
          if(1==$flog) return $flog;
        }
        return $group_id==1?2:$auth;
      }
  } 
}