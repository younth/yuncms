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

###phpstorm没有保存操作(ctrl+s)，所有的操作都是直接存储


###常用的快捷键
>ctrl+f12:显示当前文件的结构
>ctrl + x: 剪切(删除)行，不选中，直接剪切整个行，如果选中部分内容则剪切选中的内容
>ctrl+d:行复制，*之前的编辑器都是删除当前行*，现在删除当前行可以ctrl+x
>ctrl + /:单行注释
>ctrl+shift+/:块注释
>ctrl+r:替换
> ctrl + shift + n: 打开工程中的文件(hbuilder里面的ctrl+t)，目的是打开当前工程下任意目录的文件。
>  ctrl + shift + i : 如果是css中的class则显示当前class详细信息,如果是js则显示function的详细信息(想象一下，如果在jquery的方法上查看详细 信息，就直接可以看到实现代码了)，如果是php，那当时还是function的详细信息

>ctrl + '-/+': 可以折叠项目中的任何代码块，包括htm中的任意nodetype=3的元素，function,或对象直接量等等。它不是选中折叠，而是自动识别折叠。

###如何取消自动保存并标识修改的文件为星星标记
再强大的IDE都有一些不合理的地方，phpstrom自动保存就是一个非常不合理的地方，phpstrom默认会对每一个修改进行保存，这个默认的设置功能有时候可能会给我们带来一些不必要的麻烦
1、取消自动保存
进入 File -> Settings ->General，取消下面两选项的勾选：

![phpstorm](https://raw.githubusercontent.com/younth/image/master/phpstorm/1.gif)


2、星星标记

进入 File -> Settings -> Editor -> Editor Tabs，勾选下面选项：
![phpstorm](https://raw.githubusercontent.com/younth/image/master/phpstorm/2.gif)

即可实现保存了。

http://www.th7.cn/Program/php/201310/157315.shtml

http://www.tuicool.com/topics/11120019?st=0&lang=1


http://solf.me/debug-php-with-xdebug-in-phpstorm/


使用技巧：
http://blog.csdn.net/fenglailea/article/details/12166617

http://www.wwwquan.com/show-66-121-1.html

http://www.tuicool.com/topics/11120019?st=0&lang=1


debug:
http://www.chenxuanyi.cn/xampp-phpstorm-xdebug.html

http://blog.csdn.net/dc_726/article/details/9905517


检测是否安装了xdebug:
D:/xampp/php/php.exe -m