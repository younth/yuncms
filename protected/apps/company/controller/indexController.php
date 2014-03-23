<?php
/*
 * 会员管理首页控制器，该部分与前台模板，后台管理均脱离，单独处理
 * */
class indexController extends commonController
{
	  public function index()
	    {
        $_GET['act']= trim(in($_GET['act']));
        $this->act=empty($_GET['act'])?url('index/welcome'):$_GET['act'];
        $this->display();
	    }

      public function welcome()
      {
          $this->display();
      }

      public function login()
      {
        if(!$this->isPost()){
        	//未提交
            $cookie_auth=get_cookie('auth');
            //print_r($cookie_auth);
            if(!empty($this->auth)) $this->redirect(url('default/index/index'));//如果登陆了则跳转到首页
            $this->returnurl=$_SERVER['HTTP_REFERER'];//储存父级的url
            $this->display();
        }else{
       if(empty($_POST['name'])||empty($_POST['word'])) $this->error('请填写完整信息~');
            $uname=in(trim($_POST['name']));
            $password=$_POST['word'];
            $cookietime=empty($_POST['cooktime'])?0:intval($_POST['cooktime']);//接受cookie
            $returnurl=empty($_POST['returnurl'])?$_SERVER['HTTP_REFERER']:$_POST['returnurl'];
            if($this->_login($uname,$password,$cookietime))
            {
                $this->redirect($returnurl);//跳转到登陆前的url
            }
            else $this->error('用户名或密码错误，或者您的账户已被锁定');
        }
      }

      //这个登陆函数可以放在模型里面
      protected function _login($uname,$password,$cookietime=0)
      {
          $acc=model('member')->find("uname='{$uname}'");
          if($acc['password']!=$this->codepwd($password) || $acc['is_active']) return false;
          if($cookietime!=0) $cookietime=time()+$cookietime;
          $data['lastip'] = get_client_ip();
          $data['lasttime']=time();
          model('member')->update("uname='{$uname}'",$data);
          //登陆成功要设置cookie，然后保存到auth类里面
          $cookie_auth = $acc['id'].'\t'.$acc['groupid'].'\t'.$acc['uname'].'\t'.$acc['lastip'];
          if(set_cookie('auth',$cookie_auth,$cookietime)) return true;
          return false;
      }

      //用户退出
      public function logout()
      {
          $url=empty($_GET['url'])?$_SERVER['HTTP_REFERER']:$_GET['url'];
          if(set_cookie('auth','',time()-1)) $this->success('您已成功退出~',$url);
      }

      //用户注册
      public function regist()
      {
        if(!$this->isPost()){
            if(!empty($this->auth)) $this->redirect(url('default/index/index'));
            $this->display();
        }else{
            if(empty($_POST['checkcode'])||$_POST['checkcode']!=$_SESSION['verify']) $this->error('验证码错误~');
            if(empty($_POST['name'])||empty($_POST['word'])||empty($_POST['email'])) $this->error('请填写完整信息~');
            
            $data['uname']=in(trim($_POST['name']));
            $acc=model('member')->find("uname='".$data['uname']."'");
            if(!empty($acc['uname'])) $this->error('该账户已经有人注册~');
            $data['email']=in(trim($_POST['email']));
            if($_POST['word']!=$_POST['sureword']) $this->error('两次密码不相同~');
            $data['password']=$this->codepwd($_POST['word']);
            $data['regip']=$data['lastip']=get_client_ip();
            $data['ctime']=$data['lasttime']=time();
            $data['rmb']=$data['crmb']=0;
            $data['is_active']=1;
            $data['groupid']=2;
            $id=model('member')->insert($data);
            if($id){
               $cookie_auth = $id.'\t'.$data['groupid'].'\t'.$data['uname'].'\t'.$data['lastip'];
               if(set_cookie('auth',$cookie_auth,0)) $this->success('注册成功~',url('index/index'));
            }else $this->error('数据库写入失败~');
        }
      }
      
      //生成验证码
      public function verify()
      {
          Image::buildImageVerify();
      }
}
?>