<?php 
return array (
  'REWRITE' => 
  array (
  ),
  'APP' => 
  array (
    'DEBUG' => true,
    'LOG_ON' => false,
    'LOG_PATH' => BASE_PATH . 'cache/log/',
    'URL_HTTP_HOST' => '',
    'TIMEZONE' => 'PRC',
    'COOKIE_RANGE' => '',
    'COOKIE_PATH' => '/',
    'COOKIE_PRE' => 'yun_',
    'HTML_CACHE_ON' => false,
    'HTML_CACHE_PATH' => BASE_PATH . 'cache/html_cache/',
    'HTML_CACHE_RULE' => 
    array (
      'default' => 
      array (
        'index' => 
        array (
          'index' => 3000,
        ),
        'news' => 
        array (
          '*' => 3000,
        ),
        'photo' => 
        array (
          '*' => 3000,
        ),
        'page' => 
        array (
          '*' => 3000,
        ),
      ),
    ),
  ),
  'DB' => 
  array (
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PWD' => '',
    'DB_PORT' => '3306',
    'DB_NAME' => 'yuncms',
    'DB_CHARSET' => 'utf8',
    'DB_PREFIX' => 'cms_',
    'DB_CACHE_ON' => false,
    'DB_CACHE_PATH' => BASE_PATH . 'cache/db_cache/',
    'DB_CACHE_TIME' => 600,
    'DB_PCONNECT' => false,
    'DB_CACHE_CHECK' => true,
    'DB_CACHE_FILE' => 'cachedata',
    'DB_CACHE_SIZE' => '15M',
    'DB_CACHE_FLOCK' => true,
  ),
  'EMAIL' => 
  array (
    'SMTP_HOST' => 'smtp.163.com',
    'SMTP_PORT' => 25,
    'SMTP_USERNAME' => '14789998264@163.com',
    'SMTP_PASSWORD' => 'wangyang199188',
    'SMTP_SSL' => false,
    'SMTP_AUTH' => true,
    'SMTP_CHARSET' => 'utf-8',
    'SMTP_FROM_TO' => '14789998264@163.com',
    'SMTP_FROM_NAME' => 'Yuncms',
    'SMTP_DEBUG' => false,
  ),
  'TPL' => 
  array (
    'TPL_TEMPLATE_PATH' => '',
    'TPL_TEMPLATE_SUFFIX' => '.php',
    'TPL_CACHE_ON' => false,
    'TPL_CACHE_TYPE' => '',
    'TPL_CACHE_PATH' => BASE_PATH . 'cache/tpl_cache/',
    'TPL_CACHE_SUFFIX' => '.php',
  ),
  'ver_name' => 'V2.3.1',
  'ht_name' => 'Yuncms内容管理系统',
  'ver_date' => '20130704',
  'copyright' => ' Copyright © 2014　长沙云影网络科技有限公司',
  'sitename' => 'Yuncms内容管理系统',
  'siteurl' => 'http://cms.yunstudio.net',
  'keywords' => 'Yuncms内容管理系统',
  'description' => 'Yuncms内容管理系统',
  'telephone' => '14789998264',
  'beian' => '湘公网安备110105002161号',
  'myemail' => 'yunstudio2012@qq.com',
  'address' => '长沙理工大学创业园305',
  'icp' => '湘ICP证050525号',
  'fileupSize' => 2000000,
  'imgupSize' => 1000000,
  'ifwatermark' => false,
  'watermarkImg' => 'logo.png',
  'watermarkPlace' => 9,
  'coverMaxwidth' => 260,
  'coverMaxheight' => 208,
  'thumbMaxwidth' => 145,
  'thumbMaxheight' => 110,
  'allowType' => 'jpg,bmp,gif,png,flv,mp4,mp3,wma,mp4,7z,zip,rar,ppt,txt,pdf,xls,doc,swf,wmv,avi,rmvb,rm',
  'sina_wb_akey' => '3226403690',
  'sina_wb_skey' => 'b476ab21cd1b75152fd2d90e63ce31e5',
  'tongji' => 'var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=\'cnzz_stat_icon_4125145\'%3E%3C/span%3E%3Cscript src=\'" + cnzz_protocol + "s22.cnzz.com/stat.php%3Fid%3D4125145%26show%3Dpic1\' type=\'text/javascript\'%3E%3C/script%3E"));',
);