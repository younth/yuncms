<?php

/* 
 *心情赞  模型
 * by jever 2014.4.10
 * 
 */
class feed_diggModel extends baseModel{
    protected $table='feed_digg';
    
    public function  isDigg($mid,$fid){
        if(model('feed_digg')->find('mid = '.$mid.' and feed_id  = '.$fid))return 1;
        else return 0;
    }
}
