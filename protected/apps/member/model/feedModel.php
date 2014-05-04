<?php

/* 
 * 心情主表模板cms_feed
 * by jever
 * 2014.4.10
 */

class feedModel extends baseModel{
    protected $table = 'feed';
    
    public function getRepostCon($fid) {
        $info=  model('feed')->withBelongOne('member','mid','id','id = '.$fid);
        if($info['feed_type']!=2){
            return $content='';
        }
        else{
             $content='//<a id="mem_show_uname" href="#"><strong>'.@$info['member']['uname'].'</strong></a>:'.dobadword($info['feed_content']).  $this->getRepostCon($info['fid']);
        }
        return $content;
    }
    
    //评论减一
    public function minus_comment($id)
    {
    	$sql="update {$this->prefix}feed set comment_count=comment_count-1 where id='{$id}'";
    	return $this->model->query($sql);
    }
    
    //转发加一
    public function add_repost($id)
    {
    	$sql="update {$this->prefix}feed set repost_count=repost_count+1 where id='{$id}'";
    	return $this->model->query($sql);
    }
    
    //member and  feed两个表联合查询
    public function feed_member($limit,$mycard)
    {
    	if($mycard){$where="f.mid=m.id AND f.feed_type in(0,2) AND f.mid in (".$mycard.")";}
    	else $where="f.mid=m.id AND f.feed_type in(0,2)";
    	$sql="SELECT m.uname,f.* FROM {$this->prefix}member as m,{$this->prefix}feed as f WHERE {$where} ORDER BY f.ctime desc LIMIT {$limit}";
    	return $this->model->query($sql);
    }
}

