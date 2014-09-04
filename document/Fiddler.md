###Fiddler是最强大的的Web调试工具，没有之一，此文档整理如何使用fiddler

###Fiddler的基本界面

![fiddler界面](https://raw.githubusercontent.com/younth/image/master/fiddler/1.png)


####Inspectors tab下有很多查看Request或者Response的消息。 其中Raw Tab可以查看完整的消息，Headers tab 只查看消息中的header. 如下图：

![fiddler界面](https://raw.githubusercontent.com/younth/image/master/fiddler/2.png)

###Fiddler的HTTP统计视图

通过陈列出所有的HTTP通信量，Fiddler可以很容易的向您展示哪些文件生成了您当前请求的页面。使用Statistics页签，用户可以通过选择多个会话来得来这几个会话的总的信息统计，比如多个请求和传输的字节数。

选择第一个请求和最后一个请求，可获得整个页面加载所消耗的总体时间。从条形图表中还可以分别出哪些请求耗时最多，从而对页面的访问进行访问速度优化

![统计图](https://raw.githubusercontent.com/younth/image/master/fiddler/3.png)


###QuickExec命令行的使用
Fiddler的左下角有一个命令行工具叫做QuickExec,允许你直接输入命令。

常见得命令有

help  打开官方的使用页面介绍，所有的命令都会列出来

cls    清屏  (Ctrl+x 也可以清屏)

select  选择会话的命令

?.png  用来选择png后缀的图片

bpu  截获request


###Fiddler中设置断点修改Request

Fiddler最强大的功能莫过于设置断点了，设置好断点后，你可以修改httpRequest 的任何信息包括host, cookie或者表单中的数据。设置断点有两种方法

第一种：打开Fiddler 点击Rules-> Automatic Breakpoint  ->Before Requests(这种方法会中断所有的会话)

如何消除命令呢？  点击Rules-> Automatic Breakpoint  ->Disabled

第二种:  在命令行中输入命令:  bpu www.baidu.com   (这种方法只会中断www.baidu.com)

如何消除命令呢？  在命令行中输入命令 bpu