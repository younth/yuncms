###zend studio是一款强大的PHP开发工具，此文档归纳整理该套工具的用法
####下载
版本：9.04
####*如何破解*
```
34E606CF10C3E4CF202ABCEAA9B0B7A64DD2C5862A514B944AAAB38E3EB8A5F2CD735A2AB4CF9B952590EFA62BA0AB2B3E5D99C33C55309EE143165AC7F1817D626574615F3B32312F31312F323031313B392E303B3030313B313B3330
```
上面是破解码，除了这个，还需要覆盖一个叫做`com.zend.php.core_9.0.4.201210081806`的文件。这样重启之后就破解了。

####*如何收缩代码*
>当我们使用zend studio打开一个代码很长，方法很多的php文件时，会显得很杂乱，而且在阅读时要找一个不知道方法名的方法时，就比较难找。
>windows->preferences>editor->code folding  functions选中即可。


####*如何设置字体及其大小*
>设置方法：windows->preferences>general->appearance->colors and fonts->text font  edit即可。

####*如何安装插件*
>有时候会安装aptana插件，在help->install new software....
  

####*如何卸载插件*
>help->about zend studio 左下角：installation details

####*如何更换主题*
>菜单栏–help–install new software…添加一个更新源,就是点击界面的add按钮,在新窗口的location位置输入http://eclipse-color-theme.github.com/update/,然后上边的Name自己随便起
>然后ok.
选择你刚添加的更新源,稍等后应该能看到下边有eclipse_color_theme这个插件了,勾选,安装,同意协议,等等,然后重启Zend Studio.
菜单栏–window-preference,直接搜索theme,选主题即可.


####*如何设置编码*
>选择window菜单->Preferences->General->Workspace，在界面当中找到“Text file encoding” 选中Other,在下拉列表中选择UTF-8就可以了。这样所有的建立的项目将使用utf-8的编码。
>如果想某个项目使用其它编码，选中项目右键点击，在菜单中选择Preferences,弹出窗口左侧选择“Resource”,在右侧当中找到“Text file encoding” 选中Other,在下拉列表中选择你要的编码就可以了


####*如何修改字体颜色*
>Window->Preferences->PHP->Editor->Syntax Coloring
>下面提供一套仿dreamweaver的着色方案，仅供参考。
中文英文HEXRGB变量Variable#0066FF0,102,255字符串String#CC00000,12,0常数/内部常数constants/internal constants#55220085,34,0数字Number#FF0000255,0,0保留关键字Keyword#0066000,102,0块分隔符PHP tags#FF0000255,0,0注释PHPDoc comment#FF9900255,135,0注释PHPDoc#FF4400255,68,0单/多行注释Single/Multi-line comment#FF9900255,135,0


####*如何进行两个文件的比较*
>选中你要比较的两个文件，右键点击，在弹出来的菜单中选取Compare With -> Each Other,这时会开启一个比较编辑器，就可以进行两个文件的比较了。

####*快捷键*
>此部分引自互联网，可对照Window->Preferences->General->Keys。
　　CTRL+B | 重构项目
　　CTRL+D | 删除一行
　　CTRL+E | 搜索已打开的文件名
　　CTRL+F | 打开本文件的搜索/替换 ，只搜索当前文件
　　CTRL+H | 打开搜索替换窗口 ，可搜索整个磁盘、工作集
　　CTRL+K | 查找下一个
　　CTRL+SHIFT+K | 查找上一个
　　CTRL+L | 转到文件某一行
　　CTRL+M | 将当前编辑窗口最大化/还原
　　CTRL+N | 新建
　　CTRL+O | 快速大纲, 列出文件中的所有变量和方法，对阅读类文件时很有用
　　CTRL+P | 打印
　　CTRL+W | 关闭打开的文件
>CTRL+数字键/ | 可以收起/展开代码段
　　CTRL+/ | 单行注释
　　CTRL+BACKSPACE |删除光标前一个单词，这个单词的定义由ZEND自已理解，如前面是符号，就删除一个符号,前面是一个单词就删除一个单词
　　CTRL+SHIFT+/ | 先选中代码块后，按组合键可注释代码块
　　CTRL+SHIFT+\ | 取消块注释
　　Tab/Shift+Tab | 增加/减少代码缩进
　　ALT+ENTER | 查看当前文档的属性
　　CTRL+SHIFT+F | 快速格式化代码样式，可选择ZF的代码格式 ( PS 如何设置格式化的样式，可在“首选项”-> “代码样式” -> “格式化程序” 里设置)
　　ALTER+ ->或<- | 在编辑过的位置前进或后退
　　CTRL+SHIFT+L | 显示所有快捷键列表(个人称之为“新手键”)
　　CTRL+F12 | 打开任务(| PS：任务 个人定义某一个特定的工作集,如你要完成一个注册模块，有三个文件config.phpregister.class.php register.php| 你可以将这些文件保存成一个任务register ,只要打开register就能同时打开这三个文件| )
　　CTRL+F9 | 激活任务
　　CTRL+SHIFT+F9 | 取消任务
　　F11 | 调试当前文件
　　CTRL+F11 | 运行
　　F3 | 打开声明 ，在工作集下可用
　　SHIFT+F2 | 打开PHP手册帮助,查看函数的详细说明
CTRL+HOME 或 CTRL+END | 光标移到文件头或到文件尾
　　SHIFT+HOME 或SHIFT+END | 选中从光标处到行首或行尾的文字
　　CTRL+SHIFT+M | 搜索方法名

####Zend Studio调试快捷键

>F9 | 添加/删除断点 所有代码部分
　　F10 | 逐过程。单步执行调试文件到下一行
　　F5 | 开始执行。执行调试文件，直到遇到断点。
　　F8 | 调试URL。打开调试URL对话框
　　F12 | 概要文件URL。打开profile URL对话框
　　Shift+F8 | 添加监视点。打开添加监视点对话框
　　Shift+F11 | 跳出。单步执行到返回后执行的第一行
　　F11 | 逐语句。单步执行到下一被执行的行
　　Shift+F10 | 执行到光标行。执行代码到光标所在行。
　　Ctrl+F5 | 无中断的执行脚本
　　Shift+F5 | 停止调试器
　　Ctrl+Alt+B | 在浏览器中显示