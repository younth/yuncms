<?php
/*
 * 企业模块前台  控制器,对应的是学生用户了
 * */
class indexController extends commonController
{
	static protected $company_sort;//公司性质
	static protected $company_scale;//公司规模
	public function __construct()
	{
		parent::__construct();
		$this->company_sort=100054;//公司性质100054
		$this->company_scale=100060;//公司规模100054
		$this->uploadpath=ROOT_PATH.'upload/company/license/';
		$hover="class=\"current\"";//设置当前的导航状态
		$this->hover_company=$hover;
	}
	
	//会员访问公司记录
	protected  function _visit($fid,$bid)
	{
	
		$data=array();
		//看是否访问过，访问过则更新时间
		$re=model('visit_history')->find("fid='{$fid}' and bid='{$bid}' and type=2");
		if($re)
		{
			$id=$re['id'];
			$data['ctime']=time();
			model('visit_history')->update("id='{$id}'",$data);
			return true;
		}
		else{
			$data['type']=2;//类型
			$data['fid']=$fid;
			$data['bid']=$bid;
			$data['ctime']=time();
			if(model('visit_history')->insert($data))return true;
			else false;
		}
	}
	
	
	  public function index()
	    {
	    	//session标记企业用户，cookie标记学生用户
	    	$auth=$this->auth;//本地登录的cookie信息
	    	$id=$auth['id'];//学生用户的id
	    	//我关注的公司的动态
	    	//推荐关注，跟我的专业相关,自己未关注的公司
	    	$list= model('company_fans')->corp_recmd($id);
    		$this->rec_follow=$list;
    		
    		$this->path=__ROOT__.'/upload/company/license/';
	    	
	    	$hover="class=\"root\"";//设置当前的导航状态
	    	$this->nav_index=$hover;
	    	$this->display();
	    }

    //我关注的公司
	 public function myfollow()
	    {
	    	$auth=$this->auth;//本地登录的cookie信息
	    	$id=$auth['id'];//学生用户的id
	    	if($auth['is_active']!=1) $this->redirect(url('default/index/login'));//学生会员
	    	//查找我关注的企业,需要分页处理
	    	$list= model('company_fans')->myfollow($id);//两表关联查询
	    	
	    	//给二维数组增加一个字段，如何获得企业性质信息,注意改变数组的键值对
	    	if(!empty($list))
	    	{
	    		foreach ($list as  $row=>$v)
	    		{
	    			//$list[$row]['quality']
	    			$quality=substr($v['quality'],-6);//根据企业性质id得到该企业
	    			$sorts=$this->sortArray();//树状菜单
	    			$list[$row]['quality']=$sorts[$quality]['name'];//获得该企业的性质
	    			//公司规模
	    			$scale=substr($v['scale'],-6);//根据企业性质id得到该企业
	    			$list[$row]['scale']=$sorts[$scale]['name'];//获得该企业的性质
	    			   
	    		}
	    	}
	    	//我关注的公司总数
	    	$corp_all=model('company_fans')->count("mid='{$id}'");
	    	if($corp_all==0){
	    		//推荐关注的公司，根据我的专业选择合适的行内企业,匹配行业与专业
	    		//得到用户的专业和标签，根据专业及标签推荐
	    		$list_follow= model('company')->quick_follow($id);//两表关联查询
	    		$this->quick_follow=$list_follow;
	    	}else $this->corp_all=$corp_all;
	    	
	    	$this->list=$list;//分类的检索结果
	    	$this->path=__ROOT__.'/upload/company/license/';
	    	$hover="class=\"root\"";//设置当前的导航状态
	    	$this->nav_follow=$hover;
	    	$this->display();
	    }
    
	//公司展示页面
	public function show()
	{
		$id=intval($_GET['id']);//企业的id
		$auth=$this->auth;//本地登录的cookie信息
		$mid=$auth['id'];
		$this->_visit($mid,$id);//更新访问记录
		if(empty($id)) $this->error('参数错误');
		$re=model('company')->find("id='{$id}'");
		//企业的最新粉丝,连表获得会员的信息
		$corp_fans=model('company_fans')->corp_latest_fans($id);
		if(!empty($corp_fans)){
			include_once(ROOT_PATH.'/avatar/AvatarUploader.class.php');
			$au = new AvatarUploader();
			foreach ($corp_fans as  $row=>$v)
			{
				$uid=$v['id'];
				$corp_fans[$row]['avatar']=$au->getAvatar($uid,'small');
			}
		}
		
		//dump($corp_fans);
		//查看是否关注
		if(model('company_fans')->find("cid='$id' AND mid='{$mid}'")){
			$is_follow=1;
		}else $is_follow=0;
		$all_fans=model('company_fans')->fanscount($id);
		$sorts=$this->sortArray();//树状菜单
		//公司规模
		$scale=substr($re['scale'],-6);//根据企业性质id得到该企业
		$this->scale=$sorts[$scale]['name'];//获得该企业的性质
		$quality=substr($re['quality'],-6);//根据企业性质id得到该企业
		$this->quality=$sorts[$quality]['name'];//获得该企业的性质
		$this->introduce=text_out($re['introduce']);
		$this->info=msubstr($re['introduce'],0,70);
		$this->corp=$re;//公司的信息
		$this->all_fans=$all_fans;
		$this->is_follow=$is_follow;
		$this->cid=$id;
		$this->mid=$mid;
		$this->corp_fans=$corp_fans;//最新粉丝
		$this->path=__ROOT__.'/upload/company/license/';
		$this->display();
	}
	
	//取消关注
	public function cancel_follow()
	{
		$auth=$this->auth;//本地登录的cookie信息
		$mid=$auth['id'];
		$id=intval($_GET['id']);//企业的id
		if(empty($id)) {echo '您没有选择~';exit();}
		if(model('company_fans')->delete("cid='$id' AND mid='{$mid}'"))
			echo 1;
		else echo '删除失败~';
	}
	
	//关注企业
	public function follow()
	{
		$auth=$this->auth;//本地登录的cookie信息
		$data=array();
		$data['mid']=$auth['id'];
		//ajax关注
		if(!$this->isPost()){
			$data['cid']=intval($_GET['id']);//企业的id
			$data['ctime']=time();
			if(empty($data['cid'])) {echo '您没有选择~';exit();}
			if(model('company_fans')->insert($data))
				echo 1;
			else echo '删除失败~';
		}else{
			//提交，快速关注
			$corp=$_POST['corps'];
			//批量关注
			if(empty($_POST['corps'])) $this->error('您没有选择~');
			$data['ctime']=time();
			$i=0;
			foreach($corp as $vo){
				$data['cid']=$corp[$i];
				if(model('company_fans')->insert($data)) $i++;
			}
			$this->redirect(url('company/index/myfollow'));
		}
		
	}
	
	//搜索公司
	public function search_corp()
	{
		$auth=$this->auth;//本地登录的cookie信息
		$id=$auth['id'];//学生用户的id
		//显示当面的所以的公司分页，带有公司名称模糊搜索
		$listRows=6;//每页显示的信息条数
		$url=url('index/search_corp',array('page'=>'{page}'));
		//关键字搜索
	//关键字搜索
		$keyword=in(urldecode(trim($_GET['keyword'])));
		//echo $keyword;
		if(!empty($keyword)){
			//实现分页，分页处理在下边
			$url=url('index/search_corp',array('keyword'=>urlencode($keyword),'page'=>'{page}'));
		}
		$limit=$this->pageLimit($url,$listRows);
		$count=model('company')->companycount($keyword);//总条数要结合sort及keyword查询
		$where=(empty($keyword)?'':'name like "%'.$keyword.'%"');
		$list=model('company')->select($where,'','',$limit);//news联合admin查询
		//dump($list);
		if(!empty($list)){
			foreach ($list as  $row=>$v)
			{
				//$list[$row]['quality']
				$quality=substr($v['quality'],-6);//根据企业性质id得到该企业
				$sorts=$this->sortArray();//树状菜单
				$list[$row]['quality']=$sorts[$quality]['name'];//获得该企业的性质
				//公司规模
				$scale=substr($v['scale'],-6);//根据企业性质id得到该企业
				$list[$row]['scale']=$sorts[$scale]['name'];//获得该企业的性质
			
				//粉丝数
				$list[$row]['fans_count']=model('company_fans')->fanscount($v['id']);
				
				//登陆用户是否关注
				if(model('company_fans')->find("cid='{$v[id]}' AND mid='$id'")){
					$list[$row]['is_follow']=1;
				}else $list[$row]['is_follow']=0;
			}
		}else echo "无搜索结果";
		
		$this->list=$list;
		//dump($list);
		$this->path=__ROOT__.'/upload/company/license/';
		$hover="class=\"root\"";//设置当前的导航状态
	    	$this->nav_search=$hover;
		$this->page=$this->pageShow($count);
		$this->display();
		
	}
	
}