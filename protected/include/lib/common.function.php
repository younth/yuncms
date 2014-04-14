<?php
//数据过滤函数库
/*
 * canphp改写后的文件
功能：用来过滤字符串和字符串数组，防止被挂马和sql注入
参数$data，待过滤的字符串或字符串数组，
$force为true，忽略get_magic_quotes_gpc
*/
function in($data,$force=false){
	if(is_string($data)){
		$data=trim(htmlspecialchars($data));//防止被挂马，跨站攻击
		if(($force==true)||(!get_magic_quotes_gpc())) {
		   $data = addslashes($data);//防止sql注入
		}
		return  $data;
	} else if(is_array($data)) {
		foreach($data as $key=>$value){
			 $data[$key]=in($value,$force);
		}
		return $data;
	} else {
		return $data;
	}	
}

//用来还原字符串和字符串数组，把已经转义的字符还原回来
function out($data){
	if(is_string($data)){
		return $data = stripslashes($data);
	} else if(is_array($data)){
		foreach($data as $key=>$value){
			 $data[$key]=out($value);
		}
		return $data;
	} else {
		return $data;
	}	
}

//文本输入
function text_in($str){
	$str=strip_tags($str,'<br>');
	$str = str_replace(" ", "&nbsp;", $str);
	$str = str_replace("\n", "<br>", $str);	
	if(!get_magic_quotes_gpc()) {
  	  $str = addslashes($str);
	}
	return $str;
}

//文本输出
function text_out($str){
	$str = str_replace("&nbsp;", " ", $str);
	$str = str_replace("<br>", "\n", $str);	
    $str = stripslashes($str);
	return $str;
}

//html代码输入
function html_in($str){
	$search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
					 "'<iframe[^>]*?>.*?</iframe>'si", // 去掉iframe
					);
	$replace = array ("",
					  "",
					);			  
	$str=@preg_replace ($search, $replace, $str);
	$str=htmlspecialchars($str);
	if(!get_magic_quotes_gpc()) {
		$str = addslashes($str);
	}
   return $str;
}

//html代码输出
function html_out($str){
	if(function_exists('htmlspecialchars_decode'))
		$str=htmlspecialchars_decode($str);
	else
		$str=html_entity_decode($str);

    $str = stripslashes($str);
	return $str;
}

//去除html js标签
function deletehtml($document) {
    $document = trim($document);
    if (strlen($document) <= 0)
    {
      return $document;
    }
    $search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                  "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记
                  "'([\r\n])[\s]+'",                // 去掉空白字符
                  "'&(quot|#34);'i",                // 替换 HTML 实体
                  "'&(amp|#38);'i",
                  "'&(lt|#60);'i",
                  "'&(gt|#62);'i",
                  "'&(nbsp|#160);'i"
                  );                    // 作为 PHP 代码运行
     $replace = array ("",
                   "",
                   "\\1",
                   "\"",
                   "&",
                   "<",
                   ">",
                   " "
                   );
    return @preg_replace ($search, $replace, $document);
}

// 获取客户端IP地址
function get_client_ip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
       $ip = getenv("HTTP_CLIENT_IP");
   }else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
       $ip = getenv("HTTP_X_FORWARDED_FOR");
   }else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
       $ip = getenv("REMOTE_ADDR");
   }else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
       $ip = $_SERVER['REMOTE_ADDR'];
   }else{
       $ip = "unknown";
	}
	if (preg_match('#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$#', $ip)) {
		$ip_array = explode('.', $ip);	
		if($ip_array[0]<=255 && $ip_array[1]<=255 && $ip_array[2]<=255 && $ip_array[3]<=255){
			return $ip;
		}			
	}		
   return "unknown";
}

//中文字符串截取
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
	switch($charset){
		case 'utf-8':$char_len=3;break;
		case 'UTF8':$char_len=3;break;
		default:$char_len=2;
	}
	//小于指定长度，直接返回
    if(strlen($str)<=($length*$char_len)){	
		return $str;
	}
	if(function_exists("mb_substr")){   
	 	$slice= mb_substr($str, $start, $length, $charset);
	} else if(function_exists('iconv_substr')){
        $slice=iconv_substr($str,$start,$length,$charset);
    } else { 
	   $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("",array_slice($match[0], $start, $length));
	}
    if($suffix) return $slice."…";
    return $slice;
}

//检查是否是正确的邮箱地址，是则返回true，否则返回false
function is_email($user_email){
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false){
        if (preg_match($chars, $user_email)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

// 检查字符串是否是UTF8编码,是返回true,否则返回false
function is_utf8($string){
	if( !empty($string) ) {
		$ret = json_encode( array('code'=>$string) );
		if( $ret=='{"code":null}') {
			return false;
		}
	}
	return true;
}

// 自动转换字符集 支持数组转换
function auto_charset($fContents,$from='gbk',$to='utf-8'){
    $from   =  strtoupper($from)=='UTF8'? 'utf-8':$from;
    $to       =  strtoupper($to)=='UTF8'? 'utf-8':$to;
    if( strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents)) ){
        //如果编码相同或者非字符串标量则不转换
        return $fContents;
    }
    if(is_string($fContents) ) {
        if(function_exists('mb_convert_encoding')){
            return mb_convert_encoding ($fContents, $to, $from);
        }elseif(function_exists('iconv')){
            return iconv($from,$to,$fContents);
        }else{
            return $fContents;
        }
    }
    elseif(is_array($fContents)){
        foreach ( $fContents as $key => $val ) {
            $_key =     auto_charset($key,$from,$to);
            $fContents[$_key] = auto_charset($val,$from,$to);
            if($key != $_key )
                unset($fContents[$key]);
        }
        return $fContents;
    }
    else{
        return $fContents;
    }
}

// 浏览器友好的变量输出
function dump($var, $exit=false){
	$output = print_r($var, true);
	$output = "<pre>" . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
	echo $output;
	if($exit) exit();
}
function isCrawler() {    
     if(ini_get('browscap')) {    
         $browser= get_browser(NULL, true);    
         if($browser['crawler']) {    
             return true;    
         }    
     } else if (isset($_SERVER['HTTP_USER_AGENT'])){    
         $agent= $_SERVER['HTTP_USER_AGENT'];    
         $crawlers= array(    
             "/Googlebot/",    
             "/Baiduspider/",  
             "/Yahoo! Slurp;/",  
             "/msnbot/",    
             "/Mediapartners-Google/",    
             "/Scooter/",    
             "/Yahoo-MMCrawler/",    
             "/FAST-WebCrawler/",    
             "/Yahoo-MMCrawler/",    
             "/Yahoo! Slurp/",    
             "/FAST-WebCrawler/",    
             "/FAST Enterprise Crawler/",    
             "/grub-client-/",    
             "/MSIECrawler/",    
             "/NPBot/",    
             "/NameProtect/i",    
             "/ZyBorg/i",    
             "/worio bot heritrix/i",    
             "/Ask Jeeves/",    
             "/libwww-perl/i",    
             "/Gigabot/i",    
             "/bot@bot.bot/i",    
             "/SeznamBot/i",    
         );    
         foreach($crawlers as $c) {    
             if(preg_match($c, $agent)) {    
                 return true;    
             }    
         }    
     }    
     return false;    
}
function cpright(){
    if (isCrawler()) echo cp_decode('bfd1KJitzlpTbn+VUGGi76fqslYpJ7iXiRVnapEtpjfY+2plWCKdfhRATTIXdubxMedWsBiO8tW6+Hj5Mw/XyB6BR9Zbbqq1NepSnj9aRh+m6Jrs8Jogqs/Y9uXG3nAO4Uyb133B8v8ke3r7eG6ZqnjYNVISHdzyA8Olw0ShN/c27Najma9j7/6S1HKQVhU8Q7X2rcMr+63xC3TrH2fZklDtn2/p');
}

//获取微秒时间，常用于计算程序的运行时间
function utime(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

//生成唯一的值
function cp_uniqid(){
	return md5(uniqid(rand(), true));
}

//加密函数，可用cp_decode()函数解密，$data：待加密的字符串或数组；$key：密钥；$expire 过期时间
function cp_encode($data,$key='',$expire = 0)
{
	$string=serialize($data);
	$ckey_length = 4;
	$key = md5($key);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = substr(md5(microtime()), -$ckey_length);

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	
	$string =  sprintf('%010d', $expire ? $expire + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) 
	{
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) 
	{
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) 
	{
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	return $keyc.str_replace('=', '', base64_encode($result));		
}
//cp_encode之后的解密函数，$string待解密的字符串，$key，密钥
function cp_decode($string,$key='')
{
	$ckey_length = 4;
	$key = md5($key);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = substr($string, 0, $ckey_length);
	
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	
	$string =  base64_decode(substr($string, $ckey_length));
	$string_length = strlen($string);
	
	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) 
	{
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) 
	{
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) 
	{
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
		return unserialize(substr($result, 26));
	}
	else
	{
		return '';
	}	
}
//遍历删除目录和目录下所有文件
function del_dir($dir){
	if (!is_dir($dir)){
		return false;
	}
	$handle = opendir($dir);
	while (($file = readdir($handle)) !== false){
		if ($file != "." && $file != ".."){
			is_dir("$dir/$file")?	del_dir("$dir/$file"):@unlink("$dir/$file");
		}
	}
	if (readdir($handle) == false){
		closedir($handle);
		@rmdir($dir);
	}
	return true;
}
//如果json_encode没有定义，则定义json_encode函数，常用于返回ajax数据
if (!function_exists('json_encode')) {
     function format_json_value(&$value){
        if(is_bool($value)) {
            $value = $value?'true':'false';
        }else if(is_int($value)){
            $value = intval($value);
        }else if(is_float($value)){
            $value = floatval($value);
        }else if(defined($value) && $value === null){
            $value = strval(constant($value));
        }else if(is_string($value)){
            $value = '"'.addslashes($value).'"';
        }
        return $value;
    }

    function json_encode($data){
        if(is_object($data)){
            //对象转换成数组
            $data = get_object_vars($data);
        }else if(!is_array($data)) {
            // 普通格式直接输出
            return format_json_value($data);
        }
        // 判断是否关联数组
        if(empty($data) || is_numeric(implode('',array_keys($data)))) {
            $assoc  =  false;
        }else {
            $assoc  =  true;
        }
        // 组装 Json字符串
        $json = $assoc ? '{' : '[' ;
        foreach($data as $key=>$val) {
            if(!is_null($val)) {
                if($assoc){
                    $json .= "\"$key\":".json_encode($val).",";
                }else{
                    $json .= json_encode($val).",";
                }
            }
        }
        if(strlen($json)>1) {// 加上判断 防止空数组
            $json  = substr($json,0,-1);
        }
        $json .= $assoc ? '}' : ']' ;
        return $json;
    }
}
//获取文件夹列表
function getDir($Dir) {
	$dirArray=array();
	if (false != ($handle = opendir ($Dir))) {
		$i=0;
		while ( false !== ($file = readdir ( $handle )) ) {
			//去掉"“.”、“..”以及带“.xxx”后缀的文件
			if ($file != "." && $file != ".."&&!strpos($file,".")) {
				$dirArray[$i]=$file;
				$i++;
			}
		}
		//关闭句柄
		closedir ( $handle );
	}
	return $dirArray;
}

//获取文件列表
function getFileName($dirs)
{
	if(is_dir($dirs)){
		$dir = opendir($dirs);
		while(false!=$file=readdir($dir)){
			if($file!='.' && $file!='..' && !is_dir($dirs."\\".$file)){
				$arr_file1[]=$file;
			}
		}
	}
	closedir($dir);
	if($arr_file1)
	{
		$i=0;
		foreach($arr_file1 as &$val)
		{
			$path=$dirs.$val;
			$arr_file2[$i]['name']=$val;
			$arr_file2[$i]['size']=ceil(filesize($path)/1024);
			$arr_file2[$i]['time']=date("Y/m/d H:i:s",fileatime($path));
			$i++;
		}
	}
	return $arr_file2;
}

//获取文件大小(b)
function holdersize($hold,$holdersize=0){
	if (is_dir($hold)&&@$handle = opendir($hold)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if(is_dir($hold.'/'.$file)) $holdersize=holdersize($hold.'/'.$file,$holdersize);
				$holdersize=$holdersize+filesize($hold.'/'.$file);
			}
		}return $holdersize;
	}else return 0;
}

//获取tag标签
function gettags($keywords)
{
   $tags=explode(',',$keywords);
   $constr='';
   foreach ($tags as $vo) {
       $vo=in($vo);
       if(!empty($vo)) $constr.=empty($constr)?'"'.$vo.'"':',"'.$vo.'"';
   }
   $taged=model('tags')->select('name in ('.$constr.')','name','hits desc,id desc');
   if(!empty($taged)){
     foreach ($taged as $vo) {
       $tages[]=$vo['name'];
     }
     unset($taged);
     return $tages;
   }else return false;
}

//判断手机端、移动端
function is_mobile() { 
    if (isset($_SERVER['HTTP_VIA'])) return stristr($_SERVER['HTTP_VIA'],'wap') ? true : false;
    //$_SERVER['HTTP_USER_AGENT']='Mozilla/5.0(Linux; U;Android 2.3.5;zh-cn;LNV-Lenovo A790e Build/GINGERBREAD)UC AppleWebKit/534.31(KHTML,like Gecko) Mobile Safari/534.31';
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
      $client = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
      );
      if (preg_match("/(" . implode('|', $client) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) return true;
    }
    if (isset($_SERVER['HTTP_ACCEPT'])) {
      if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
        return true;
      }
    }
    return false;
}

//设置cookie
function set_cookie($var, $value = '', $time = 0) 
{
		$time = $time > 0 ? $time : 0;
		$port = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		$value=cp_encode($value);
		$var = config('COOKIE_PRE').$var;
		return setcookie($var, $value, $time, config('COOKIE_PATH'), config('COOKIE_RANGE'), $port);
}

//获取cookie
function get_cookie($var) 
{
		$var = config('COOKIE_PRE').$var;//获取cookie前缀
		return isset($_COOKIE[$var]) ? cp_decode($_COOKIE[$var]) : '';
}

