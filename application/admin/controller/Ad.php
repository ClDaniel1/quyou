<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/1
 * Time: 9:59
 */

namespace app\admin\controller;


use org\RadomStr;

class Ad extends \think\Controller
{
    public function ad(){
        $am = new \app\admin\model\Ad();
        $data= $am->getAd();
        $this->assign("ad",$data);
        return $this->fetch();
    }

    public function upImg(){

        $dir = "static/upload";

        $radom = new RadomStr();
        $fileName = $radom->get("16").time();

        //移动文件到用户文件夹
        $type = $_FILES["file"]["type"];
        $type = explode("/",$type)[1];
        $path = $dir."/".$fileName.".".$type;
        move_uploaded_file($_FILES["file"]["tmp_name"],$path);

        $userPath = "upload/".$fileName.".".$type;

        $reMsg=[
            "code"=>60001,
            "msg" => "",
            "data"=>[$userPath]
        ];

        return json($reMsg);
    }

    public function setAd(){
        $adtype = input("param.type");
        $content = input("param.content");
        $url = input("param.url");
        $img = input("param.img");

        if($adtype==0){
            $newImg = "images/ad/";
            $oldPath = "static/".$img;
            $rand = new RadomStr();
            $type = explode(".",$img)[1];
            while (1){
                $name = $rand->get(32).".".$type;
                $newName = "static/".$newImg.$name;
                if(!file_exists($newName)){
                    break;
                }
            }
            copy($oldPath,$newName);
            unlink($oldPath);
            $img = $newImg.$name;
        }



        $am = new \app\admin\model\Ad();

        if($adtype == 0 || $adtype == 1){
            $am->setAd($content,$img,$url,$adtype);
            return 1;
        }
    }

    public function delAd(){
        $adId = input("param.adId");
        $am = new \app\admin\model\Ad();
        $info = $am->getAdById($adId);
        if($info[0]["img"]!=""){
            $path = "static/".$info[0]["img"];
            unlink($path);
        }
        $am->removeAd($adId);
        return 1;
    }
}