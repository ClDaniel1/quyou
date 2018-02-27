<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/26
 * Time: 10:02
 */

namespace app\home\controller;


class Useorder extends \think\Controller
{
    public function show(){
        return $this->fetch();
    }
}