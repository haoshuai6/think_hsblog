<?php
/**
 * Created by PhpStorm.
 * User: haoshuai_it
 * Date: 2016-10-13
 * Time: 17:03
 */
namespace Vendor\Alidayu;
class AlidayuSendMsg {

    public function sendSMS() {
        include_once('TopClient.class.php');
        include_once('RequestCheckUtil.class.php');
        include_once('ResultSet.class.php');
        include_once('TopLogger.class.php');
        include_once('AlibabaAliqinFcSmsNumSendRequest.class.php');

        $c = new \TopClient;
        $c->appkey = '23476581';
        $c->secretKey = '42cbc25c574852e80b017f802e4338cf';
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("HSBLOG");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("[HSBLOG]");
        $req->setSmsParam("{\"verify\":\"1234\"}");
        $req->setRecNum("15275166392");
        $req->setSmsTemplateCode("SMS_17160001");
        $resp = $c->execute($req);

        var_dump($resp);
        
    }

}
