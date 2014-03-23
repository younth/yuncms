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
              array('name'=>'会员组管理','url'=>url('member/admingroup/index')),
			  array('name'=>'会员管理','url'=>url('member/adminmember/index')),
			  array('name'=>'待激活用户','url'=>url('member/adminmember/active')),
			  array('name'=>'群发邮件','url'=>url('member/adminmember/sendAll')),
			  array('name'=>'群发私信','url'=>url('member/adminmember/send_allmsg')),
			  array('name'=>'标签管理','url'=>url('admin/sort/index')),
			);
  } 
  
  //会员的权限检测，返回1没有权限，返回2未登陆有权限，返回数组登陆有权限
  public function powerCheck(){
		 $cookie_auth=get_cookie('auth');//读取cookie的值，登陆的什么时候存入的cookie
	//echo $cookie_auth;
	
     if(empty($cookie_auth)) $group_id=1;//未登录组
     else{
        $memberinfo=explode('\t',$cookie_auth); //分隔数组
        //print_r($memberinfo);
        $auth['id']=$memberinfo[0];//会员的id
        $auth['groupid']=$memberinfo[1];//会员组id
        $auth['uname']=$memberinfo[2];//账号
        //$auth['nickname']=empty($memberinfo[3])?'未知':$memberinfo[3];//昵称
        $auth['lastip']=$memberinfo[4];//IP

        $group_id=$auth['groupid'];
     }
      $notallow=model('memberGroup')->find("id={$group_id}");
      if(empty($notallow['notallow'])) return $group_id==1?2:$auth;
      else{
        $flog=2;
        $rules=explode('|',$notallow['notallow']);
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