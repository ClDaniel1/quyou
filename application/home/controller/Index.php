<?php
namespace app\home\controller;


use app\home\model\Ad;

class Index extends \think\Controller
{
    /**
     * 显示首页
     * @return mixed
     */
    public function index()
    {
        //引用广告模型，获取广告内容
        $am = new Ad();
        $data= $am->getAd();
        //将广告数据绑定到ad变量
        $this->assign("ad",$data);
        return $this->fetch('index');
    }

    public function err($str="OHH~<br>好像出错了，请重试",$url=""){
        if($url == ""){
            $url = url("home/index/index");
        }
        $this->assign("str",$str);
        $this->assign("url",$url);
        return $this->fetch("index/err");
    }
}
