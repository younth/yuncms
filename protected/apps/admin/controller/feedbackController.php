<?php
/*
 * 留言管理控制器
 * */
class feedbackController extends commonController
{
	static protected $path='';
    //留言列表
	public function __construct()
	{
		parent::__construct();
		$this->path=__ROOT__.'/upload/feedback/';//图片路径,相对系统的路径
	}
	
    public function index()
    {
        $listRows=10;//每页显示的信息条数
        $url=url('feedback/index',array('page'=>'{page}'));
        $limit=$this->pageLimit($url,$listRows); 
        
        $sortlist=model('feedback')->select('','id,email,ctime,is_read','ctime DESC',$limit);
        $count=model('feedback')->count(); 
        $this->list=$sortlist;
        $this->t_name='留言';
        $this->count=$count;
        $this->page=$this->pageShow($count);
        $this->display();
    }
    
    //删除留言
    public function del()
    {
        if(!$this->isPost()){
            //未提交,ajax删除
            $id=intval($_GET['id']);
            if(empty($id)) $this->error('您没有选择~'); 
            if(model('feedback')->delete("id='$id'"))
                echo 1;
            else
                 echo '删除失败~';
        }else{
            //批量删除
            if(empty($_POST['delid'])) $this->error('您没有选择~');
            $delid=implode(',',$_POST['delid']);//分隔数组
            if(model('feedback')->delete('id in ('.$delid.')'))
            $this->success('删除成功',url('feedback/index'));
        }
    }
    
    //查看留言具体内容
    public function read()
    {
        $id=intval($_GET['id']);
        //标记已读
        model("feedback")->readfeedback($id);
        if(empty($id)) $this->error('参数错误');
        $info=model('feedback')->find("id='$id'");//当前新闻的相关信息
        $pic=model("feedback_pic")->select("fid='$id'",'picture');
        $this->info=$info;
        $this->pic=$pic;
        $this->display();
    }
    
    //显示未读留言信息列表
    public function unreply()
    {
        $listRows=10;//每页显示的信息条数
        $url=url('feedback/unreply',array('page'=>'{page}'));
        $where="is_reply=0";
        $sortlist=model('feedback')->select($where); //表示查询未读留言
        $limit=$this->pageLimit($url,$listRows);
        $count=model('feedback')->count();
        $this->list=$sortlist;
        $this->count=$count;
        $this->t_name='未读';
        $this->page=$this->pageShow($count);
        $this->display('feedback/index');
    }
    
    //邮件回复
    public function sendemail()
    {
    	$email=$_GET['email'];
    	$id=intval($_GET['id']);
    	if(empty($email)) $this->error('参数错误');
    	if(!$this->isPost()){
    		$this->t_name='邮件';
    		$this->display();
    	}else {
    		$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
    		$data=array();
    		$feedback=array();
    		$data['uid']=-1;//代表系统管理员
    		$data['type']=-1;
    		$data['email']=$email;//收信人
    		//内容
    		if (get_magic_quotes_gpc()) {
    			$data['body'] = stripslashes($_POST['body']);
    		} else {
    			$data['body'] = $_POST['body'];
    		}
    		$data['ctime']=time();
    		$title="91频道回复邮件";
    		Email::init($config['EMAIL']);//初始化邮箱配置
    		$re=Email::send($data['email'], $title, $data['body']);
    		if($re)
    		{
    			//写入系统邮件记录
    			if(model('notify_email')->insert($data)){
    				$feedback['is_reply']=1;//标志已经回复
    				model('feedback')->update("id='$id'",$feedback);
    				$this->success("邮件回复成功！",url('feedback/index'));
    			}
    		}
    		else $this->error("邮件发送失败~");
    	}
    	
    }
}
