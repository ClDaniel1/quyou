<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/28
 * Time: 11:11
 */

namespace org;


class RadomStr
{
    public function get($length = 6){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}