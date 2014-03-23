<?php
/*
 * 文件管理控制器
 * */
class filesController extends commonController
{
	public function index()
	{
	   $dirget=in($_GET['dirget']);//文件目录名
	   //echo $dirget;
	   $urls=str_replace(',','/',$dirget);//替换之后的url
	   //echo $urls;
	   $dirs=str_replace(',','/',$dirget);
	   //echo $dirs;
	   //若为空则是upload目录下面的子目录，不为空则显示当前目录下的文件，显示为物理地址
	   $dirs=empty($dirs)?ROOT_PATH.'upload':ROOT_PATH.'upload'.$dirs;
	   //echo $dirs;
       if(is_dir($dirs)){
		 $dir = opendir($dirs);//打开目录
		 $i=0;
		 //循环读取当前目录下的文件或者文件夹
		 while(false!=$file=readdir($dir)){
			if($file!='.' && $file!='..'){
				$arr_file1[$i]['name']=$file;
				$path=$dirs."/".$file;
				if(is_dir($path)) $arr_file1[$i]['type']=1;//type=1文件夹
				else{
					//是文件
			        $arr_file1[$i]['size']=ceil(filesize($path)/1024);//计算文件的大小
			        $arr_file1[$i]['time']=date("Y-m-d H:i:s",fileatime($path));//文件的时间

			        $names=explode('.',$file);
			        $names[1]=strtolower($names[1]);
			        $allowType=explode(',',strtolower(config('allowType')));
			        if(in_array($names[1],$allowType)){
			        	//type=2是图片
                       if($names[1]='jpg' || $names[1]='bmp' || $names[1]='gif' ||$names[1]='png') $arr_file1[$i]['type']=2;
                       else $arr_file1[$i]['type']=3;
			        }else $arr_file1[$i]['type']=4;
				}
			    $i++;
			}
		  }
	   }
	   closedir($dir);
	   $this->upload=__UPLOAD__;
	   //echo __UPLOAD__;
	   $this->dirget=$dirget;//文件路径
	   $this->urls=$urls.'/';//URL路径
	   //print_r($arr_file1);
	   $this->list=$arr_file1;//当前目录下面的所有文件处理后的信息或者文件夹信息
	   
	   //面包屑导航，从哪里来，还可以回去
	   $FilesArr=explode(',', $dirget);//逗号分隔数组
	   //print_r($FilesArr);
	   $daohang='<a href="'.url('files/index').'">文件列表</a>';//当前位置

	   for($i=1;$i<count($FilesArr);$i++){
	   	 $pl=strpos($dirget,','.$FilesArr[$i]);
	   	 $len=strlen($FilesArr[$i]);
	   	 $dirdao=substr($dirget,0,$pl+$len+1);
	   	 $daohang.=' > <a href="'.url('files/index',array('dirget'=>$dirdao)).'">'.$FilesArr[$i].'</a>';
	   }
	   //echo $daohang;
	   $this->daohang=$daohang;
	   $this->display();
	}
	
	//ajax删除文件,输出的为data的内容
	public function del()
	{
	   $dirs=in($_GET['fname']);
	   $dirs=str_replace(',','/',$dirs);//变成文件地址
	   $dirs=ROOT_PATH.'upload'.$dirs;//变成物理地址
	   //is_dir() 函数检查指定的文件是否是目录
	   if(is_dir($dirs)){del_dir($dirs); echo 1;} //删除目录
	   //file_exists() 函数检查文件是否存在
	   elseif(file_exists($dirs)){
	   	 if(unlink($dirs)) echo 1;//删除文件
	   }else echo '文件不存在'; 
	}
}