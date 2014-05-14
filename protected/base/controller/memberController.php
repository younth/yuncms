<?php
/*
 * 会员模块的基类，因为系统的前台需要调用，所以作为base基类
 * */
class memberController extends baseController{
  protected $auth=array();//auth是用户信息的数组
	
	public function __construct()
	{
    parent::__construct(); 
    @session_start();//开启session
    $this->NewImgPath=__ROOT__.'/upload/news/image/';
    $this->LinkImgPath=__ROOT__.'/upload/links/';
    
    //前台直接使用config
    $this->title=config('sitename');
    $this->keywords=config('keywords');
    $this->description=config('description');
    $this->tel=config('telephone');
    $this->icp=config('icp');
    $this->email=config('email');
    $this->address=config('address');
    $this->ver_name=config('ver_name');
    $this->copyright=config('copyright');
    $this->beian=config('beian');
    $this->tongji=config('tongji');
    $this->sorts=$this->sortArray();//树状菜单
    //dump($this->sorts);
    require(ROOT_PATH.'/avatar/AvatarUploader.class.php');
    $uid=$_SESSION['uid'];
    $au = new AvatarUploader();
    $urlAvatarBig = $au->getAvatar($uid,'big');
    $urlAvatarMiddle = $au->getAvatar($uid,'middle');
    $urlAvatarSmall = $au->getAvatar($uid,'small');
    $this->small_photo=$urlAvatarSmall;
    $this->middle_photo=$urlAvatarMiddle;
    $this->big_photo=$urlAvatarBig;
    
    //自定义标签加载添加，调用base/extend/function.php中getlist函数
    $this->view()->addTags(array(
    		"/{(\S+):{(.*)}}/i"=>"<?php $$1=getlist(\"$2\"); $$1_i=0; if(!empty($$1)) foreach($$1 as $$1){  $$1_i++; ?> ",
    		"/{\/([a-zA-Z_]+)}/i"=> "<?php } ?>",
    		"/\[([a-zA-Z_]+)\:\i\]/i"=>"<?php echo \$$1_i ?>",
    		"/\#\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\#/i"=>'".\$$1[\'$2\']."',
    		"/\#\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\#/i"=> '".\$$1[\'$2\']."',
    		"/\#\\$(\S+)\#/i"=>'".$$1."',
    		"/\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]/i"=>"<?php echo \$$1['$2'] ?>",
    		"/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$len\=([0-9]+)\]/i"=>"<?php echo msubstr(\$$1['$2'],0,$3); ?>",
    		"/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$elen\=([0-9]+)\]/i"=>"<?php echo substr(\$$1['$2'],0,$3); ?>",
    		"/{piece:([a-zA-Z_]+)}/i"=> "<?php \$cpTemplate->display(model('fragment')->fragment($1),false,false); ?>"
    ),true);
    
    	//powerCheck，返回1没有权限，返回2未登陆有权限，返回数组登陆有权限
		$power=api('member','powerCheck');//加载member模块的powerCheck方法，获得登陆会员的相关信息
    switch ($power) {
      case false:
      	//会员应用没有开启
        $this->assign('memberoff',true);
        break;
      case 1://没有权限访问
      	//$_SERVER['HTTP_REFERER'] 获取当前链接的上一个连接的来源地址  起到防盗链作用
        $this->error('您没有登陆或是权限不够进入~',$_SERVER['HTTP_REFERER']);
		//跳转到登录的页面
        break;
      case 2://游客没有权限访问
      	//$this->error('您没有登陆或是权限不够进入~',$_SERVER['HTTP_REFERER']);
        break;
      default://会员信息数组,会员有权限访问
        $this->auth=$power;//auth是用户信息的数组,
        //print_r($power);
        $this->assign('auth',$power);//auth的默认值是3,auth传到模板
        break;
    	}
	}
	
	//返回无限分类数组
	protected  function  sortArray($type=0,$deep=0,$path='')
	{
		$where="";
		if($type) $where.="type='{$type}' ";
		if($deep) $where.=empty($where)?"deep='{$deep}' ":" AND deep='{$deep}'";
		if(!empty($path)) $where.=empty($where)?"path LIKE '{$path}%'":" AND path LIKE '{$path}%'";
		$list=model('sort')->select($where,'id,deep,name,path,norder,method,url,type,ifmenu');
		if(!empty($list)) $list=re_sort($list);
		$newList=array();
		if(!empty($list)){
			foreach ($list as $vo)
			{
				$next=current($list);
				next($list);
				$newList[$vo['id']]['name']=$vo['name'];
				if(!empty($vo['picture'])){
					if($vo['picture']!='NoPic.gif'){
						switch ($vo['type']) {
							case 1:
								$newList[$vo['id']]['picture']=$this->NewImgPath.$vo['picture'];
								break;
							case 2:
								$newList[$vo['id']]['picture']=$this->PhotoImgPath.$vo['picture'];
								break;
							case 3:
								$newList[$vo['id']]['picture']=$this->PageImgPath.$vo['picture'];
								break;
						}
					}else $newList[$vo['id']]['picture']=__UPLOAD__.'/NoPic.gif';
				}
				$newList[$vo['id']]['pid']=substr($vo['path'],strrpos($vo['path'],",")+1);
				$newList[$vo['id']]['type']=$vo['type'];
				$newList[$vo['id']]['path']=$vo['path'].','.$vo['id'];
				$newList[$vo['id']]['deep']=$vo['deep'];
				$newList[$vo['id']]['method']=$vo['method'];
				$newList[$vo['id']]['ifmenu']=$vo['ifmenu'];
				$newList[$vo['id']]['nextdeep']=$next['deep'];
				$newList[$vo['id']]['url']=getURl($vo['type'],$vo['method'],$vo['url'],$vo['id'],$vo['extendid']);
			}
		}
		return $newList;
	}
	
	//文件上传方法
   protected function _upload($upload_dir)
    {
                        
			$upload = new UploadFile();
			//设置上传文件大小
			$upload->maxSize=1024*1024*2;//最大2M
			//设置上传文件类型
			$upload->allowExts  = explode(',','jpg,gif,png,bmp');
			//设置附件上传目录
			$upload->savePath ='../images/'.$upload_dir."/";
			$upload->saveRule = cp_uniqid;
                        // 使用对上传图片进行缩略图处理     
                       $upload->thumb   =  TRUE;     
                        // 缩略图最大宽度  
                        $upload->thumbMaxWidth=240;    
                        // 缩略图最大高度   
                         $upload->thumbMaxHeight=2000;     
                        // 缩略图前缀     
                        $upload->thumbPrefix   =  'thumb_';     
                        $upload->thumbSuffix  =  '';    
                        // 缩略图保存路径     
                        $upload->thumbPath = '';     
                        // 缩略图文件名 
                        
                        $upload->savePath=$upload_dir;
                        
                        $upload->saveRule=rand(100, 999).time();
	
			if(!$upload->upload())
			 {
				//捕获上传异常
				$this->error($upload->getErrorMsg());
			}
			else 
			{
				//取得成功上传的文件信息
				return $upload->getUploadFileInfo();
			}
	}

	//图片上传方法
	protected function _uploadpic($upload_dir)
	{
		$upload = new UploadFile();
		//设置上传文件大小
		$upload->maxSize=1024*1024*2;//最大2M
		//设置上传文件类型
		$upload->allowExts  = explode(',','jpg,gif,png,bmp');
		//设置附件上传目录
		$upload->savePath ='../images/'.$upload_dir."/";
		//没有自动创建
		$upload->saveRule = cp_uniqid;
		if(!$upload->upload())
		{
			//捕获上传异常
			$this->error($upload->getErrorMsg());
		}
		else
		{
			//取得成功上传的文件信息
			return $upload->getUploadFileInfo();
		}
	}
}