<?php
/*
 * 会员模块的基类，因为系统的前台需要调用，所以作为base基类
 * */
class memberController extends baseController{
  protected $auth=array();//auth是用户信息的数组
	
	public function __construct()
	{
    parent::__construct(); 
    @session_start();//开启session
    $this->NewImgPath=__ROOT__.'/upload/news/image/';
    $this->LinkImgPath=__ROOT__.'/upload/links/';
    
    //前台直接使用config
    $this->title=config('sitename');
    $this->keywords=config('keywords');
    $this->description=config('description');
    $this->tel=config('telephone');
    $this->icp=config('icp');
    $this->email=config('email');
    $this->address=config('address');
    $this->ver_name=config('ver_name');
    $this->copyright=config('copyright');
    $this->beian=config('beian');
    
    //自定义标签加载添加，调用base/extend/function.php中getlist函数
    $this->view()->addTags(array(
    		"/{(\S+):{(.*)}}/i"=>"<?php $$1=getlist(\"$2\"); $$1_i=0; if(!empty($$1)) foreach($$1 as $$1){  $$1_i++; ?> ",
    		"/{\/([a-zA-Z_]+)}/i"=> "<?php } ?>",
    		"/\[([a-zA-Z_]+)\:\i\]/i"=>"<?php echo \$$1_i ?>",
    		"/\#\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\#/i"=>'".\$$1[\'$2\']."',
    		"/\#\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\#/i"=> '".\$$1[\'$2\']."',
    		"/\#\\$(\S+)\#/i"=>'".$$1."',
    		"/\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]/i"=>"<?php echo \$$1['$2'] ?>",
    		"/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$len\=([0-9]+)\]/i"=>"<?php echo msubstr(\$$1['$2'],0,$3); ?>",
    		"/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$elen\=([0-9]+)\]/i"=>"<?php echo substr(\$$1['$2'],0,$3); ?>",
    		"/{piece:([a-zA-Z_]+)}/i"=> "<?php \$cpTemplate->display(model('fragment')->fragment($1),false,false); ?>"
    ),true);
    
    	//powerCheck，返回1没有权限，返回2未登陆有权限，返回数组登陆有权限
		$power=api('member','powerCheck');//加载member模块的powerCheck方法，获得登陆会员的相关信息
    switch ($power) {
      case false:
      	//会员应用没有开启
        $this->assign('memberoff',true);
        break;
      case 1://没有权限访问
      	//$_SERVER['HTTP_REFERER'] 获取当前链接的上一个连接的来源地址  起到防盗链作用
        $this->error('您没有登陆或是权限不够进入~',$_SERVER['HTTP_REFERER']);
		//跳转到登录的页面
        break;
      case 2://游客没有权限访问
      	//$this->error('您没有登陆或是权限不够进入~',$_SERVER['HTTP_REFERER']);
        break;
      default://会员信息数组,会员有权限访问
        $this->auth=$power;//auth是用户信息的数组,
        //print_r($power);
        $this->assign('auth',$power);//auth的默认值是3,auth传到模板
        break;
    }
	}
}