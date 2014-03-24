<?php
/*
 * 前台会员后台的管理
 * */
class admincompanyController extends appadminController{
	static protected $sorttype;//资讯分类，为1,代表news
	public function __construct()
	{
		parent::__construct();
		$this->sorttype=5;//5是自定义类型
	}
	//会员列表
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('admincompany/index',array('page'=>'{page}'));
		
		//关键字搜索
		$keyword=in(urldecode(trim($_GET['keyword'])));
		$starttime=strtotime(in($_GET['starttime']));
		$endtime=strtotime(in($_GET['endtime']));
		
		if(!empty($keyword)){
			//实现分页，分页处理在下边
			$url=url('admincompany/index',array('keyword'=>urlencode($keyword),'page'=>'{page}'));
			//$this->keyword=$keyword;//赋值关键字
		}
		/**关键字检索处理结束***/
		//echo $url;
		$limit=$this->pageLimit($url,$listRows);
		$count=model('company')->companycount($keyword,$starttime,$endtime);//总条数要结合keyword查询
		//构造where条件直接查询
		$where=model('company')->company_search($keyword,$starttime,$endtime,$limit);//在模型里面对检索条件进行处理
		$list=model('company')->select($where,'id,name,sort,ctime,lasttime,is_active,license,logo');//检索出符合条件的企业
		
		//给二维数组增加一个字段，统计出企业的粉丝数
		foreach ($list as  $row=>$v)
		{
			$list[$row]['fans_count']=model('company_fans')->fanscount($v['id']);
		}
		//print_r($list);
		$where="type=".$this->sorttype;
		$sortlist=model('sort')->select($where,'id,name,deep,path,norder,type');
		
		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);//无限分类重排序
			$sortname=array();
			//循环生成栏目选项
			foreach($sortlist as $vol){
                $sortname[$vol['id']]=$vol['name'];//分类的id=>分类名
            }
            $this->sortname=$sortname;
		}
		//计算粉丝总数
		
		//print_r($sortname);
		$this->list=$list;
		$this->page=$this->pageShow($count);
		$this->public=__PUBLIC__.'/admin';//app路径
		$this->path=__ROOT__.'/upload/license/image/';
		$this->display();
	}

	//会员修改
	public function edit()
	{
		if(!$this->isPost()){
			$id=$_GET['id'];
			if(empty($id)) $this->error('参数错误');
			$info=model('company')->find_link($id);//查找用户的信息,连表三次
			//print_r($info);
			//构造会员组权限组
			$group=model('companyGroup')->select("id !='1'","id,group_name");
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
			model('company_group_link')->update("uid='$id'",$groupid);
			
			if($_POST['password']!=$_POST['oldpassword']) $data['password']=$this->codepwd($_POST['password']);
			//$data['nickname']=$_POST['nickname'];
			$data['login']=$_POST['login'];
			$data['tel']=$_POST['tel'];
			$data['qq']=$_POST['qq'];
			$data['is_active']=intval($_POST['is_active']);
			if(model('company')->update("id='$id'",$data))
			    $this->success('会员信息编辑成功~');
			else $this->error('出错了~');
		}
	}

	//删除会员
	public function del()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) {echo '您没有选择~';exit();}
			if(model('company')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			if(model('company')->delete('id in ('.$delid.')'))
			$this->success('删除成功');
		}
	}

	//会员冻结
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['is_active']=intval($_POST['is_active']);
		if(model('company')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}

	//发送邮件
	public function sendemail()
	{
		$id=$_GET['id'];
		if(empty($id)) $this->error('参数错误');
		$info=model('company')->find("id='$id'");
		
		if(!$this->isPost()){
			$this->t_name="邮件";
			$this->display();
			}else{
		      $config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		      $data=array();
		      $data['uid']=$info['id'];
		      $data['email']=$info['login'];//收信人
		      $data['title']=$_POST['title'];//主题
		       //内容
		      if (get_magic_quotes_gpc()) {
		      	$data['body'] = stripslashes($_POST['body']);
		      } else {
		      	$data['body'] = $_POST['body'];
		      }
		      $data['ctime']=time();
		      Email::init($config['EMAIL']);//初始化配置
		      $re=Email::send($data['email'], $data['title'], $data['body']);
		      if($re)
		      {
		      	//写入系统邮件记录
		      	if(model('notify_email')->insert($data))
		      	$this->success("发送成功！",url('admincompany/index'));
		      	
		      }
		      else $this->error("邮件发送失败~");
				
		}
	}
		
	//待审核用户管理
	public function active()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('admincompany/active',array('page'=>'{page}'));
		
		//关键字搜索
		$keyword=in(urldecode(trim($_GET['keyword'])));
		$starttime=strtotime(in($_GET['starttime']));
		$endtime=strtotime(in($_GET['endtime']));
		
		if(!empty($keyword)){
			//实现分页，分页处理在下边
			$url=url('admincompany/index',array('keyword'=>urlencode($keyword),'page'=>'{page}'));
			//$this->keyword=$keyword;//赋值关键字
		}
		/**关键字检索处理结束***/
		//echo $url;
		$limit=$this->pageLimit($url,$listRows);
		$count=model('company')->active_companycount($keyword,$starttime,$endtime);//总条数要结合keyword查询
		$list=model('company')->active_company_group_link($keyword,$starttime,$endtime,$limit);//连表查询，显示会员级别及会员信息
		
		$this->list=$list;
		$this->page=$this->pageShow($count);
		$this->display("admincompany_index");
	}
	
	//群发邮件
	public function sendall()
	{
		if(!$this->isPost())
		{
			//构造会员组权限组
			$group=model('companyGroup')->select("id !='1'","id,group_name");
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
			//找到该组别下的所有会员或者全部会员，全部会员的处理可以读取link表，也可以读取company表
			if($groupid==0) $groupuser=model('company')->select('','id');
				else $groupuser=model('company_group_link')->select("user_group_id ='$groupid'","uid");
			//print_r($groupuser);return;
			//循环给该组别下的所有会员分别发信
			foreach ($groupuser as $val)
			{
				//获取会员其他信息,所有人跟分组用户分别处理，因为一个是uid  一个是id
				if($groupid==0) $info=model('company')->find_link($val['id']);
				else $info=model('company')->find_link($val['uid']);
				$data['uid']=$info['id'];
				$data['email']=$info['login'];//收信人
				$re=Email::send($data['email'], $data['title'], $data['body']);
				//写入邮件记录
				$send_result= model('notify_email')->insert($data);
			}
			if($send_result) $this->success("发送成功！",url('admincompany/sendall'));
			else $this->error("群发邮件失败~");
		}
	}
	
	//发送私信
	public  function sendmsg()
	{
		$id=$_GET['id'];
		if(empty($id)) $this->error('参数错误');
		$info=model('company')->find("id='$id'");
		
		if(!$this->isPost()){
			$this->t_name="私信";
			$this->display('admincompany_sendemail');
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
				$this->success("发送成功！",url('admincompany/index'));
			else $this->error("邮件发送失败~");
				
		}
	}

	//群发私信
	public  function send_allmsg()
	{
		if(!$this->isPost())
		{
			//构造会员组权限组
			$group=model('companyGroup')->select("id !='1'","id,group_name");
			foreach ($group as $val) {
				$select.="<option value='{$val['id']}'>{$val['group_name']}</option>";
			}
			$this->select=$select;
			//选择发送的组名
			$this->t_name="私信";
			$this->display('admincompany_sendall');
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
			//找到该组别下的所有会员或者全部会员，全部会员的处理可以读取link表，也可以读取company表
			if($groupid==0) $groupuser=model('company')->select('','id');
			else $groupuser=model('company_group_link')->select("user_group_id ='$groupid'","uid");
			//print_r($groupuser);return;
			//循环给该组别下的所有会员分别发私信
			foreach ($groupuser as $val)
			{
				//获取会员其他信息,所有人跟分组用户分别处理，因为一个是uid  一个是id
				if($groupid==0) $info=model('company')->find_link($val['id']);
				else $info=model('company')->find_link($val['uid']);
				$data['uid']=$info['id'];
				$send_result= model('notify_message')->insert($data);
			}
			if($send_result) $this->success("群发私信成功！",url('admincompany/send_allmsg'));
			else $this->error("群发私信失败~");
				
		}
	}

}