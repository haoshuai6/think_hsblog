<?php
return array(
    'TEMPLATE_CHARSET' =>'UTF8', // 模板模板编码
    'OUTPUT_CHARSET' =>'UTF8', // 默认输出编码
    /* 模板路径简化 ,由默认的'/'分隔符改为'_'下划线分隔符，这样，模板文件路径就清晰明了
      old： Home/Index/index.html
      new:  Home/Index_inde.html
   */
    'TMPL_FILE_DEPR'    =>  '_',
 
    
    'MODULE_ALLOW_LIST'     =>  array ('Home','Admin'),
    'LOAD_EXT_CONFIG'       =>  'db,systemconfig',//加载网站设置文件//数据库配置文件
    'TOKEN_ON'      =>    true,  // 开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__HSBLOGS__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后重置令牌 
    //static为静态资源文件夹
    'TMPL_PARSE_STRING'     =>  array(
        /*default*/
        '__HOME_CSS__'    =>  __ROOT__.'/static/home/css',
        '__HOME_JS__'       =>  __ROOT__.'/static/home/js',
        '__HOME_IMAGES__'   =>  __ROOT__.'/static/home/images',

        '__RAND_IMAGES__'   =>  __ROOT__.'/static/randimg',
        
        '__ADMIN_CSS__'     =>  __ROOT__.'/static/admin/css',
        '__ADMIN_JS__'      =>  __ROOT__.'/static/admin/js',
        '__ADMIN_LIB__'     =>  __ROOT__.'/static/admin/lib',
        '__ADMIN_IMAGES__'  =>  __ROOT__.'/static/admin/images',
        '__ADMIN_UI_CORE__' =>  __ROOT__.'/static/admin/ui-core',
        '__ADMIN_PLUGINS__' =>  __ROOT__.'/static/admin/plugins',

    ),
    'ARTICLE_RECYCLE'   =>    '2', //文章放入回收站的标志
    'ARTICLE_NORMAL'   =>    '1',  //文章正常显示状态
    'ARTICLE_CATEGORY_NORMAL'   =>    '1',  //分类正常显示状态




);