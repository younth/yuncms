<?php
/*
 * 前台会员后台的管理
 * */
class adminmemberController extends appadminController{
	
	//会员列表
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('adminmember/index',array('page'=>'{page}'));
		
		//关键字搜索
		$keyword=in(urldecode(trim($_GET['keyword'])));
		$starttime=strtotime(in($_GET['starttime']));
		$endtime=strtotime(in($_GET['endtime']));
		
		if(!empty($keyword)){
			//实现分页，分页处理在下边
			$url=url('adminmember/index',array('keyword'=>urlencode($keyword),'page'=>'{page}'));
			//$this->keyword=$keyword;//赋值关键字
		}
		/**关键字检索处理结束***/
		//echo $url;
		$limit=$this->pageLimit($url,$listRows);
		$count=model('member')->membercount($keyword,$starttime,$endtime);//总条数要结合keyword查询
		$list=model('member')->member_group_link($keyword,$starttime,$endtime,$limit);//连表查询，显示会员级别及会员信息
		//print_r($list);
		$this->list=$list;
		$this->page=$this->pageShow($count);
		$this->display();
	}
    
	//会员增加
   public function add(){
            if(!$this->isPost()){
                $this->t_name="添加";
                $group= model('memberGroup')->select("id !=1","id,group_name");
                foreach ($group as $val) {
                    $select.="<option value='{$val['id']}'>{$val['group_name']}</option>";
			}
                $this->select=$select;
                $this->action="add";
                $this->display('adminmember/edit');
            }else{
                $data=array();
          
                $data['uname']=$_POST['uname'];
                $data['password']=codepwd($_POST['password']);
                $data['login_email']=$_POST['login_email'];
                $data['tel']=$_POST['tel'];
                $data['qq']=$_POST['qq'];
                $data['is_active']=intval($_POST['is_active']);
                $data['ctime']=  time();
                $id=model('member')->insert($data);//插入到会员表，顺便获得插入的id
                //更新到会员组，先插入会员记录，得到插入的id,才能更新会员组信息
                $group['user_group_id']=intval($_POST['groupid']);
                $group['uid']=$id;
                if(model('member_group_link')->insert($group)){
                    $this->success('添加成功！');
                }else{
                    $this->error('添加会员失败~~');
                }
             }
        }

    //会员修改
	public function edit()
	{
		if(!$this->isPost()){
            $this->t_name="编辑";
			$id=$_GET['id'];
			if(empty($id)) $this->error('参数错误');
			$info=model('member')->find_link($id);//查找用户的信息,连表三次
			//print_r($info);
			//构造会员组权限组
			$group=model('memberGroup')->select("id !='1'","id,group_name");
			foreach ($group as $val) {
				$select.=($val['id']==$info['user_group_id'])?"<option selected='selected' value='{$val['id']}'>{$val['group_name']}</option>":"<option value='{$val['id']}'>{$val['group_name']}</option>";
			}
			$this->select=$select;
			$this->info=$info;
			$this->display();
		}else{
			$id=$_POST['id'];
			$data=array();
			
			//更新会员组信息
			$groupid['user_group_id']=intval($_POST['groupid']);
			model('member_group_link')->update("uid='$id'",$groupid);
			
			if($_POST['password']!=$_POST['oldpassword']) $data['password']=codepwd($_POST['password']);
			$data['uname']=$_POST['uname'];
			$data['login_email']=$_POST['login_email'];
			$data['tel']=$_POST['tel'];
			$data['qq']=$_POST['qq'];
			$data['is_active']=intval($_POST['is_active']);
			if(model('member')->update("id='$id'",$data))
			    $this->success('会员信息编辑成功~');
			else $this->error('出错了~');
		}
	}

	//删除会员
	public function del()
	{
		if(!$this->isPost()){
			//注意同时删除会员组信息，三方登录信息，登录日志，member  member_login  member_group_link   login_logs
			$id=intval($_GET['id']);
			if(empty($id)) {echo '您没有选择~';exit();}
			if(model('member')->delete("id='$id'"))
			{
				model('member_login')->delete("mid='$id'");
				model('member_group_link')->delete("uid='$id'");
				model('login_logs')->delete("uid='$id' AND type=1");
				echo 1;
			}
			else echo '删除失败~';
		}else{
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			if(model('member')->delete('id in ('.$delid.')'))
			$this->success('删除成功');
		}
	}

	//会员冻结
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['is_active']=intval($_POST['is_active']);
		if(model('member')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}

	//发送邮件
	public function sendemail()
	{
		$id=$_GET['id'];
		if(empty($id)) $this->error('参数错误');
		$info=model('member')->find("id='$id'");
		
		if(!$this->isPost()){
			$this->t_name="邮件";
			$this->display();
			}else{
		      $config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		      $data=array();
		      $data['uid']=$info['id'];
		      $data['email']=$info['login_email'];//收信人
		      $data['title']=$_POST['title'];//主题
		      $data['type']=1;
		       //内容
		      if (get_magic_quotes_gpc()) {
		      	$data['body'] = stripslashes($_POST['body']);
		      } else {
		      	$data['body'] = $_POST['body'];
		      }
		      $data['ctime']=time();
		      Email::init($config['EMAIL']);//初始化邮箱配置
		      $re=Email::send($data['email'], $data['title'], $data['body']);
		      if($re)
		      {
		      	//写入系统邮件记录
		      	if(model('notify_email')->insert($data))
		      	$this->success("发送成功！",url('adminmember/index'));
		      	
		      }
		      else $this->error("邮件发送失败~");
				
		}
	}
		
	//待审核用户管理
	public function active()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('adminmember/active',array('page'=>'{page}'));
		
		//关键字搜索
		$keyword=in(urldecode(trim($_GET['keyword'])));
		$starttime=strtotime(in($_GET['starttime']));
		$endtime=strtotime(in($_GET['endtime']));
		
		if(!empty($keyword)){
			//实现分页，分页处理在下边
			$url=url('adminmember/index',array('keyword'=>urlencode($keyword),'page'=>'{page}'));
			//$this->keyword=$keyword;//赋值关键字
		}
		/**关键字检索处理结束***/
		//echo $url;
		$limit=$this->pageLimit($url,$listRows);
		$count=model('member')->active_membercount($keyword,$starttime,$endtime);//总条数要结合keyword查询
		$list=model('member')->active_member_group_link($keyword,$starttime,$endtime,$limit);//连表查询，显示会员级别及会员信息
		
		$this->list=$list;
		$this->page=$this->pageShow($count);
		$this->display("adminmember/index");
	}
	
	//群发邮件
	public function sendall()
	{
		if(!$this->isPost())
		{
			//构造会员组权限组
			$group=model('memberGroup')->select("id !='1'","id,group_name");
			foreach ($group as $val) {
				$select.="<option value='{$val['id']}'>{$val['group_name']}</option>";
			}
			$this->select=$select;
			//选择发送的组名
			$this->t_name="邮件";
			$this->display();
		}
		else {
			$groupid=intval($_POST['groupid']);
			$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
			Email::init($config['EMAIL']);//初始化配置
			$data=array();
			$data['title']=$_POST['title'];//主题
			//内容
			if (get_magic_quotes_gpc()) {
				$data['body'] = stripslashes($_POST['body']);
			} else {
				$data['body'] = $_POST['body'];
			}
			$data['ctime']=time();
			/***上面接收的信息公用**/
			//找到该组别下的所有会员或者全部会员，全部会员的处理可以读取link表，也可以读取member表
			if($groupid==0) $groupuser=model('member')->select('','id');
				else $groupuser=model('member_group_link')->select("user_group_id ='$groupid'","uid");
			//print_r($groupuser);return;
			//循环给该组别下的所有会员分别发信
			foreach ($groupuser as $val)
			{
				//获取会员其他信息,所有人跟分组用户分别处理，因为一个是uid  一个是id
				if($groupid==0) $info=model('member')->find_link($val['id']);
				else $info=model('member')->find_link($val['uid']);
				$data['uid']=$info['id'];
				$data['type']=1;
				$data['email']=$info['login_email'];//收信人
				$re=Email::send($data['email'], $data['title'], $data['body']);
				//写入邮件记录
				$send_result= model('notify_email')->insert($data);
			}
			if($send_result) $this->success("发送成功！",url('adminmember/sendall'));
			else $this->error("群发邮件失败~");
		}
	}
	
	//发送私信
	public  function sendmsg()
	{
		$id=$_GET['id'];
		if(empty($id)) $this->error('参数错误');
		$info=model('member')->find("id='$id'");
		
		if(!$this->isPost()){
			$this->t_name="私信";
			$this->display('adminmember/sendemail');
		}else{
			//处理私信
			$data=array();
			$data['uid']=$info['id'];//接收私信的人
			$data['title']=$_POST['title'];//主题
			$data['type']='system';//私信类型
			//内容
			if (get_magic_quotes_gpc()) {
				$data['body'] = stripslashes($_POST['body']);
			} else {
				$data['body'] = $_POST['body'];
			}
			$data['ctime']=time();
			if(model('notify_message')->insert($data))
				$this->success("发送成功！",url('adminmember/index'));
			else $this->error("邮件发送失败~");
				
		}
	}

	//群发私信
	public  function send_allmsg()
	{
		if(!$this->isPost())
		{
			//构造会员组权限组
			$group=model('memberGroup')->select("id !='1'","id,group_name");
			foreach ($group as $val) {
				$select.="<option value='{$val['id']}'>{$val['group_name']}</option>";
			}
			$this->select=$select;
			//选择发送的组名
			$this->t_name="私信";
			$this->display('adminmember/sendall');
		}
		else {
			//群发私信的处理
			$groupid=intval($_POST['groupid']);
			$data=array();
			$data['title']=$_POST['title'];//主题
			$data['type']='system';//私信类型
			//内容
			if (get_magic_quotes_gpc()) {
				$data['body'] = stripslashes($_POST['body']);
			} else {
				$data['body'] = $_POST['body'];
			}
			$data['ctime']=time();
			/***上面接收的信息公用**/
			//找到该组别下的所有会员或者全部会员，全部会员的处理可以读取link表，也可以读取member表
			if($groupid==0) $groupuser=model('member')->select('','id');
			else $groupuser=model('member_group_link')->select("user_group_id ='$groupid'","uid");
			//print_r($groupuser);return;
			//循环给该组别下的所有会员分别发私信
			foreach ($groupuser as $val)
			{
				//获取会员其他信息,所有人跟分组用户分别处理，因为一个是uid  一个是id
				if($groupid==0) $info=model('member')->find_link($val['id']);
				else $info=model('member')->find_link($val['uid']);
				$data['uid']=$info['id'];
				$send_result= model('notify_message')->insert($data);
			}
			if($send_result) $this->success("群发私信成功！",url('adminmember/send_allmsg'));
			else $this->error("群发私信失败~");
				
		}
	}

}