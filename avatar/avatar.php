<?php 
require 'AvatarUploader.class.php';
session_start();//用sesson传值

header("Expires: 0");
header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
header("Pragma: no-cache");
header("Cache-Control:no-cache");

$au = new AvatarUploader();
if ( $au->processRequest() ) {
	exit();
}

// 显示编辑页面，页面中包含 camera.swf
//当前用户的uid的处理
$uid=$_SESSION['uid'];

if(isset($uid))
{
	$uid = intval($uid);

}
else
{
	$uid = 1;
}
$urlAvatarBig    = $au->getAvatarUrl( $uid, 'big' );
$urlAvatarMiddle = $au->getAvatarUrl( $uid, 'middle' );
$urlAvatarSmall  = $au->getAvatarUrl( $uid, 'small' );
$urlCameraFlash = $au->renderHtml( $uid );
?>
<script type="text/javascript">
function updateavatar() {
	window.location.reload();//上传完刷新本页面
}
</script>

<?php echo $urlCameraFlash ?>
<br/><br/>
<span style="font-family: \5FAE\8F6F\96C5\9ED1;font-size: 12px;">当前头像:</span>
<br /><br/>
<img src="<?php echo  $urlAvatarBig ?>">
<img src="<?php echo  $urlAvatarMiddle ?>">
<img src="<?php echo  $urlAvatarSmall ?>">

