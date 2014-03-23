<?php
/*
 * 模型基类，对应与basecontrolller.php
 * */
class baseModel extends model{
     protected $prefix='';//前缀
     
     //初始化表名前缀
     public function __construct( $database= 'DB' ){
		parent::__construct();
		$this->prefix=config('DB_PREFIX');
	}
}