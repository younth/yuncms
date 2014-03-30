<?php
/*
 * 会员登陆注册处理类
 * */
class accountController extends commonController
{
	static protected $we_akey;
	static protected $we_skey;
	static protected $we_callback_url;//回调地址
	
	public function __construct()
	{
		parent::__construct();
		$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		require(CP_PATH . 'ext/saetv2.ex.class.php');
		$this->we_akey=$config['sina_wb_akey'];
		$this->we_skey=$config['sina_wb_skey'];
		$this->we_callback_url='http://cms.yunstudio.net/index.php?yun=member/account/weibo';//回调地址
		
	}

      public function login()
      {
        if(!$this->isPost()){
        	
        	//新浪微博登陆url处理
        	$o = new SaeTOAuthV2( $this->we_akey , $this->we_skey );
        	$code_url = $o->getAuthorizeURL($this->we_callback_url);
        	$this->weibo_login=$code_url;
        	$weibo_uid=$_SESSION['token']['access_token'];
        	
            //如果登陆了则跳转到首页,auth是存放用户信息的数组
            if(!empty($this->auth)||!empty($weibo_uid)) $this->redirect(url('member/index/index'));
            $this->returnurl=$_SERVER['HTTP_REFERER'];//传递父级的url，以便登录之后跳转回去
            $this->display();
        }else{
        	//记住我，就存入cookie
       if(empty($_POST['login_email'])||empty($_POST['password'])) $this->error('请填写完整信息~');
            $login_email=in(trim($_POST['login_email']));
            $password=$_POST['password'];
            $cookietime=empty($_POST['cooktime'])?0:intval($_POST['cooktime']);//接收cookie
            //$_SERVER['HTTP_REFERER']为父级url
            $returnurl=empty($_POST['returnurl'])?$_SERVER['HTTP_REFERER']:$_POST['returnurl'];
            //判断登录的处理，单独用一个函数判断登录
            if($this->_login($login_email,$password,$cookietime))
            {
                $this->redirect($returnurl);//跳转到登陆前的url
            }
            else $this->error('邮箱或密码错误，或者您的账户已被锁定');
        }
      }

      //这个登陆验证函数，申明为protected
      protected function _login($login_email,$password,$cookietime=0)
      {
          $acc=model('member')->find("login_email='{$login_email}'");
          if($acc['password']!=$this->codepwd($password) || !$acc['is_active']) return false;
          if($cookietime!=0) $cookietime=time()+$cookietime;//设置cookie
          $log['ip'] = get_client_ip();
          $data['lasttime']=$log['ctime']=time();
          $log['uid']=$id=$acc['id'];
          $log['type']=1;
          model('member')->update("id='{$id}'",$data);
          $grouplink=model("member_group_link")->find("uid='{$id}'");
          //存入登录日志
          model('login_logs')->insert($log);
          
          //登陆成功要设置cookie，然后保存到auth类里面，注意groupid的存放
          $cookie_auth = $acc['id'].'\t'.$acc['uname'].'\t'.$acc['lasttime'].'\t'.$grouplink['user_group_id'].'\t'.$login_email.'\t'.$acc['is_active'];
          if(set_cookie('auth',$cookie_auth,$cookietime)) return true;//设置cookie
          return false;
      }

      //用户退出
      public function logout()
      {
      	  session_unset();//释放所有的session
          $url=empty($_GET['url'])?$_SERVER['HTTP_REFERER']:$_GET['url'];
          if(set_cookie('auth','',time()-1)) $this->success('您已成功退出~',$url);//清除cookie
          //清除session
      }

      //用户注册
      public function regist()
      {
        if(!$this->isPost()){
            if(!empty($this->auth)) $this->redirect(url('member/index/index'));
            $this->display();
        }else{
            if(empty($_POST['login_email'])||empty($_POST['password'])||empty($_POST['uname'])) $this->error('请填写完整信息~');
            
            /**检测邮箱是否存在，ajax方式好~~**/
            $data=array();
            $grouplink=array();
            $login=array();
            $data['login_email']=in(trim($_POST['login_email']));
            $acc=model('member')->find("login_email='".$data['login_email']."'");
            if(!empty($acc['login_email'])) $this->error('该邮箱已被注册~');
            
            $data['uname']=in(trim($_POST['uname']));
            $data['password']=$this->codepwd($_POST['password']);
            $data['regip']=$data['lastip']=get_client_ip();
            $data['ctime']=$data['lasttime']=time();
            $data['is_active']=0;
            $token = md5($data['uname'].$data['password'].$data['ctime']); //创建用于激活识别码
            //下面先将用户写入会员比表
            $id=model('member')->insert($data);
            $grouplink['uid']=$id;//会员id
            $grouplink['user_group_id']=2;//新手上路
            model('member_group_link')->insert($grouplink);
            //将token token_exptime写入member_login表
            $login['mid']=$id;
            $login['token']=$token;//激活码
            model('member_login')->insert($login);
            if($id){
            	//下面处理邮箱
            	$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
            	Email::init($config['EMAIL']);//初始化邮箱配置
            	$smtpemailto=$data['login_email'];//收信人邮箱
            	$emailsubject="感谢使用91频道，请完成邮箱验证";//注册邮箱的主题
            	$uname=$data['uname'];//收信人name
            	$url=url('account/active',array('verify'=>urlencode($token)));//url传参数问题的解决办法
            	$verify_url=$config['siteurl'].$url;//邮箱验证的url
            	$emailbody=$uname."你好！<br/><br/>点击以下链接完成邮箱验证并激活在91频道的帐号：​<br/><a href='{$verify_url}'>{$verify_url}</a>";//注册邮箱的内容
            	$emailbody.="<br/><span style='font-size:14px;color:#999999'>如无法点击，请将链接拷贝到浏览器地址栏中直接访问。</span>";
            	$re=Email::send($smtpemailto, $emailsubject, $emailbody);
                $cookie_auth = $id.'\t'.$data['uname'].'\t'.$data['lasttime'].'\t'.$grouplink['user_group_id'].'\t'.$data['login_email'].'\t'.$data['is_active'];
               if(set_cookie('auth',$cookie_auth,0)&&$re) $this->redirect(url('member/account/regsucceed'));
            }else $this->error('数据库写入失败~');
        }
      }
      
      //邮箱注册成功处理
      public function regsucceed()
      {
      	//读取cookie中信息
      	$auth=$this->auth;//本地登录的cookie信息
      	$member_email=$auth['login_email'];
      	if($member_email)
      	{
      		$emailArr = explode("@",$member_email);//获得邮箱服务器
      		$this->login_email="http://mail.".$emailArr[1];//登录邮箱的地址
      		$this->member_email=$member_email;
      		$this->display();
      	}
      	else $this->error("禁止访问~");
      	
      }
      
      //邮箱注册激活处理
      public function active()
      {
      	$verify = stripslashes(trim($_GET['verify']));//激活码
      	$re=model('member_login')->find("token='{$verify}'");
      	//激活账号
      	if($re)
      	{
      		$id=$re['mid'];
      		$data['is_active']=1;
      		model('member')->update("id='{$id}'",$data);
      		//自动登录，根据验证码读取用户信息，设置用户cookie
      		$log['ip'] = get_client_ip();
      		$log['uid']=$id;
      		$log['type']=1;
      		//存入登录日志
      		model('login_logs')->insert($log);
      		$acc=model('member')->find("id='{$id}'");
      		$grouplink=model("member_group_link")->find("uid='{$id}'");
      		
      		$cookie_auth = $acc['id'].'\t'.$acc['uname'].'\t'.$acc['lasttime'].'\t'.$grouplink['user_group_id'].'\t'.$acc['login_email'].'\t'.$acc['is_active'];
      		if(set_cookie('auth',$cookie_auth,0)&&$re) $this->redirect(url('member/index/index'));
      	}
      }
      
      //新浪微博登陆回调函数处理
      public function weibo()
      {
      	   	$o = new SaeTOAuthV2( $this->we_akey,$this->we_skey);
     		if (isset($_REQUEST['code'])) {
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = $this->we_callback_url;
				try {
					$token = $o->getAccessToken( 'code', $keys ) ;
				} catch (OAuthException $e) {
			}
		}
		if ($token) {
			$_SESSION['token'] = $token;
			setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
			//授权成功，跳转页面，微博登陆成功，判断有没有绑定，没有则进行绑定，否则跳转到用户首页
			$weibo_uid=$_SESSION['token']['access_token'];
			if(model("member_login")->find("weibo_key='{$weibo_uid}'")) $this->redirect(url('member/index/index'));
				else $this->redirect(url('member/account/loginbind'));
		}
		else $this->error('绑定失败~~~');
 	}
      
      //使用微博登陆之后，如果有账号，则绑定，就是讲目前的账号写入一个weibo_key
      public function loginbind()
      {
      	if(!$this->isPost())
      	{
      		//绑定登陆的页面，此时已经使用微博登陆了，获取微博信息
      		$weibo_uid=$_SESSION['token']['access_token'];
      		$c = new SaeTClientV2($this->we_akey,$this->we_skey,$weibo_uid);
      		$ms  = $c->home_timeline(); // done
      		$uid_get = $c->get_uid();
      		$uid = $uid_get['uid'];
      		//根据ID获取用户等基本信息，$user_message数组为用户信息数组
      		$user_message = $c->show_user_by_id( $uid);//用户信息数组
      		$this->weibo_name=$user_message['screen_name'];//微博的昵称
      		$this->photo=$user_message['profile_image_url'];//微博头像
      		//判断是否登录
      		$auth=$this->auth;
      		if(empty($auth)&&empty($weibo_uid)) $this->redirect(url('member/account/login'));
      		else $this->display();
      	}
      	else
      	{
      		//提交绑定登陆动作
      		if(empty($_POST['login_email'])||empty($_POST['password'])) $this->error('请填写完整信息~');
      		$login_email=in(trim($_POST['login_email']));
      		$password=$_POST['password'];
      		$cookietime=empty($_POST['cooktime'])?0:intval($_POST['cooktime']);//接收cookie
      		//判断登录的处理，单独用一个函数判断登录
      		if($this->_login($login_email,$password,$cookietime))
      		{
      			//成功登陆，则写入微博Key
      			$auth=$this->auth;//auth存放会员信息
      			$data=array();
      			$data['mid']=$auth['id'];
      			$data['weibo_key']=$_SESSION['token']['access_token'];
      			if(model('member_login')->insert($data)) $this->redirect(url('member/index/index'));
      		}
      		else $this->error('邮箱或密码错误，或者您的账户已被锁定');
      	}
      }

      //新浪微博第一次登陆之后完善信息，这相当于注册
      public function openreg()
      {
      	
      }
      //找回密码
      public function lostpassword()
      {
      	if(!$this->isPost()){
      		$this->display();
      	}
      	else{
      		//提交
      		if(empty($_POST['login_email'])) $this->error('请输入邮箱地址~');
      		$login_email=in(trim($_POST['login_email']));
      		//检查是否存在该邮箱
      		$acc=model('member')->find("login_email='{$login_email}'");
      		$grouplink=model("member_group_link")->find("uid='".$acc['id']."'");
      		if(empty($acc)) $this->error('该邮箱尚未注册，现在去注册~','member/index/regist');
      		else{
      			//存在该邮件，构造url,发送邮件
      			$token = md5($acc['uname'].$acc['password'].$acc['ctime']); //创建用于激活识别码
      			$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
      			Email::init($config['EMAIL']);//初始化邮箱配置
      			$smtpemailto=$acc['login_email'];//收信人邮箱
      			$emailsubject="找回91频道密码";//注册邮箱的主题
      			$uname=$acc['uname'];//收信人name
      			$url=url('account/resetpassword',array('verify'=>urlencode($token)));//url传参数问题的解决办法
      			$verify_url=$config['siteurl'].$url;//邮箱验证的url
      			$emailbody=$uname."你好！<br/><br/>点击以下链接并根据页面提示完成密码重设：​<br/><a href='{$verify_url}'>{$verify_url}</a>";//注册邮箱的内容
      			$emailbody.="<br/><span style='font-size:14px;color:#999999'>如无法点击，请将链接拷贝到浏览器地址栏中直接访问。</span>";
      			$re=Email::send($smtpemailto, $emailsubject, $emailbody);
      			//这里不能设置cookie登陆,需要重新设置密码
      			//$cookie_auth = $acc['id'].'\t'.$acc['uname'].'\t'.$acc['lasttime'].'\t'.$grouplink['user_group_id'].'\t'.$acc['login_email'].'\t'.$acc['is_active'];
      			if($re){
      				$this->member_email=$login_email;
      				$emailArr = explode("@",$login_email);//获得邮箱服务器
      				$this->login_email="http://mail.".$emailArr[1];//登录邮箱的地址
      				$this->display("account/sendpassword");
      			}
      		}
      	}
      }
      
      //邮件发送成功
      public function sendpassword()
      {
      	$this->display();
      }
      
      //找回密码，重新设置密码
      public function resetpassword()
      {
      	$verify = stripslashes(trim($_GET['verify']));//激活码，对比用户的激活码
      	$re=model('member_login')->find("token='{$verify}'");//验证用户的登陆token
      	if(empty($re)) $this->error('该邮箱尚未激活，现在激活');
      	if(!$this->isPost()){
      		$this->display();
      	}else{
      		//重新设置密码
      		if($_POST['password']!=$_POST['repassword']) $this->error('确认密码与新密码不符~');
      		$data['password']=$this->codepwd($_POST['password']);
      		$id=$re['mid'];
      		if(model('member')->update("id='{$id}'",$data)) $this->success('密码修改成功~',url('default/index/index'));
      		else $this->error('密码修改失败~');
      	}
     
      	
      }
}