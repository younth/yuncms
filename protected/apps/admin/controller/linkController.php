<?php
/*
 * 友情链接管理控制器
 * */
class linkController extends commonController
{
	static protected $imgpath='';//封面图路径
	static protected $uploadpath='';//封面图上传路径
	static public $nopic='';//默认logo路径
	
	public function __construct()
	{
		parent::__construct();
		//初始化图片路径
		$this->imgpath = __ROOT__.'/upload/links/image/';
		$this->uploadpath = ROOT_PATH.'upload/links/image/';//封面图路径
		$this->nopic='youlink.gif';//默认封面
	}
	
	public function index()
	{
		$listRows=12;//每页显示的信息条数
		$url=url('link/index',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);
		$count=model('link')->count();
		$list=model('link')->select('','id,type,name,url,picture,logourl,norder,ispass','norder DESC',$limit);

		$this->page=$this->pageShow($count);
		$this->list=$list;
		$this->path=$this->imgpath;
		$this->url=url('link');//admin/link
		$this->public=__PUBLIC__;//public文件夹
		$this->display();
	}
	
	public function add()
	{
		if(!$this->isPost()){
			$this->t_name="增加";
			$this->display("link/edit");//与编辑用同一个模板
		}else{
			if(empty($_POST['webname']))
			$this->error('请填写完整的信息~');
			$data=array();
			$data['type']=$_POST['type'];
			$data['name']=in($_POST['webname']);
			$data['url']=in($_POST['url']);
			$data['logourl']=in($_POST['logourl']);
			$data['siteowner']=in($_POST['siteowner']);
			$data['info']=in($_POST['info']);
			$data['norder']=intval(in($_POST['norder']));
			$data['ispass']=intval($_POST['ispass']);
			
			//logo上传，这里借助Kindeditor的上传功能
			if(empty($_POST['picture']))$data['picture']=$this->nopic;
			else{
				$firstpath=in($_POST['picture']);
				if(!empty($firstpath)){
					$lastlocation=strrpos($firstpath,'/');
					$timefile=substr($firstpath,$lastlocation-8,8);
					$covername=substr($firstpath,$lastlocation+1);
					if(file_exists($this->uploadpath.$timefile.'/'.$covername)){
						$data['picture']= $timefile.'/'.$covername;  //自动生成一个图片用于希望的封面图
					}else   $data['picture']=$this->nopic;
				}else   $data['picture']=$this->nopic;
			}
			
			if(model('link')->insert($data))
			$this->success('链接添加成功~',url('link/index'));
			else $this->error('链接添加失败~');
		}
	}

	//编辑
	public function edit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$info=model('link')->find("id='$id'");
			$this->info=$info;
			$this->path=$this->imgpath;
			$this->public=__PUBLICAPP__;
			$this->t_name="编辑";
			$this->display();
		}else{
			//提交修改
			if(empty($_POST['webname']))
			$this->error('请填写完整的信息~');
			$data=array();
			$data['type']=$_POST['type'];
			$data['name']=in($_POST['webname']);
			$data['url']=in($_POST['url']);
			$data['logourl']=in($_POST['logourl']);
			$data['siteowner']=in($_POST['siteowner']);
			$data['info']=in($_POST['info']);
			$data['norder']=intval(in($_POST['norder']));
			$data['ispass']=intval($_POST['ispass']);
			//logo上传，这里借助Kindeditor的上传功能
			if(empty($_POST['picture']))$data['picture']=$this->nopic;
			else{
				$firstpath=in($_POST['picture']);
				if(!empty($firstpath)){
					$lastlocation=strrpos($firstpath,'/');
					$timefile=substr($firstpath,$lastlocation-8,8);
					$covername=substr($firstpath,$lastlocation+1);
					if(file_exists($this->uploadpath.$timefile.'/'.$covername)){
						$data['picture']= $timefile.'/'.$covername;  //自动生成一个图片用于希望的封面图
					}else   $data['picture']=$this->nopic;
				}else   $data['picture']=$this->nopic;
			}
			//print_r($data['picture']);return ;
			if(model('link')->update("id='{$id}'",$data))
			$this->success('链接编辑成功~',url('link/index'));
			else $this->error('信息不需要修改~');
		}
	}

	public function del()
	{
		if(!$this->isPost()){
			//没有提交，是ajax删除
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('您没有选择~');
			$coverpic=model('link')->find("id='$id'",'picture');
			$picpath=$this->uploadpath.$coverpic[picture];//图片的物理地址
			if(file_exists($picpath)) @unlink($picpath);//删除logo图片
			if(model('link')->delete("id='$id'"))//删除记录
			echo 1;
			else echo '删除失败~';
		}else{
			//提交了，是批量删除
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			$coverpics=model('link')->select('id in ('.$delid.')','picture');//找到批量的图片
			//遍历删除
			foreach($coverpics as $vo){
				if(!empty($vo[picture])){
					$picpath=$this->uploadpath.$vo[picture];
					//删除对应的图片
					if(file_exists($picpath)) @unlink($picpath);
				}
			}
			if(model('link')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('link/index'));
		}
	}
	//审核,ajax
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['ispass']=intval($_POST['ispass']);
		if(model('link')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}

	//编辑器上传
	public function UploadJson(){
		//上传到news目录下面
		EditUploadJson('links');
	}
	
	//编辑器文件管理
	public function FileManagerJson(){
		EditFileManagerJson('links');
	}
	
}