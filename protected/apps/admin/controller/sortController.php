<?php
/*
 * 栏目管理控制器
 * 不同类型处理方法基本一样
 * */
class sortController extends commonController
{
	static public $sort=array(
	   1=>array('name'=>'文章','mark'=>'news'),
	   3=>array('name'=>'单页','mark'=>'page'),
	   5=>array('name'=>'自定义','mark'=>'link'),
	);
	//static public $templepath;//前台模板路径
	public function __construct()
	{
		parent::__construct();
	}

	//添加分类
    private function sortadd($parentid){
    	//0为顶级分类
        if($parentid==0){
			$data['path']=',000000';//path是内容定位
			$data['deep']=1;//deep=1是一级导航
		}else{
			//不是顶级分类，则为子集分类
			$parent=model('sort')->find("id='{$parentid}'",'id,path,deep');//得到父级
			$data['path']=$parent['path'].','.$parent['id'];//父级的path加父级的id得到新增的path，导航定位
			//echo $data['path'];
			$data['deep']=$parent['deep']+1;//父级的deep+1
		}
		return $data;
    }
    
    //移动栏目
    private function sortmove($newparentid,$id){
    	//if(!$this->checkConPower('sort',$id)) return "当前账户没有权限编辑{$id}~";
    	if($id==$newparentid) return "{$id}不能将自身作为上级栏目~";
    	//判断是否有子类
    	$list=model('sort')->select("path like '%{$id}%' OR id='{$id}'",'path,type','path');
    	if(!empty($list[1])) return "{$id}下有子栏目不可以移动~";
    	$where='\''.$list[0]['path'].','.$id.'\'';
    	if($newparentid==0){
    		$data['path']=',000000';
    		$data['deep']=1;
    	}else{
    		$parent=model('sort')->find("id='{$newparentid}'",'id,path,deep');
    		$data['path']=$parent['path'].','.$parent['id'];
    		$data['deep']=$parent['deep']+1;
    	}
    	if(in_array($list[0]['type'], array(1,2,3))){//修改分类下所有信息类别
    		$updata['sort']=$data['path'].','.$id;
    		model(self::$sort[$list[0]['type']]['mark'])->update('sort='.$where,$updata);
    	}
    	return $data;
    }

    //分类编辑
    private function sortedit($path,$newparentid,$id,$mark=''){
    	//$newparentid父级id
		if($id==$newparentid) $this->error('不能将自身作为父类~');
		//判断是否有子类
		$where='\''.$path.','.$id.'\'';
		if(model('sort')->find('path ='.$where))//找匹配
		$this->error('该分类下有子类不可以任意移动~');
		
		if($newparentid==0){
			//顶级分类
			$data['path']=',000000';
			$data['deep']=1;
		}else{
			//子分类
			$parent=model('sort')->find("id='{$newparentid}'",'id,path,deep');
			$data['path']=$parent['path'].','.$parent['id'];//父级的path加父级的id得到新增的path，导航定位
			$data['deep']=$parent['deep']+1;//父级的deep+1
		}
        if(!empty($mark)){
        	//修改分类下所有信息类别,因为修改了栏目的类别位置，对应$mark里面的sort的导航也要改变，更新原来的分类导航
	    	$updata['sort']=$data['path'].','.$id;
            model($mark)->update('sort='.$where,$updata);
	    }
		return $data;
    }
    
	//类别管理首页
	public function index()
	{
		$list=model('sort')->select('','id,type,name,deep,ifmenu,path,norder,method,url');//全部检索，未排序
		//无限分类方法，利用path无限定位，利用deep重排
		if(!empty($list)){
			$list=re_sort($list);//无限分类重排序，这个排序函数很复杂啊
			//print_r($list);
			foreach ($list as $key=>$vo)
			{
				//资讯类型的url格式 /yuncms/index.php?yun=default/news/index&id=100028
				$list[$key]['url']=getURL($vo['type'],$vo['method'],$vo['url'],$vo['id']);//获取菜单URL
			}
			//print_r($list);
			$this->list=$list;
		}
		//排序之后的栏目分类，一级栏目，二级栏目.....
		$this->sort=self::$sort;//调用静态成员,分类的类型
		//print_r(self::$sort);
		$this->display();
	}
	
	//新增栏目，不同的栏目
	public function add()
	{
	    $sortaction=$_GET['sortaction'];//ajax接受
	    //添加不同的栏目对应不同的函数
		  switch ($sortaction) {
		  	case 'noadd':
		  		break;
		  	case 'newsadd':
		  		$this->newsadd();
		  		break;
		  	case 'pageadd':
		  		$this->pageadd();
		  		break;
		  	case 'pluginadd':
		  		$this->pluginadd();
		  		break;
		  	case 'linkadd':
		  		$this->linkadd();
		  		break;
		  	default:
		  		$this->display();
		  		break;
		  }
	}
   
	//添加文章栏目
	public function newsadd()
	{
		$type=1;//文章类型
		
		if(!$this->isPost())
		{
			//未提交的时候显示
			$list=model('sort')->select('','id,name,deep,path,norder');//显示所有的栏目分类
			if(!empty($list)){
				$list=re_sort($list);//重排
				$this->list=$list;
			}
			
			//self::$sort[$type]['mark'] 是news
			$chooseL=$this->tempchoose(self::$sort[$type]['mark'],'index');//前台栏目模板news_开头
			$chooseC=$this->tempchoose(self::$sort[$type]['mark'],'content');//前台默认内容模板news_开头
            if(!empty($chooseL)) $this->chooseL=$chooseL;
            if(!empty($chooseC)) $this->chooseC=$chooseC;
            
			$this->md=self::$sort[$type]['mark'];//不同的类型标志  news
			$this->url=url('sort');//路径：/yuncms/index.php?yun=admin/sort
			$this->display('sort/newsadd');
		}else{
			//提交增加资讯栏目
			if(empty($_POST['sortname']) || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			$data=array();
			$parentid=intval($_POST['parentid']);//添加分类类型
			$data=$this->sortadd($parentid);//得到新增分类的deep  path!!!
			$data['type']=$type;
			$data['name']=in($_POST['sortname']);
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['url']=intval($_POST['num']);//url存储页数num
			$data['method']='news/index';//方法
			$data['tplist']=$_POST['tplist'].','.$_POST['cnlist'];//模板列表
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			//插入数据
			if(model('sort')->insert($data)){
				$this->success('文章栏目添加成功~',url('sort/index'));
			}
			else $this->error('文章栏目添加失败~');
		}
	}
	
	//编辑文章栏目
	public function newsedit()
	{
		$type=1;//文章类型
		$id=intval($_GET['id']);//栏目的id
		if(empty($id)) $this->error('空的类别参数');
		$info=model('sort')->find("id='$id'",'name,norder,path,ifmenu,url,method,tplist,keywords,description');//查询相应的参数
		$info['url']=empty($info['url'])?10:$info['url'];//10是页数，也当url用，此处是url
		//echo $info['path'];
		$oldparentid=intval(substr ($info['path'], -6));//截取出父级的id
		//echo $oldparentid;
		$tps=explode(',',$info['tplist']);//模板文件分割成数组
		//print_r($tps);
		$info['tplist']=$tps[0];//栏目模板
		$info['cnlist']=$tps[1];//内容模板
		
		if(!$this->isPost())
		{
			//没有提交就显示
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);//排序
				$this->list=$list;
			}
			//print_r($list);
			$tpdef=explode('_',$info['tplist']);//将news_index继续分割成数组
			//print_r($tpdef);
			if(empty($tpdef[1])) $tpdef[1]='index';
			
			//$chooseL是<option>无法直接打印
			// self::$sort[$type]['mark']为news $tpdef[1]为index
			$chooseL=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);//获取news_的模板，前台栏目模板
			
            if(!empty($chooseL)) $this->chooseL=$chooseL;//赋值
            
            
            $tpdef=explode('_',$info['cnlist']);//将news_content继续分割成数组
			if(empty($tpdef[1])) $tpdef[1]='content';
			// self::$sort[$type]['mark'].$tpdef[1];  news content
			$chooseC=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);//news
            if(!empty($chooseC)) $this->chooseC=$chooseC;//内容模板
            unset($tpdef);

			
			$this->id=$id;
			$this->info=$info;
			$this->md=self::$sort[$type]['mark'];
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
			
			//提交修改
			if(empty($_POST['sortname'])  || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);//当前修改栏目的父级id
			//$oldparentid父级的id
			//print_r($info);
			//self::$sort[$type]['mark']   news
			if($oldparentid!=$newparentid) $data=$this->sortedit($info['path'],$newparentid,$id,self::$sort[$type]['mark']);//分类编辑
			
			$data['name']=$_POST['sortname'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['url']=intval($_POST['num']);
			$data['tplist']=$_POST['tplist'].','.$_POST['cnlist'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);
			
			
			//更新数据
			if(model('sort')->update("id = '$id'",$data)){
				$this->success('文章栏目修改成功',url('sort/index'));
			}
			else $this->error('文章栏目没有任何修改，不需要执行');
		}
	}

	//添加单页栏目
	public function pageadd()
	{
		$type=3;//单页类型
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$choose=$this->tempchoose(self::$sort[$type]['mark'],'index');//page模板
            if(!empty($choose)) $this->choose=$choose;	

			$this->md=self::$sort[$type]['mark'];
			$this->url=url('sort');
			$this->display('sort/pageadd');
		}else{
			// print_r($_POST);exit();
			if(empty($_POST['sortname']) || empty($_POST['method'])||empty($_POST['content']) || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			$data=array();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['method']=in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
            if (empty($data['description'])) {
                   $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
                }
                 if(empty($data['keywords'])){    
                     $data['keywords']= $this->getkeyword($data['name'],$data['description']); //自动获取中文关键词 
                     if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
                 }
			$data1=array();
			if (get_magic_quotes_gpc()) {
				$data1['content'] = stripslashes($_POST['content']);
			} else {
				$data1['content'] = $_POST['content'];
			}
			$data1['edittime']=in($_POST['edittime']);
			//插入数据
			$newid=model('sort')->insert($data);
			if($newid){
				$data1['sort']=$data['path'].','.$newid;
				if(model('page')->insert($data1))
				$this->success('单页添加成功~',url('sort/index'));
			}
			else $this->error('单页添加失败~');
		}
	}
	
	//编辑单页栏目
	public function pageedit()
	{
		$type=3;//单页类型
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		$info=model('sort')->find("id='$id'",'name,norder,path,ifmenu,method,tplist,keywords,description');
		$oldparentid=intval(substr ($info['path'], -6));
		$oldsort=$info['path'].','.$id;//单页sort字段
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$tpdef=explode('_',$info['tplist']);
			if(!isset($tpdef[1])) $this->error('非法的模板参数~');
			$choose=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);
            if(!empty($choose)) $this->choose=$choose;	

			$info1=model('page')->find("sort='$oldsort'");
			$this->id=$id;
			$this->info=$info;//栏目信息
			$this->info1=$info1;//单页信息
			$this->md=self::$sort[$type]['mark'];
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
            $pageid=intval($_GET['pageid']);
		    if(empty($pageid)) $this->error('空的单页id参数');
			if(empty($_POST['sortname']) || empty($_POST['method'])||empty($_POST['content']) || empty($_POST['tplist'])) $this->error('请填写完整的栏目信息！');
			//数据处理
			$data=array();
			$data1=array();
            $newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid){
				$data=$this->sortedit($info['path'],$newparentid,$id);//分类编辑
                $data1['sort']=$data['path'].','.$id;
			}
			$data['name']=$_POST['sortname'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['method']=in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);
            if (empty($data['description'])) {
                $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
            }
            if(empty($data['keywords'])){    
                $data['keywords']= $this->getkeyword($data['name'],$data['description']); //自动获取中文关键词 
                if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
            }
			
			if (get_magic_quotes_gpc()) {
				$data1['content'] = stripslashes($_POST['content']);
			} else {
				$data1['content'] = $_POST['content'];
			}
			$data1['edittime']=in($_POST['edittime']);
			if(model('page')->update("id = '$pageid'",$data1) && model('sort')->update("id = '$id'",$data))
			$this->success('单页修改成功',url('sort/index'));
			else $this->error('单页没有任何修改，不需要执行');
		}
	}
	
	//添加应用栏目
	public function pluginadd()
	{
		$type=4;//插件类型
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
				$plugs=api(getApps(),'getdefaultMenu');//已开启的应用列表
				if(!empty($plugs)){
					$choose='<option value="">=选择已安装的应用=</option>';
				   foreach ($plugs as $vo){
					   if(!empty($vo))
					       $choose.='<option value="'.$vo['r'].'">'.$vo['name'].'</option>';
				    }
				    $this->choose=$choose;
				}

			$this->url=url('sort');
			$this->display('sort/pluginadd');
		}else{
			if(empty($_POST['sortname']) || empty($_POST['method'])) $this->error('请填写完整栏目信息！');
			$data=array();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['method']=in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			//插入数据
			if(model('sort')->insert($data)){
				$this->success('插件栏目添加成功~',url('sort/index'));
			}
			else $this->error('插件栏目添加失败~');
		}
	}

	//编辑应用栏目
	public function pluginedit()
	{
		$type=4;//插件类型
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		$info=model('sort')->find("id='$id'",'name,norder,path,ifmenu,method,tplist,keywords,description');
		$oldparentid=intval(substr ($info['path'], -6));
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
            $plugs=api(getApps(),'getdefaultMenu');//已开启的应用列表
				if(!empty($plugs)){
				   foreach ($plugs as $vo){
					   if(!empty($vo))
					   	if($vo['r']==$info['method']) $choose.='<option selected="selected" value="'.$vo['r'].'">'.$vo['name'].'</option>';
					    else $choose.='<option value="'.$vo['r'].'">'.$vo['name'].'</option>';
				    }
				    $this->choose=$choose;
				}
			$this->id=$id;
			$this->info=$info;
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
			if(empty($_POST['sortname']) || empty($_POST['method'])) $this->error('请填写完整栏目信息！');
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid) $data=$this->sortedit($info['path'],$newparentid,$id);//分类编辑

			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['method']=in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);

			
			//更新数据
			if(model('sort')->update("id = '$id'",$data)){
				$this->success('插件栏目修改成功',url('sort/index'));
			}
			else $this->error('插件栏目没有任何修改，不需要执行');
		}
	}

	 //删除栏目,批量+ajax删除
	private function _del($id){
		if(empty($id)) return '错误的ID参数~';
		//if(!$this->checkConPower('sort',$id)) return "当前账户没有权限删除{$id}~"; 
		$condition['id']=$id;
		$target=model('sort')->find($condition,'path,type');
		$where='path = \''.$target['path'].','.$id.'\'';
		if(model('sort')->find($where)) return "请先删除{$id}下的栏目~";
		//判断类下有无内容
		$table=self::$sort[$target['type']]['mark'];
		if(empty($table)) return "{$id}未知类别";
		if($table!='plugin' && $table!='link'&& $table!='extend'){//插件栏目不用做以下操作
			$info=model($table)->find('sort = \''.$target['path'].','.$id.'\'','id');
			if($info){
				$delid=$info['id'];
				if('page'!=$table) return "请先删除{$id}下的内容~";//一栏目对多信息情况
				elseif(!model($table)->delete("id='{$delid}'")) return "{$id}下内容删除失败~";
			}
		}
		if(model('sort')->delete($condition)) return 'done';
		else return "{$id}删除失败~";
	}
	
	//删除栏目
	public function del()
	{
		if($this->isPost()){
			if('del'!=$_POST['dotype']) $this->error('操作类型错误~',url('sort/index'));
			if(empty($_POST['delid'])) $this->error('还没有选择栏目~',url('sort/index'));
			$delid=array_reverse($_POST['delid']);
			$er='';
			foreach ($delid as $vo) {
				if(!empty($vo)){
					foreach ($vo as $v) {
						$back=$this->_del(intval($v));
						if('done'!=$back) $er.=$back.'<br>';
					}
				}
			}
			if($er) $this->error($er,url('sort/index'));
			else $this->success('栏目删除成功~',url('sort/index'));
		}else{//ajax方式
			$id=intval($_GET['id']);
			$back=$this->_del($id);
			if('done'==$back) echo 1;
			else echo $back;
		}
	}
	
	//批量移动栏目
	public function sortsmove()
	{
		if(!$this->isPost()) $this->error('非法操作~',url('sort/index'));
		if('move'!=$_POST['dotype']) $this->error('操作类型错误~',url('sort/index'));
		if(empty($_POST['delid'])||empty($_POST['col'])) $this->error('还没有选择栏目~',url('sort/index'));
		$delid=array_reverse($_POST['delid']);
		if('top'==$_POST['col']) $_POST['col']=0;
		$pid=intval($_POST['col']);
		$er='';
		foreach ($delid as $vo) {
			if(!empty($vo)){
				foreach ($vo as $v) {
					$v=intval($v);
					$data=$this->sortmove($pid,$v);
					if(is_array($data)) {
						model('sort')->update("id = '$v'",$data);
					}
					else $er.=$data.'<br>';
				}
			}
		}
		if($er) $this->error($er,url('sort/index'));
		else $this->success('栏目移动成功~',url('sort/index'));
	}
	
	//单页编辑器上传
	public function PageUploadJson(){
		$this->EditUploadJson('pages');
	}
	//单页编辑器文件管理
	public function PageFileManagerJson(){
		$this->EditFileManagerJson('pages');
	}
	
	//添加自定义栏目
	public function linkadd()
	{
		$type=5;//栏目类型
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$this->url=url('sort');
			$this->display('sort/linkadd');
		}else{
			if(empty($_POST['sortname'])) $this->error('请填写完整栏目信息！');
			$data=array();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['url']=$_POST['url'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			//插入数据
			if(model('sort')->insert($data)){
				$this->success('外链栏目添加成功~',url('sort/index'));
			}
			else $this->error('外链栏目添加失败~');
		}
	}
	
	//编辑自定义栏目
	public function linkedit()
	{
		$type=5;//栏目类型
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		$info=model('sort')->find("id='$id'",'name,norder,path,ifmenu,url');
		$oldparentid=intval(substr ($info['path'], -6));
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$this->id=$id;
			$this->info=$info;
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
			if(empty($_POST['sortname'])) $this->error('请填写完整栏目信息！');
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid) $data=$this->sortedit($info['path'],$newparentid,$id);//分类编辑
	
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['url']=$_POST['url'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);
	
			//更新数据
			if(model('sort')->update("id = '$id'",$data)){
				$this->success('外链栏目修改成功',url('sort/index'));
			}
			else $this->error('外链栏目没有任何修改，不需要执行');
		}
	}
	
	//隐藏,ajax
	public function ifmenu()
	{
		$id=intval($_POST['id']);
		$menu['ifmenu']=intval($_POST['ifmenu']);
		if(model('sort')->update("id='{$id}'",$menu))
			echo 1;
		else echo '操作失败~';
	}
	
}