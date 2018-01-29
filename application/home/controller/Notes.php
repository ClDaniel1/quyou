<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/28
 * Time: 18:04
 */

namespace app\home\controller;


class Notes extends \think\Controller
{
    public function notes(){
        $um = new User();
        $res = $um->checkLogin();
        if($res){
            $uphone = cookie("uphone");

            return $this->fetch("note");
        }else{
            $this->error('很抱歉，请登录后再试');
        }
    }

    public function setUp(){

        if(empty($_FILES)){
            $w = input("param.size");
            var_dump($w);
            session("img",$w);
        }
        else{

            $resMsg = ["code"=>50001,
                                "msg"=>"",
                                "data"=>[]];


            $uphone = cookie("quyou_uphone");
            $userDir = "static/images/user/".$uphone;
            if(!(is_dir($userDir))){
                mkdir($userDir);
            }
            move_uploaded_file($_FILES["file"]["tmp_name"],$userDir."/temp.jpg");

            $image = $userDir."/temp.jpg"; // 原图
            $imgstream = file_get_contents($image);
            $im = imagecreatefromstring($imgstream);
            $x = imagesx($im);//获取图片的宽
            $y = imagesy($im);//获取图片的高

            if($x<1350 || $y < 480){
                $resMsg["code"] = 50002;
                $resMsg["msg"] = config("msg")["note"]["imgTooSmall"];
                return json($resMsg);
            }

            $size = json_decode(session("img"),true);

            $w = $size[0];
            $sw = $size[1];
            $sh = $size[2];
            $ew = $size[3];
            $eh = $size[4];

            $scale = $w/$x;

            $rsw = $sw/$scale;
            $rsh = $sh/$scale;
            $rew = $ew/$scale;
            $reh = $eh/$scale;

            if($rew-$rsw<900 || $reh-$rsh < 300){
                $resMsg["code"] = 50003;
                $resMsg["msg"] = config("msg")["note"]["imgSelectTooSmall"];
                return json($resMsg);
            }
            if(round(($rew-$rsw)/($reh-$rsh)) != 3){
                $resMsg["code"] = 50004;
                $resMsg["msg"] = config("msg")["note"]["scaleErr"];
                return json($resMsg);
            }


            $source=imagecreatefromjpeg($image);
            $croped=imagecreatetruecolor($rew-$rsw, $reh-$rsh);
            imagecopy($croped, $source, 0, 0, $rsw, $rsh,$rew-$rsw , $reh-$rsh);

            imagejpeg($croped, $userDir."/temp.jpg");
            imagedestroy($croped);

            $userDir = "images/user/".$uphone;

            $resMsg["data"]["url"] = $userDir."/temp.jpg";

            return json($resMsg);
        }



    }

}