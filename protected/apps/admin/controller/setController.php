<?php
/*
 * 前台模板管理，切换，增加，修改，删除
 * */
class setController extends commonController
{
	// 显示主设置
	public function index()
	{
		$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		if(!$this->isPost()){
			//未提交，显示
			$this->config=$config;
			$this->display();
		}else{
			//接收表单数据，直接接收post,不是数组提交，需要保证name与config里面的名字一样
			
			$newconfig = $_POST; 
			//dump($newconfig['tongji']);return;
			//$newconfig['tongji']=t($newconfig['tongji']);
			//echo $newconfig['tongji'];return;
			
			//将url规则转换为数组
			//echo $_POST['REWRITE'];return;
			//处理比较复杂
			if(empty($newconfig['REWRITE'])) $newconfig['REWRITE']=array();
			else{
               $rewrites=explode("\r\n",$newconfig['REWRITE']);
               $newconfig['REWRITE']=array();
               if(!empty($rewrites)){
               	   foreach ($rewrites as $value) {
               	      if(!empty($value)) $rewrite=explode("=",$value);
               	      if(!empty($rewrite[1])){
               	      	$rewrite[0]=trim($rewrite[0]);
               	      	$rewrite[1]=trim($rewrite[1]);
               	      	$newconfig['REWRITE'][$rewrite[0]]=$rewrite[1];
               	      } 
                   }
               }
			}
            if(!($config['REWRITE']===$newconfig['REWRITE'])){
                del_dir(config('HTML_CACHE_PATH'));
            }
			$config['REWRITE']=array();
			foreach ($newconfig as $key => $value) {
				if(is_array($value)){
					foreach ($value as $k=> $v) {
						$config[$key][$k]=conReplace($v);
					}
				}else $config[$key] = conReplace($value);
			}
			//保存修改的配置
			if (save_config(BASE_PATH . '/config.php',$config)) {
				$this->success('设置修改成功~');
			} else {
				$this->error('设置修改失败');
			}
		}
	}
	
	//后台方法显示、编辑
	public function menuname()
	{
		$list=model('method')->select('','','rootid,id');//查询method表，按rootid id查询
		if(!$this->isPost()){
			$this->list= $list;//给模板赋值list数组变量
			$this->display();
		}else{
			//菜单显示设置
			$menu=implode(',',$_POST['menu']);//implode 将数组元素合并成字符串
			//echo $menu;
			model('method')->update("id IN($menu) AND rootid!= 0","ifmenu='1'");//除app应用外
			model('method')->update("id NOT IN($menu) AND rootid!=0","ifmenu='0'");
			//方法名称设置
			$menuname=$_POST['mname'];
			foreach ($list as $vo){
				$name=in(trim($menuname[$vo['id']]));
				if($vo['name']!=$name && $vo['operate']!=$name && !empty($name))//除app应用外
				model('method')->update("id='".$vo['id']."'","name='$name'");
			}
			$this->success('设置成功',url('set/menuname'));
		}
	}
	
	//增加后台方法
	public  function menuadd()
	{
		$list=model('method')->select('pid=0 and rootid!=0','','rootid,id');//查询method表，按rootid id查询
		if(!$this->isPost()){
			$this->list= $list;//给模板赋值list数组变量
			$this->display();
		}else{
		//添加
		if(empty($_POST['operate'])||empty($_POST['name']))$this->error('请填写完整的信息~');
		$data=array();
		$data['name']=in($_POST['name']);
		$data['operate']=in($_POST['operate']);
		$data['ifmenu']=$_POST['ifmenu'];
		$data['pid']=$_POST['pid'];
		//rootid的处理  如果pid=0 rootid=id  否则rootid=pid
		//不是顶级分类，
		if($_POST['pid']!=0)
		{
			$data['rootid']=$_POST['pid'];
			if(model('method')->insert($data)) $this->success('添加功能成功~',url('set/menuname'));
			else $this->error('添加功能失败');
		}
		//作为顶级分类
		elseif($_POST['pid']==0)
		{
			$id=model('method')->insert($data);
			$data['rootid']=$id;
			//更新rootid
			if(model('method')->update("id='$id'",$data)) $this->success('添加功能成功~',url('set/menuname'));
			else $this->error('添加功能失败');
		}
		}
	}
	
	//删除后台方法，暂时不做，太危险
	
	
	//邮件配置，写入配置文件
	public function email()
	{
		$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		if(!$this->isPost()){
			//未提交，显示
			$this->config=$config;
			$this->display();
		}else{
			//接收表单数据，直接接收post,不是数组提交，需要保证name与config里面的名字一样
			$newconfig = $_POST;
			//dump($newconfig);return;
			//对提交的数据进行处理
			foreach ($newconfig as $key => $value) {
				if(is_array($value)){
					foreach ($value as $k0 => $v0) {
						if(is_array($v0)){
							foreach ($v0 as $k1=> $v1) {
								$config[$key][$k0][$k1]=conReplace($v1);
							}
						}else $config[$key][$k0]=conReplace($v0);
					}
				}else $config[$key] = conReplace($value);
			}
			
			//保存修改的配置
			if (save_config(BASE_PATH . '/config.php',$config)) {
				$this->success('设置修改成功~',url('set/email'));
			} else {
				$this->error('设置修改失败');
			}
		}		
	}
	
	//测试发送邮件，直接发送，不存入数据库
	public function sendemail()
	{
		$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		$mail_to=$config['myemail'];
		$mail_subject="测试邮件";//邮件标题 
		$mail_body="这是一封测试邮件！";
		//print_r($config['EMAIL']);return;
		//为何读取不到email配置信息啊................
	
		//$email=new Email($config['EMAIL']);//初始化类
		//print_r($email::$config);return ;
		//echo $config['EMAIL']['SMTP_FROM_TO'];return ;
		Email::init($config['EMAIL']);//初始化配置
		$re=Email::send($mail_to, $mail_subject, $mail_body);
		if($re)$this->success("发送成功！",url('set/email'));
		else $this->error("邮件发送失败，请检查邮箱账号密码是否正确");
	}
	
	
	//清空缓存
	public function clear()
	{
		$path['db']=config('DB_CACHE_PATH');
		$path['temp']=config('TPL_CACHE_PATH');
		$path['html']=config('HTML_CACHE_PATH');
		if(empty($_GET['file'])){
			$this->dbsize=intval(holdersize($path['db'])/1024);
			$this->temsize=intval(holdersize($path['temp'])/1024);
			$this->htmlsize=intval(holdersize($path['html'])/1024);
			$this->display();
		}else{
			$file=$_GET['file'];
			if(del_dir($path[$file])) echo '<div class="inputhelp">清空成功~</div>';
			else echo '<div class="inputhelp">已经是空里了~</div>';
		}
	}

	/*
	 * 模板管理，管理前台模板，实质操作为读取文件
	 * */
	private $tpath='apps/default/view/';//前台模板路径
	
	//前台选择
	public function tpchange($appname='default')
	{
		$config=appConfig($appname);//获取default的config信息,后面要修改
		//print_r($config);
		//echo $config['TPL']['TPL_TEMPLATE_PATH'];
		if(empty($config['TPL']['TPL_TEMPLATE_PATH'])) $this->error('该应用不支持多模版');
		if(!$this->isPost()){
			//未提交数据，则显示
			$templepath=BASE_PATH . $this->tpath;//前台模板路径
			//echo $templepath;
			$tps=getDir($templepath);//获取文件夹列表
			//print_r($tps);
			foreach ($tps as $vo){
				$infofile=$templepath.$vo.'/info.php';//获取每个模板文件夹里面的info.php
				//echo $infofile."<br>";
				if(file_exists($infofile))
				   $tpinfo[$vo]=require($infofile);//载入info.php作为$tpinfo的二维数组
				else $tpinfo[$vo]=array();
			}
			
			//print_r($tpinfo);
			$this->tpinfo=$tpinfo;//每个模板的信息数组赋值给tpinfo，可以考虑通过模板引擎的数组传值到前台模板
			//default的config信息
			$this->fileNow=$config['TPL']['TPL_TEMPLATE_PATH'];//当前模板文件名
			$this->fileNowMobile=$config['TPL']['TPL_TEMPLATE_PATH_MOBILE'];//当前移动端模板文件名
			$this->display();
		}else{
			//ajax接收post提交的数据,ajax里面输出的内容的信息被接收为data，js里面会alert
			$tpfile = $_POST['tpfile'];//模板名称
			$type = intval($_POST['type']);
			//echo $tpfile."~".$type;
			if(empty($tpfile)) $this->error('参数错误~');
			$tpname=$type?'TPL_TEMPLATE_PATH_MOBILE':'TPL_TEMPLATE_PATH';//判断模板类型,电脑或移动端
			
			if($tpfile!=$config['TPL'][$tpname]){
				//切换模板时
				$tpcachepath=substr(config('TPL_CACHE_PATH'), 0, -1);
				if(is_dir($tpcachepath)) del_dir($tpcachepath);//清除模板缓存
				
				$config['TPL'][$tpname]=$tpfile;
				//保存配置信息到default config.php里面，这里面保存选择模板的配置信息
				//print_r($config);
				if (save_config($appname,$config)){
					echo 1;
					return;
				}
				else{
					echo '模板设置失败~';
					return;
				}
			}
           echo '当前模板已经使用~';
		}
	}
	
	//模板文件列表
	public function tplist()
	{
	   $tpfile=$_GET['Mname'];//get获取
	   if(empty($tpfile)) $this->error('非法操作~');
       $templepath=BASE_PATH . $this->tpath.$tpfile.'/';//模板的地址
       //echo $templepath;
       $list=getFileName($templepath);//获取文件列表，包括文件名，大小，修改时间
       //print_r($list);
       $this->tpfile=$tpfile;//赋值变量给模板, 模板名称
       $this->flist=$list;//模板目录文件数组
       $this->display();
	}

	//添加模板
	public function tpadd()
	{
	   $tpfile=$_GET['Mname'];//目录名
	   if(empty($tpfile)) $this->error('非法操作~');
	   $templepath=BASE_PATH . $this->tpath.$tpfile.'/';//文件路径
	   
	   if(!$this->isPost()){
	   	//未提交，显示
	   	 $this->tpfile=$tpfile;
	   	 $this->display();
	   }else{
	   	//post提交
	   	 $filename=trim($_POST['filename']);
	   	 $code=stripcslashes($_POST['code']);
	   	 if(empty($filename)||empty($code)) $this->error('文件名和内容不能为空');
         $filepath=$templepath.$filename.'.php';
         try{
			file_put_contents($filepath, $code);//内容存放到文件，文件无则自动创建
		  } catch(Exception $e) {
			$this->error('模板文件创建失败！');
		  }	
		  $this->success('模板文件创建成功！',url('set/tplist',array('Mname'=>$tpfile)));
	   }
	}

	//修改模板文件
	public function tpedit()
	{
	   $tpfile=$_GET['Mname'];//模板目录名
	   $filename=$_GET['fname'];//文件名
	   if(empty($tpfile) || empty($filename)) $this->error('非法操作~');
	   
	   if(!$this->isPost()){
	   	//未提交，则显示文件内容
          $this->tpfile=$tpfile;
          $this->filename=$filename;
	   	  $this->display();
	   }else{
	   	//修改代码通过post方式
           $code=$_POST['code'];
           if(empty($code)) $this->error('模板内容不能为空~');
		   try{
		      $filepath=BASE_PATH . $this->tpath.$tpfile.'/'.$filename;
			  file_put_contents($filepath, stripcslashes($code));//把内容写入文件
		   } catch(Exception $e) {
			   $this->error('模板文件保存失败！');
		   }
		   $this->success('模板保存成功！',url('set/tplist',array('Mname'=>$tpfile)));
	   }
	   
	}
	//读取文件内容,ajax方式，函数输出内容为ajax的data内容
	public function tpgetcode()
	{
	   $tpfile=$_POST['Mname'];//模板目录名
	   $filename=$_POST['fname'];//文件名
	   if(empty($tpfile) || empty($filename)) $this->error('非法操作~');
	   $filepath=BASE_PATH . $this->tpath.$tpfile.'/'.$filename;//文件路径地址
	   try{
			$code = file_get_contents($filepath);//读取文件内容
			echo $code;//输出文件内容返回
		  } catch(Exception $e) {
			echo '读取文件失败';
		}
	}

	//删除模板文件，参数为：模板名称+文件名称，没有删除的动作，通过js执行删除，不可以传参数过来？应该也可以啊
	public function tpdel()
	{
       $tpfile=$_GET['Mname'];
	   $filename=$_GET['fname'];
	   if(empty($tpfile) || empty($filename)) $this->error('非法操作~');
	   $filepath=BASE_PATH . $this->tpath.$tpfile.'/'.$filename;
	   try{
			@unlink($filepath);//删除文件，必须要找到文件的物理路径
		} catch(Exception $e) {
			$this->error('文件删除失败！');
		}	
		$this->success('文件删除成功~',url('set/tplist',array('Mname'=>$tpfile)));
	}
}