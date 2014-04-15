<?php
/*
 * 档案控制器
 * */
class profileController extends commonController
{
	public function __construct()
	{
		parent::__construct();
		$this->uploadpath=ROOT_PATH.'upload/company/license/';
		$hover="class=\"current\"";//设置当前的导航状态
		$this->hover_profile=$hover;
	}
	
    //档案的首页
    public function index()
    {
        $auth=$this->auth;//本地登录的cookie信息
    	$id=$auth['id'];//读取用户的id
        $info=model('member_profile')->find("mid='$id'");
        $this->edu=$this->_edu($info['education']);
        $this->info=$info;
        //我的专长
        $list= model('member_tag')->select("mid='{$id}'",'id,name','id asc');
        $this->mytag=$list;
        //最近来访
        $visit=model("visit_history")->visitme($id);
	    if(!empty($visit)){
				include_once(ROOT_PATH.'/avatar/AvatarUploader.class.php');
				$au = new AvatarUploader();
				foreach ($visit as  $row=>$v)
				{
					$uid=$v['id'];
					$visit[$row]['avatar']=$au->getAvatar($uid,'small');
				}
			}        
        $this->visit=$visit;
        $this->display();
    }
    
    //判断学历
    protected function _edu($edu)
    {
    	//学历的判断
    	switch ($edu){
    		case 1:
    			$education="博士研究生";
    			break;
    		case 2:
    			$education="硕士研究生";
    			break;
    		case 3:
    			$education="本科";
    			break;
    		case 4:
    			$education="专科";
    			break;
    		case 5:
    			$education="其他";
    			break;
    	}
    	 return $education;
    }

    //修改基本信息
    public function editbase()
    {
        $auth=$this->auth;//本地登录的cookie信息
    	$id=$auth['id'];//读取用户的id
        //if(empty($id)) $this->error('参数错误');
        if(!$this->isPost()){
                $info=model('member_profile')->find("mid='{$id}'",'location,qq,sex,city,major,tel');
                $auth=$this->auth;//本地登录的cookie信息
                //读取用户的name
                               
                //city表示所在城市，location表示家乡
                $city=  explode(',', $info['city']);
                $location= explode(',', $info['location']);
                $info['province']=$city[0];
                $info['city2']=$city[1];
                $info['province1']=$location[0];               
                $info['city1']=$location[1];
                
                //未提交则显示
                $this->info=$info;//当前管理员信息数组
                $this->t_name="编辑";
                $this->display();
        }else{
                //提交，修改
                $data=array();//要保存的数组
                $user=array();
//                $data['name']=$_POST['name'];待实现
                //将数组转化为字符串
                //修改到member姓名
                $user['uname']=in(trim($_POST['uname']));
                if($auth['uname']!=$user['uname'])
                {
                	$user['first_letter']=getFirstCharter($user['uname']);//获取会员的首字母
                	//姓名被改,更改cookie及会员的首字母
                	if(model("member")->update("id='{$id}'",$user))
                	{
                		$cookie_auth = $auth['id'].'\t'.$user['uname'].'\t'.$auth['lasttime'].'\t'.$auth['groupid'].'\t'.$auth['login_email'].'\t'.$auth['is_active'];
                		set_cookie('auth',$cookie_auth);//设置cookie
                	}
                	
                }
                $city=$_POST['province'].",".$_POST['city'];
                $location=$_POST['province1'].",".$_POST['city1'];               
                
                $data['qq']=$_POST['qq'];
                $data['sex']=$_POST['gender'];
                $data['city']=$city; 
                $data['location']=$location;
                $data['tel']=$_POST['tel'];
                if(model('member_profile')->update("mid='{$id}'",$data))
                	$this->redirect(url('profile/index'));
                else 
                    $this->error('没有任何修改，不需要执行');
        }
    }

    //修改教育信息
     public function editedu()
     {
     	$auth=$this->auth;//本地登录的cookie信息
     	$id=$auth['id'];//读取用户的id
        if(empty($id)) $this->error('参数错误');
        if(!$this->isPost()){
                //未提交则显示
                $info=model('member_profile')->find("mid='{$id}'",'school,major,major_type,education,start_time,end_time');          
                $major_type= explode(',', $info['major_type']);
                $this->major1= $major_type['0']; 
                $this->major2= $major_type['1'];
                $this->info=$info;//当前管理员信息数组
                $this->display();
        }else{
                //连接成字符串
                $major_type=in(trim($_POST['province'])).",".in(trim($_POST['city']));
                //提交，修改
                $data=array();//要保存的数组
                $data['school']=$_POST['school'];
                $data['major']=$_POST['majorName'];
                $data['major_type']=$major_type;
                $data['education']=$_POST['education'];
                $data['start_time']= strtotime(in($_POST['start_time']));
                $data['end_time']=  strtotime(in($_POST['end_time']));
                if(model('member_profile')->update("mid='{$id}'",$data))
                $this->redirect(url('profile/index#aboutme'));
                else $this->error('没有任何修改，不需要执行');
        }
     }
     
     //首页秀特长
     public function tag()
     {
     	$this->display();
     }

     //修改技能信息
     public function editskills()
     {
     	$auth=$this->auth;//本地登录的cookie信息
     	$id=$auth['id'];//学生用户的id
      	//读取用户标签,联系member_tag表与sort表
      	$list= model('member_tag')->select("mid='{$id}'",'id,name','id asc');//两表关联查询
      	$this->mytag=$list;
      	
      	$this->display();
      	
     }
     
     //ajax增加标签
     public function addtag()
     {
     	$auth=$this->auth;//本地登录的cookie信息
     	$data=array();
     	$data['mid']=$auth['id'];//学生用户的id
     	if(empty($data['mid'])) $this->error('未登录~');
     	$data['tid']=intval($_GET['id']);//tag的id
     	$data['name']=in($_GET['name']);
     	//判断是否增加过
     	if(model("member_tag")->insert($data)) echo 1;
     	else echo "增加失败";
     }
     
     //ajax删除标签
     public function deltag()
     {
     	$auth=$this->auth;//本地登录的cookie信息
     	$mid=$auth['id'];//学生用户的id
     	$id=intval($_GET['id']);
     	if(model("member_tag")->delete("mid='{$mid}' and id='{$id}'")) echo 1;
     	else echo "删除失败";
     }
     
     //修改兴趣信息
     public function editinterest()
     {
            $this->interest=$_POST['interest'];

            if($_POST['interest1']) {
                  $_SESSION['token']['access_token']="唐娜";
                  $info=model('member')->find("uname='{$_SESSION['token']['access_token']}'",'id');

                  //将数组转化为字符串
                  foreach ($_POST['interest1'] as $_k => $_v) {
                      $interest.=$_v.",";
                  }
                  $interest=  substr($interest, 0, strlen($interest)-1);//去掉末尾的逗号","
                  
                  if(model('member_profile')->update("mid='{$info['id']}'","interest='{$interest}'"))
                      $this->success('信息修改成功~',url('profile/index'));
                  else 
                      $this->error('没有任何修改，不需要执行');
            }
            
            $this->display();
     }
     
     //修改关于我的信息
     public function editintroduce()
     {
        $auth=$this->auth;//本地登录的cookie信息
     	$id=$auth['id'];//读取用户的id
         if(empty($id)) $this->error('参数错误');
         
         if(!$this->isPost()){
              $info=model('member_profile')->find("mid='$id'",'introduce');
              $this->introduce=$info['introduce'];
              $this->display();
         } else {
             //提交，修改
             $data=array();//要保存的数组
             $data['introduce']=in($_POST['introduce']);
             if(model('member_profile')->update("mid='{$id}'",$data))
                $this->redirect(url('profile/index#aboutme'));
             else 
                 $this->error('没有任何修改，不需要执行');
         }
     }

     //会员访问记录
     protected  function _visit($fid,$bid)
     {
     	$data=array();
     	if($fid==$bid) return false;//不可自己访问自己
     	//看是否访问过，访问过则更新时间
     	$re=model('visit_history')->find("fid='{$fid}' and bid='{$bid}' and type=1");
     	if($re)
     	{
     		$id=$re['id'];
     		$data['ctime']=time();
     		model('visit_history')->update("id='{$id}'",$data);
     		return true;
     	}
     	else{
     		$data['type']=1;//类型1，会员访问记录
     		$data['fid']=$fid;
     		$data['bid']=$bid;
     		$data['ctime']=time();
     		if(model('visit_history')->insert($data))return true;
     		else false;
     	}
     }
      
     //其他学生用户
     public function user()
     {
     	$id=intval($_GET['id']);
     	$auth=$this->auth;//本地登录的cookie信息
     	$mid=$auth['id'];
     	if($mid==$id) $this->redirect(url("member/profile/index"));//是自己
     	//得到用户的所有信息,连表查询
     	//访问记录
     	$this->_visit($mid,$id);//更新访问记录
     	$info=model('member')->user_profile($id,'');
     	include_once(ROOT_PATH.'/avatar/AvatarUploader.class.php');
     	$au = new AvatarUploader();
     	$urlAvatarBig = $au->getAvatar($id,'big');
     	$urlAvatarMiddle = $au->getAvatar($id,'middle');
     	$urlAvatarSmall = $au->getAvatar($id,'small');
     	$this->small=$urlAvatarSmall;
     	$this->middle=$urlAvatarMiddle;
     	$this->big=$urlAvatarBig;     	
     	$this->edu=$this->_edu($info['education']);
     	//会员的专长
     	$list= model('member_tag')->select("mid='{$id}'",'id,name','id asc');
     	$this->mytag=$list;
     	//最近来访,不包括自己
     	$visit=model("visit_history")->visitme($id);
     	if(!empty($visit)){
     		include_once(ROOT_PATH.'/avatar/AvatarUploader.class.php');
     		$au = new AvatarUploader();
     		foreach ($visit as  $row=>$v)
     		{
     			$uid=$v['id'];
     			$visit[$row]['avatar']=$au->getAvatar($uid,'small');
     		}
     	}
     	$this->visit=$visit;
     	//mid我  id是被访问的用户
     	//判断我是否被申请加为好友，申请者是他人
     	$rece_card=model('member_card')->find("rece_id='{$mid}' AND send_id='{$id}'");//当前会员收到的申请
     	//我收到申请，我看别人的资料显示：确认通过
     	if($rece_card['status']==1)
     	{
     		$this->card=1;//接受邀请
     	}elseif($rece_card['status']==2){
     		$this->card=2;//发送私信
     	}
     	//我发出的申请，我看被申请的人的资料时候显示
     	$send_card=model('member_card')->find("send_id='{$mid}' AND rece_id='{$id}'");
       if($send_card['status']==1)
     	{
     		$this->card=3;//等待	审核
     	}elseif($send_card['status']==2){
     		$this->card=2;//发送私信
     	}
     	$this->info=$info;
     	$this->display();
     }
}