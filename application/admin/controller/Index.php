<?php
namespace app\admin\controller;



class Index extends \think\Controller
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function welcome(){
        return $this->fetch('welcome');
    }

    public function login(){
        return $this->fetch('login');
    }

    public function getMenu()
    {
        $str=new \app\admin\model\Index();
        $run=$str->getMenu();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }

}
