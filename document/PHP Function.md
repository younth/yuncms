common function
===================
###*容易疏忽的有用的函数*


1.**strtr()** 函数转换字符串中特定的字符。
 strtr(string,from,to)或者strtr(string,array)数组，其中的键是原始字符，值是目标字符。

2.**array_combine()** 函数通过合并两个数组来创建一个新数组，其中的一个数组是键名，另一个数组的值为键值。两个参数必须有相同数目的元素。

3.**array_fill()** 函数用给定的值填充数组，返回的数组有 number 个元素，值为 value。

4.**str_replace()** 函数使用一个字符串替换字符串中的另一些字符。

5.**strtotime()** 函数将任何英文文本的日期时间描述解析为 Unix 时间戳。

6.**time()** 函数返回当前时间的 Unix 时间戳。

7.**defined()** 函数检查某常量是否存在。


###yuncms模板中常用函数
```
函数：text_in($str)
说明：文本输入，用于textarea文本区域的内容换行和空格处理
参数：
$str：字符串

函数：text_out($str)
说明：文本输出，用于textarea文本区域的内容换行和空格处理
参数：
$str：字符串

函数： html_in($str)
说明：html代码输入，用于在线编辑器提交的数据过滤， 
注意此函数会过滤掉iframe和js代码，且html_out()不能还原js代码
参数：
$str：含html代码的字符串。

函数：html_out($str)
说明：html代码输出，用于还原过滤后的文章内容
参数：
$str：经过转义后的html代码字符串

函数：get_client_ip()
说明：获取客户端ip地址
参数：
如果能成功获取ip地址，返回ip地址，否则返回'unknown'。
使用方法：
    $ip=get_client_ip();
    
函数：msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
说明：中文字符串截取
参数：
$str：要截取的字符串。
$start：开始截取的字符，一般从0开始。
$length：截取的字符长度，按字符计算，不是按字节计算。
$charset：字符串的编码。utf-8,gbk,gb2312,big5
$suffix：字符串过长，截断之后是否显示"……"。
使用方法：
    msubstr($str, 0, 20);//截取20个字符
    
函数：is_email($user_email)
说明：检查是否是正确的邮箱地址，是则返回true，否则返回false
参数：
$user_email：给定的邮箱地址。
使用方法：
    if(!is_email($user_email))
    {
        echo '邮箱地址不正确';
    }
```