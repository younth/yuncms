系统中各种常量
===================

```

 1. $_SERVER['REQUEST_URI']：常用来获当前URL(不包括域名).
 
	例如：http://www.baidu.com/index.php?p=3获得的就是/index.php?p=3这部分
 
 2. $_SERVER["HTTP_X_REWRITE_URL"]  在IIS下获得的是当前URL,在apache下的值为空

 3. dirname(__FILE__)：F:\xampp\htdocs\Yuncms   得到的是文件所在层目录名
 
 4. ROOT_PATH  根目录  Yuncms物理地址

 5. BASE_PATH： F:\xampp\htdocs\Yuncms\protected/  protected的绝对路径

 6. CP_PATH : F:\xampp\htdocs\cp\Yuncms\protected/include/   cp的绝对路径

 7. DEFAULT_APP： 默认的模块为default
 
 8. DEFAULT_CONTROLLER ：index 默认控制器

 9. DEFAULT_ACTION：  index

 10. __UPLOAD__ ：/yuncms/upload  下载的目录

 11. __PUBLICAPP__：当前app的public地址：/yuncms/public/admin

 12. __PUBLIC__   模板公共目录         /cp/Yuncms/public

 13. $_SERVER['REQUEST_URI']  当前的url：/Yuncms/index.php?r=default/index/index 

 14. $_SERVER['HTTP_REFERER']   当前页的父页面URL

 15. DIRECTORY_SEPARATOR:  “/”

 16. NewImgPath：新闻的图片
  

 

```