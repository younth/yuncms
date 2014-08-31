Yuncms模板
=================
先来介绍Yuncms前台模板的一些相关知识

> 模板的位置：protected/apps/default/view/

 - 看看config配置文件与其他模块的不同点：
```
  'TPL' => 
  array (
    'TPL_TEMPLATE_PATH' => 'default',
    'TPL_TEMPLATE_PATH_MOBILE' => 'default',
  ),
  /*
	  1.这里PC端及移动端分别采用的模板的配置参数说明
	  2.根据配置参加判断运行见core.php的run方法
	  3.判断是在服务器端进行，也可以考虑从客户端
  */
```

 - 重点是view目录：

> view目录下面存放着前台的模板文件，一个文件夹代表对应的一个模板，default是默认的前台模板，每个模板里面有个配置文件：info.php

```
<?php return array (
  'name' => '91频道',
  'author' => '王洋',
);
/*
	name:模板名称
	author:模板作者
*/ 
?>
```

### ***layout*是什么？**


> Layout是模板的基本布局，或者说公共的布局，可以放网站的公用的header,footer等。

 - layout如何用
 >{include file="$__template_file"} 
 >__template_file：controller.php里面定义

 - 如何关闭layout?

> 有时候我们要自定义页面，或者并不是每个页面都需要公用，可以选择关闭。找到对应模块控制器下面的commonController.php文件
```
protected $layout = 'layout';
//把这句话注释掉即可关闭layout布局。
```

 - 关闭之后，如何定义公用的头部尾部？

> 在layout同级目录下面创建header.php  footer.php。在需要用到的页面中引入：
>  {include file="header"}
>    {include file="footer"}

>如果某个控制器对应需要有自己的header,则在改页面文件夹下面创建header.php
然后{include file="控制器名/header"}

##模板引擎的定义
Yuncms采用`自定义的模板引擎`，其实就是一些标签的正则匹配

```
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
```
处理在base/extend/function.php中`自定义的模板引擎`。
>getlist是前台的模板直接查询数据库操作

+ 选用*js模板引擎*还是phpd的呢?

> 原理：
> php传递json数据给js来执行模板渲染
> php直接利用模板引擎生成html传给js呢

###模板文件
 - 模板后缀：.php文件
 >为什么要用.php而不用.html？防止模板被盗。

 - 每个模板都有`<?php if(!defined('APP_NAME')) exit;?>`
还是防止被盗。


 - 如何给模板传值
 

> 模板传值直接：`$this->result=$result;`
> 这样在模板中可以直接调用$result变量。可以传递变量，数组*等*。
> 显示模板：`$this->display();`
  
- 如何引入外部js,css文件
```
//css
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
//js
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>

//publicapp表示当前模块的css,js文件,public表示公共的
```

 - 如何调其他公用文件
`{include file="模版名称"}`     *需要注意路径*
###Yuncms模板标签的调用

####常量变量标签
config文件里面的变量可以直接使用。
```
{$name}：输出变量$name
{CONSTANCE}:输出常量CONSTANCE
```


####时间格式化标签

```
PHP中使用的是Unix时间戳：以1970 年 1 月 1 日 00:00:00到某一时刻经过的秒数来计时
{date($t,Y-m-d H:i:s)} ：将$t时间戳转换为 Y-m-d H:i:s 格式即：年-月-日 小时:分钟:秒。例：1985-11-15 12:00:00
{date(Y-m-d H:i:s)} : 将当前时间戳转换为 Y-m-d H:i:s 格式即：年-月-日 小时:分钟:秒。例：2013-4-1 12:00:00
```