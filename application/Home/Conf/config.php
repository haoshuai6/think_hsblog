<?php
return array(
    
    'URL_ROUTER_ON'     => true,
    //路由规则
    'URL_ROUTE_RULES' => array(
        '/^index$/'   =>    'Index/index',
        '/^article-(\d{1,5})$/'     =>  'Index/article?id=:1',
    ),
);