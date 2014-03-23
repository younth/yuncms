<?php
class inforController extends commonController
{
	    public function index()
	    {
        if(!$this->isPost()){
           $auth=$this->auth;
           $id=$auth['id'];
           $info=model('member')->find("id='{$id}'");
           $this->info=$info;
           $this->display();
        }else{
           $id=intval($_POST['id']);

           $data['uname']=in(trim($_POST['uname']));
           $acc=model('member')->find("id!='{$id}' AND uname='".$data['uname']."'");
           if(!empty($acc['uname'])) $this->error('该昵称已经有人使用~');

           $data['email']=$_POST['email'];
           $data['tel']=in($_POST['tel']);
           $data['school']=in($_POST['school']);
		   $data['number']=in($_POST['number']);
		   $data['flt_no']=in($_POST['flt_no']);
		   $data['flt_time']=in($_POST['flt_time']);
           if(model('member')->update("id='{$id}'",$data)) $this->success('信息编辑成功~');
           else $this->error('信息编辑失败~');
        }
	    }
      
      public function password()
      {
         if(!$this->isPost()){
           $this->display();
        }else{
           if($_POST['password']!=$_POST['surepassword']) $this->error('确认密码与新密码不符~');
           $auth=$this->auth;
           $id=$auth['id'];
           $info=model('member')->find("id='{$id}'",'password');
           $oldpassword=$this->codepwd($_POST['oldpassword']);
           if($oldpassword!=$info['password']) $this->error('旧密码不正确~');
           
           $data['password']=$this->codepwd($_POST['password']);
           if(model('member')->update("id='{$id}'",$data)) $this->success('密码修改成功~',url('index/password'));
           else $this->error('密码修改失败~');
        }
      }
    
}
?>