<?php
/*
 * 数据库管理控制器
 * */
class dbbackController extends commonController
{
	static protected  $db='';//所有的数据表
	public function __construct()
	{
		parent::__construct();
		//Dbbak是CP里面的数据库类库
		self::$db=new Dbbak(config('DB_HOST'),config('DB_USER'),config('DB_PWD'),config('DB_NAME'),'utf8',ROOT_PATH.'data/db_back/');
	}

	//显示备份
	public function index()
	{
		$list=self::$db->getTables(config('DB_NAME'));//读取config里面的数据库名，获取数据库所有表名
		//print_r($list);
		if(!$this->isPost()){
			$this->table=$list;//数据库中的表
			//$this->assign('list',$this->getFileName('../data/db_back'));//文件夹下所有文件信息
			$this->files=getDir(self::$db->dataDir);//获得文件夹列表
			//$files=getDir(self::$db->dataDir);
			//print_r($files);
			$this->display();
		}else{
			//提交备份
			@set_time_limit(0);
			$backtype=intval($_POST['backtype']);//要备份类型
			$table=$_POST['table'];//要备份的表
			$db_size=$_POST['size'];//要备份的分卷大小
			if($backtype)
			{
				//如果是全部备份的话，则是全部的表
				$table=$list;
			}
			else {if(empty($table)) $this->error('请选择需要备份的表~');}
			if(self::$db->exportSql($table,$db_size))//导出sql语句，这句调用有点复杂
			$this->success('备份成功',url('dbback/index'));
			else $this->error('备份失败');
		}

	}

	//恢复已存在备份
	public function recover()
	{
		@set_time_limit(0);
		$file=$_GET['f'];//获得文件夹名列表
		//echo $file;return;
		if(empty($file)) $this->error('参数错误');
		if(self::$db->importSql($file.'/'))//载入sql文件，恢复数据库
		{
			$this->success('数据恢复成功！',url('dbback/index'));
		}
		else{
			$this->error('数据恢复失败！');
		}
	}
	
	//ajax显示备份详细信息
	public function detail(){
		$file=$_GET['f'];//获得文件名列表
		if(empty($file)) {echo '参数错误'; return;}
		$list=getFileName(self::$db->dataDir.$file.'/');
		if(empty($list)) echo '没有详细信息';
		else{
		$str.='<table width="100%"><tr><th>分卷</th><th>大小</th><th>修改时间</th></tr>';
		foreach($list as $vo)
		   $str.='<tr><td align="center">'.$vo['name'].'</td><td align="center">'.$vo['size'].'kb</td><td align="center">'.$vo['time'].'</td></tr>';
		$str.='</table>';
		echo $str;
		}
	}

	//删除备份文件
	public function del()
	{
		$file=$_GET['f'];//获得文件名列表
		//echo $file;return ;
		if(empty($file)) $this->error('参数错误');
		if(del_dir(self::$db->dataDir.$file))
		$this->success('删除成功',url('dbback/index'));
		else $this->error('删除失败');
	}
}