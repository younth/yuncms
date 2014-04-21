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
        
        //with关联查询，将关联表的数据存入子数组中，先试试吧
        //注：目的是把关联的表的数据存入结果的子数组中，多对一用find，一对多和多对多用select      
        //属于，多对一,一个字段的关联
        //$withTable:关联表。。,$withField关联表的关联字段。。$orgField当前表的关联字段
        public function withBelong($withTable= '',$withField='',$orgField='id',$condition='', $field = '', $order = '', $limit = ''){
            $result=$this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->limit($limit)->select();
           
            
            for($i=0;$i<count($result);$i++){
                $resultWith=$this->model->table($withTable, $this->ignoreTablePrefix)->where($orgField.'='.$result[$i][$withField])->order($order)->find();
                $result[$i]=  array_merge($result[$i],array($withTable=>$resultWith));
            }
            return $result;
        }
        
         public function withBelongOne($withTable= '',$withField='',$orgField='id',$condition='', $field = '', $order = ''){
            $result=$this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->find();
           
            $resultWith=$this->model->table($withTable, $this->ignoreTablePrefix)->where($orgField.'='.$result[$withField])->order($order)->find();
            $result=  array_merge($result,array($withTable=>$resultWith));
            return $result;
        }
        
       
        //属于，多对一,多个字段的关联
         public function withMoreBelong($with=array(array('withTable'=>'','withField'=>'','orgField'=>'id')),$condition='', $field = '', $order = '', $limit = ''){
             $result=$this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->limit($limit)->select();
             for($i=0;$i<count($result);$i++){
//                $resultWith[$i]=$this->model->table($with[$i]['withTable'], $this->ignoreTablePrefix)->where($with[$i]['orgField'].'='.$result[$i][$with[$i]['withField']])->order($order)->find();
                for($j=0;$j<count($with);$j++){
                  $resultWith=$this->model->table($with[$j]['withTable'], $this->ignoreTablePrefix)->where($with[$j]['orgField'].'='.$result[$i][$with[$j]['withField']])->find();
                  $result[$i]=  array_merge($result[$i],array($with[$j]['withTable'].$with[$j]['withField']=>$resultWith));
               }
            }
            return $result;
         }
         
          public function withMoreBelongOne($with=array(array('withTable'=>'','withField'=>'','orgField'=>'id')),$condition='', $field = '', $order = ''){
             $result=$this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->find();
             for($i=0;$i<count($with);$i++){
                $resultWith=$this->model->table($with[$i]['withTable'], $this->ignoreTablePrefix)->where($with[$i]['orgField'].'='.$result[$with[$i]['withField']])->order($order)->find();
                $result=  array_merge($result,array($with[$i]['withTable'].$with[$i]['withField']=>$resultWith));
            }
            return $result;
         }
}