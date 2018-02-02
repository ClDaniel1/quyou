<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/1
 * Time: 13:27
 */

namespace app\home\model;


class Ad
{
    public function getAd(){
        $data = db("t_ad")->select();
        return $data;
    }


}