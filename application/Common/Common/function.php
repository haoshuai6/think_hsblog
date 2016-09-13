<?php
/**
 * Created by PhpStorm.
 * User: hao
 * Date: 2016-08-21
 * Time: 15:25
 */
// 检测验证码
function check_verify($code){
    $verify=new \Think\Verify();
    return $verify->check($code);
}
// 设置验证码
function show_verify($config=''){
    if($config==''){
        $config=array(
            'codeSet'=>'123456789zxcvbnmlkjhgfdsaqwertyuip',
            'fontSize'=>30,
            'useCurve'=>false,
            'imageH'=>60,
            'imageW'=>240,
            'length'=>4,
            'fontttf'=>'4.ttf',
        );
    }
    $verify=new \Think\Verify($config);
    return $verify->entry();
}
/** 创建TOKEN */
function creatToken() {
    $code = chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE));
    session('TOKEN', authcode($code));
}
/** 判断TOKEN */
function checkToken($token) {
    if ($token == session('TOKEN')) {
        session('TOKEN', NULL);
        return TRUE;
    } else {
        return FALSE;
    }
}
/** 加密TOKEN */
function authcode($str) {
    $key = "HSBLOGS";
    $str = substr(md5($str), 8, 10);
    return md5($key . $str);
}
/*if (!checkToken($_POST['TOKEN'])) {
    echo  "自定义令牌验证错误";
}else{
    //创建token
    creatToken();
    //<input type="hidden" name="TOKEN" value="{:session('TOKEN')}"> 
}*/

/**
 * 检测FORM是否提交
 * @param  $check_token 是否验证token
 * @return boolean
 */
function chksubmit($check_token = false){
    $submit = isset($_POST['form_submit']) ? $_POST['form_submit'] : $_GET['form_submit'];
    if ($submit != 'ok') return false;
    if ($check_token && !checkToken()){
            return -11;
    }
    return true;
}
