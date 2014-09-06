<?php
/*
 * admin模块 公共控制器类
 * */
class commonController extends baseController{

	//初始化，判断登陆与权限
	public function __construct()
	{
		parent::__construct();
		$this->ht_name=config('ht_name');//系统名称
		$sid=session_id();
        if(empty($sid) && !empty($_GET['phpsessid'])) session_id($_GET['phpsessid']);//通过GET方法传递sessionid
       // @session_start();//开启session
       	session_starts();
		//登录与权限验证
		$config['AUTH_LOGIN_URL']=url('admin/index/login');//没有登录的时候调用
		$config['AUTH_LOGIN_NO']=array('index'=> array('login','logout','verify'),'common'=>'*');//不需要认证的模块，则放行
		$config['AUTH_POWER_CACHE']=false;
		Auth::check($config);//登陆和权限检查
		//dump($_SESSION);
	}

	//密码加密，高度md5加密
	protected  function newpwd($password)
	{
		return md5(substr(md5($password),7,-9));
	}

	//文件上传
	protected  function  upload($savePath='',$maxSize='',$allowExts='',$allowTypes='',$saveRule='')
	{
		$upload=new UploadFile($savePath,$maxSize,$allowExts,$allowTypes,$saveRule);
		return $upload;
	}

	//获取app模版下全部模版
    protected function temps($appname='default'){
        $config=require(BASE_PATH.'apps/'.$appname.'/config.php');
		if(empty($config['TPL']['TPL_TEMPLATE_PATH'])) $templepath=BASE_PATH.'apps/'.$appname.'/view/news';
		else $templepath=BASE_PATH.'apps/'.$appname.'/view/'.$config['TPL']['TPL_TEMPLATE_PATH'].'/news';
		if(is_dir($templepath)){
				$temps=getFileName($templepath.'/');//前台模板列表
                if(empty($temps)) $this->error('前台模板文件夹为空~');
               $temple=array();
				foreach ($temps as $vo){
					  $tp=substr($vo['name'],0,strrpos($vo['name'],config('TPL_TEMPLATE_SUFFIX')));
    				  if(!empty($tp)){
					  	$tps=explode('_',$tp);
					  if(isset($tps[1])) $temple[$tps[0]][]=$tps[1];
					  }
				}
		}else $this->error('前台模板文件夹不存在~');
		return $temple;
	}
    //自定义资讯模板选择,待完成
    protected function choosetpl($appname='default'){
        $config=require(BASE_PATH.'apps/'.$appname.'/config.php');
        $templepath=BASE_PATH.'apps/'.$appname.'/view/'.$config['TPL']['TPL_TEMPLATE_PATH'].'/news';
        if(is_dir($templepath)){
            $temps=getFileName($templepath.'/showtpl');//前台模板列表
        }

    }
	//信息添加，编辑时获得模板选项
    protected function tempchoose($mark='index',$default='index'){
         $temparray=$this->temps();//获取app模版下全部模版
         if(empty($temparray[$mark])) return null;
         $choose='';
         	foreach ($temparray[$mark] as $vo) {
         		$select='';
         		if($vo==$default) //默认模板
         		   $select='selected="selected"';//当前的模板选中
                $choose.='<option '.$select.' value="'.$mark.'_'.$vo.'">'.$mark.'_'.$vo.'</option>';
         	}
         return $choose;
    }



    //获取keywords
    protected function getkeyword($content='')
    {
        if(!empty($content)){
        	$segment = new Segment();
            $key=$segment->get_keyword(iconv('utf-8','gbk',$content));
            $tag=iconv('gbk','utf-8',str_replace(" ", ",", $key));
            return $tag;
        }
        return '';
    }

    //编辑器获得第一张图
    protected function onepic($content)
    {
        $ext = 'gif|jpg|jpeg|bmp|png';
        preg_match("/(href|src)=([\"|']?)([^ \"'>]+\.($ext))\\2/i",html_out($content), $matches); 
        return $matches[3];
    }

    /*******编辑文件处理开始*******/
	public $order;//编辑器文件管理排序
	
	//编辑器上传
	
	//编辑器文件上传出错提示
	protected  function AlertJson($msg) {
		$json = new ServicesJson();
		echo $json->encode(array('error' => 1, 'message' => $msg));
		exit;
	}


	//编辑器文件管理排序函数
	protected function EditSort($a, $b){
		global $order;
		if ($a['is_dir'] && !$b['is_dir']) {
			return -1;
		} else if (!$a['is_dir'] && $b['is_dir']) {
			return 1;
		} else {
			if ($order == 'size') {
				if ($a['filesize'] > $b['filesize']) {
					return 1;
				} else if ($a['filesize'] < $b['filesize']) {
					return -1;
				} else {
					return 0;
				}
			} else if ($order == 'type') {
				return strcmp($a['filetype'], $b['filetype']);
			} else {
				return strcmp($a['filename'], $b['filename']);
			}
		}
	}
	/*******编辑文件处理结束*******/

	//图片批量上传,ajax方式使用
	protected function AjaxUpload($filename,$ifthumb=false,$thumbtype=1,$thumbMaxwidth,$thumbMaxheight)
	{
		$path=ROOT_PATH.'upload/'.$filename.'/';
		$upload = $this->upload($path,config('imgupSize'),'jpg,bmp,gif,png');
		$upload->saveRule = date('ymdhis').mt_rand(); //命名规范
		$upload->thumb = $ifthumb; //缩略图开关
		$upload->thumbType=$thumbtype;
		$upload->thumbMaxWidth = empty($thumbMaxwidth)?config('thumbMaxwidth'):$thumbMaxwidth; // 缩略图最大宽度
		$upload->thumbMaxHeight = empty($thumbMaxheight)?config('thumbMaxheight'):$thumbMaxheight; // 缩略图最大高度
		$upload->upload(); //上传
		$info = $upload->getUploadFileInfo(); //返回信息 Array ( [0] => Array ( [name] => 未命名.jpg [type] => image/pjpeg [size] => 53241 [key] => Filedata [extension] => jpg [savepath] => ../../../upload/2011-12-17/ [savename] => 1112170727041127335395.jpg ) )
		if (empty($info)) return;
		// 输出
		if(config('ifwatermark'))//是否加水印
		{
			$Image = new Image();
			$tp = $info[0]['savepath'].$info[0]['savename']; //原图
			$logo = ROOT_PATH.'public/watermark/'.config('watermarkImg');//水印图
			$Image->water($tp,$logo,config('watermarkPlace')); //执行
		}
		echo $info[0]['savename'];
	}
}