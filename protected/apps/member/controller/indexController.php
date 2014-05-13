<?php
/*
 * 会员管理首页控制器，该部分为单独模块
 * */
class indexController extends commonController
{
	    public function __construct()
		{
			parent::__construct();
			$this->uploadpath=ROOT_PATH.'upload/member/feed/';//封面图路径
			$hover="class=\"current\"";//设置当前的导航状态
			$this->hover_index=$hover;
		}
	
		//要用protected类型
		protected  function getUrls(){
			//url参数
			$this->url_postfeed=  url('index/postfeed');
			$this->url_showcomment=  url('index/showcomment');
			$this->url_postcomment=  url('index/postcomment');
			$this->url_zan=  url('index/zan');
			$this->url_losezan=  url('index/losezan');
			$this->url_showpic=  url('index/showpic');
			$this->url_delpic=  url('index/delpic');
			$this->url_loadwater=  url('index/loadwater');
			$this->url_mayknow=  url('index/mayknow');
			$this->url_repost_feed=url('index/repost_feed');
		}
		
	    public function index()
	        {
            //判断是否登录
            //新浪微博的session信息,还需要判断是不是第一次用新浪微博登陆
            //注意使用新闻微博登录没有存储本地cookie
            $weibo_uid=$_SESSION['token']['access_token'];
            $auth=$this->auth;//本地登录的cookie信息
            if(empty($auth)&&empty($weibo_uid)) $this->redirect(url('member/account/login'));//未登录， 跳转到登录页面
            if($weibo_uid)
            {
                    //找出该微博key的用户
                    $acc=model("member_login")->member_weibo($weibo_uid);
                    if($acc) $this->uname=$acc['uname'];//绑定了，读出用户信息
            }
            if($auth&&$acc['is_active']=1) $this->uname=$auth['uname'];
			$this->my=$user=model("member")->user_profile($this->auth['id'],'');//个人信息
			//推荐关注，跟我的专业相关,自己未关注的公司
			$list= model('company_fans')->corp_recmd($auth['id']);
			$this->rec_follow=$list;
            $this->getUrls();
            $this->loadAds=1;
            $this->path=__ROOT__.'/upload/company/license/';
            $this->display();
	        }

	   //瀑布流加载，进入加载
        public function loadWater(){
        	$num=5;
        	$list=intval($_POST['list']);
        	$limit=($list*$num).','.$num;
        	//读取我的联系人
        	$type=$_POST['type']?$_POST['type']:1;
        	switch ($type)
        	{
        		case 1://全部
        			$condition='';
        			break;
        		case 2://联系人
        			$condition=model("member_card")->mycardstring($this->auth['id']);
        			break;
        		case 3://自己
        			$condition=$this->auth['id'];
        			break;
        	}
        	//echo $type;
        	//dump($mycard);
        	//这句sql有bug啊,没有记录怎么办,查询member,feed表
        	//$result= model('feed')->withBelong('member','mid','id','is_audit = 1 and feed_type in(0,2)','','ctime desc',($list*$num).','.$num);
        	$result=model('feed')->feed_member($limit,$condition);//不会报错
        	if(!empty($result)){
        		include_once(ROOT_PATH.'/avatar/AvatarUploader.class.php');
        		$au = new AvatarUploader();
        		foreach ($result as $_k => $_v) {
        			$result[$_k]['avatar']=$au->getAvatar($_v['mid'],'small');
        			$picture=model('feed_pic')->find('fid = '.$_v['id']);
        			if(!empty($picture)){
        				$result[$_k]['pic']=$picture;
        			}
        			if($_v['feed_type']==2){
        				//显示转发的心情
        				$org_info=  model('feed')->withBelongOne('member','mid','id','id ='.$_v['oid']);
        				//dump($org_info);
        				$org_picture=model('feed_pic')->find('fid='.$org_info['id']);
        				if(!empty($org_picture)){
        					$org_info['pic']=$org_picture;
        				}
        				$result[$_k]['org_info']=$org_info;
        				$result[$_k]['feed_content']=$_v['feed_content'].model('feed')->getRepostCon($_v['fid']);
        			}
        			$result[$_k]['is_zan']=model('feed_digg')->isDigg($this->auth['id'],$_v['id']);//我是否赞过该心情
        		}
        		//dump($result);
        		$this->result=$result;
        		//dump($result);
        		$this->getUrls();
        		$this->path=__ROOT__.'/upload/member/feed/';
        		$this->display();
        	}
        	else{
        		echo 0;
        	}
        }
	         
        //发布心情
        public function postFeed() {
            if(!$this->isPost()){
                $this->error('您请求的参数不存在！');
            }
            else{
            	$this->path=__ROOT__.'/upload/member/feed/';
                $this->getUrls();
                $data=array();
                $data['mid']=  $this->auth['id'];
                $data['feed_content']=$_POST['content'];
                $data['ctime']= time();
                $data['fid']=$data['fmid']=$data['oid']=-1;//-1是原创心情
                $data['feed_type']=0;
                if(model('feed')->insert($data)){
                    require_once ROOT_PATH.'/avatar/AvatarUploader.class.php';
                    $au=new AvatarUploader();
                    $data_org=model('feed')->withBelongOne('member','mid','id','ctime = '.$data['ctime'],'','ctime desc');
                    $data_org['avatar']=$au->getAvatar($data_org['member']['id'],'small');
                    if(!empty($_POST['pic_url']) && !empty($_POST['thumb_pic_url'])){
                        $data_pic=array();
                        $data_pic['fid']=$data_org['id'];
                        $data_pic['url']=$_POST['pic_url'];
                        $data_pic['thumb_url']=$_POST['thumb_pic_url'];
                        $data_pic['ctime']=  time();
                        if(model('feed_pic')->insert($data_pic)){
                            $this->picture=$data_pic;
                            $data_org['is_zan']=model('feed_digg')->isDigg($this->auth['id'],$data_org['id']);
                            $this->data_org=$data_org;
                            $this->display();
                        }
                        else{
                            $this->error('请求数据错误！');
                        }
                    }
                    else{
                        $data_org['is_zan']=model('feed_digg')->isDigg($this->auth['id'],$data_org['id']);
                        $this->data_org=$data_org;
                        $this->display();
                    }
                }
                else{
                    $this->error('操作失败！');
                }
            }
        }

        //心情赞
        public function zan() {
            $id=$_POST['id'];
            $data=array();
            $data['mid']=  $this->auth['id'];
            $data['feed_id']=$id;
            $data['ctime']=  time();
            if(model('feed_digg')->insert($data)){
                $feed_info=model('feed')->find('id = '.$id);
                $feed_data=array();
                $feed_data['praise_count']=$feed_info['praise_count']+1;
                if(model('feed')->update('id = '.$id,$feed_data)){
                    $notice['mid']=$feed_info['mid'];
                    $notice['fid']=$id;
                    $notice['type']=1;
                    if(model('feed_notify')->insert($notice)){
                        $result ='<a href= "javascript:void(0)" onclick="feedLoseZan(\''.$id.'\',\''.url("index/losezan").'\')" style="color:#999;"> 已赞('.$feed_data["praise_count"].')</a>';
                        echo $result;
                    }
                }
            }
        }
        
        //取消赞
         public function loseZan() {
            $id=$_POST['id'];
            if(model('feed_digg')->delete('mid = '.$this->auth['id'].' and feed_id = '.$id)){
                $feed_info=model('feed')->find('id = '.$id);
                $feed_data=array();
                $feed_data['praise_count']=$feed_info['praise_count']-1;
                if(model('feed')->update('id = '.$id,$feed_data)){
                      if(model('feed_notify')->delete('mid = '.$feed_info['mid'].' and fid = '.$id)){
                        $result ='<a href= "javascript:void(0)" onclick="feedZan(\''.$id.'\',\''.url("index/zan").'\')" > 赞';
                        if($feed_data["praise_count"]!=0){
                            $result.='('.$feed_data["praise_count"].')';
                        }
                        echo $result.'</a>';
                      }
                }
            }
        }

        //显示评论内容
        public function showComment() {
            if(!$this->isPost()){
                echo "评论加载失败，请重试！";
            }
            else{
                $this->getUrls();
                $id=$_POST['id'];
                $this->id=$id;
                $total=model('feed')->count('oid = '.$id.' and feed_type in (1,3)');
                $limit=10;
                if($total!=0){
                    require_once ROOT_PATH.'/avatar/AvatarUploader.class.php';
                    $au=new AvatarUploader();
                    $result=model('feed')->withMoreBelong(array(
                        array('withTable'=>'member','withField'=>'mid','orgField'=>'id'),
                        array('withTable'=>'member','withField'=>'fmid','orgField'=>'id'),
                        ),'oid = '.$id.' and feed_type in (1,3)','','ctime asc',$limit);
                foreach ($result as $_k => $_v) {
                    $result[$_k]['avatar']=$au->getAvatar($_v['membermid']['id'],'small');
                }
                    
                    $this->result=$result;
                }
                $this->total=$total;
                $this->remain=$total-10;
                $this->limit=$limit;
                $this->display();//输出显示
            }
        }

        //提交评论
        public function postcomment() {
            if(!$this->isPost()){
                $this->error('请求的参数错误！！');
            }
            else{
                $this->getUrls();
                $content=(string)$_POST['content'];
                $is_repost=intval($_POST['is_repost']);//是否转发，0否1是
                $id=$_POST['id'];
                $data_org= model('feed')->find('id = '.$id);//原心情
                $data=array();
                $data['mid']= $this->auth['id'];
                $data['fid']=$id;
                $data['fid']=$_POST['rid']?$_POST['rid']:$id;
                $data['fmid']=$data_org['mid'];
                $data['oid']=$id;
                $data['feed_content']=$content;
                $data['feed_type']=intval($_POST['type']);//回复类型
                $data['ctime']= time();
                
                if(is_repost){
                	//转发
                	$this->_repost($id, $data_org['mid'], $data_org['oid'], $content);
                }
                if(model('feed')->insert($data)){
                    $fdata=array();
                    $fdata['comment_count']=$data_org['comment_count']+1;
                    if(model('feed')->update('id = '.$data_org['id'],$fdata)){
                        require_once ROOT_PATH.'/avatar/AvatarUploader.class.php';
                        $au=new AvatarUploader();
                        $result= model('feed')->withBelongOne('member','mid','id','ctime = '.$data['ctime'],'','ctime desc');
                        $result['avatar']=$au->getAvatar($result['member']['id'],'small');
                        $this->result=$result;
                        $this->display();
                    }
                }
            }
        }

        //显示图片上传
        public function showPic() {
                if($_FILES){
                     $picture=$this->_upload(ROOT_PATH."upload/member/feed/");
                     echo $picture[0]['savename'];
                } 
                else{
                    $this->getUrls();
                     $this->display(); 
                }   
        }

        //删除图片上传
        public function delPic() {
                $filename = $_POST['imagename'];
                if(!empty($filename)){
                        unlink(ROOT_PATH."upload/member/feed/".$filename);
                        unlink(ROOT_PATH."upload/member/feed/"."thumb_".$filename);
                        echo '1';
                }else{
                        echo '删除失败.';
                }
        }

       //删除心情
       public function delfeed()
       {
       	$id=intval($_GET['id']);
       	$oid=intval($_GET['oid']);
       	if(model("feed")->delete("id='{$id}'"))
       	{
       		if($oid)
       		{
       			//是评论的删除，则原来的心情评论数减一
       			$comment_count=model("feed")->minus_comment($oid);
       		}
       		 
       		//删除所有的赞记录，评论记录，图片记录
       		$re=model("feed_pic")->find("fid='{$id}'");
       		if($re)
       		{
       			//删除图片
       			unlink($this->uploadpath.$re['url']);
       			unlink($this->uploadpath.$re['thumb_url']);
       			model("feed_pic")->delete("fid='{$id}'");
       		}
       		model("feed_digg")->delete("feed_id='{$id}'");//可能没有，需要判断？
       		model("feed_notify")->delete("f_id='{$id}'");//可能没有，需要判断？
       		model("feed")->delete("oid='{$id}' and feed_type=1");//删除评论
       		echo 1;
       	}else echo "失败~";
       	
       }
       
       //转发
       public function repost_feed()
       {
       	if(!$this->isPost()){
       		
       		$id=intval($_GET['id']);
       		$result= model('feed')->withBelongOne('member','mid','id','id = '.$id);
       		$is_photo=model("feed_pic")->find("fid='{$id}'");
       		$this->photo=$is_photo;
       		$this->result=$result;
       		$this->getUrls();
       		$this->display();
       	}else{
       		//要判断是否是转发原创的心情
       		$id=intval($_POST['feed_id']);//心情的id
       		$oid=intval($_POST['oid']);//原始心情的id
       		$mid=intval($_POST['mid']);//心情的发布者
       		$content=$_POST['content'];
       		if(empty($id)) return;//用这个修复自己提供bug
       		//echo "<script>alert(1);</script>";return;
       		$this->_repost($id, $mid, $oid, $content);
       		echo 1;
       	}
       }
      
       //转发类，注意参数，用于转发和评论转发
      protected function _repost($id,$mid,$oid,$content){
      	$data=array();
      	if($oid==-1){
      		//转发的是原创心情
      		$data['oid']=$data['fid']=$id;
      	}else{
      		//转发的是已经转发的心情
      		$data['oid']=$oid;
      		$data['fid']=$id;
      	}
      	$data['fmid']=$mid;
      	$data['mid']=  $this->auth['id'];
      	$data['feed_content']=$content;
      	$data['feed_type']=2;
      	$data['comment_count']=0;
      	$data['repost_count']=0;
      	$data['praise_count']=0;
      	$data['ctime']=time();
      	$data['is_audit']=1;
      	if(model('feed')->insert($data)){
      		model('feed')->add_repost($data['oid']);//原转发量增加1
      	}
      }

      //异步加载，显示可能认识的人
      public function mayknow(){
      	if($this->isPost()){
      		$total=model('member')->maybeknow($this->auth['id'],'');//为空，全部读出
      		$len= count($total);
      		$num=3;
      		$key=$len/$num;
      		$now=$_POST['num'];
      		$result=array();
      		for($j=0;$j<$num;$j++){
      			if(!empty($total[$now*$num+$j])){
      				$result[$j]=$total[$now+$j];
      			}
      		}
      		if(empty($result)) echo 0;
      		else{
      			$this->result=$result;
      			$this->display();
      		}
      	}
      }
            
      //反馈信息
      public function feedback()
      {
      	if(!$this->isPost()){
      		$this->display();
      	}else{
      		//ajax提交处理
      		$data=array();
      		$data['email']=in($_POST['email']);
      		$data['content']=in($_POST['content']);
      		$data['ctime']=time();
      		$data['is_reply']=0;
      		if(empty($data['email'])||empty($data['content'])) return;
      		//增加到记录
      		if(model("feedback")->insert($data)) echo 1;
      	}
      	
      }
}