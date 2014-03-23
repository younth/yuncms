<?php
if( !function_exists('tpl_parse_ext')) {
	function tpl_parse_ext($template){
		return template_ext($template);
	}
}
//模板扩展函数
function template_ext($template)
{
	//解析并格式化时间
	/*
	 * {date($t,Y-m-d h:i:s)}
	 */
	$template = preg_replace("/{date\((\\$[a-zA-Z_]\w*(?:\[[\w\.\"\'\[\]\$]+\])*)\,([Y\-md H\:is]*)\)}/i", "<?php echo date('$2',$1); ?>", $template);

	//解析并格式化当前时间	
	/*
	 * {date(Y-m-d h:i:s)}
	 */
	$template = preg_replace("/{date\(([Y\-md H\:is]*)\)}/i", "<?php echo date('$1',time()); ?>", $template);
    //php标签
	/*
			{php echo phpinfo();}	=>	<?php echo phpinfo(); ?>
    */
	$template = preg_replace ( "/\{php\s+(.+)\}/", "<?php \\1?>", $template );
	//函数 标签
	/*
			{date('Y-m-d H:i:s')}	=>	<?php echo date('Y-m-d H:i:s');?> 
			{$date('Y-m-d H:i:s')}	=>	<?php echo $date('Y-m-d H:i:s');?> 
	*/
	$template = preg_replace ( "/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $template );
	$template = preg_replace ( "/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $template );
	
	//if 标签
	/*
	 {if $name==1}		=>	<?php if ($name==1){ ?>
	 {elseif $name==2}	=>	<?php } elseif ($name==2){ ?>
	 {else}				=>	<?php } else { ?>
	 {/if}				=>	<?php } ?>
	 */
	$template = preg_replace ( "/\{if\s+(.+?)\}/", "<?php if(\\1) { ?>", $template );
	$template = preg_replace ( "/\{else\}/", "<?php } else { ?>", $template );
	$template = preg_replace ( "/\{elseif\s+(.+?)\}/", "<?php } elseif (\\1) { ?>", $template );
	$template = preg_replace ( "/\{\/if\}/", "<?php } ?>", $template );
	//for 标签
	/*
	 {for $i=0;$i<10;$i++}	=>	<?php for($i=0;$i<10;$i++) { ?>
	 {/for}					=>	<?php } ?>
	 */
	$template = preg_replace("/\{for\s+(.+?)\}/","<?php for(\\1) { ?>",$template);
	$template = preg_replace("/\{\/for\}/","<?php } ?>",$template);

	//loop 标签
	/*
	 {loop $arr $vo}			=>	<?php $n=1; if (is_array($arr) foreach($arr as $vo){ ?>
	 {loop $arr $key $vo}	=>	<?php $n=1; if (is_array($array) foreach($arr as $key => $vo){ ?>
	 {/loop}					=>	<?php $n++;}unset($n) ?>
	 */
	$template = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\}/", "<?php \$n=1;if(is_array(\\1)) foreach(\\1 AS \\2) { ?>", $template );
	$template = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/", "<?php \$n=1; if(is_array(\\1)) foreach(\\1 AS \\2 => \\3) { ?>", $template );
	$template = preg_replace ( "/\{\/loop\}/", "<?php \$n++;}unset(\$n); ?>", $template );


	//变量/常量 标签
	/*
	 {$name}	=>	<?php echo $name; ?>
	 {CONSTANCE}	=> <?php echo CONSTANCE;?>
	 */
	/*$template = preg_replace ( "/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/", "<?php echo \\1;?>", $template );*/
	/*$template = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es", "\$this->addquote('<?php echo \\1;?>')",$template);*/
	$template = preg_replace ( "/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $template );

	/*替换循环
	 {yourname:{table=(table) where=(where) limit=(n) order=(id desc)}} =>	<?php $yourname=module('label')->getlist("table=(table) where=(where) limit=(n) order=(id desc)"); $yourname_i=0; if(!empty($yourname)) foreach($yourname as $yourname){  $yourname_i++; ?>
	 {/yourname}  =>  <?php } ?>
	 
	$template = preg_replace("/{(\S+):{(.*)}}/i","<?php $$1=getlist(\"$2\"); $$1_i=0; if(!empty($$1)) foreach($$1 as $$1){  $$1_i++; ?> ",$template);
	$template = preg_replace("/{\/([a-zA-Z_]+)}/i", "<?php } ?>", $template);*/

	/*输出 $yourname_i 循环条件标签
	 [yourname:i]  =>  <?php echo $yourname_i ?>
	 
	$template = preg_replace("/\[([a-zA-Z_]+)\:\i\]/i", "<?php echo \$$1_i ?>", $template);*/

	/*处理 #[list:value]# 循环中循环条件标签
	  * 上层循环{xxx{...} }
	 * where=(key=#[xxx:value]#) =>where=(key=".$xxx['value'].")
	 
	$template = preg_replace("/\#\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\#/i", '".\$$1[\'$2\']."', $template);*/

	/*处理 #$list['value']# 循环中循环条件标签
	 * 上层循环{xxx{...} }
	 * where=(key=#$xxx['value']#) =>where=(key=".$xxx['value'].")
	 
	$template = preg_replace("/\#\\$(\S+)\#/i", '".$$1."', $template);*/

	/*处理循环中数组变量
	 * [list:value] => <?php echo $list['value'] ?>
	 
	$template = preg_replace("/\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]/i", "<?php echo \$$1['$2'] ?>",$template);*/

	/*截取中文字符长度[list:title $len=7]
	 * [list:title $len=n] => <?php echo msubstr($list['title'],n) ?>
	 
	$template = preg_replace("/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$len\=([0-9]+)\]/i","<?php echo msubstr(\$$1['$2'],0,$3); ?>", $template);
      */  
     /*截取英文字符长度[list:title $elen=7]
	 * [list:title $elen=n] => <?php echo substr($list['title'],n) ?>
	 
	$template = preg_replace("/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$elen\=([0-9]+)\]/i","<?php echo substr(\$$1['$2'],0,$3).'...'; ?>", $template);
	*/
     /*数据碎片
	 * {piece:name} => <?php module('label')->fragment(name);?>
	 
	$template = preg_replace("/{piece:([a-zA-Z_]+)}/i", "<?php model('fragment')->fragment($1);?>",$template);
    */
	return $template;

}
?>