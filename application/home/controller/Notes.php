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
       return $this->fetch("note");
    }

    public function setUp(){

        if(empty($_FILES)){
            $w = input("param.size");
            var_dump($w);
            session("img",$w);
        }
        else{
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




            $source=imagecreatefromjpeg($image);
            $croped=imagecreatetruecolor($rew-$rsw, $reh-$rsh);
            imagecopy($croped, $source, 0, 0, $rsw, $rsh,$rew-$rsw , $reh-$rsh);

            imagejpeg($croped, $userDir."/temp.jpg");
            imagedestroy($croped);

            $userDir = "images/user/".$uphone;

            $resMsg = '{
                                    "code": 5001
                                  ,"msg": ""
                                  ,"data": {
                                    "src": "'.$userDir."/temp.jpg".'"
                                  }
                                }   ';

            echo $resMsg;
        }



    }
}