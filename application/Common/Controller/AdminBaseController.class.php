<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 后台基类Controller
 */
class AdminBaseController extends BaseController{
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();
        if(session('hsblog_admin')!= 'hsblog_is_login'){
            //$this->redirect(U('Admin/Login/login'));
            $this->error('当前用户未登录或登录超时，请重新登录',U('Admin/Login/login'),'',1);
        }
    }
}

