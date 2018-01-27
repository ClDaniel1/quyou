<?php
/**
 * Created by lqr.
 * User: lenovo
 * Date: 2018/1/26
 * Time: 11:46
 */

namespace app\home\controller;

class Setting extends \think\Controller
{
    public function setting()
    {
        return $this->fetch('setting');
    }

}