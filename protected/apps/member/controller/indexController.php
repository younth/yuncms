<?php
/*
 * 会员管理首页控制器，该部分为单独模块
 * */
class indexController extends commonController
{
    
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
                
                //查询所有的心情
                $listrow=10;
                $url=  url('index/index',array('page'=>'{page}'));
                $limit=  $this->pageLimit($url,$listrow);
                $count=  model('feed')->count('is_audit = 1 and feed_type in(0,2)');
                $result=  model('feed')->withBelong('member','mid','id','is_audit = 1 and feed_type in(0,2)','','ctime desc',$listrow);
                foreach ($result as $_k => $_v) {
                    $picture=model('feed_pic')->feedPic($_v['id']);
                    if(!empty($picture)){
                        $result[$_k]['pic']=$picture;
                    }
                    if($_v['feed_type']==2){
                        $org_info=  model('feed')->withBelongOne('member','mid','id','id = '.$_v['oid']);
                        $org_picture=model('feed_pic')->feedPic($org_info['id']);
                        if(!empty($org_picture)){
                            $org_info['pic']=$org_picture;
                        }
                        $result[$_k]['org_info']=$org_info;
                        $result[$_k]['feed_content']=$_v['feed_content'].model('feed')->getRepostCon($_v['fid']);
                    }
                    $result[$_k]['is_zan']=model('feed_digg')->isDigg($auth['id'],$_v['id']);
                }
//                dump($result);
                $this->feed_fiter="全部";
                
                $this->getUrls();
                
                $this->result=$result;
                $this->page=$this->pageShow($count);
                $this->loadAds=1;
        	$this->display();
	    }
            
            //首页加载广告页面
            public function loadAds() {
//                $this->display();
                $this->displayPart();
            }
            
            //提交动态
            public function postFeed() {
                if(!$this->isPost()){
                    $this->error('您请求的参数不存在！');
                }
                else{
                    $this->getUrls();
                    $data=array();
                    $data['mid']=  $this->auth['id'];
                    $data['feed_content']=$_POST['content'];
                    $data['ctime']=  time();
                    if(model('feed')->insert($data)){
                        $data_org=model('feed')->withBelongOne('member','mid','id','ctime = '.$data['ctime'],'','ctime desc');
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
                                $this->displayPart();
                            }
                            else{
                                $this->error('请求数据错误！！');
                            }
                        }
                        else{
                            $data_org['is_zan']=model('feed_digg')->isDigg($this->auth['id'],$data_org['id']);
                            $this->data_org=$data_org;
                            $this->displayPart();
                        }
                    }
                    else{
                        $this->error('操作失败！！');
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
                            $result ='<a href= "javascript:void(0)" onclick="feedLoseZan(\''.$id.'\',\''.url("index/losezan").'\')" > 取消赞('.$feed_data["praise_count"].')</a>';
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
                    echo "评论加载失败，请重试！！";
                }
                else{
                    $this->getUrls();
                    $id=$_POST['id'];
                    $this->id=$id;
                    $total=model('feed')->count('oid = '.$id.' and feed_type in (1,3)');
                    $limit=10;
                    if($total!=0){
                        $result=model('feed')->withMoreBelong(array(
                            array('withTable'=>'member','withField'=>'mid','orgField'=>'id'),
                            array('withTable'=>'member','withField'=>'fmid','orgField'=>'id'),
                            ),'oid = '.$id,'','ctime desc',$limit);
                        $this->result=$result;
                    }
                    $this->total=$total;
                    $this->remain=$total-10;
                    $this->limit=$limit;
                    $this->displayPart();
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
                    $id=$_POST['id'];
                    $data_org=  model('feed')->find('id = '.$id);
                    
                    $data=array();
                    $data['mid']=  $this->auth['id'];
                    $data['fid']=$id;
                    $data['fmid']=$data_org['mid'];
                    $data['oid']=$id;
                    $data['feed_content']=$content;
                    $data['feed_type']=1;
                    $data['ctime']= time();
                    if(model('feed')->insert($data)){
                        $fdata=array();
                        $fdata['comment_count']=$data_org['comment_count']+1;
                        if(model('feed')->update('id = '.$data_org['id'],$fdata)){
                            $result=  model('feed')->withBelongOne('member','mid','id','ctime = '.$data['ctime'],'','ctime desc');
                            $this->result=$result;
                            $this->displayPart();
                        }
                    }
                }
            }
            
            //显示回复框
            public function showReply() {
                if(!$this->isPost()){
                    echo "加载失败，请重试！！";
                }
                else{
                    $id=$_POST['id'];
                    $data_org=model('feed')->find('id = '.$id);
                    $this->id=$id;
                    $this->oid=$data_org['oid'];
                    $this->displayPart();
                }
            }
            
            //提交回复
            public function postReply() {
                if(!$this->isPost()){
                    $this->error('请求数据错误！！');
                }
                else{
                    $this->getUrls();
                    $id=$_POST['id'];
                    $oid=$_POST['oid'];
                    $content=$_POST['content'];
                    $data_father=model('feed')->find('id = '.$id);                    
                    $data_org=model('feed')->find('id = '.$oid);
                    
                    $data=array();
                    $data['mid']=  $this->auth['id'];
                    $data['fid']=$id;
                    $data['fmid']=$data_father['mid'];
                    $data['oid']=$oid;
                    $data['feed_content']=$content;
                    $data['feed_type']=3;
                    $data['ctime']=  time();
                    if(model('feed')->insert($data)){
                        $odata=array();
                        $odata['comment_count']=$data_org['comment_count']+1;
                        if(model('feed')->update('id = '.$oid,$odata)){
                            $result=  model('feed')->withMoreBelongOne(array(
                            array('withTable'=>'member','withField'=>'mid','orgField'=>'id'),
                            array('withTable'=>'member','withField'=>'fmid','orgField'=>'id'),
                            ),'ctime = '. $data['ctime'],'','ctime desc',$limit);
                            $this->result=$result;
                            $this->displayPart();
                        }
                    }
                }
            }
            
            //显示转发框
            public function showRepost(){
                if(!$this->isPost()){
                    echo "请求数据错误";
                }
                else{
                    $id=$_POST['id'];
                    
                    $result=  model('feed')->withBelongOne('member','mid','id','id = '.$id);
                    
                    $this->result=$result;
                    $this->displayPart();
                }
            }
            
            //提交转发
            public function postRepost(){
                if(!$this->isPost()){
                    $this->error('请求数据错误！！');
                }
                else{
                    $this->getUrls();
                    $id=$_POST['id'];
                    $content=(string)$_POST['content'];
                    $data_father=model('feed')->find('id = '.$id);
                    
                    $data=array();
                    $data['mid']=$this->auth['id'];
                    $data['fid']=$id;
                    $data['fmid']=$data_father['mid'];
                    if(empty($data_father['fid'])){
                        $data['oid']=$id;
                    }
                    else{
                        $data['oid']=$data_father['oid'];
                    }
                    $data['feed_content']=$content;
                    $data['feed_type']=2;
                    $data['ctime']=  time();
                    if(model('feed')->insert($data)){
                        $fdata=array();
                        $fdata['repost_count']=$data_father['repost_count']+1;
                        if(model('feed')->update('id = '.$id,$fdata)){
                            $result=  model('feed')->withBelongOne('member','mid','id','ctime = '.$data['ctime']);
                            $org_info=model('feed')->withBelongOne('member','mid','id','id = '.$result['oid']);
                            $result['org']=$org_info;
                            $result['pic']=model('feed_pic')->feedPic($org_info['id']);
                            $result['feed_content']=$result['feed_content'].model('feed')->getRepostCon($result['fid']);
                            $this->result=$result;
                            $this->displayPart();
                        }
                    }
                }
            }
            
            //显示图片上传
            public function showPic() {
                    if($_FILES){
                         $picture=$this->_upload(ROOT_PATH."upload/member/img/");
                         echo $picture[0]['savename'];
                    } 
                    else{
                        $this->getUrls();
                         $this->displayPart(); 
                    }   
            }
             //显示图片上传
            public function delPic() {
                    $filename = $_POST['imagename'];
                    if(!empty($filename)){
                            unlink(ROOT_PATH."upload/member/img/".$filename);
                            unlink(ROOT_PATH."upload/member/img/"."thumb_".$filename);
                            echo '1';
                    }else{
                            echo '删除失败.';
                    }
            }
            
            public function getUrls(){
                 //url参数
                $this->url_loadads=  url('index/loadads');
                $this->url_postfeed=  url('index/postfeed');
                $this->url_showcomment=  url('index/showcomment');
                $this->url_postcomment=  url('index/postcomment');
                $this->url_showreply=  url('index/showreply');
                $this->url_postreply=  url('index/postreply');
                $this->url_showrepost=  url('index/showrepost');
                $this->url_postrepost=  url('index/postrepost');
                $this->url_zan=  url('index/zan');
                $this->url_losezan=  url('index/losezan');
                $this->url_showpic=  url('index/showpic');
                $this->url_delpic=  url('index/delpic');
            }
}