<?php 
return array (
  'REWRITE' => 
  array (
    '<c>/<a>-<id>-<page>-<keywords>-<type>.html' => 'default/<c>/<a>',
    '<c>/<a>-<id>-<page>-<keywords>.html' => 'default/<c>/<a>',
    '<c>/<a>-<id>-<page>.html' => 'default/<c>/<a>',
    'index.html' => 'default/index/index',
    '<c>/<a>-<id>.html' => 'default/<c>/<a>',
    '<c>/<a>.html' => 'default/<c>/<a>',
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
    'DB_NAME' => 'ce',
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
    'SMTP_FROM_NAME' => '91频道',
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
  'ver_name' => 'V2.0',
  'ht_name' => 'Yuncms内容管理系统',
  'ver_date' => '20130704',
  'copyright' => 'Yunstudio',
  'sitename' => 'Yuncms站群管理系统',
  'siteurl' => 'http://cms.yunstudio.net/',
  'keywords' => 'cms',
  'description' => '建站系统',
  'telephone' => '14789998264',
  'QQ' => 825075713,
  'myemail' => 'yunstudio2012@qq.com',
  'address' => '长沙理工大学创业园305',
  'icp' => '0',
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
);