<?php
/*
 * 测试功能类，开发的，大家测试
 * */
class testController extends commonController
{
		static protected $uploadpath='';//封面图路径
		static protected $test='';//test
	    public function __construct()
		{
			parent::__construct();
			$this->test=ROOT_PATH.'upload/member/test/';//封面图路径
			$this->path=__ROOT__.'/upload/member/test/';//图片路径
			//$this->yun='yun';//封面图路径
		}

      //ajax图片上传,需要写入数据库
      public function uploadimg()
      {
      	if(!$this->isPost()){
      		$this->display();
      	}else{
      		//$_FILES['picture']['name'] 文件名称
      		//上传的方法
      		if (empty($_FILES['picture']['name']) === false){
      			$tfile=date("Ymd");//时间作为文件夹
      			if(!is_dir($this->test)) mkdir($this->test);//没有则创建文件夹
      			//upload函数
      			$imgupload= $this->upload($this->test.$tfile.'/',config('imgupSize'),'jpg,bmp,gif,png');
      			//$imgupload->saveRule='thumb_'.time();//上传文件命名规则
      			$imgupload->saveRule=time();
      			//上传缩略图
      			$imgupload->upload();//上传
      			$fileinfo=$imgupload->getUploadFileInfo();//取得上传文件的信息,可以直接echo出来
      			$errorinfo=$imgupload->getErrorMsg();//取得上传文件的出错信息
      			//dump($fileinfo);
      			if(!empty($errorinfo)){
      				//出错处理
      				//$data['picture']=$this->nopic;
      				$this->alert($errorinfo);
      			}
      			else{
      				//成功返回上传的信息，并写入数据库
      				//model('feedback_pic')->insert($data);
      				foreach ($fileinfo as $row=>$v)
      				{
      					$fileinfo[$row]['newname']=$tfile.'/'.$v['savename'];//时间文件夹+文件名,用户存入数据库
      					$fileinfo[$row]['size']=round($v['size']/1024,2);//转化为k
      				}
      				//dump($fileinfo[0]);
      				// echo $tfile.'/'.$fileinfo[0]['savename'];//时间文件夹+文件名,用于存放数据表中
      				echo json_encode($fileinfo[0]);
      			}
      		}
      	}
      }
      
      //删除上传的图片
      public function delpic()
      {
      	$path=$_GET['path'];
      	if(unlink($path)) echo 1;
      }
      
      //对数组进行增加或者修改
      public function addrow()
      {
      	$test=array(
      			'name'=>'wangyang',
      			'sex'=>1
      	);
      	foreach ($test as $row=>$v){
      		//$test['name']='yunstudio';
      		//$test['school']='changsha';
      		$test[$row]=array(4,5,6);
      	}
      	dump($test);
      }
}