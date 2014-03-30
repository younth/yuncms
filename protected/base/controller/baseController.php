<?php
//基类，处理静态缓存及app拓展应用的后台管理
class baseController extends controller{
	protected $appConfig = array();
	
	public function __construct(){
		$this->appConfig = config('APP');//加载app数组
		if( $this->_readHtmlCache() ){
			$this->appConfig['HTML_CACHE_ON'] = false;//config模板里面的静态模板缓存开关
			exit;
		}
		parent::__construct();
	}
	
	public function __destruct(){
		$this->_writeHtmlCache();
	}
	
	//读取静态缓存
	private function _readHtmlCache() {	
		if ( ($this->appConfig['HTML_CACHE_ON'] == false) || empty($this->appConfig['HTML_CACHE_RULE']) ) {
			$this->appConfig['HTML_CACHE_ON'] = false;
			return false;
		}
		if( isset($this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME][ACTION_NAME]) ){
			$expire = $this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME][ACTION_NAME];
		}else if(isset($this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME]['*'])){
			$expire = $this->appConfig['HTML_CACHE_RULE'][APP_NAME][CONTROLLER_NAME]['*'];
		}else{
			$this->appConfig['HTML_CACHE_ON'] = false;
			return false;
		}
		return cpHtmlCache::read($this->appConfig['HTML_CACHE_PATH'], $expire);
	}
	
	//写入静态页面缓存
	private function _writeHtmlCache() {	
		if ( $this->appConfig['HTML_CACHE_ON'] ) {
			cpHtmlCache::write();
		}	
	}

	
}