<?php
/**
 * Created by PhpStorm.
 * User: haoshuai_it
 * Date: 2016-11-19
 * Time: 10:35
 */
namespace Home\Controller;
use Common\Controller\BaseController;

class TestController extends BaseController{
      public function index(){
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
          echo json_encode($json_array);
      }
}