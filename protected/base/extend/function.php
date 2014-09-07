<?php
/*
 *  拓展的函数库，整个系统共用的函数库
 * */
require(CP_PATH . 'lib/common.function.php');
require(CP_PATH . 'ext/template_ext.php');

//调试运行时间和占用内存
function debug($flag='system', $end = false){
	static $arr =array();
	if( !$end ){
		$arr[$flag] = microtime(true); 
	} else if( $end && isset($arr[$flag]) ) {
		echo  '<p>' . $flag . ': runtime:' . round( (microtime(true) - $arr[$flag]), 6)
			 . '	memory_usage:' . memory_get_usage()/1000 . 'KB</p>'; 
	}
}

//保存配置
function save_config($app, $new_config = array()){
	if( !is_file($app) ){
		$file = BASE_PATH . 'apps/' . $app. '/config.php';
	}else{
		$file = $app;
	}
	
	if( is_file($file) ) {
		$config = require($file);
		$config = array_merge($config, $new_config);
	}else{
		$config = $new_config;
	}
	$content = var_export($config, true);
	$content = str_replace("_PATH' => '" . addslashes(BASE_PATH), "_PATH' => BASE_PATH . '", $content);

	if( file_put_contents($file, "<?php \r\nreturn " . $content . ';' ) ) {
		return true;
	}
	return false;
}

//修改配置参数时候对false 和true的处理
function conReplace($value){
	if($value=='true') return true;
	if($value=='false') return false;
	if(preg_match("/^\d*$/",$value) && strlen($value)<10 && !empty($value)) return intval($value);
	return $value;
}

//复制文件夹
function copy_dir($src, $dst) {
 // if (file_exists($dst)) del_dir($dst);
  if (is_dir($src)) {
    mkdir($dst);
    $files = scandir($src);
    foreach ($files as $file)
    if ($file != "." && $file != "..") copy_dir("$src/$file", "$dst/$file");
  }
  else if (file_exists($src)) copy($src, $dst);
}

//无限分类重排序
function re_sort($data){
	$max_sort = 0;
	foreach($data as $i => $n){   //获得最大深度
		if($n['deep'] > $max_sort) $max_sort = $n['deep'];
	}
	foreach($data as $i => $n){
		for($x=1; $x<=$max_sort; $x++){
			if($n['deep'] == $x){
				${'rela_'.$x}[] = $n;  //每个深度一个数组$real_i,存放一行所有数据
			}
		}
	}
	for($i=1; $i<=$max_sort; $i++){
		if(is_array(${'rela_'.$i})){
			foreach (${'rela_'.$i} as $o => $p) {
				${'sort_'.$i}[$o] = $p['norder']; //每个深度一个数组$sort_i,该行的指定排序
			}
			array_multisort(${'sort_'.$i},SORT_ASC,${'rela_'.$i});//$real_i按$sort_i排序
		}
	}
	if(is_array($rela_1)){//多个顶级分类
		foreach($rela_1 as $i => $n){
			$all_column_1[] = $n;
			if(!is_array($rela_2)) break;
			foreach($rela_2 as $x => $y){
				if(stristr($y['path'],$n['id'])) $all_column_1[] = $y;//将二级分类放在对应一级父分类后
			}
		}
	}
	if(empty($rela_1)) $all_column_1 = $rela_2; //无顶级分类
	for($i=2; $i<$max_sort; $i++){
		if(empty(${'rela_'.$i})) ${'all_column_'.$i} = ${'rela_'.($i+1)};
		if(is_array(${'all_column_'.($i-1)})){
			foreach(${'all_column_'.($i-1)} as $o => $p){
				${'all_column_'.$i}[] = $p;
				if($p['deep'] == $i){
					foreach(${'rela_'.($i+1)} as $e => $r){
						if(stristr($r['path'],$p['id'])) ${'all_column_'.$i}[] = $r;//将子分类放在对应父分类后
					}
				}
			}
		}
	}
	$all_column = ${'all_column_' . ($max_sort-1)};
	if(empty($all_column) || $max_sort == 1) $all_column = $rela_1;
	return $all_column;
}

//图片剪切方法
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
{//参数说明：剪切后图片路径、原图路径、剪切框宽度、剪切框高度、剪切框左上顶点坐标、剪切后图片与选中部分宽度比
list($imagewidth, $imageheight, $imageType) = getimagesize($image);
$imageType = image_type_to_mime_type($imageType);
$newImageWidth = ceil($width * $scale);
$newImageHeight = ceil($height * $scale);
$newImage = @imagecreatetruecolor($newImageWidth,$newImageHeight);
switch($imageType) {
	case "image/gif":
		$source= @imagecreatefromgif($image);
		break;
	case "image/pjpeg":
	case "image/jpeg":
	case "image/jpg":
		$source= @imagecreatefromjpeg($image);
		break;
	case "image/png":
	case "image/x-png":
		$source= @imagecreatefrompng($image);
		break;
}
@imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
switch($imageType) {
	case "image/gif":
		@imagegif($newImage,$thumb_image_name);
		break;
	case "image/pjpeg":
	case "image/jpeg":
	case "image/jpg":
		@imagejpeg($newImage,$thumb_image_name,90);
		break;
	case "image/png":
	case "image/x-png":
		@imagepng($newImage,$thumb_image_name);
		break;
}
chmod($thumb_image_name,  0644);
return $thumb_image_name;
}

//获取菜单URL,根据不同的类型
function getURL($type,$method,$url,$id,$extendid=0)
{
	switch ($type) {
		case 5:
			$urls=explode(',',$url);
			$url=$urls[0];
			if(!empty($urls[1])){
				$para=array();
				$arr=explode('/',$urls[1]);
				foreach ($arr as $v) {
					$ele=explode('=',$v);
					$para[$ele[0]]=$ele[1];
				}
			}
			return ($extendid==0) ? empty($para)?url($url):url($url,$para) : $url;
			break;
		case 4:
			return url($method);
			break;
		default:
			return url('default/'.$method,array('id'=>$id));//形成url
			break;
	}
}

//前台模板直接查询数据库调用
function getlist($html)
{
	$html = stripslashes($html);
	preg_match_all('/(\S+)=\((.*)\)/iU', $html, $matches);
	$get = array_combine($matches[1], $matches[2]);
	$table = in($get['table']);
	$extable= in($get['extable']);
	$field =in($get['field']);
	$field = $field ? $field :'*';
	$limit = in($get['limit']);
	$desc = $get['order'];
	$condition = $get['where'];
	$sort=$get['sort'];
	//echo $right;
	//拼凑right查询
	if(!empty($sort)) $condition=$condition.' AND RIGHT(path,6)='.$sort;
	//echo $condition;
	if('news'==$table || 'photo'==$table){//资讯、图集处理
		$column= in($get['column']);
		$nocolumn= in($get['nocolumn']);
		$place = in($get['place']);
		$noplace = in($get['noplace']);
		$exfield = in($get['exfield']);
		 
		//栏目限定
		if(!empty($column)){
			if(strpos($column,',')!==false){
				$cols=explode(',', $column);
				$colcondition='';
				foreach ($cols as $vo) {
					if(!empty($vo)) $colcondition.=empty($colcondition)?"(sort like '%".$vo."%'":" OR sort like '%".$vo."%'";
				}
				$colcondition.=')';
				$condition.=empty($condition)?$colcondition: 'AND'.$colcondition;
			}else $condition.=empty($condition)?"sort like '%".$column."%'":" AND sort like '%".$column."%'";
		}
		//反向栏目
		if(!empty($nocolumn)){
			if(strpos($nocolumn,',')!==false){
				$cols=explode(',', $nocolumn);
				foreach ($cols as $vo) {
					if(!empty($vo)) $condition.=empty($condition)?"sort not like '%".$vo."%'":" AND sort not like '%".$vo."%'";
				}
			}else $condition.=empty($condition)?"sort not like '%".$nocolumn."%'":" AND sort not like '%".$nocolumn."%'";
		}

		//定位
		if(!empty($place)) {
			$places=explode(',',$place);
			if(empty($places[1])) {
				$place=intval($places[0]);
				$condition.=empty($condition)?"places like '%".$place."%'":" AND places like '%".$place."%'";
			}else {
				$placecd='';
				foreach ($places as $vo) {
					$vo=intval($vo);
					if(!empty($vo)) $placecd.=empty($placecd)?"places like '%".$vo."%'":" OR places like '%".$vo."%'";
				}
				if(!empty($placecd)) $condition.=empty($condition)?"(".$placecd.")":" AND (".$placecd.")";
			}
		}

		//反向定位
		if(!empty($noplace)) {
			$noplaces=explode(',',$noplace);
			if(empty($noplaces[1])) {
				$noplace=intval($noplaces[0]);
				$condition.=empty($condition)?"places not like '%".$noplace."%'":" AND places not like '%".$noplace."%'";
			}else {
				$noplacecd='';
				foreach ($noplaces as $vo) {
					$vo=intval($vo);
					if(!empty($vo)) $noplacecd.=empty($noplacecd)?"places not like '%".$vo."%'":" AND places not like '%".$vo."%'";
				}
				if(!empty($noplacecd)) $condition.=empty($condition)?$noplacecd:" AND ".$noplacecd;
			}
		}
		//默认排序
		if(empty($desc)) $desc='recmd desc,norder desc,addtime desc';
	

		if(!(strpos($field,'id')!==false) && '*'!=$field) $field.=',id';
		if(!(strpos($field,'method')!==false) && '*'!=$field) $field.=',method';
		if(!empty($extable) && '*'!=$field && !(strpos($field,'extfield')!==false)) $field.=',extfield';

		$list = model($table)->select($condition,$field,$desc,$limit);
		if(empty($list)) return $list;

		$i=0;
		$ids='';
		//一次处理
		foreach ($list as $vo) {
			$list[$i]['url']=Check::url($vo['method'])?$vo['method']:url($vo['method'],array('id'=>$vo['id']));
			if(strpos($field,'picture')!==false){
				switch ($table) {
					case 'news':
						$list[$i]['picturepath']=__ROOT__.'/upload/news/image/'.$vo['picture'];
						break;
					case 'photo':
						$list[$i]['picturepath']=__ROOT__.'/upload/photos/thumb_'.$vo['picture'];
						break;
				}
			}
			//栏目id获取
			if(!empty($vo['sort'])) $list[$i]['sort']=substr($vo['sort'],-6);
			if(!empty($vo['extfield'])) $ids.=empty($ids)?$vo['extfield']:','.$vo['extfield'];
			$i++;
		}
		if(!empty($extable) && !empty($ids)){}
		return $list;
	}
	
	$list= model($table)->select($condition,$field,$desc,$limit); //通用
	if(strpos($field,'picture')!==false && !empty($list)){
		switch ($table) {
			case 'link'://友情链接进行处理
				$i=0;
				foreach ($list as $vo) {
					if(!empty($vo['logourl'])) $list[$i]['picturepath']=$vo['logourl'];
					if(!empty($vo['picture'])) $list[$i]['picturepath']=__ROOT__.'/upload/links/image/'.$vo['picture'];
					$i++;
				}
				break;
		}
	}
	return $list;
}

//开启session,优化：增加session路径和有效期设置
function session_starts($time=9600)
{
	if(!isset($_SESSION)){
		$time=$time>0?$time:0;
		session_set_cookie_params($time);
		$sessionPath = realpath(ROOT_PATH.'data/session/');
		session_save_path($sessionPath);
		session_start();
	}
}

//敏感词过滤函数,参数为待转换的字符串
function dobadword($str)
{
	//构造新的badword
	$file=BASE_PATH.'/badwords.txt';//加载敏感字配置文件
	if (is_file($file))$badword = file($file);//读取为数组
	$newbadword=array_combine($badword, array_fill(0,count($badword),'**'));
	$str = strtr($str, $newbadword);
	return $str;
}

//会员密码加密
function codepwd($password)
{
	return md5(substr(md5($password),7,-7));
}

//编辑器上传管理
function EditFileManagerJson($filename)
{
	$root=__ROOT__;
	//根目录路径，可以指定绝对路径，比如 /var/www/attached/
	$root_path =ROOT_PATH.'upload/'.$filename.'/';
	//根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
	$root_url = $root.'/upload/'.$filename.'/';
	//图片扩展名
	$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

	//目录名
	$dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
	if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
		echo "Invalid Directory name.";
		exit;
	}
	if ($dir_name !== '') {
		$root_path .= $dir_name . "/";
		$root_url .= $dir_name . "/";
		if (!file_exists($root_path)) {
			mkdir($root_path);
		}
	}
	//根据path参数，设置各路径和URL
	if (empty($_GET['path'])) {
		$current_path = realpath($root_path) . '/';
		$current_url = $root_url;
		$current_dir_path = '';
		$moveup_dir_path = '';
	} else {
		$current_path = realpath($root_path) . '/' . $_GET['path'];
		$current_url = $root_url . $_GET['path'];
		$current_dir_path = $_GET['path'];
		$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
	}
	echo realpath($root_path);
	//排序形式，name or size or type
	global $order;
	$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

	//不允许使用..移动到上一级目录
	if (preg_match('/\.\./', $current_path)) {
		echo 'Access is not allowed.';
		exit;
	}
	//最后一个字符不是/
	if (!preg_match('/\/$/', $current_path)) {
		echo 'Parameter is not valid.';
		exit;
	}
	//目录不存在或不是目录
	if (!file_exists($current_path) || !is_dir($current_path)) {
		echo 'Directory does not exist.';
		exit;
	}
	//遍历目录取得文件信息
	$file_list = array();
	if ($handle = opendir($current_path)) {
		$i = 0;
		while (false !== ($filename = readdir($handle))) {
			if ($filename{0} == '.') continue;
			$file = $current_path . $filename;
			if (is_dir($file)) {
				$file_list[$i]['is_dir'] = true; //是否文件夹
				$file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
				$file_list[$i]['filesize'] = 0; //文件大小
				$file_list[$i]['is_photo'] = false; //是否图片
				$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
			} else {
				$file_list[$i]['is_dir'] = false;
				$file_list[$i]['has_file'] = false;
				$file_list[$i]['filesize'] = filesize($file);
				$file_list[$i]['dir_path'] = '';
				$file_ext = strtolower(array_pop(explode('.', trim($file))));
				$file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
				$file_list[$i]['filetype'] = $file_ext;
			}
			$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
			$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
			$i++;
		}
		closedir($handle);
	}
	usort($file_list,array('commonController','EditSort'));//该函数在自定义函数中
	$result = array();
	//相对于根目录的上一级目录
	$result['moveup_dir_path'] = $moveup_dir_path;
	//相对于根目录的当前目录
	$result['current_dir_path'] = $current_dir_path;
	//当前目录的URL
	$result['current_url'] = $current_url;
	//文件数
	$result['total_count'] = count($file_list);
	//文件列表数组
	$result['file_list'] = $file_list;
	//输出JSON字符串
	$json = new ServicesJson();
	echo $json->encode($result);
}

//编辑器上传
function EditUploadJson($filename)
{
	$root=__ROOT__;
	//文件保存目录路径
	$php_path = ROOT_PATH.'upload/';
	$php_url = $root.'/upload/';
	//文件保存目录路径
	$save_path = $php_path.$filename.'/';
	//文件保存目录URL
	$save_url = $php_url.$filename.'/';
	//定义允许上传的文件扩展名
	$ext_arr = array(
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf'),
	);
	//最大文件大小
	$max_size = intval(config('fileupSize'));

	$save_path = realpath($save_path) . '/';

	//有上传文件时
	if (empty($_FILES) === false) {
		//原文件名
		$file_name = $_FILES['imgFile']['name'];
		//服务器上临时文件名
		$tmp_name = $_FILES['imgFile']['tmp_name'];
		//文件大小
		$file_size = $_FILES['imgFile']['size'];
		//检查文件名
		if (!$file_name) {
			$this->AlertJson("请选择文件。");
		}
		//检查目录
		if (@is_dir($save_path) === false) {
			$this->AlertJson("上传目录不存在。");
		}
		//检查目录写权限
		if (@is_writable($save_path) === false) {
			$this->AlertJson("上传目录没有写权限。");
		}
		//检查是否已上传
		if (@is_uploaded_file($tmp_name) === false) {
			$this->AlertJson("临时文件可能不是上传文件。");
		}
		//检查文件大小
		if ($file_size > $max_size) {
			$this->AlertJson("上传文件大小超过限制。");
		}
		//检查目录名
		$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
		if (empty($ext_arr[$dir_name])) {
			$this->AlertJson("目录名不正确。");
		}
		//获得文件扩展名
		$temp_arr = explode(".", $file_name);
		$file_ext = array_pop($temp_arr);
		$file_ext = trim($file_ext);
		$file_ext = strtolower($file_ext);
		//检查扩展名
		if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
			$this->AlertJson("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
		}
		//创建文件夹
		if ($dir_name !== '') {
			$save_path .= $dir_name . "/";
			$save_url .= $dir_name . "/";
			if (!file_exists($save_path)) {
				mkdir($save_path);
			}
		}
		$ymd = date("Ymd");
		$save_path .= $ymd . "/";
		$save_url .= $ymd . "/";
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
		//新文件名
		$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
		//移动文件
		$file_path = $save_path . $new_file_name;
		if (move_uploaded_file($tmp_name, $file_path) === false) {
			$this->AlertJson("上传文件失败。");
		}

		$file_url = $save_url . $new_file_name;
		//图片加水印
		if(config('ifwatermark') && in_array($file_ext,$ext_arr['image']))//是否加水印
		{
			$Image = new Image();
			$logo = ROOT_PATH.'public/watermark/'.config('watermarkImg');//水印图
			$Image->water($file_path,$logo,config('watermarkPlace')); //执行
		}
		@chmod($file_path, 0644);
		$json = new ServicesJson();
		echo $json->encode(array('error' => 0, 'url' => $file_url));
		exit;
	}
}

//获取用户名的首字母  英文 汉子 数字的处理
function getFirstCharter($str){
	if(empty($str)){return '';}
	$fchar=ord($str{0});
	if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
	$s1=iconv('UTF-8','gb2312',$str);
	$s2=iconv('gb2312','UTF-8',$s1);
	$s=$s2==$str?$s1:$str;
	$asc=ord($s{0})*256+ord($s{1})-65536;
	if($asc>=-20319&&$asc<=-20284) return 'A';
	if($asc>=-20283&&$asc<=-19776) return 'B';
	if($asc>=-19775&&$asc<=-19219) return 'C';
	if($asc>=-19218&&$asc<=-18711) return 'D';
	if($asc>=-18710&&$asc<=-18527) return 'E';
	if($asc>=-18526&&$asc<=-18240) return 'F';
	if($asc>=-18239&&$asc<=-17923) return 'G';
	if($asc>=-17922&&$asc<=-17418) return 'H';
	if($asc>=-17417&&$asc<=-16475) return 'J';
	if($asc>=-16474&&$asc<=-16213) return 'K';
	if($asc>=-16212&&$asc<=-15641) return 'L';
	if($asc>=-15640&&$asc<=-15166) return 'M';
	if($asc>=-15165&&$asc<=-14923) return 'N';
	if($asc>=-14922&&$asc<=-14915) return 'O';
	if($asc>=-14914&&$asc<=-14631) return 'P';
	if($asc>=-14630&&$asc<=-14150) return 'Q';
	if($asc>=-14149&&$asc<=-14091) return 'R';
	if($asc>=-14090&&$asc<=-13319) return 'S';
	if($asc>=-13318&&$asc<=-12839) return 'T';
	if($asc>=-12838&&$asc<=-12557) return 'W';
	if($asc>=-12556&&$asc<=-11848) return 'X';
	if($asc>=-11847&&$asc<=-11056) return 'Y';
	if($asc>=-11055&&$asc<=-10247) return 'Z';
	return '#';//未查找到 的
}


function timeshow($sTime) {
	//sTime=源时间，cTime=当前时间，dTime=时间差
	$cTime		=	time();
	
        if($cTime>=$sTime){
        $dTime		=	$cTime - $sTime;
	$dDay		=	intval(date("Ymd",$cTime)) - intval(date("Ymd",$sTime));
	$dYear		=	intval(date("Y",$cTime)) - intval(date("Y",$sTime));
	if( $dTime < 60 ){
		$dTime =  $dTime."秒前";
	}elseif( $dTime < 3600 ){
		$dTime =  intval($dTime/60)."分钟前";
	}elseif( $dTime >= 3600 && $dDay == 0  ){
		$dTime =  "今天".date("H:i",$sTime);
	}elseif($dYear==0){
		$dTime =  date("m月d日 H:i",$sTime);
	}else{
		$dTime =  date("Y年m月d日 H:i",$sTime);
	}
        }
        else {
            $dTime=$sTime - $cTime;
            $dDay		=	intval(date("Ymd",$cTime)) - intval(date("Ymd",$sTime));
	$dYear		=	intval(date("Y",$cTime)) - intval(date("Y",$sTime));
	if( $dTime < 60 ){
		$dTime =  $dTime."秒后";
	}elseif( $dTime < 3600 ){
		$dTime =  intval($dTime/60)."分钟后";
	}elseif( $dTime >= 3600 && $dDay == 0  ){
		$dTime =  "今天".date("H:i",$sTime);
	}elseif($dYear==0){
		$dTime =  date("m月d日 H:i",$sTime);
	}else{
		$dTime =  date("Y年m月d日 H:i",$sTime);
	}
        }
	return $dTime;
}

//对一个给定的二维数组按照指定的键值进行排序
function array_sort($arr,$keys,$type='asc'){
    $keysvalue = $new_array = array();
    foreach ($arr as $k=>$v){
        $keysvalue[$k] = $v[$keys];
    }
    if($type == 'asc'){
        asort($keysvalue);
    }else{
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k=>$v){
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}