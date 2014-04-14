<?php
header("Content-Type:text/html;charset=utf-8");//php处理判断里面输出内容的需要
$yu= base64_encode("王洋");
echo base64_decode($yu);
?>
