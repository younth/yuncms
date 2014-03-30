<?php
/*
 * 留言管理控制器
 * */
class feedbackController extends commonController
{
    //留言列表
    public function index()
    {
        $listRows=10;//每页显示的信息条数
        $url=url('feedback/index',array('page'=>'{page}'));
        $limit=$this->pageLimit($url,$listRows); 
        
        $sortlist=model('feedback')->select('','id,title,email,ctime','ctime DESC',$limit);
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
        if(empty($id)) $this->error('参数错误');
            $info=model('feedback')->find("id='$id'");//当前新闻的相关信息
//            dump($info);
//            return;
        $this->info=$info;
        if(empty($this->info))
            $data['is_read']='1';
        if(!model('feedback')->update("id='{$id}'",$data))
            $this->error('查看留言失败~');
        $this->display();
    }
    
    //显示未读留言信息列表
    public function unread()
    {
        $listRows=10;//每页显示的信息条数
        $url=url('feedback/unread',array('page'=>'{page}'));
        $where="is_read=0";
        $sortlist=model('feedback')->select($where); //0表示查询未读留言
        $limit=$this->pageLimit($url,$listRows);
        $count=model('feedback')->count();
        $this->list=$sortlist;
        $this->count=$count;
        $this->t_name='未读';
        $this->page=$this->pageShow($count);
        $this->display('feedback/index');
    }
}
