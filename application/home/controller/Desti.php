<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/25
 * Time: 11:01
 */

namespace app\home\controller;


class Desti extends \think\Controller
{
    public function desti(){
        return $this->fetch("desti");
    }
}