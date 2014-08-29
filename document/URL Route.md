
###url路由重定向
url路由重定向是为了优化url，利于搜索引擎搜索。
Yuncms中路由的重定向在core.php里面的urlRoute()
Yuncms的路由重定向体现为伪静态的设置。首先必须保证你的服务器开启并支持伪静态。

> apache伪静态规则文件：.htaccess
> 
> iis伪静态规则文件：httpd.ini

###URL规则(default)
```
index/search-<keywords>-<type>-<page>.html=default/index/search
index/search-<keywords>-<type>.html=default/index/search
<c>/<a>-<id>-<page>-<exsort>.html=default/<c>/<a>
<c>/<a>.html=member/<c>/<a>
<c>/<a>=default/<c>/<a>
index.html=default/index/index

```

> 原始URL为原本的URL模块，不必填写GET参数基本格式为 app名/控制器/方法（如：admin/index/index）。
> 
替换URL为最终想要的URL样式，URL内必须包含原URL的GET变量，每个GET名包含在<>内。(如：/admin 或者 /houtai 等都可以)，固定的GET变量为 <app>(APP名称)，<c> (控制器)， <a>(方法名)

>多种不同的APP遇到相同或者类似的URL请在规则内加标识，如遇到规则重复覆盖请适当调整规则顺序，**固定URL要优先于条件URL**，如有其他问题请在规则前面加入**特定标识**如"class/"等调整规则即可，以下为常用URL的GET参数。
栏目URL可使用变量为： <cid> (栏目ID)、<urlname> (栏目URL名称)
内容URL可使用变量为： <aid> (内容ID)、 <urltitle> (内容英文名)、 <dir> (所属栏目URL)、<dirs> (所属多级栏目URL)、 <yyyy> (年份：2013)、 <yy> (年份：13)、 <m> (月份：8)、 <d> (日：31)


```
//example:一个路由解析
index.xxx=default/index/index
in/<c>/<a>.xxx=default/<c>/<a>
admin/<c>/<a>.xxx=admin/<c>/<a>
<c>/<a>.xxx=member/<c>/<a>
```



###URL函数

> Url函数的作用：在当前的app下面定位url
> 
> example: 在admin下面 url(yun):/Yuncms/index.php?yun=admin/yun
				 在default下面 url(login):/Yuncms/index.php?yun=default/login
> 
> 
> 数组形式：
> url('set/tpdel',array('Mname'=>$tpfile)
> 路径为：yuncms/index.php?Yun=admin/set/tpdel&Mname=


