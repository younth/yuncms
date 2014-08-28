图片上传
===================

用PHP上传是功能，ajax处理是方法。使用ajax上传的原理还是php。

首先要知道PHP如何返回json数据：

```
	$arr = array(
		'name'=>$picname,
		'pic'=>$pics,
		'size'=>$size
	);
	echo json_encode($arr);
	
	//对应的js处理json  data.name  data.pic   data.size
```

###如何改变二维数组的内容？
```
foreach ($visit as  $row=>$v)
{
	$uid=$v['id'];
	//增加键值
	$visit[$row]['avatar']=$au->getAvatar($uid,'small');
}
foreach ($may as  $row=>$v)
{
	$may[$row]=model("member")->user_profile($v['mid'],'');
}
```
上传两种图片，一张原图，一张缩略图

上传图片的方法在 **membet/test/uploadimg**
