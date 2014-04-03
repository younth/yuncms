<?php
/*
 * 前台会员后台的管理
 * */
class admincompanyController extends appadminController{
	static protected $sorttype;//分类
	static public $nopic='';//默认logo路径
	static protected $uploadpath='';//封面图上传路径
	public function __construct()
	{
		parent::__construct();
		$this->sorttype=5;//5是自定义类型
		$this->nopic='NoPic.gif';//默认封面
		$this->uploadpath = ROOT_PATH.'upload/company/image/';//封面图路径
	}
	//企业列表
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
		$this->path=__ROOT__.'/upload/company/image/';
		$this->display();
	}

	//企业修改
	public function edit()
	{
		$id=$_GET['id'];
		if(empty($id)) $this->error('参数错误');
		$info=model('company')->find("id='$id'");//查找用户的信息,连表三次
		if(!$this->isPost()){
			$sort=$info['sort'];//当前的栏目
			//构造企业所属行业,行业管理的sort是100039
			$where="type=5 AND find_in_set('100039',path)";
			$sortlist=model('sort')->select($where,'id,name,deep,path,norder,type');
			//dump($sortlist);
			if(!empty($sortlist)){
				$sortlist=re_sort($sortlist);//无限分类重排序
				$sortname=array();
				//循环生成栏目选项
				foreach($sortlist as $vo){
					$space = str_repeat('├┈', $vo['deep']-1);//str_repeat指定字符串重复的次数，重复deep-1次，二级栏目就一个，三级两个
					$sortnow=$vo['path'].','.$vo['id'];//构造的栏目导航定位
					$selected=($sort==$sortnow)?'selected="selected"':''; //选中当前的分类
					$option.= '<option '.$selected.' value="'.$sortnow.'">'.$space.$vo ['name'].'</option>';
				}
				$this->option=$option;
			}
			$this->public=__PUBLIC__.'/admin';//app路径
			$this->path=__ROOT__.'/upload/company/image/';
			$this->info=$info;
			$this->display();
		}else{
			$data=array();
			//更新企业信息
			
			$data['sort']=$_POST['sort'];
			$data['address']=$_POST['address'];
			$data['websites']=$_POST['websites'];
			$data['introduce']=$_POST['introduce'];
			$data['is_active']=intval($_POST['is_active']);
			
			//logo上传，这里借助Kindeditor的上传功能
			if(empty($_POST['logo']))$data['logo']=$this->nopic;
			else{
				$firstpath=in($_POST['logo']);
				if(!empty($firstpath)){
					$lastlocation=strrpos($firstpath,'/');
					$timefile=substr($firstpath,$lastlocation-8,8);
					$covername=substr($firstpath,$lastlocation+1);
					if(file_exists($this->uploadpath.$timefile.'/'.$covername)){
						$data['logo']= $timefile.'/'.$covername;  //自动生成一个图片用于希望的封面图
					}else   $data['logo']=$this->nopic;
				}else   $data['logo']=$this->nopic;
			}
			
			if(model('company')->update("id='$id'",$data))
			    $this->success('企业信息编辑成功~');
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

	//企业冻结和激活
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['is_active']=intval($_POST['is_active']);
		if(model('company')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}

	//企业发送邮件
	public function sendemail()
	{
		$id=$_GET['id'];
		if(empty($id)) $this->error('参数错误');
		$info=model('company')->find("id='$id'");
		if(!$this->isPost()){
			$this->t_name="企业邮件";
			$this->display();
                }else{
                    $config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
                    $data=array();
                    $data['uid']=$info['id'];
                    $data['email']=$info['login_email'];//收信人
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
		
	//待审核企业管理
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
		$count=model('company')->companycount($keyword,$starttime,$endtime);//总条数要结合keyword查询
		//构造where条件直接查询
		$where=model('company')->company_search($keyword,$starttime,$endtime,$limit);//在模型里面对检索条件进行处理
                $where=  empty($where)?'is_active=0':$where.' and is_active = 0';
		$list=model('company')->select($where,'id,name,sort,ctime,lasttime,is_active,license,logo');//检索出符合条件的企业
		
		//给二维数组增加一个字段，统计出企业的粉丝数
                if(!empty($list)){
		foreach ($list as  $row=>$v)
		{
			$list[$row]['fans_count']=model('company_fans')->fanscount($v['id']);
		}
                $where="type=".$this->sorttype;
		$sortlist=model('sort')->select($where,'id,name,deep,path,norder,type');
                }
		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);//无限分类重排序
			$sortname=array();
			//循环生成栏目选项
			foreach($sortlist as $vol){
                $sortname[$vol['id']]=$vol['name'];//分类的id=>分类名
            }
            $this->sortname=$sortname;
		}
		$this->list=$list;
		$this->page=$this->pageShow($count);
                $this->public=__PUBLIC__.'/admin';//app路径
		$this->path=__ROOT__.'/upload/company/image/';
		$this->display("admincompany/index");
	}
	
	//群发邮件
	public function sendall()
	{
		if(!$this->isPost())
		{
			//选择发送的组名
			$this->t_name="企业邮件";
			$this->display();
		}
		else {
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
           $all_company=model('company')->select();
			foreach ($all_company as $_k => $_v)
			{
				$data['uid']=$_v['id'];
				$data['email']=$_v['login_email'];//收信人
                $data['type']=1;
				$re=Email::send($data['email'], $data['title'], $data['body']);
				//写入邮件记录
				$send_result[$_k]= model('notify_email')->insert($data);
			}
			if($send_result) $this->success("共".  count($send_result)."条邮件发送成功！",url('admincompany/sendall'));
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
			$this->t_name="企业私信";
			$this->display('admincompany/sendemail');
		}else{
			//处理私信
			$data=array();
			$data['uid']=$info['id'];//接收私信的人
			$data['title']=$_POST['title'];//主题
			$data['type']='system';//私信类型
                        $data['accept_type']=1;
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
			//选择发送的组名
			$this->t_name="公司私信";
			$this->display('admincompany/sendall');
		}
		else {
			//群发私信的处理
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
                        $data['accept_type']=1;
			/***上面接收的信息公用**/
                        $all_company=model('company')->select();
			//循环给该组别下的所有会员分别发私信
			foreach ($all_company as $_k =>$_v)
			{
				//获取会员其他信息,所有人跟分组用户分别处理，因为一个是uid  一个是id
				$data['uid']=$_v['id'];
				$send_result[$_k]= model('notify_message')->insert($data);
			}
			if($send_result) $this->success("共有".count($send_result)."条私信发送成功！",url('admincompany/send_allmsg'));
			else $this->error("群发私信失败~");
				
		}
	}

	
	//编辑器上传
	public function UploadJson(){
		//上传到news目录下面
		EditUploadJson('company');
	}
	
	//编辑器文件管理
	public function FileManagerJson(){
		EditFileManagerJson('company');
	}
	
}