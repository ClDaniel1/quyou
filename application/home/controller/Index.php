<?php
namespace app\home\controller;


class Index extends \think\Controller
{
    public function index()
    {
        return $this->fetch('index');
    }
}
