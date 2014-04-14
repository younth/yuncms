<?php
/*
 * 企业管理控制器，企业用户登录之后管理该企业的信息
 * */
class manageController extends commonController
{
	static protected $company_sort;//公司性质
	static protected $company_scale;//公司规模
	static protected $uploadpath='';//logo,licence路径
	static protected $imagepath='';//封面图路径
	static public $nopic='';//默认封面路径
	
	public function __construct()
	{
		parent::__construct();
		$this->company_sort=100054;//公司性质100054
		$this->company_scale=100060;//公司规模100054
		$this->uploadpath=ROOT_PATH.'upload/company/license/';
		$this->imagepath=ROOT_PATH.'upload/company/image/';
		$this->nopic='NoPic.gif';//默认封面
	}
	
	//公司管理首页
      public function index()
      {
      	//判断是否登录
      	$id=$_SESSION['company_id'];
      	if(empty($id)) $this->redirect(url('default/index/login'));
      	else {
      		$re=model('company')->find("id='{$id}'");
      		//dump($re);
      		if(!empty($re['name'])&&!empty($re['quality'])&&!empty($re['scale'])&&!empty($re['introduce'])&&!empty($re['address'])){
      			//已经完善资料,更新init
      			$data['is_init']=1;
      			model('company')->update("id='{$id}'",$data);
      		}
      		if($re['is_active']==1){
      			//激活且登陆，判断是否完善信息，没有完善则提醒
      			$this->path=__ROOT__.'/upload/company/license/';//logo地址
      			$this->info=$re;
      		}
      		else  $this->error('账号未激活~',url('default/index/login'));
      	}
      	$this->display();
      	
      }
      
      //基本资料管理
      public function info()
      {
      	$id=$_SESSION['company_id'];
      	if(empty($id)) $this->error('参数错误');
      	if(!$this->isPost()){
      		//当前登陆公司的基本资料
      		$info=model('company')->find("id='{$id}'");
      		//构造公司性质，寻找某个栏目下面的全部子栏目,利用mysql 字符串函数 find_in_set(),或者利用RIGHt函数
      		//$where="type=5 AND find_in_set('100054',path)";
      		$where="type=5 AND RIGHT(path,6)=".$this->company_sort;
      		$sortlist=model('sort')->select($where,'id,name,path');
      		$sort=$info['quality'];//当前的性质
      		//dump($sortlist);
      		//循环构造公司性质select option
      		if(!empty($sortlist)){
      			foreach($sortlist as $vo){
      				$sortnow=$vo['path'].','.$vo['id'];//构造的栏目导航定位
      				$selected=($sort==$sortnow)?'selected="selected"':''; //选中当前的分类
      				$quality_option.= '<option '.$selected.' value="'.$sortnow.'">'.$vo ['name'].'</option>';
      			}
      			$this->quality_option=$quality_option;
      		}
      		unset($where);
      		unset($sortlist);
      		
      		//循环构造公司规模select option
      		$where="type=5 AND RIGHT(path,6)=".$this->company_scale;
      		$sortlist=model('sort')->select($where,'id,name,path');
      		$sort=$info['scale'];//当前的性质
      		if(!empty($sortlist)){
      			foreach($sortlist as $vo){
      				$sortnow=$vo['path'].','.$vo['id'];//构造的栏目导航定位
      				$selected=($sort==$sortnow)?'selected="selected"':''; //选中当前的分类
      				$company_scale.= '<option '.$selected.' value="'.$sortnow.'">'.$vo ['name'].'</option>';
      			}
      			$this->company_scale=$company_scale;
      		}
      		
      		//行业的选择构造
      		$this->info=$info;
      		$this->display();
      	}else {
      		//提交修改
      		$data=array();
      		$data['name']=in($_POST['name']);
      		$data['quality']=$_POST['quality'];
      		$data['scale']=$_POST['scale'];
      		$data['phone']=in($_POST['phone']);
      		$data['address']=in($_POST['address']);
      		$data['introduce'] = $_POST['introduce'];
      		$data['websites']=in($_POST['websites']);
      		$data['on_industry']=rtrim(in($_POST['on_industry']),'+');
      		//行业
      		$data['industry']=in($_POST['industry']);
      	
      		if(model('company')->update("id='$id'",$data)){
      			$this->success('企业信息编辑成功~',url('company/manage/index'));
      		}
      			
      		else $this->error('没有信息被修改 ~');
      	}
      }

      //logo上传
      public function company_logo()
      {
      	$id=$_SESSION['company_id'];
      	if(empty($id)) $this->error('参数错误');
      	$re=model('company')->find("id='{$id}'");
      	$this->info=$re;
      	
      	if(!$this->isPost()){
      		$this->path=__ROOT__.'/upload/company/license/';
      		$this->display();
      	}
      	else {
      		//上传未对大小限制
      		if (empty($_FILES['logo']['name']) === false){
      			$tfile=date("Ymd");
      			$imgupload= $this->upload($this->uploadpath.$tfile.'/',config('imgupSize'),'jpg,bmp,gif,png');
      			$imgupload->saveRule='thumb_'.time();
      			$imgupload->upload();
      			$fileinfo=$imgupload->getUploadFileInfo();
      			$errorinfo=$imgupload->getErrorMsg();
      			if(!empty($errorinfo)) $this->alert($errorinfo);
      			else{
      				if(!empty($_POST['oldheadpic'])){
      					$picpath=$this->uploadpath.$_POST['oldheadpic'];
      					if(file_exists($picpath)) @unlink($picpath);
      				}
      				$data['logo']=$tfile.'/'.$fileinfo[0]['savename'];
      			}
      			if(model('company')->update("id='{$id}'",$data)) $this->success('上传logo成功~');
      		}else $this->error('未选择logo图片~');
      		
      	}
      	
      	
      	
      }

      //营业执照,上传营业执照副本
      public function company_auth()
      {
      	$id=$_SESSION['company_id'];
      	if(empty($id)) $this->error('参数错误');
      	$re=model('company')->find("id='{$id}'");
      	$this->info=$re;
      	 
      	if(!$this->isPost()){
      		$this->path=__ROOT__.'/upload/company/license/';
      		$this->display();
      	}
      	else {
      		//上传未对大小限制
      		if (empty($_FILES['license']['name']) === false){
      			$tfile=date("Ymd");
      			$imgupload= $this->upload($this->uploadpath.$tfile.'/',config('imgupSize'),'jpg,bmp,gif,png');
      			$imgupload->saveRule='thumb_'.time();
      			$imgupload->upload();
      			$fileinfo=$imgupload->getUploadFileInfo();
      			$errorinfo=$imgupload->getErrorMsg();
      			if(!empty($errorinfo)) $this->alert($errorinfo);
      			else{
      				if(!empty($_POST['oldheadpic'])){
      					$picpath=$this->uploadpath.$_POST['oldheadpic'];
      					if(file_exists($picpath)) @unlink($picpath);
      				}
      				$data['license']=$tfile.'/'.$fileinfo[0]['savename'];
      			}
      			if(model('company')->update("id='{$id}'",$data)) $this->success('上传logo成功~');
      		}else $this->error('未选择logo图片~');
      	}
      }

	//密码修改
	public function modifypassword()
	{
		if(!$this->isPost()){
			$this->display();
		}else{
			if($_POST['password']!=$_POST['surepassword']) $this->error('确认密码与新密码不符~');
			$id=$_SESSION['company_id'];
			$info=model('company')->find("id='{$id}'",'password');
			$oldpassword=codepwd($_POST['oldpassword']);
			if($oldpassword!=$info['password']) $this->error('旧密码不正确~');
			 
			$data['password']=codepwd($_POST['password']);
			model('company')->update("id='{$id}'",$data);
			$this->success('密码修改成功~',url('company/manage/index'));
		}
		
	}
	
	//企业粉丝,显示企业的粉丝
	public function fans()
	{
		$id=$_SESSION['company_id'];
		$fans=model('company_fans')->fanscount($id);//粉丝总数
	}
	
	//企业发布动态，新闻
	public function pubnews()
	{
		$id=$_SESSION['company_id'];
		if(!$this->isPost()){
			$this->t_name="添加";
			$this->display();
		}else{
			if(empty($_POST['title'])||empty($_POST['content']))
				$this->error('请填写完整的信息~');
			$data=array();
			$data['account']=$_SESSION['name'];//发布者，读取session，插入到account字段
			$data['title']=in($_POST['title']);
			$data['sort']='company_news';//企业动态
			//新闻内容进行处理
			if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes($_POST['content']);
			} else {
				$data['content'] = $_POST['content'];
			}
			//封面图，如何确定上传路径，封面图上传需借助其他插件,图片存储的路径需要改变
			if(empty($_POST['picture']))$data['picture']=$this->nopic;
			else {
				//对上传的图片路径进行截取，也可用于抓取新闻内容的第一张图片
				$firstpath=in($_POST['picture']);
				if(!empty($firstpath)){
					$lastlocation=strrpos($firstpath,'/');
					$timefile=substr($firstpath,$lastlocation-8,8);
					$covername=substr($firstpath,$lastlocation+1);
					if(file_exists($this->imagepath.$timefile.'/'.$covername)){
						@copy($this->imagepath.$timefile.'/'.$covername, $this->imagepath.$timefile.'/thumb_'.$covername);//复制第一张图片为缩略图
						//删除原上传的图
						unlink($this->imagepath.$timefile.'/'.$covername);
						$data['picture']= $timefile.'/thumb_'.$covername;  //自动生成一个图片用于希望的封面图
					}
					else   $data['picture']=$this->nopic;
				}else   $data['picture']=$this->nopic;
			}
			//dump($data);
			if(model('news')->insert($data))
			$this->success('动态添加成功~',url('manage/index'));
			else $this->error('动态添加失败');
		}
	}

	//企业动态管理
	public function corbnews()
	{
		$listRows=12;//每页显示的信息条数
		$url=url('manage/corbnews',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);
	    $account=$_SESSION['name'];
	    $where="account='{$account}' AND sort='company_news'";
		$count=model('news')->count($where);
		$list=model('news')->select($where,'id,sort,account,title,picture,addtime','norder DESC',$limit);

		$this->page=$this->pageShow($count);
		$this->list=$list;
		$this->path=$this->imgpath;
		$this->url=url('link');//admin/link
		$this->public=__PUBLIC__;//public文件夹
		$this->display();
	}
	
	//编辑动态
	public function editnews()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$info=model('news')->find("id='$id'");//当前新闻的相关信息
			$this->info=$info;
			$this->path=__ROOT__.'/upload/company/image/';
			$this->public=__PUBLIC__."/admin";
			$this->t_name="编辑";
			$this->display("manage/pubnews");
		}else{
			if(empty($_POST['content'])||empty($_POST['title']))
				$this->error('请填写完整的信息~');
			$data=array();
		$data['account']=$_SESSION['name'];//发布者，读取session，插入到account字段
			$data['title']=in($_POST['title']);
			//新闻内容进行处理
			if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes($_POST['content']);
			} else {
				$data['content'] = $_POST['content'];
			}
			//封面图，如何确定上传路径，封面图上传需借助其他插件,图片存储的路径需要改变
			if(empty($_POST['picture']))$data['picture']=$this->nopic;
			else {
				//对上传的图片路径进行截取，也可用于抓取新闻内容的第一张图片
				$firstpath=in($_POST['picture']);
				if(!empty($firstpath)){
					$lastlocation=strrpos($firstpath,'/');
					$timefile=substr($firstpath,$lastlocation-8,8);
					$covername=substr($firstpath,$lastlocation+1);
					if(file_exists($this->imagepath.$timefile.'/'.$covername)){
						@copy($this->imagepath.$timefile.'/'.$covername, $this->imagepath.$timefile.'/thumb_'.$covername);//复制第一张图片为缩略图
						//删除原上传的图
						unlink($this->imagepath.$timefile.'/'.$covername);
						$data['picture']= $timefile.'/thumb_'.$covername;  //自动生成一个图片用于希望的封面图
					}
					else   $data['picture']=$this->nopic;
				}else   $data['picture']=$this->nopic;
			}
			if(model('news')->update("id='$id'",$data))
				$this->success('动态编辑成功~',url('manage/index'));
			else $this->error('没有动态被修改 ~');
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