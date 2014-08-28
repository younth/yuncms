## 关于config文件 ##

系统中有几处config文件需要注意区别：

 - protected/config.php :这是整个系统的配置文件参数，包括数据库连接参数，邮件配置参数及其他基本参数信息。通过<kbd>config</kbd>函数获取。
 
 - 每个模块下面的config文件，比如 app/admin/config.php ：主要存放当前模块的信息，也可以通过<kbd>config</kbd>函数获取。

```
> return array(
	    'APP_STATE' => 1,
	    'APP_NAME' => '网站后台',
	    'APP_VER' => '2.0',
	    'APP_AUTHOR' => '王洋',
	    'APP_ORIGINAL_PREFIX' => 'Yun_',
	    'APP_TABLES' => '',
		'TPL' => 
	    array (
	    'TPL_CACHE_ON' => false,
	  ),
);
```

 - <kbd>appconfig</kbd>函数：用于获取当前app下面的config文件，就是上面的config文件
 

>  **Note:**
>  Config函数可以加载系统的config.php或者是当前模块的config.php文件，自动去寻找