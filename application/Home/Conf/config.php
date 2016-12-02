<?php
return array(
    'URL_MODEL'    => 2 ,
    /*'URL_HTML_SUFFIX' =>'.shtml',*/
    'URL_ROUTER_ON'     => true,
    //路由规则
    'URL_ROUTE_RULES' => array(
        'article/id/:id\d'=>'Index/article'
    ),
);