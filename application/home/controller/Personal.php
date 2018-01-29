<?php
/**
 * Created by lqr.
 * User: lenovo
 * Date: 2018/1/26
 * Time: 10:35
 */

namespace app\home\controller;

class Personal extends \think\Controller
{
    public function personal()
    {
        return $this->fetch('personal');
    }

    public function setting()
    {
        return $this->fetch('setting');
    }

}

