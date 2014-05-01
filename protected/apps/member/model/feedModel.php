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
            return $content;//.....
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
}

