<?php
/*
 * 前台模板处理公共控制器类,每个控制器都需要用到
 * */
class commonController extends memberController {
	protected $layout = 'layout';//layout是基本页面布局
	
	public function __construct()
	{
		parent::__construct();//先继承父类的construct，需要判断会员权限信息     		
		$this->NewImgPath=__ROOT__.'/upload/news/image/';
		$this->LinkImgPath=__ROOT__.'/upload/links/';
		
		$this->title=config('sitename');
		$this->keywords=config('keywords');
		$this->description=config('description');
		$this->telephone=config('telephone');
		$this->QQ=config('QQ');
		$this->email=config('email');
		$this->address=config('address');
		$this->ver_name=config('ver_name');
		$this->copyright=config('copyright');
		
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
	}
}
?>