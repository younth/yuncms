<?php
class indexController extends baseController{
	protected $layout = 'layout';
	protected $lockFile = '';
	
	//init是框架定义的初始化，PHP本身用__construct函数
	public function __construct(){
		$this->lockFile = BASE_PATH . 'apps/' . APP_NAME .'/install.lock';
		if(ACTION_NAME !='ok' && file_exists($this->lockFile) ){
			$this->error('程序安装已被锁定，如需重新安装，请先删除文件' . str_replace("\\", "/", $this->lockFile));
			exit;
		}
		$this->title = config('title');
		$this->menu = array(
				//指定下标的二维数组
				'index'=>'1.软件协议',
				'env'=>'2.系统检查',
				'db'=>'3.数据库安装',
				'ok'=>'4.安装状态',
			);
	}
	
	//引导首页
	public function index(){
		$this->display();
	}
	
	//检查环境
	public function env(){
		$this->ifMysql = function_exists('mysql_connect');
		$this->ifVer = ((float)substr(PHP_VERSION, 0, 3) >= 5.0 ) ? true : false;
		$this->ifGd = function_exists('gd_info');
        $this->yes='<font color="green">√</font>';
        $this->no='<font color="red">×</font>';
		
		$rwFiles = array();
		foreach((array)config('rw_files') as $file){
			$perms = substr( sprintf("%o", @fileperms($file)), -4);
			$rwFiles[$file] = $perms >0644 ? true : false;
		}
		$this->rwFiles = $rwFiles;
		
		$this->display();
	}
	
	//安装数据库
	public function db(){
		if( !$this->isPost() ){
			$this->display();
		}else{
			if(empty($_POST['DB_HOST'])||empty($_POST['DB_USER'])||empty($_POST['DB_NAME'])||empty($_POST['DB_PORT'])||empty($_POST['DB_PREFIX']))
			$this->error('安装信息没有填写完整~');
			config('DB', $_POST);//写入到config里面的DB数组
			
			//安装数据库文件
			model('install')->installSql( BASE_PATH . 'apps/' . APP_NAME .'/db.sql' );

			//修改配置文件
			if( !save_config(BASE_PATH . '/config.php', array('DB' => config('DB') ) ) ){ 
				cpError::show('配置文件写入失败！');
			}
			
			//安装成功，创建锁定文件
			if( NULL == ($fp = @fopen($this->lockFile, 'w')) ){
				cpError::show('数据库安装成功，但创建锁定文件失败！请手动删除install安装目录');
			}else{
				fwrite($fp, 'Yuncms');
				fclose($fp);
			}
			
			$this->redirect( url('index/ok') );
		}
	}
	
	//安装成功
	public function ok(){
		$this->display();
		//程序安装结束之后，/删除install目录
		if( config('run_after_del') ){
			del_dir( BASE_PATH . 'apps/' . APP_NAME  ); 
		}
	}
}