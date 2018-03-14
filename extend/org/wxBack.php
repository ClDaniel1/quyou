<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/3/14
 * Time: 11:09
 */
namespace org;
class wxBack{
    public function get(){
        file_put_contents("fans.txt","123");
        $msg = file_get_contents("php://input");

        file_put_contents("fans.txt",$msg);


        $msgObj = simplexml_load_string($msg, 'SimpleXMLElement', LIBXML_NOCDATA);

        if($msgObj->result_code == "SUCCESS"){
            $no = $msgObj->out_trade_no;
            if($msgObj->return_code == "SUCCESS"){
                //session($no, 'ok');
                return true;
            }
            //session($no, 'err');
        }

        return false;

    }
}


