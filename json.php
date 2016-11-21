<?php
/**
 * Created by PhpStorm.
 * User: haoshuai_it
 * Date: 2016-11-19
 * Time: 12:04
 */
header("Access-Control-Allow-Origin: *");
$two_hours = array(
    "id"=> "1",
    "class_id"=> "1",
    "status"=> "1",
    "time_start"=> "08:00",
    "time_end"=> "10:00"
);

$json_array['data'] = '2016-11-20';
$json_array['week'] = '周日';
$json_array['datarray'] = $two_hours;
$json_array_temp = array (
  0 => 
  array (
    'time' => '2015-08-03 13:47',
    'title' => '滥捕海马做标本 英国机构称海马未来30年或绝种',
    'description' => '滥捕海马做标本 英国机构称海马未来30年或绝种...',
    'picUrl' => 'http://photocdn.sohu.com/20150803/Img418067295_ss.jpg',
    'url' => 'http://news.sohu.com/20150803/n418068683.shtml',
  ),
  1 => 
  array (
    'time' => '2015-08-03 13:42',
    'title' => '日本福岛县海域发生里氏4.9级地震 未引发海啸',
    'description' => '日本福岛县海域发生里氏4.9级地震 未引发海啸...',
    'picUrl' => 'http://photocdn.sohu.com/20150803/Img418067158_ss.jpg',
    'url' => 'http://news.sohu.com/20150803/n418068517.shtml',
  ),
  2 => 
  array (
    'time' => '2015-08-03 13:41',
    'title' => '俄媒：美国将动用飞机保护在叙受训部队',
    'description' => '俄媒：美国将动用飞机保护在叙受训部队...',
    'picUrl' => 'http://photocdn.sohu.com/20150803/Img418059433_ss.jpg',
    'url' => 'http://news.sohu.com/20150803/n418068416.shtml',
  ),
  3 => 
  array (
    'time' => '2015-08-03 13:40',
    'title' => '男子被控涉嫌33次虚报车祸 企图骗取巨额保险金',
    'description' => '男子被控涉嫌33次虚报车祸 企图骗取巨额保险金...',
    'picUrl' => 'http://photocdn.sohu.com/20150803/Img418058993_ss.jpg',
    'url' => 'http://news.sohu.com/20150803/n418068750.shtml',
  ),
  4 => 
  array (
    'time' => '2015-08-03 13:38',
    'title' => '东京连日迎高温酷暑天气 已致9人中暑身亡',
    'description' => '东京连日迎高温酷暑天气 已致9人中暑身亡...',
    'picUrl' => '',
    'url' => 'http://news.sohu.com/20150803/n418068530.shtml',
  ),
  5 => 
  array (
    'time' => '2015-08-03 13:37',
    'title' => '乌克兰敖德萨一大楼遭炸弹袭击 未造成人员伤亡',
    'description' => '乌克兰敖德萨一大楼遭炸弹袭击 未造成人员伤亡...',
    'picUrl' => '',
    'url' => 'http://news.sohu.com/20150803/n418068631.shtml',
  ),
  6 => 
  array (
    'time' => '2015-08-03 13:37',
    'title' => '默克尔或有意参加2017德大选 民调显示支持率高',
    'description' => '默克尔或有意参加2017德大选 民调显示支持率高...',
    'picUrl' => '',
    'url' => 'http://news.sohu.com/20150803/n418069057.shtml',
  ),
  7 => 
  array (
    'time' => '2015-08-03 13:36',
    'title' => '日本回应遭美窃听事件 称身为盟友“极为遗憾”',
    'description' => '日本回应遭美窃听事件 称身为盟友“极为遗憾”...',
    'picUrl' => '',
    'url' => 'http://news.sohu.com/20150803/n418067294.shtml ',
  ),
  8 => 
  array (
    'time' => '2015-08-03 13:34',
    'title' => '二战中国三菱受害劳工团体声明：接受和解',
    'description' => '二战中国三菱受害劳工团体声明：接受和解...',
    'picUrl' => '',
    'url' => 'http://news.sohu.com/20150803/n418067157.shtml',
  ),
  9 => 
  array (
    'time' => '2015-08-03 13:28',
    'title' => '“博科圣地”报复式袭击 尼日利亚13民众丧生',
    'description' => '“博科圣地”报复式袭击 尼日利亚13民众丧生...',
    'picUrl' => '',
    'url' => 'http://news.sohu.com/20150803/n418066970.shtml',
  ),
  'code' => '200',
  'msg' => 'ok',
);

echo json_encode($json_array_temp);