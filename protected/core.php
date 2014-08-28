<?php
/*
 * 系统核心函数
 * */
defined('BASE_PATH') or define('BASE_PATH', dirname(__FILE__) . '/');
defined('CP_PATH') or define('CP_PATH', dirname(__FILE__) . '/include/');
defined('DEFAULT_APP') or define('DEFAULT_APP', 'default');
defined('DEFAULT_CONTROLLER') or define('DEFAULT_CONTROLLER', 'index');
defined('DEFAULT_ACTION') or define('DEFAULT_ACTION', 'index');

/*
 * url路由重写，网址解析的函数，CP自带的网址解析函数是  _parseUrl 
 * 这里跟后台的URL规则相关
 * */
function urlRoute(){
	$rewrite = config('REWRITE');//读取config 内容
	if( !empty($rewrite) ) {
		if( ($pos = strpos( $_SERVER['REQUEST_URI'], '?' )) !== false ){
			parse_str( substr( $_SERVER['REQUEST_URI'], $pos + 1 ), $_GET );
		}
		foreach($rewrite as $rule => $mapper){
			$rule = ltrim($rule, "./\\");
			if( false === stripos($rule, 'http://')){
				$rule = $_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER["SCRIPT_NAME"]),'/\\').'/'.$rule;
			}
			$rule = '/'.str_ireplace(array('\\\\', 'http://', '-', '/', '<', '>',  '.'), array('', '', '\-', '\/', '(?<', ">[a-z0-9_%]+)", '\.'), $rule).'/i';
			if(preg_match($rule,$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],$matches)){
				foreach($matches as $matchkey => $matchval){
					if(('app' === $matchkey)){
						$mapper = str_ireplace('<app>', $matchval, $mapper);
					}else if('c' === $matchkey){
						$mapper = str_ireplace('<c>', $matchval, $mapper);
					}else if('a' === $matchkey){
						$mapper = str_ireplace('<a>', $matchval, $mapper);
					} else {
						if( !is_int($matchkey) ) $_GET[$matchkey] = $matchval;
					}
				}
				$_REQUEST['yun'] = $mapper;
				break;
			}
		}
	}
	$route_arr = isset($_REQUEST['yun']) ? explode("/", htmlspecialchars($_REQUEST['yun'])) : array();
	$app_name = empty($route_arr[0]) ? DEFAULT_APP : strtolower($route_arr[0]);
	$controller_name = empty($route_arr[1]) ? DEFAULT_CONTROLLER : strtolower($route_arr[1]);
	$action_name = empty($route_arr[2]) ? DEFAULT_ACTION : $route_arr[2];
	$_REQUEST['yun'] = $app_name .'/'. $controller_name .'/'. strtolower($action_name);
	
	define('APP_NAME', $app_name);
	define('CONTROLLER_NAME', $controller_name);
	define('ACTION_NAME', $action_name);
}

//在当前的app下面定位url，处理URL为index.php?yun=default/...形式
function url($route='index/index', $params=array()){
	if( count( explode('/', $route) ) < 3 )  $route = config('_APP_NAME') . '/' . $route;
	$param_str = empty($params) ? '' : '&' . http_build_query($params);
	$url = $_SERVER["SCRIPT_NAME"] . '?yun=' . $route . $param_str;
	
	static $rewrite = array();
	if( empty($rewrite) ) $rewrite = config('REWRITE');
	
	if( !empty($rewrite) ){
		static $urlArray = array();
		if( !isset($urlArray[$url]) ){
			foreach($rewrite as $rule => $mapper){
				$mapper = '/'.str_ireplace(array('/', '<app>', '<c>', '<a>'), array('\/', '(?<app>\w+)', '(?<c>\w+)', '(?<a>\w+)'), $mapper).'/i';
				if(preg_match($mapper,$route,$matches)){
					list($app, $controller, $action) = explode('/', $route);
					$urlArray[$url] = str_ireplace(array('<app>', '<c>', '<a>'), array($app, $controller, $action), $rule);
					if( !empty($params) ){
						$_args = array();
						foreach($params as $argkey => $arg){
							$count = 0;
							$urlArray[$url] = str_ireplace('<'.$argkey.'>', $arg, $urlArray[$url], $count);
							if(!$count) $_args[$argkey] = $arg;
						}
						//处理多出来的参数
						if( !empty($_args) ){
							$urlArray[$url] = preg_replace('/<\w+>/', '', $urlArray[$url]). '?' . http_build_query($_args);
						}
					}
					//自动加上域名
					if(false === stripos($urlArray[$url], 'http://')){
						$urlArray[$url] = 'http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER["SCRIPT_NAME"]), "./\\") .'/'.ltrim($urlArray[$url], "./\\");
					}
					
					//参数个数匹配则返回
					$rule = str_ireplace(array('<app>', '<c>', '<a>'), '', $rule);
					if( count($params) == preg_match_all('/<\w+>/is', $rule, $_match)){
						return $urlArray[$url];
					}	
				}
			}
			return isset($urlArray[$url]) ? $urlArray[$url] : $url;
		}
		return $urlArray[$url];
	}
	return $url;
}

//自动加载系统的控制器，模型基类，拓展函数，CP框架等。
function autoload($className){
	$array = array(
					BASE_PATH . 'apps/' . config('_APP_NAME') . '/model/' . $className . '.php',
					BASE_PATH . 'apps/' . config('_APP_NAME') . '/controller/' . $className . '.php',				
					BASE_PATH . 'base/model/' . $className . '.php',
					BASE_PATH . 'base/controller/' . $className . '.php',
					BASE_PATH . 'base/api/' . $className . '.php',
					BASE_PATH . 'base/extend/' . $className . '.php',
					CP_PATH . 'core/' . $className . '.class.php',
					CP_PATH . 'lib/' . $className . '.class.php',
					CP_PATH . 'ext/' . $className . '.class.php',				
	);
	foreach($array as $file){
		if( is_file($file)){
			require_once($file);
			return true;
		}
	}
	return false;
}

//获得apps下面所有的app名称，返回数组
function getApps(){
	static $appsArray = array();
	foreach(glob(BASE_PATH . 'apps/*/config.php') as $file){
		if( preg_match('#apps/(.*?)/config.php#', $file, $matches)){
			$appsArray[] = $matches[1];
		}
	}
	return $appsArray;
}

//读取模块config文件，返回数组
function appConfig($app){
	static $appConfig = array();
	if( !isset( $appConfig[$app]) ){
		if( is_file(BASE_PATH . 'apps/' . $app . '/config.php') ){
			$appConfig[$app] = require(BASE_PATH . 'apps/' . $app . '/config.php');
		}else{
			$appConfig[$app] = array();
		}
	}
	return $appConfig[$app];
}

//得到系统config文件或者app下面的config文件
function config($name=NULL, $value=NULL){
	static $config = array();
	$argsNum = func_num_args();
	if( 0 == $argsNum ){
		return $config;
	}else if( 1 == $argsNum ){
		if( is_array($name)){
			foreach($name as $k => $v){
				if( is_array($v) ){
					isset($config[$k]) or $config[$k] = array();
					$config[$k] = array_merge($config[$k], $v);
				} else {
					$config[$k] = $v;
				}
			}
			return $config;
		}else if(isset($config[$name])) {
			return $config[$name];
		} else if(isset($config['APP'][$name])) {
			return $config['APP'][$name];
		} else if(isset($config['DB'][$name])) {
			return $config['DB'][$name];			
		} else if(isset($config['TPL'][$name])) {
			return $config['TPL'][$name];
		} else {
			return NULL;
		}
	} else {
		return $config[$name] = is_array($value) ? array_merge($config[$name], $value) : $value;
	}
}

//执行模型，判断模型是否存在
function model($model){
	static $objArray = array();
	$className = $model . 'Model';
	if( !is_object($objArray[$className]) ){
		if( !class_exists($className) ) {
			throw new Exception(config('_APP_NAME'). '/' . $className . '.php 模型类不存在');
		}
		$objArray[$className] = new $className();
	}
	return $objArray[$className];
}

//获取应用菜单
function api($app, $method = '', $params = array()){	
	if( empty($app) || empty($method) ) return false;
	
	$apis =array(); 
	if( is_array($app) ){
		$isArray = true;
		$apis = $app;
	}else{
		$isArray = false;
		$apis[] = $app;
	}
	
	static $objArray = array();
	$returnData = array();
	$currentConfig = config();
	foreach($apis as $app){
		config('_APP_NAME', $app);
		$config = appConfig($app);
		$className = $app . 'Api';
		if( !is_object($objArray[$className]) ){
			
			if( empty( $config['APP_STATE'] ) || (1 != $config['APP_STATE'] )) continue;
			$file = BASE_PATH . 'apps/' . $app . '/'. $className.'.php'; 
			if( !is_file($file) ) continue;
			require_once($file);
			if( !class_exists($className) ) continue;
			config($config);			
			$objArray[$className] = new $className();
		}
		if( !method_exists($objArray[$className], $method) ) continue;
		config($config);
		$returnData[$app] = call_user_func_array( array($objArray[$className], $method), $params);
		config('_APP_NAME', APP_NAME);
		config($currentConfig);
	}
	config('_APP_NAME', APP_NAME);
	config($currentConfig);
	return $isArray ? $returnData : ( isset($returnData[$app]) ? $returnData[$app] : NULL );
}


//系统运行函数
function run(){
	require(CP_PATH . 'core/cpConfig.class.php');//加载默认配置
	config( require(BASE_PATH . 'config.php') );//加载全局配置
	cpConfig::set('APP', array_merge(cpConfig::get('APP'), config('APP')));	
	defined('DEBUG') or define('DEBUG', cpConfig::get('DEBUG'));
	date_default_timezone_set( cpConfig::get('TIMEZONE') );
	
	if ( DEBUG ) {
		ini_set("display_errors", 1);
		error_reporting( E_ALL ^ E_NOTICE );//除了notice提示，其他类型的错误都报告
	} else {
		ini_set("display_errors", 0);
		error_reporting(0);//把错误报告，全部屏蔽
	}
	
	urlRoute();//网址路由解析
	config('_APP_NAME', APP_NAME);
	config( appConfig(APP_NAME) ); //加载app配置
		
	try{
		defined('__ROOT__') or define('__ROOT__', config('URL_HTTP_HOST') . rtrim(dirname($_SERVER["SCRIPT_NAME"]), '\\/'));
		defined('__PUBLIC__') or define('__PUBLIC__', __ROOT__ . '/' . 'public');
		defined('__UPLOAD__') or define('__UPLOAD__', __ROOT__ . '/' . 'upload');
		require(BASE_PATH . 'base/extend/function.php');
		//判断移动端与电脑端调用不同的模板
		if(is_mobile() && config(TPL_TEMPLATE_PATH_MOBILE)) $tems=config(TPL_TEMPLATE_PATH_MOBILE);
		else $tems=config(TPL_TEMPLATE_PATH);
		defined('__PUBLICAPP__') or empty($tems)? define('__PUBLICAPP__', __ROOT__ . '/' . 'public/' . APP_NAME):define('__PUBLICAPP__', __ROOT__ . '/' . 'public/' . APP_NAME.'/'.$tems);
		
		spl_autoload_register( 'autoload' );
		$controller = CONTROLLER_NAME . 'Controller';
		$action = ACTION_NAME;

		if( !class_exists($controller) ) {
			throw new Exception(APP_NAME. '/' .$controller.'.php 控制器类不存在', 404);
		}
		$obj = new $controller();
		
		if( !method_exists($obj, $action) ){
			throw new Exception(APP_NAME. '/' .$controller.'.php的' . $action.'() 方法不存在', 404);
		}
		$obj ->$action();

	} catch( Exception $e){
		cpError::show( $e->getMessage(), $e->getCode());
	}
}


run();//启动xit