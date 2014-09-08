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
###*如何让模块可以多模板选择呢*
在当前模块的config文件下面增加tpl这个数组即可。


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


> Layout是模板的基本布局，或者说公共的布局，可以放网站的公用的header,footer等。在实际应用中如果每个模板都有共用的部分我们可以采用layout布局方式。

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

 - 如何调其他公用文件,模板文件包含
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

####支持PHP标签
```
当我们需要在模板中调用php代码时，一般会采用<?php 代码  ?>，现在你也可以使用这种方式调用：{php 代码 }
```

####函数标签
```
模板中我们用这种方式来调用函数：{函数名（参数1，参数2，....）}
以最常见的网址格式化函数url()在模板中调用为例：
输出网站首页URL地址：{url('default/index/index')}
输出ID为100001的资讯文章URL地址：{url('default/news/content',array('id'=>100001))}
```

####if 标签
```
{if 条件1}
	.....
{elseif 条件2}
	.....
{else}
	....
{/if}
例如在前台模板news_content.php中有这样一个判断：
{if !empty($upnews)}
<a href="{url($upnews['method'],array('id'=>$upnews['id']))}">{$upnews['title']}</a>
{else} 
	没有了....
{/if}
以上判断是否还有上一篇文章，有的话输出上一篇文章链接，没有的话输出'没有了'
```

#### for 标签
```
{for 三元条件}
	循环体..
{/for}
例:
{for $i=0;$i<3;$i++}
	这是第{$i}个元素<br>
{/for}
以上输出结果为：
	这是第0个元素
	这是第1个元素
	这是第2个元素
```

####loop 标签
loop标签是在控制器里面赋值，然后在模板里面循环输出
```
loop是php中foreach函数的应用
{loop 数组 数组键值 数组值}
	循环体..
{/loop}
例：
有这样一个数组变量：$arr=array('张三'=>'20岁','李四'=>'24岁','王二小'=>'28岁') ;
在模板中使用loop输出：
{loop $arr $key $vo}
	{$key}的年龄是{$vo} <br>
{/loop}
输出结果为：
    张三的年龄是20岁
    李四的年龄是24岁
    王二小的年龄是28岁
```
example:
```
//控制器
$list= model('member_tag')->select("mid='{$id}'",'id,name','id asc');
$this->mytag=$list;
//对应模板
{loop $mytag $key $vo}
	<a value="{$vo['id']}" title="{$vo['name']}" href="javascript:void(0);"><span>{$vo['name']}</span><em></em>
	</a>
{/loop}  
```

####查表输出
```
模板中直接查询数据库表输出数据：
	{自定义数组名:{table=(数据库表名) field(查询字段) where=(查询条件) limit=(查询条数) order=(排序方式)}} 
	{/自定义数组名}
```
example:
```
<span class="margin">友情链接：</span>
{link:{table=(link) field=(name,url,type,picture,logourl) order=(norder desc,id desc) where=(ispass='1')}}
	{if $link['type']==1} <a href="[link:url]" target="_blank">[link:name]</a>
	{elseif $link['type']==2} <a href="[link:url]" target="_blank"><img src="[link:picturepath]" alt="[link:name]"></a>
	{/if}
{/link}
```

```
例：调用资讯栏目ID为100001下3条数据内容
{news:{table=(news) field=(title,color,addtime) order= (recmd DESC,norder desc,id desc)where=(ispass='1'AND like '%100001%') limit=(3)}}
	这是第[news:i]条 - 标题颜色：[news:color] - 标题：[news:title] - 截取3字符后标题：[news:title $len=3] - 时间：[news:addtime] <br>
{/news}
```

####资讯内容调用标签
```
{循环标识:{table=(news) field=(字段) place=(定位ID) column=(栏目ID) where=(条件) order=(排序) limit=(条数)}}
	循环主体
{/循环标识}
/*
	1.column 指定栏目ID
	2.place 指定定位ID
	3.
*/
```
example:
```
{news:{table=(news) field=(id,title,color,addtime,method,picture,description) column=(100001) order=(norder desc,id desc) where=(ispass='1') limit=(8)}}
    <a style="color:[news:color]" title="[news:title]" target="_blank" href="[news:url]">[news:title $len=16]</a><span>{date($news['addtime'],Y-m-d)}</span>
    
    {$NewImgPath}[news:picture] 封面图 （此标签适用于1.1.8与之前版本）
    {$NewImgPath}thumb_[news:picture] 封面缩略图 (此标签适用于1.1.8与之前版本)
    [循环标识:picturepath] 封面图 
	
    [news:title $len=16]中"$len=16" 截取中文字符串
    {msubstr($news['title'], 0, 16)} 中文字符串截取函数，与上条效果一致，可灵活用至其它地方
    [news:title $elen=16]中"$elen=16" 截取英文字符串
    {substr($news['title'], 0, 16)} 英文字符串截取函数，与上条效果一致，可灵活用至其它地方
    {date($news['addtime'],Y-m-d H:i:s)} 格式化时间，Y-m-d H:i:s 格式即：年-月-日 小时:分钟:秒，例：1985-11-15 12:00:00
    {date($news['addtime'],Y-m-d)} 格式化时间，Y-m-d 格式即：年-月-日，例：1985-11-15
    $news_i 循环计数 （1，2，3，4，5，6，7，8） 

{/news}
注：以上调用出8条栏目ID为"100001"的审核通过的内容的标题颜色、标题、链接、添加时间，并按内容排序ID和文章ID从大到小降序排列，和一些常用标签范例。
```
