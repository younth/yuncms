<?php
class indexController extends commonController
{
	public function index()
	{
            $this->display();
	}


	//搜索
	public function search()
	{
		//文章关键字或者类型搜索
       if(empty($_GET['keywords'])||empty($_GET['type'])) $this->error('搜索条件不足~');
       $keywords=in(urldecode(trim($_GET['keywords'])));
       $type=in($_GET['type']);
       $listRows=10;//每页显示的信息条数,2n偶数
       $url=url('index/search',array('id'=>'000000','page'=>'{page}','keywords'=>urlencode($keywords),'type'=>$type));
	   $where="title like '%".$keywords."%' OR description like '%".$keywords."%'";
         switch ($type) {
       	case 'news':
       	      $count=model('news')->count($where);
                  $limit=$this->pageLimit($url,$listRows);
       		$list=model('news')->select($where,'id,title,description,method,addtime,hits','id DESC',$limit);
       		break;

       	case 'photo':
       	      $count=model('photo')->count($where);
                  $limit=$this->pageLimit($url,$listRows);
       		$list=model('photo')->select($where,'id,title,description,method,addtime,hits','id DESC',$limit);
       		break;
       	
       	case 'all':
       	      $count1=model('news')->count($where);
       	      $count2=model('photo')->count($where);
                  $limit=$this->pageLimit($url,$listRows/2);
       	      $list1=model('news')->select($where,'id,title,description,method,addtime,hits','id DESC',$limit);
       		$list2=model('photo')->select($where,'id,title,description,method,addtime,hits','id DESC',$limit);
       		$count=max($count1,$count2);
       		if(empty($list1)) $list1=array();
       		if(empty($list2)) $list2=array();
       		$list=array_merge($list1,$list2);
       		break;
       	default:
       		$this->error('搜索类型错误~');
       		break;
       }
       $this->page=$this->pageShow($count);
       $count=isset($count1)?($count1+$count2):$count;
       $this->count=$count;
       if(strlen($keywords)<60) model('tags')->update("name='{$keywords}'","hits=hits+1,mesnum='{$count}'");
       $this->list=$list;
       $this->keywords=$keywords;
       $this->display();
	}

	//生成验证码
    public function verify()
      {
            Image::buildImageVerify();
      }
}
?>