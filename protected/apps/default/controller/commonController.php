<?php
/*
 * 前台模板处理公共控制器类,每个控制器都需要用到
 * */
class commonController extends memberController {
	protected $layout = 'layout';//layout是基本页面布局
	
	public function __construct()
	{
		parent::__construct();//先继承父类的construct，需要判断会员权限信息     		
		$this->NewImgPath=__ROOT__.'/upload/news/image/';
		$this->PhotoImgPath=__ROOT__.'/upload/photos/';
		$this->LinkImgPath=__ROOT__.'/upload/links/';
		
		$this->sorts=$this->sortArray();//树状菜单
		//print_r($this->sortArray());
		$this->title=config('sitename');
		$this->keywords=config('keywords');
		$this->description=config('description');
		$this->telephone=config('telephone');
		$this->QQ=config('QQ');
		$this->email=config('email');
		$this->address=config('address');
		$this->ver_name=config('ver_name');
		$this->copyright=config('copyright');
		
		//自定义标签加载添加，调用cp/lib/common.function.php中getlist函数
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
	}

	//获得根节点
    protected function getrootid($id){
        $id=in($id); 
        $rootpath=model('sort')->find("id='{$id}'",'path');
        $rootid= empty($rootpath['path'])? '': substr($rootpath['path'].','.$id, 8, 6);
        return $rootid;
    }
	
    //返回无限分类数组,与后台的栏目处理比较
	protected  function  sortArray($type=0,$deep=0,$path='')
	{
		$where="";
		if($type) $where.="type='{$type}' ";
		if($deep) $where.=empty($where)?"deep='{$deep}' ":" AND deep='{$deep}'";
		if(!empty($path)) $where.=empty($where)?"path LIKE '{$path}%'":" AND path LIKE '{$path}%'";
		//上面都是查询的条件
		$list=model('sort')->select($where,'id,deep,name,path,norder,method,url,type,ifmenu');
		if(!empty($list)) $list=re_sort($list);//重排
		$newList=array();
		if(!empty($list)){
			foreach ($list as $vo)
			{
				$next=current($list);//current() 函数返回数组中的当前元素
				//print_r($next)."<br>";
				next($list);//next() 函数把指向当前元素的指针移动到下一个元素的位置，并返回当前元素的值
				$newList[$vo['id']]['name']=$vo['name'];
				$newList[$vo['id']]['path']=$vo['path'].','.$vo['id'];
				$newList[$vo['id']]['deep']=$vo['deep'];
				$newList[$vo['id']]['method']=$vo['method'];
				$newList[$vo['id']]['ifmenu']=$vo['ifmenu'];
				$newList[$vo['id']]['nextdeep']=$next['deep'];
				//echo $vo['type']."<br>";
				//获取url地址
				$newList[$vo['id']]['url']=getURl($vo['type'],$vo['method'],$vo['url'],$vo['id']);
			}
		}
		return $newList;
	}
	
	//面包屑导航
	protected  function  crumbs($path=',000000')
	{
		$crumb=array();
		if(strlen($path)>7){
			$ids=substr($path,8);
			$crumb=model('sort')->select("id IN($ids)",'id,type,name,method,url','deep');
			foreach ($crumb as $key=>$vo){
				$crumb[$key]['url']=getURl($vo['type'],$vo['method'],$vo['url'],$vo['id']);
			}
		}
		return $crumb;
	}
	
	//文件上传
	protected  function  upload($savePath='',$maxSize='',$allowExts='',$allowTypes='',$saveRule='')
	{
		$upload=new UploadFile($savePath,$maxSize,$allowExts,$allowTypes,$saveRule);
		return $upload;
	}
}
?>