<?php

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
// 定义应用目录
define('APP_PATH','./application/');
// 定义缓存目录
define('RUNTIME_PATH','./data/runtime/');
// 定义模板主题
define("DEFAULT_THEME","default");

// 定义模板文件默认目录
define("TMPL_PATH","./themes/".DEFAULT_THEME."/");
// 引入ThinkPHP入口文件
require './core/ThinkPHP.php';