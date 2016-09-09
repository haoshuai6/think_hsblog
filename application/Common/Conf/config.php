<?php
return array(
    'TEMPLATE_CHARSET' =>'UTF8', // 模板模板编码
    'OUTPUT_CHARSET' =>'UTF8', // 默认输出编码
    /* 模板路径简化 ,由默认的'/'分隔符改为'_'下划线分隔符，这样，模板文件路径就清晰明了
      old： Home/Index/index.html
      new:  Home/Index_inde.html
   */
    'TMPL_FILE_DEPR'    =>  '_',
    'URL_MODEL'         => 0,
    
    'MODULE_ALLOW_LIST'     =>  array ('Home','Admin'),
    'LOAD_EXT_CONFIG'       =>  'db',//加载网站设置文件//数据库配置文件
    'TOKEN_ON'      =>    true,  // 开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__HSBLOGS__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后重置令牌 
    //public为公共资源文件夹
    //前台、themes/default/Home/public
    //后台、themes/default/Admin/public
    'TMPL_PARSE_STRING'     =>  array(                        //定义常用路径
        '__HOME_CSS__'      =>  __ROOT__.trim(TMPL_PATH,'.').'Home/public/css',
        '__HOME_JS__'       =>  __ROOT__.trim(TMPL_PATH,'.').'Home/public/js',
        '__HOME_IMAGE__'    =>  __ROOT__.trim(TMPL_PATH,'.').'Home/public/image',
        '__ADMIN_CSS__'     =>  __ROOT__.trim(TMPL_PATH,'.').'Admin/public/css',
        '__ADMIN_JS__'      =>  __ROOT__.trim(TMPL_PATH,'.').'Admin/public/js',
        '__ADMIN_IMAGE__'   =>  __ROOT__.trim(TMPL_PATH,'.').'Admin/public/image',
    ),


);