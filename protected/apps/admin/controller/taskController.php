<?php

/* 
 *后台任务控制器
 * by jever 
 * 2014.3.29
 */
class taskController extends commonController{
    public function index(){
       $listrow=10;
       $url=  url('task/index',array('page'=>'{page}'));
       $limit=$this->pageLimit($url,$listrow);
       
       $count=  model('task_base')->count();
       $result=  model('task_base')->select('','','ctime desc',$limit);
       $this->h_name="任务列表";
       $this->result=$result;
       $this->count=$count;
       $this->page=$this->pageShow($count);
       $this->display();
    }
    
    public function add(){
        if(!$this->isPost()){
            $this->h_name="添加任务";
            $this->display();
        }
        else{
            if($_POST['name'] == NULL)$this->error('请填写有效的信息！');
            $data=array();
            $data['name']=$_POST['name'];
            $data['goal']=$_POST['goal'];
	        if (get_magic_quotes_gpc()) {
					$data['content'] = stripslashes($_POST['content']);
				} else {
					$data['content'] = $_POST['content'];
				}
            $data['obtain_gold']=intval($_POST['obtain_gold']);
            $data['consume_gold']=intval($_POST['consume_gold']);
            $data['certification_way']=in($_POST['certification_way']);
            $data['reminder']=$_POST['reminder'];
            $data['score']=in($_POST['score']);
            $data['way']=$_POST['way'];
            $data['ctime']=  time();
            $data['author']=$_SESSION['admin_username'];
            if(model('task_base')->insert($data)){
                $this->success('添加任务成功！',  url('task/index'));
            }else{
                $this->error('添加任务失败！');
            }
        }
    }
    
    public function edit(){
        if(!$_GET['tid']){
            $this->error('参数错误！！');
        }
        else{
            $tid=$_GET['tid'];
        if(!$this->isPost()){
            $result=  model('task_base')->find('id= '.$tid);
            $this->h_name="编辑任务";
            $this->result=$result;
            $this->display('task/add');
        }
        else{
            if(empty($_POST['name'])){$this->error('请填写有效的信息！');}
            $data=array();
            $data['name']=$_POST['name'];
            $data['goal']=$_POST['goal'];
	        if (get_magic_quotes_gpc()) {
					$data['content'] = stripslashes($_POST['content']);
				} else {
					$data['content'] = $_POST['content'];
				}
			$data['obtain_gold']=intval($_POST['obtain_gold']);
			$data['consume_gold']=intval($_POST['consume_gold']);
			$data['certification_way']=in($_POST['certification_way']);
            $data['reminder']=$_POST['reminder'];
            $data['score']=in($_POST['score']);
            $data['way']=$_POST['way'];
            $data['ctime']=  time();
            $data['author']=$_SESSION['admin_username'];
            if(model('task_base')->update('id ='.$tid,$data)){
                $this->success('编辑任务成功！',  url('task/index'));
            }else{
                $this->error('编辑任务失败！');
            }
        }
        }
    }
    
    public function del() {
        if(!$this->isPost()){
            $id=  intval($_GET['id']);
            if(empty($id)){echo '操作失败！';}
            else{
            if(model('task_base')->delete('id = '.$id)){echo 1;}
            else{echo "删除失败！";}
            }
        }
        else{
            if($_POST['dotype']!='del'){$this->error('选择操作类型错误！！');}  
            elseif(empty ($_POST['delid'])){$this->error('没有选择删除条目！！');}
            else{
                $delid=  '('.implode(',',$_POST['delid']).')';
                if(model('task_base')->delete('id in '.$delid)){$this->success('删除成功！',  url('task/index'));}   
            }
        }
    }
    
    public function custom(){
       $listrow=10;
       $url=  url('task/custom',array('page'=>'{page}'));
       $limit=$this->pageLimit($url,$listrow);
       
//       $result=model('task_custom')->taskcustomAndCompany();
//       $result=  model('task_custom')->withBelong('company','cid');//两表关联查询
       $result=  model('task_custom')->withMoreBelong(array(array('withTable'=>'company','withField'=>'cid')));//多表关联查询
//       dump($result);
       $count=  model('task_custom')->count();
//       $result=  model('task_custom')->select('','','ctime desc',$limit);
       $this->h_name="企业特定任务列表";
       $this->result=$result;
       $this->count=$count;
       $this->page=$this->pageShow($count);
       $this->display();
    }
    
    public function editcustom() {
        if(!$_GET['id']){
            $this->error('参数错误！！');
        }else{
            $id=$_GET['id'];
        if(!$this->isPost()){
            $result=  model('task_custom')->find('id= '.$id);
            $comlist=model('company')->select('','','ctime desc');
            $this->h_name="编辑公司定制任务";
            $this->result=$result;
            $this->comlist=$comlist;
            $this->display('task/editcustom');
        }
        else{
            if(empty($_POST['name'])){$this->error('请填写有效的信息！');}
            $data=array();
            $data['name']=$_POST['name'];
            $data['cid']=$_POST['com'];
	        if (get_magic_quotes_gpc()) {
					$data['content'] = stripslashes($_POST['content']);
				} else {
					$data['content'] = $_POST['content'];
				}
            $data['gold']=$_POST['gold'];
            $data['score']=$_POST['score'];
            $data['starttime']=intval(strtotime($_POST['starttime']));
            $data['endtime']=  intval(strtotime($_POST['endtime']));
            $data['ctime']=  time();
            if(model('task_custom')->update('id ='.$id,$data)){
                $this->success('编辑任务成功！',  url('task/custom'));
            }else{
                $this->error('编辑任务失败！');
            }
        }
        }
    }
    
    public function delcustom() {
        if(!$this->isPost()){
            $id=  intval($_GET['id']);
            if(empty($id)){echo '操作失败！';}
            else{
            if(model('task_custom')->delete('id = '.$id)){echo 1;}
            else{echo "删除失败！";}
            }
        }
        else{
            if($_POST['dotype']!='del'){$this->error('选择操作类型错误！！');}  
            elseif(empty ($_POST['delid'])){$this->error('没有选择删除条目！！');}
            else{
                $delid=  '('.implode(',',$_POST['delid']).')';
                if(model('task_custom')->delete('id in '.$delid)){$this->success('删除成功！',  url('task/custom'));}   
            }
        }
    }


}
