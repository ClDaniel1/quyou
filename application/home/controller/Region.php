<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 19:08
 */
namespace app\home\controller;

class Region extends \think\Controller
{
    public function region()//显示地区攻略
    {
        return $this->fetch();
    }
    public function hotel()//显示地区酒店
    {
        $rgId=isset($_GET['rgId'])?$_GET['rgId']:"";
        return $this->fetch('hotel');
    }
}
