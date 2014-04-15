<?php
class admingroupController extends appadminController{
	
	//会员组列表
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('admin/index',array('page'=>'{page}'));
		$limit=$this->pageLimit($url,$listRows);

		$count=model('memberGroup')->count();//获取行数
		$list=model('memberGroup')->select('','id,group_name,user_group_icon','id DESC',$limit);
		//print_r($list);
		$this->path=__ROOT__.'/public/images/usergroup/';
		$this->list=$list;
		$this->page=$this->pageShow($count);
		$this->display();
	}
    
	//会员组添加
	public function add()
	{
		if(!$this->isPost()){
			$this->t_name="添加";
			$this->display("admingroup/edit");//添加修改用同一个页面
		}else{
			$data=array();
			$data['group_name']=trim($_POST['gname']);
			if(empty($data['group_name'])) $this->error("请输入组名");
			$data['user_group_icon']=trim($_POST['user_group_icon']);
			$data['notallow']=trim($_POST['notallow']);
			$data['notallow']=str_replace("\r\n","|",$data['notallow']);
			if(model('memberGroup')->insert($data))
			    $this->success('会员组添加成功~');
			else $this->error('出错了~');
		}
	}
	
	//会员组修改
	public function edit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$info=model('memberGroup')->find("id='$id'");
			$info['notallow']=str_replace("|","\r\n",$info['notallow']);
			$this->info=$info;
			$this->t_name="修改";
			$this->display();
		}else{
			$data=array();
			$data['group_name']=trim($_POST['gname']);
			$data['user_group_icon']=trim($_POST['user_group_icon']);
			if(empty($data['group_name'])) $this->error("请输入组名");
			$data['notallow']=trim($_POST['notallow']);
			$data['notallow']=str_replace("\r\n","|",$data['notallow']);
			if(model('memberGroup')->update("id='$id'",$data))
			    $this->success('会员组编辑成功~');
			else $this->error('出错了~');
		}
	}

	//删除会员组
	public function del()
	{
		$id=intval($_GET['id']);//ajax方式传来groupid
		if(empty($id)) $this->error('您没有选择~');
		//判断当前删除的分组下面是否已经有会员
		$member=model('member_group_link')->find("user_group_id='$id'");//寻找属于该组的会员
		if(!empty($member)) {
			echo '有属于该组的会员存在，不能删除~';
			return;
		}
		if(model('memberGroup')->delete("id='$id'"))
		echo 1;
		else echo '删除失败~';
	}

}