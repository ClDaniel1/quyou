<?php
namespace app\home\controller;


class Index extends \think\Controller
{
    public function index()
    {
        $am = new \app\admin\model\Ad();
        $data= $am->getAd();
        $this->assign("ad",$data);
        return $this->fetch('index');
    }
}
