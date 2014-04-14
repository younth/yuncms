<?php
/*
 * 企业登陆注册处理类
 * */
class accountController extends commonController
{
	//企业欢迎页面
      public function welcome()
      {
      	$this->display();
      }
      
      //企业注册
      public function regist()
      {
        if(!$this->isPost()){
            if(!empty($_SESSION['company_id'])) $this->redirect(url('company/index/index'));
            $this->display();
        }else{
            if(empty($_POST['login_email'])||empty($_POST['password'])||empty($_POST['name'])) $this->error('请填写完整信息~');
            
            /**检测邮箱是否存在，ajax方式好~~**/
            $data=array();
            $login=array();
            $data['login_email']=in(trim($_POST['login_email']));
            $acc=model('company')->find("login_email='".$data['login_email']."'");
            if(!empty($acc['login_email'])) $this->error('该邮箱已被注册~');
            
            $data['name']=in(trim($_POST['name']));
            $data['password']=codepwd($_POST['password']);
            $data['regip']=$data['lastip']=get_client_ip();
            $data['ctime']=$data['lasttime']=time();
            $data['is_active']=0;
            $token = md5($data['name'].$data['password'].$data['ctime']); //创建用于激活识别码
            //下面先将用户写入会员比表
            $id=model('company')->insert($data);
            //将token token_exptime写入member_login表
            $login['mid']=$id;
            $login['type']=2;
            $login['token']=$token;//激活码
            model('member_login')->insert($login);
            if($id){
            	//下面处理邮箱
            	$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
            	Email::init($config['EMAIL']);//初始化邮箱配置
            	$smtpemailto=$data['login_email'];//收信人邮箱
            	$emailsubject="感谢使用91频道，请完成邮箱验证";//注册邮箱的主题
            	$name=$data['name'];//收信人name
            	$url=url('account/active',array('verify'=>urlencode($token)));//url传参数问题的解决办法
            	$verify_url=$config['siteurl'].$url;//邮箱验证的url
            	$emailbody=$name."你好！<br/><br/>点击以下链接完成邮箱验证并激活在91频道的帐号：​<br/><a href='{$verify_url}'>{$verify_url}</a>";//注册邮箱的内容
            	$emailbody.="<br/><span style='font-size:14px;color:#999999'>如无法点击，请将链接拷贝到浏览器地址栏中直接访问。</span>";
            	$re=Email::send($smtpemailto, $emailsubject, $emailbody);
            	//此时未激活，不设置session
            	//$_SESSION['company_id']=$id;
            	//$_SESSION['name']=$data['name'];
            	$_SESSION['login_email']=$data['login_email'];//用于传递
            	if($re) $this->redirect(url('company/account/regsucceed'));
            }else $this->error('数据库写入失败~');
        }
      }
      
      //邮箱注册成功处理
      public function regsucceed()
      {
      	//用session传递提交的email
      	$member_email=$_SESSION['login_email'];
      	if($member_email)
      	{
      		$emailArr = explode("@",$member_email);//获得邮箱服务器
      		$this->login_email="http://mail.".$emailArr[1];//登录邮箱的地址
      		$this->member_email=$member_email;
      		$this->display();
      	}
      	else $this->error("禁止访问~");
      	
      }

      //激活
      public function active()
      {
      	$verify = stripslashes(trim($_GET['verify']));//激活码
      	$re=model('member_login')->find("token='{$verify}'");
      	//激活账号
      	if($re)
      	{
      		$id=$re['mid'];
      		$data['is_active']=1;
      		model('company')->update("id='{$id}'",$data);
      		//自动登录，根据验证码读取用户信息，设置用户cookie
      		$log['ip'] = get_client_ip();
      		$log['uid']=$id;
      		$log['type']=2;
      		//存入登录日志
      		model('login_logs')->insert($log);
      		//sisson存储,比较方便
      		$acc=model('company')->find("id='{$id}'");
      		$_SESSION['id']=$acc['id'];
      		$_SESSION['name']=$acc['name'];
      		$this->redirect(url('company/index/index'));
      	}
      }
      
      //激活之后完善信息
}