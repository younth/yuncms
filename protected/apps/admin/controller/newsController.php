<?php
class newsController extends commonController
{
	static protected $sorttype;//资讯分类，为1,代表news
	static protected $uploadpath='';//封面图路径
    static public $nopic='';//默认封面路径
	public function __construct()
	{
		parent::__construct();
		$this->uploadpath=ROOT_PATH.'upload/news/image/';//封面图路径
        $this->nopic='NoPic.gif';//默认封面
		$this->sorttype=1;//1是资讯类型
	}
	
	//列表
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('news/index',array('page'=>'{page}'));
		//检索时候添加条件，只检索新闻栏目
		$where="type=".$this->sorttype;
		$sortlist=model('sort')->select($where,'id,name,deep,path,norder,type');
		$sort=in(urldecode($_GET['sort']));//当前类别定位
		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);//无限分类重排序
			$sortname=array();
			//循环生成栏目选项
			foreach($sortlist as $vo){
                $space = str_repeat('├┈', $vo['deep']-1);//str_repeat指定字符串重复的次数，重复deep-1次，二级栏目就一个，三级两个
                
                $sortnow=$vo['path'].','.$vo['id'];//构造的栏目导航定位
               // echo $sortnow."<br>";
                $selected=($sort==$sortnow)?'selected="selected"':''; //选中当前的分类
               //echo   $vo['type']."<br>";
                //构造option,也可以在模板里面构造
                $option.= '<option '.$selected.' value="'.$sortnow.'">'.$space.$vo ['name'].'</option>';
                $sortname[$vo['id']]=$vo['name'];//分类的id=>分类名
            }
          	//print_r($sortname);
            $this->option=$option;
            $this->sortname=$sortname;
		}
		
		//下面是select下拉检索显示
		if($sort){
			//分页显示当前栏目下,分页处理在下边
			$url=url('news/index',array('sort'=>$sort,'page'=>'{page}'));
			//echo $url;
			$this->sort=$sort;
		}
		//关键字搜索
		$keyword=in(urldecode(trim($_GET['keyword'])));
		if(!empty($keyword)) $this->keyword=$keyword;
		$starttime=strtotime(in($_GET['starttime']));
		$endtime=strtotime(in($_GET['endtime']));
		
		$limit=$this->pageLimit($url,$listRows);
		$count=model('news')->newscount($sort,$keyword,$starttime,$endtime);//总条数要结合sort及keyword查询
        $list=model('news')->newsANDadmin($sort,$keyword,$starttime,$endtime,$limit);//news联合admin查询

		$this->list=$list;//分类的检索结果
		$this->count=$count;
		$this->path=__ROOT__.'/upload/news/image/';
		$this->public=__PUBLICAPP__;
		$this->page=$this->pageShow($count);
		$this->display();
	}

	//添加
	public function add()
	{
		if(!$this->isPost()){
			$where="type=".$this->sorttype;
			$sortlist=model('sort')->select($where,'id,name,deep,tplist,path,norder,type');
			$sort=in(urldecode($_GET['sort']));//当前类别定位
		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);//无限分类重排序
			$sortname=array();
			//循环生成栏目选项
			foreach($sortlist as $vo){
				$space = str_repeat('├┈', $vo['deep']-1);//str_repeat指定字符串重复的次数，重复deep-1次，二级栏目就一个，三级两个
		
				$sortnow=$vo['path'].','.$vo['id'];//构造的栏目导航定位
				// echo $sortnow."<br>";
				$selected=($sort==$sortnow)?'selected="selected"':''; //选中当前的分类
				//echo   $vo['type']."<br>";
				//构造option,也可以在模板里面构造
				$option.= '<option '.$selected.' value="'.$sortnow.'">'.$space.$vo ['name'].'</option>';
			}
			//print_r($sortname);
			$this->option=$option;
		}			
		
			if(empty($sortlist))  $this->error('请先添加文章栏目~',url('sort/newsadd'));
			
			foreach ($sortlist as $vo) {
				$ct=explode(',',$vo['tplist']);
				$tpco[$vo['path'].','.$vo['id']]=$ct[1];
			}
			//print_r($tpco);
			$this->tpc=json_encode($tpco);//默认模板处理
			$choose=$this->tempchoose('news','content');
            if(!empty($choose)) $this->choose=$choose;
			
			$places=model('place')->select('','','norder DESC');//内容定位
			$this->places=$places;
			$this->t_name="添加";
			$this->display();
		}else{
			//提交增加
			if(empty($_POST['sort'])||empty($_POST['title'])||empty($_POST['content']))
			$this->error('请填写完整的信息~');
			$data=array();
			
			$data['places']=empty($_POST['places'])?'':implode(',',$_POST['places']);//内容定位
			$data['account']=$_SESSION['admin_username'];//发布者，读取session，插入到account字段
			$data['sort']=$_POST['sort'];
			$data['title']=in($_POST['title']);
			$data['color']=$_POST['color'];
			$data['origin']=empty($_POST['origin'])?'原创':in($_POST['origin']);//新闻来源，为空则默认原创
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			//新闻内容进行处理
			if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes($_POST['content']);
			} else {
				$data['content'] = $_POST['content'];
			}
			
			$data['method']=in($_POST['method']);
			$data['tpcontent']=in($_POST['tpcontent']);
			$data['ispass']=empty($_POST['ispass'])?0:1;
			$data['recmd']=empty($_POST['recmd'])?0:1;
			$data['hits']=intval(in($_POST['hits']));
			$data['norder']=intval(in($_POST['norder']));
			$data['addtime']=strtotime(in($_POST['addtime']));
			//seo描述
            if (empty($data['description'])) {
                $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述 
            }
           //关键字
            if(empty($data['keywords'])){    
                $data['keywords']= $this->getkeyword($data['title'].$data['description']); //自动获取中文关键词 
                if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
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
                    if(file_exists($this->uploadpath.$timefile.'/'.$covername)){
                        @copy($this->uploadpath.$timefile.'/'.$covername, $this->uploadpath.$timefile.'/thumb_'.$covername);//复制第一张图片为缩略图
                        //删除原上传的图
                        unlink($this->uploadpath.$timefile.'/'.$covername);
                         $data['picture']= $timefile.'/thumb_'.$covername;  //自动生成一个图片用于希望的封面图
                    } 
                    else   $data['picture']=$this->nopic;  
                }else   $data['picture']=$this->nopic;       
             }
             
			if(model('news')->insert($data))
			$this->success('资讯添加成功~',url('news/index'));
			else $this->error('资讯添加失败');
		}
	}

	//编辑新闻
	public function edit()
	{
		$id=intval($_GET['id']);
		$info=model('news')->find("id='$id'");//当前新闻的相关信息
		if(empty($id)) $this->error('参数错误');
		/****上面的信息修改及查看公用***/
		if(!$this->isPost()){
			//未提交
			$where="type=".$this->sorttype;
			$sortlist=model('sort')->select($where,'id,name,deep,path,norder,type');
			if(empty($sortlist)) $this->error('资讯分类被清空了');
			//当前的类别
			$sort=$info['sort'];
			if(!empty($sortlist)){
				$sortlist=re_sort($sortlist);//无限分类重排序
				$sortname=array();
				//循环生成栏目选项
				foreach($sortlist as $vo){
					$space = str_repeat('├┈', $vo['deep']-1);//str_repeat指定字符串重复的次数，重复deep-1次，二级栏目就一个，三级两个
			
					$sortnow=$vo['path'].','.$vo['id'];//构造的栏目导航定位
					// echo $sortnow."<br>";
					$selected=($sort==$sortnow)?'selected="selected"':''; //选中当前的分类
					//echo   $vo['type']."<br>";
					//构造option,也可以在模板里面构造
					$option.= '<option '.$selected.' value="'.$sortnow.'">'.$space.$vo ['name'].'</option>';
				}
				$this->option=$option;
			}			
	
			$info['addtime']=date("Y-m-d H:i:s",$info['addtime']);
			$tpdef=explode('_',$info['tpcontent']);//模板分隔
			//echo $tpdef[1];  content
			if(!isset($tpdef[1])) $this->error('非法的模板参数~');
			$choose=$this->tempchoose('news',$tpdef[1]);//选择前天模板
            if(!empty($choose)) $this->choose=$choose;	

            $places=model('place')->select('','','norder DESC');//定位
			$this->places=$places;
			$this->info=$info;
			$this->path=__ROOT__.'/upload/news/image/';
			$this->public=__PUBLICAPP__;
			$this->t_name="编辑";
			$this->display("news/add");//与编辑用同一个模板
		}else{
			if(empty($_POST['sort'])||empty($_POST['title']))
			$this->error('请填写完整的信息~');
			$data=array();
			//$data['account']=$_SESSION['admin_username'];
			$data['places']=empty($_POST['places'])?'':implode(',',$_POST['places']);
			$data['sort']=$_POST['sort'];
			$data['title']=in($_POST['title']);
			$data['color']=$_POST['color'];
			$data['origin']=empty($_POST['origin'])?'原创':in($_POST['origin']);
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			//内容处理
			if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes($_POST['content']);
			} else {
				$data['content'] = $_POST['content'];
			}
			$data['method']=in($_POST['method']);
			$data['tpcontent']=in($_POST['tpcontent']);
			$data['ispass']=empty($_POST['ispass'])?0:1;
			$data['recmd']=empty($_POST['recmd'])?0:1;
			$data['hits']=intval(in($_POST['hits']));
			$data['norder']=intval(in($_POST['norder']));
			$data['addtime']=strtotime(in($_POST['addtime']));
            if (empty($data['description'])) {
                $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
            }
            if(empty($data['keywords'])){    
                $data['keywords']= $this->getkeyword($data['title'].$data['description']); //自动获取中文关键词 
                if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
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
             		if(file_exists($this->uploadpath.$timefile.'/'.$covername)){
             			@copy($this->uploadpath.$timefile.'/'.$covername, $this->uploadpath.$timefile.'/thumb_'.$covername);//复制第一张图片为缩略图
             			//删除原上传的图
             			unlink($this->uploadpath.$timefile.'/'.$covername);
             			$data['picture']= $timefile.'/thumb_'.$covername;  //自动生成一个图片用于希望的封面图
             		}
             		else   $data['picture']=$this->nopic;
             	}else   $data['picture']=$this->nopic;
             }           
             
			if(model('news')->update("id='$id'",$data))
			$this->success('资讯编辑成功~',url('news/index'));
			else $this->error('没有信息被修改 ~');
		}
	}

	//删除
	public function del()
	{
		if(!$this->isPost()){
			//未提交,ajax删除
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('您没有选择~');
			$info=model('news')->find("id='$id'",'sort,picture');

			$sortid=substr($info['sort'],-6,6);
			
			if(!empty($info['picture']) && 'NoPic.gif'!=$info['picture']){//图片非空且不是默认图片
				//删除文章对应 图片
				$picpath=$this->uploadpath.$info[picture];
				if(file_exists($picpath)) @unlink($picpath);
			}
			if(model('news')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			//批量删除
			if('del'!=$_POST['dotype']) $this->error('操作类型错误~');
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);//分隔数组
			$list=model('news')->select('id in ('.$delid.')','sort,picture');
			
			foreach($list as $vo){
				//删除对应tup
				if(!empty($vo['picture']) && 'NoPic.gif'!=$vo['picture']){
					$picpath=$this->uploadpath.$vo[picture];
					if(file_exists($picpath)) @unlink($picpath);
				}
			}
			if(model('news')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('news/index'));
		}
	}
	
	//栏目移动
	public function colchange()
	{
		 if('change'!=$_POST['dotype']) $this->error('操作类型错误~');
         if(empty($_POST['delid'])||empty($_POST['col'])) $this->error('您没有选择~');
         //批量栏目移动
		 $changeid=implode(',',$_POST['delid']);
		 $data['sort']=$_POST['col'];//改变sort为提交过来的sort定位
		 if(model('news')->update('id in ('.$changeid.')',$data)) $this->success('栏目移动成功~',url('news/index'));
		 else $this->error('栏目移动失败~');
	}

	//审核,ajax返回
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['ispass']=intval($_POST['ispass']);
		if(model('news')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}

	//推荐，ajax
	public function recmd()
	{
		$id=intval($_POST['id']);
		$recmd['recmd']=intval($_POST['recmd']);
		if(model('news')->update("id='{$id}'",$recmd))
		echo 1;
		else echo '操作失败~';
	}
	
	//编辑器上传
	public function UploadJson(){
		//上传到news目录下面
		EditUploadJson('news');
	}
	
	//编辑器文件管理
	public function FileManagerJson(){
		EditFileManagerJson('news');
	}
	
}