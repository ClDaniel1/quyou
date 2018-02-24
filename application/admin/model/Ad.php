<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/1
 * Time: 13:27
 */

namespace app\admin\model;


class Ad
{
    public function setAd($content,$img,$url,$adType){
        $data = [
            "content" => $content,
            "url" => $url,
            "adType"=>$adType,
            "img"=>$img
        ];

        db("t_ad")->insert($data);
    }

    public function getAd(){
        $data = db("t_ad")->order('adId')->select();
        return $data;
    }

    public function getAdById($adId){
        $data = db("t_ad")->where('adId',$adId)->select();
        return $data;
    }

    public function removeAd($adId){
        db("t_ad")->where('adId',$adId)->delete();
    }
}