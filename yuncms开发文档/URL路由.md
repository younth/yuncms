
###url路由重定向

> Url函数的作用：在当前的app下面定位url
> 
> example: 在admin下面 url(yun):/Yuncms/index.php?yun=admin/yun
				 在default下面 url(login):/Yuncms/index.php?yun=default/login
> 
> 
> 数组形式：
> url('set/tpdel',array('Mname'=>$tpfile)
> 路径为：yuncms/index.php?Yun=admin/set/tpdel&Mname=


###URL规则(default)
```
index/search-<keywords>-<type>-<page>.html=default/index/search
index/search-<keywords>-<type>.html=default/index/search
<c>/<a>-<id>-<page>-<exsort>.html=default/<c>/<a>
<c>/<a>.html=member/<c>/<a>
<c>/<a>=default/<c>/<a>
index.html=default/index/index

```