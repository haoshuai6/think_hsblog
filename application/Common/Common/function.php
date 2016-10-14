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
/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
/*  示例
    $str='123/456/789';
    cut_str($str,'/',0);  返回 123
    cut_str($str,'/',-1);  返回 789
    cut_str($str,'/',-2);  返回 456
    具体参考 http://www.baijunyao.com/index.php/Home/Index/article/aid/18
*/
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}

/**
 * 发送邮件
 * @param  string $address 需要发送的邮箱地址
 * @param  string $subject 标题
 * @param  string $content 内容
 * @return boolean         是否成功
 */
function send_email($address,$subject,$content){
    $email_smtp=C('EMAIL_SMTP');
    $email_username=C('EMAIL_USERNAME');
    $email_password=C('EMAIL_PASSWORD');
    $email_from_name=C('EMAIL_FROM_NAME');
    if(empty($email_smtp) || empty($email_username) || empty($email_password) || empty($email_from_name)){
        return array("error"=>1,"message"=>'邮箱配置不完整');
    }
    require './ThinkPHP/Library/Org/Bjy/class.phpmailer.php';
    require './ThinkPHP/Library/Org/Bjy/class.smtp.php';
    $phpmailer=new \Phpmailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $phpmailer->IsSMTP();
    // 设置为html格式
    $phpmailer->IsHTML(true);
    // 设置邮件的字符编码'
    $phpmailer->CharSet='UTF-8';
    // 设置SMTP服务器。
    $phpmailer->Host=$email_smtp;
    // 设置为"需要验证"
    $phpmailer->SMTPAuth=true;
    // 设置用户名
    $phpmailer->Username=$email_username;
    // 设置密码
    $phpmailer->Password=$email_password;
    // 设置邮件头的From字段。
    $phpmailer->From=$email_username;
    // 设置发件人名字
    $phpmailer->FromName=$email_from_name;
    // 添加收件人地址，可以多次使用来添加多个收件人
    $phpmailer->AddAddress($address);
    // 设置邮件标题
    $phpmailer->Subject=$subject;
    // 设置邮件正文
    $phpmailer->Body=$content;

    // 发送邮件。
    if(!$phpmailer->Send()) {
        $phpmailererror=$phpmailer->ErrorInfo;
        return array("error"=>1,"message"=>$phpmailererror);
    }else{
        return array("error"=>0);
    }
}

/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end    结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1,$end=10,$length=4){
    $connt=0;
    $temp=array();
    while($connt<$length){
        $temp[]=mt_rand($start,$end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);
    return $data;
}

/**
 * 传递ueditor生成的内容获取其中图片的路径
 * @param  string $str 含有图片链接的字符串
 * @return array       匹配的图片数组
 */
function get_ueditor_image_path($str){
    $preg='/\/data\/upload\/images\/\d*\/\d*\.[jpg|jpeg|png|bmp]*/i';
    preg_match_all($preg, $str,$data);
    return current($data);
}

/**
 * 将ueditor存入数据库的文章中的图片绝对路径转为相对路径
 * @param  string $content 文章内容
 * @return string          转换后的数据
 */
function preg_ueditor_image_path($data){
    // 兼容图片路径
    $root_path=rtrim($_SERVER['SCRIPT_NAME'],'/index.php');
    // 正则替换图片
    $data=htmlspecialchars_decode($data);
    $data=preg_replace('/src=\"^\/.*\/Upload\/image\/ueditor$/','src="'.$root_path.'/Upload/image/ueditor',$data);
    return $data;
}

/**
 * 将字符串分割为数组
 * @param  string $str 字符串
 * @return array       分割得到的数组
 */
function mb_str_split($str){
    return preg_split('/(?<!^)(?!$)/u', $str );
}

/**
 * 获取访问用户ip
 */
function getRealIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 * 传递图片路径根据配置项添加水印
 * @param string $path 图片路径
 */
function add_water($path){
    $image=new \Think\Image();
    if(C('WATER_TYPE')==1){
        $image->open($path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save($path);
    }elseif(C('WATER_TYPE')==2){
        $image->open($path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save($path);
    }elseif(C('WATER_TYPE')==3){
        $image->open($path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save($path);
        $image->open($path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save($path);
    }
}

function sendSMS(){
    vendor('alidayu.TopSdk');
    $appkey = '';
    $secret = '';
    $c = new TopClient;
    $c->appkey = $appkey;
    $c->secretKey = $secret;
    $c->format = 'json';
    function SendDayuSMS()
    {
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend('123456');
        $req->setSmsType('normal');
        $req->setSmsFreeSignName(''); //发送的签名
        $req->setSmsParam("{ 'code':'1234','product':''}");//根据模板进行填写
        $req->setRecNum('18705');//接收着的手机号码
        $req->setSmsTemplateCode('SMS_4035770');
        $resp = $c->execute($req);
        print_r($resp);
    }
}


