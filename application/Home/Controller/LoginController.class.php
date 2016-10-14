<?php
namespace Home\Controller;
use Common\Controller\BaseController;
/**
 * 前台登陆
 */
class LoginController extends BaseController{
    private $db_Users;
    public function __construct(){
        parent::__construct();
        $this->db_Users = M ('Users');
    }
    // 登陆页面
    public function login(){
        if(IS_POST){
            $data = I('post.');
            if(check_verify($data['verify'])){
                $user_info = $this->db_Users->where(array('user_name'=>$data['name']))->find();
                if(!empty($user_info) && is_array($user_info)){
                    if(md5($data['passwd']) == $user_info['user_pw']){
                        session('hsblog_admin','hsblog_is_login');
                        session('user_name',$user_info['user_name']);
                        session('user_id',$user_info['u_id']);
                        //记录本次登陆信息
                        $update_array['user_lastip'] = '127.0.0.1';
                        $update_array['user_lasttime'] = date('Y-m-d H:i:s',time());
                        $this->db_Users->where(array('u_id'=>$user_info['u_id']))->save($update_array);
                        $this->success('登陆成功',U('Home/Index/index'));
                    }else{
                        $this->error('密码输入错误',U('Home/Index/Index'));
                    }
                }else{
                    $this->error('用户不存在',U('Home/Index/Index'));
                }
            }else{
                $this->error('验证码输入错误',U('Home/Index/Index'));
            }
        }else{
            if(session('hsblog_admin') == 'hsblog_is_login'){
                $this->error('已经登录',U('Home/Index/index'));
            }
            $this->display();
        }
    }

    // 退出登录
    public function logout(){
        session('hsblog_admin',null);
        session('user_name',null);
        session('user_id',null);
        $this->success('退出成功',U('Home/Index/Index'));
    }

    // 生成验证码
    public function showVerify(){
        show_verify();
    }

}
