Yuncms目录结构
===================

```
系统目录介绍:
index.php：网站入口
protected：网站程序核心文件夹
data：存放备份数据
public：存放css、js、images等模板公用文件
upload：存放上传文件
protected:
|------apps：存放应用：
|------|------后台（admin）
|------|------前台（default）
|------|------会员中心（member）
|------|------系统安装（install）
|------|------应用管理（appmanage）
        每个应用中包含：
               控制器（controller）
               模型（model）
               模板（view）  
               应用配置（config.php）
               应用接口（xxxApi.php）
|------base：控制器、模型以及接口的父类
|------cache：数据库缓存、模板缓存等
|------include：canphp核心
|------config.php：系统全局配置
|------core.php：系统核心函数


```


###public文件夹下文件结构
```
artDialog：弹出框插件，去掉不用的颜色  skin里面
Kindeditor编辑器的优化：
Httpd.ini：window下面的IIS配置文件
.htaccess：apache下面的配置文件
```