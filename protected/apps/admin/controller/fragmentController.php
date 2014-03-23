<?php
/*
 * 碎片管理控制器
 * */
class fragmentController extends commonController
{
	
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('fragment/index',array('page'=>'{page}'));//分页的url
	    $limit=$this->pageLimit($url,$listRows);//限制分页
		$count=model('fragment')->count();
		$list=model('fragment')->select('','id,title,sign','',$limit);
		//print_r($list);
		$this->page=$this->pageShow($count);
		$this->url=url('fragment');//fragment路径	
		$this->list=$list;
		$this->display();
	}
	
	//碎片添加
	public function add()
	{
		if(!$this->isPost()){
			$this->t_name="添加";
			$this->display("fragment_edit");
		}else{
			if(empty($_POST['content'])||empty($_POST['sign']))$this->error('请填写完整的信息~');
			$data=array();
			$data['title']=in($_POST['title']);
		    if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes($_POST['content']);
			} else {
				$data['content'] = $_POST['content'];
			}
			$data['sign']=$sign=in($_POST['sign']);
            $ifsigh=model('fragment')->find("sign='{$sign}'");
            if(empty($ifsigh)){
			    if(model('fragment')->insert($data))
			       $this->success('碎片添加成功~',url('fragment/index'));
			    else $this->error('碎片添加失败~');
                        }else $this->error('调用标识跟已有碎片重复~');
		}
	}
	
	//碎片编辑
	public function edit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		
		if(!$this->isPost()){
			$info=model('fragment')->find("id='$id'");
			$this->info= $info;
			$this->t_name="编辑";
			$this->display();
		}else{
			//修改
			if(empty($_POST['content']))
			$this->error('请填写完整的信息~');
			$data=array();
			$data['title']=in($_POST['title']);
			/*
			 * 得到php.ini设置中magic_quotes_gpc选项的值
			 * 如果magic_quotes_gpc=On，PHP解析器就会自动为post、get、cookie过来的数据增加转义字符“\”
			 * 以确保这些数据不会引起程序
			 * */
		    if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes($_POST['content']);
			} else {
				$data['content'] = $_POST['content'];
			}
			if(model('fragment')->update("id='{$id}'",$data))
			$this->success('碎片编辑成功~',url('fragment/index'));
			else $this->error('信息不需要修改~');
		}
	}

	//删除碎片
	public function del()
	{
		if(!$this->isPost()){
			//未提交，则是ajax方式删除，根据提交过来的id
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('您没有选择~');
			if(model('fragment')->delete("id='$id'"))//delete在fragment模型的父类中
			echo 1;
			else echo '删除失败~';
		}else{
			//提交，则是批量删除
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			if(model('fragment')->delete('id in ('.$delid.')'))//批量删除
			$this->success('删除成功',url('fragment/index'));
		}
	}
	
	/*编辑器上传管理，自定义编辑器，方便管理文件 */
	public function UploadJson(){
		$this->EditUploadJson('fragment');
	}
	
	//编辑器文件管理
	public function FileManagerJson(){
		$this->EditFileManagerJson('fragment');
	}
}