<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/4
 * Time: 15:55
 */

namespace app\admin\controller;


class Note extends \think\Controller
{
    public function note(){
        return $this->fetch("note");
    }
}