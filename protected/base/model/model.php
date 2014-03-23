<?php
/*
 * 模型父类，数据库操作函数的父类，模型最低层的类，调用大部分CP的模型函数  cpModel.class.php
 * */
class model{
	public $model = NULL;
	protected $db = NULL;
	protected $table = "";//表名
	protected $ignoreTablePrefix = false;//是否忽视表的前缀，false代表不忽略
	
	//读取config文件的DB数组，初始化连接数据库
	public function __construct( $database= 'DB', $force = false){
		$this->model = self::connect( config($database), $force);
		$this->db = $this->model->db;
	}
	
	//连接数据库，调用CP功能
	static public function connect($config, $force=false){
		static $model = NULL;
		if( $force==true || empty($model) ){
			$model = new cpModel($config);
		}
		return $model;
	}
	
	//执行sql语句
	public function query($sql){
		return $this->model->query($sql);
	}
	
	//找到符合当前添加的记录，返回数组形式，只查找一条记录
	public function find($condition = '', $field = '', $order = ''){
		return $this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->find();
	}
	
	//选择查询
	public function select($condition = '', $field = '', $order = '', $limit = ''){
		return $this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->limit($limit)->select();
	}
	
	//统计总数
	public function count($condition = ''){
		return $this->model->table($this->table, $this->ignoreTablePrefix)->where($condition)->count();
	}
	
	//插入数据,返回上一次插入的id
	public function insert($data = array() ){
		return $this->model->table($this->table, $this->ignoreTablePrefix)->data($data)->insert();
	}
	
	//更新数据
	public function update($condition, $data = array() ){
		return $this->model->table($this->table, $this->ignoreTablePrefix)->data($data)->where($condition)->update();
	}
	
	//删除数据
	public function delete($condition){
		return $this->model->table($this->table, $this->ignoreTablePrefix)->where($condition)->delete();
	}
	
	//返回sql语句
	public function getSql(){
		return $this->model->getSql();
	}
	
	//数据过滤
	public function escape($value){
		return $this->model->escape($value);
	}
	
	//缓存
	public function cache($time = 0){
		$this->model->cache($time);
		return $this;
	}
	
}