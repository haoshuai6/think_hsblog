<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 前台基类Controller
 */
class HomeBaseController extends BaseController{
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();
        //sidebar--date
        $weekarray = array("日","一","二","三","四","五","六");
        $week = "星期".$weekarray[date("w")];
        $date_info = date("Y").'年'.date("m").'月'.date("d").'日'.'  '.$week;
        $this->assign("date_info",$date_info);
    }
}

