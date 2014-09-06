####PhpStorm是一款强大的IDE，非常适合于PHP开发人员及前端工程师。

>本地修改记录：在项目名称上右键，点击Local History | Show History。你可以看到项目文件各个历史版本；Alt+Shift+C，可以看到项目最近的修改。这就是它的版本集成功能特性。


----------


>最近编辑：Ctrl+E。可以快速打开你最近编辑的文件。


----------
>代码分界线：打开File | Setting | Editor，选择Appearance下面的Show Method Separators。它会将你的代码按方法，用灰色线框进行智能分割。你还可以使用：alt+↑或↓，在方法之间进行跳转。


----------
>皮肤切换：Ctrl+反引号，可以快速切换皮肤。


----------
>快速查看样式：在HTML标签上进行右键，选择Show Applied Styles For Tag。可以快速查看该标签应用的样式。类似于前端开发工程师常用的firebug。


----------
>查找和替换：当前文件中的文本查找和替换使用Ctrl+F和Ctrl+R；


###如何解决中文乱码
>打开：File -> Settings -> Appearance，这里可以设置你的软件界面的字体
>建议这里选一个中文字体，比如微软雅黑,宋体之类，或者别的什么的。 


###如何添加js库
>file->setting->javascript->libraries->download->official libraries
>然后选择类库

###phpstorm没有保存操作(ctrl+s)，所有的操作都是直接存储,就连刷新都不需要，自动刷新！！



###如何取消自动保存并标识修改的文件为星星标记
再强大的IDE都有一些不合理的地方，phpstrom自动保存就是一个非常不合理的地方，phpstrom默认会对每一个修改进行保存，这个默认的设置功能有时候可能会给我们带来一些不必要的麻烦
1、取消自动保存
进入 File -> Settings ->General，取消下面两选项的勾选：

![phpstorm](https://raw.githubusercontent.com/younth/image/master/phpstorm/1.gif)


2、星星标记

进入 File -> Settings -> Editor -> Editor Tabs，勾选下面选项：
![phpstorm](https://raw.githubusercontent.com/younth/image/master/phpstorm/2.gif)

即可实现保存了。



###phpstorm怎么设置php文件在浏览器中运行
在run/debug configration中的debault下拉选项中，配置php wab application,然后配置测试web服务器
这样在每个文件单机右键就会有open in browser .....

###右上角的run debug linsten
run就是运行，但是运行的不一定是当前的文件，鼠标右键运行的就是当前的文件。
>phpstorm运行php需要配置php解析器！！



###史上最靠谱的php调试！！没有之一！！(phpStorm+XDebug的断点调试)

####1.首先，下载安装phpstorm及xdebug
>phpstorm:http://www.jetbrains.com/phpstorm/ 当然网上有各种破解的Key
>xdebug:http://www.xdebug.org/ 官网很详细的了。值得注意的是，如何下载合适的版本？
>在download的releases那段最后有句话：if you don't know which one you need, please refer to the custom installation instructions.
>好吧，说的这么明白了。点击，然后复制你的phpinfo内容。他会自己帮你检测的。
>此过程可能出现，php版本过低，没有对应的xdebug,这种情况只能自己升级php了。我用的是xamppV3.2.1，亲测可用。

####2.配置
###最先配置的应该是php的解析器！！！
files->setting->PHP->Interpreter 然后配置，现在php.exe文件的路径
**服务器daunting配置**
在安装目录下找到php.ini，类似于D:\xampp\php\php.ini，并打开
最下面被注释了几行，建议自己按下面的格式去添加：
```
zend_extension = "C:\xampp\php\ext\php_xdebug.dll"
xdebug.remote_enable=on
;此地址为IDE所在IP
xdebug.remote_host = "127.0.0.1"
xdebug.remote_port=9000
; 可以是任意Key，这里设定为PHPSTORM
xdebug.idekey="PHPSTORM"
```

然后重启apache

*下面检测一下是否成功安装了xdegbug:*

cmd 进入你的xamp下面的php目录
D:/xampp/php/php.exe -m

服务器端配置完毕！


**客户端配置,即配置phpstorm**
打开phpStorm，进入File>Settings>PHP>Servers，这里要填写服务器端的相关信息，name填localhost，host填localhost，port填80，debugger选XDebug

进入File>Settings>PHP>Debug，看到XDebug选项卡，port填9000，其他默认

进入File>Settings>PHP>Debug>DBGp Proxy，IDE key 填 phpStorm，host 填localhost，port 填80

*配置浏览器*
chrome/firefox:下载xdebug插件。然后进行设置。点击那个小虫的图标（在浏览器输入url的右侧，找不到就输入localhost就会出来），进行设置：
具的设置里的IDE KEY填上phpStorm，把localhost加入到白名单，以后调试的时候把工具启用就好了。

**连接调试**
还记得phpstorm右上角那几个图标吧。点击那个电话的按钮，开始监听。然后在浏览器运行文件，遇到断点就会自动断开到phpstorm进行调试了。

参考：
[http://www.tuicool.com/topics/11120019?st=0&lang=1](http://www.tuicool.com/topics/11120019?st=0&lang=1)

[phpstorm里面ftp的使用](http://www.wwwquan.com/show-66-121-1.html)







其他一些便捷操作
====
 - 启动的时候不打开工程文件 Settings->General去掉Reopen last project on startup.
 - 用*标识编辑过的文件Editor –> Editor Tabs 选中Mark modifyied tabs with asterisk 
 - 编码设置:FILE ->Settings->       有3处设置根据自己需要设置
IDE Encondings：IDE编码 ，选择 IDE Encoding为GBK。这边要自己去调整了
Project Encoding：项目编码
Default encoding for properties files：默认文件编码


优化文件保存
File->Settings->General->
Synchronize file on frame activation：个人需要是否取消同步文件
Save files on framedeactivation：取消
Save files automatically：选中，设置自动保存，设置 30秒自动保存时间，这样IDE依然可以自动保持文件,所以在每次切换时，你需要按下Ctrl+S保存文件


###快捷键
查询快捷键
CTRL+N   查找类
CTRL+SHIFT+N  查找文件，打开工程中的文件
CTRL+SHIFT+ALT+N 查 找类中的方法或变量(JS)
CIRL+B   找变量的来源，跳到变量申明处
CTRL+ALT+B  找所有的子类
CTRL+SHIFT+B  找变量的 类
CTRL+G   定位行，跳转行
CTRL+F   在当前窗口查找文本
CTRL+SHIFT+F  在指定窗口查找文本
CTRL+R   在 当前窗口替换文本
CTRL+SHIFT+R  在指定窗口替换文本
ALT+SHIFT+C  查找修改的文件，最近变更历史
CTRL+E   最近打开的文件
F3   向下查找关键字出现位置
SHIFT+F3  向上一个关键字出现位置
F4   查找变量来源
CTRL+ALT+F7  选 中的字符 查找工程出现的地方
ALT+F7 直接查询选中的字符

自动代码
ALT+回车  导入包,自动修正
CTRL+ALT+L  格式化代码
CTRL+ALT+I  自动缩进
CTRL+ALT+O  优化导入的类和包
CTRL+E  最近更改的文件/代码
CTRL+SHIFT+SPACE 切换窗口
CTRL+空格  代码提示
CTRL+ALT+SPACE  类 名或接口名提示（与系统冲突）
CTRL+P   方法参数提示，显示默认参数
CTRL+J   自动代码提示，自动补全
CTRL+ALT+T  把选中的代码放在 TRY{} IF{} ELSE{} 里
ALT+INSERT  生成代码(如GET,SET方法,构造函数等)
复制快捷方式
F5   拷贝文件快捷方式
CTRL+C   复制
CTRL+V   粘贴
CTRL+D   复制行
CTRL+X   剪 切,删除行
CTRL+SHIFT+V  可以复制多个文本 

高亮
CTRL+F   选中的文字,高亮显示 上下跳到下一个或者上一个
F2  高亮错误或警告快速定位
SHIFT+F2  高亮错误或警告快速定位
CTRL+SHIFT+F7  高亮显示多个关键字. 

其他快捷方式
CTRL+Z   倒退(代码后悔)
CTRL+SHIFT+Z  向前
CTRL+H   显 示类结构图
CTRL+Q   显示代码注释
CTRL+W   选中代码，连续按会 有其他效果
CTRL+B   快速打开光标处的类或方法
CTRL+O   魔术方法
CTRL+/   注释//  
CTRL+SHIFT+/  注释/*...*/
ctrl+[]   匹配 {}[]
ctrl+shift+[]    选中块代码
ctrl + '-/+': 可以折叠项目中的任何代码块,包括htm中的任意nodetype=3的元素，function,或对象直接量等等。它不是选中折叠，而是自动识别折叠。

ctrl + '.': 折叠选中的代码的代码

ctrl+shift+u      字母大小写转换 
ctrl+shift+i      快速查看变量或方法定义源
CTRL+ALT+F12  资源管理器打开文件夹，跳转至当前文件在磁盘上的位置
ALT+F1   查找文件所在目录位置
SHIFT+ALT+INSERT 竖编辑模式

CTRL+ALT ←/→  返回上次编辑的位置
ALT+ ←/→  切换代码视图，标签切换
ALT+ ↑/↓  在方法间快速移动定位
alt + '7': 显示当前的类/函数结构。类似于eclipse中的outline的效果。试验了一下，要比aptana的给力一些，但还是不能完全显示prototype下面的方法名。
SHIFT+F6  重构-重命名
不但可以重命名文件名，而且可以命名函数名，函数名可以搜索引用的文件，还可以重命名局部变量。还可以重命名标签名。在sublime text中有个类似的快捷键：ctrl+shift+d。

ctrl+shift+enter(智能完善代码 如 if()) 
ctrl+shift+up/down(移动行、合并选中行，代码选中区域 向上/下移动) 
CTRL+UP/DOWN  光标跳转到编辑器显示区第一行或最后一行下
ESC   光标返回编辑框
SHIFT+ESC  光 标返回编辑框,关闭无用的窗口
F1   帮助 千万别按,很卡!
CTRL+F4   非常重要 下班都用

###常用的快捷键
>ctrl+f12:显示当前文件的结构
>ctrl + x: 剪切(删除)行，不选中，直接剪切整个行，如果选中部分内容则剪切选中的内容
>ctrl+d:行复制，*之前的编辑器都是删除当前行*，现在删除当前行可以ctrl+x
>ctrl + /:单行注释
>ctrl+shift+/:块注释
>ctrl+r:替换
>####** ctrl + shift + n**: 打开工程中的文件(hbuilder里面的ctrl+t)，目的是打开当前工程下任意目录的文件。
>  ctrl + shift + i : 如果是css中的class则显示当前class详细信息,如果是js则显示function的详细信息(想象一下，如果在jquery的方法上查看详细 信息，就直接可以看到实现代码了)，如果是php，那当时还是function的详细信息

>ctrl + '-/+': 可以折叠项目中的任何代码块，包括htm中的任意nodetype=3的元素，function,或对象直接量等等。它不是选中折叠，而是自动识别折叠。



####在列表中直接打字搜索，即可！！！