<?php
class fragmentModel extends baseModel{
	protected $table = 'fragment';

	public function fragment($sign)
    {
        $sign=in($sign);
        $info = $this->find('sign="'.$sign.'"','content');
        $info['content'] = html_out($info['content']);
        return $info['content'];
    }
}
?>