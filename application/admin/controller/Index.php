<?php
namespace app\admin\controller;



class Index extends \think\Controller
{
    public function index()
    {
        $am=new \app\admin\model\Index();
        $data=$am->getMenu();
        $this->assign("menu",$data);
        return $this->fetch('index');
    }

    public function welcome(){
        return $this->fetch('welcome');
    }

    public function login(){
        return $this->fetch('login');
    }
    public function folderAppend()
    {
        $id=10001;

        mkdir("static/".$id,0777,true);
    }
}
