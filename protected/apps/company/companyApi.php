<?php
/*
 * 会员模块的接口文件
 * */
class companyApi extends baseApi{
	
	//获取前台的栏目
  public function getdefaultMenu(){
    return array('name'=>'企业面板','yun'=>'company/index/index');   
  }

  //获取会员管理模块后台管理的栏目
  public function getadminMenu(){
		return array(
              array('name'=>'行业管理','url'=>url('admin/sort/index')),
			  array('name'=>'企业管理','url'=>url('company/admincompany/index')),
			  array('name'=>'待激活企业','url'=>url('company/admincompany/active')),
			  array('name'=>'群发私信','url'=>url('company/admincompany/send_allmsg')),
			 array('name'=>'群发邮件','url'=>url('company/admincompany/sendAll')),
			);
  } 
  
  //会员的权限检测，返回1没有权限，返回2未登陆有权限，返回数组登陆有权限
  public function powerCheck(){
		 $cookie_auth=get_cookie('auth');//读取cookie的值，登陆的什么时候存入的cookie
	//echo $cookie_auth;
	
     if(empty($cookie_auth)) $group_id=1;//未登录组
     else{
        $companyinfo=explode('\t',$cookie_auth); //分隔数组
        //print_r($companyinfo);
        $auth['id']=$companyinfo[0];//会员的id
        $auth['groupid']=$companyinfo[1];//会员组id
        $auth['uname']=$companyinfo[2];//账号
        //$auth['nickname']=empty($companyinfo[3])?'未知':$companyinfo[3];//昵称
        $auth['lastip']=$companyinfo[4];//IP

        $group_id=$auth['groupid'];
     }
      $notallow=model('companyGroup')->find("id={$group_id}");
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