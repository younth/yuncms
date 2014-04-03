<?php
/*
 * 动态控制器
 * */
class adminfeedController extends appadminController
{
    //动态列表
    public function index()
    {
        $listRows=10;//每页显示的信息条数
        $url=url('adminfeed/index',array('page'=>'{page}'));
        $limit=$this->pageLimit($url,$listRows); 
        
        $sortlist=model('feed')->select('','id,type,mid,comment_count,repost_count,is_repost,is_audit,ctime','ctime DESC',$limit);
        $count=model('feed')->count(); 
        $this->list=$sortlist;
        $this->count=$count;
        $this->page=$this->pageShow($count);
        $this->display();
    }
    
    //删除动态
    public function del()
    {
        if(!$this->isPost()){
            //未提交,ajax删除
            $id=intval($_GET['id']);
            if(empty($id)) $this->error('您没有选择~'); 
            if(model('feed')->delete("id='$id'"))
                echo 1;
            else
                 echo '删除失败~';
        }else{
            //批量删除
            if(empty($_POST['delid'])) $this->error('您没有选择~');
            $delid=implode(',',$_POST['delid']);//分隔数组
            if(model('feed')->delete('id in ('.$delid.')'))
            $this->success('删除成功',url('adminfeed/index'));
        }
    }
}
