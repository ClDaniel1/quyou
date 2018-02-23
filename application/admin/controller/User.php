<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/4
 * Time: 16:06
 */

namespace app\admin\controller;


class User extends \think\Controller
{
    public function user()
    {
        $user=new \app\admin\model\User();
        $data=$user->userInformation();
        $this->assign('user',$data);
        return $this->fetch('user');
    }
    public function userCheck()
    {
        $uid=input('param.id');
        $user=new \app\admin\model\User();
        $data=$user->userCheck($uid);
        $this->assign('userCheck',$data);
        return $this->fetch('userCheck');
    }
    public function userAdd()
    {
        $uid=input('param.id');
        $user=new \app\admin\model\User();
        $data=$user->userCheck($uid);
        $this->assign('userAdd',$data);
        return $this->fetch('userAdd');
    }
    public function userTheShelves()
    {
        $uid=input('param.id');
        $ustatus=new \app\admin\model\User();
        $data=$ustatus->userTheShelves($uid);
        $returnMsg=config("msg")["userCon"]["stop"];
        $returnMsg["data"]=[$data];
        echo json_encode($returnMsg);

    }//停用
    public function userShelves()
    {
        $uid=input('param.id');
        $ustatus=new \app\admin\model\User();
        $data=$ustatus->userShelves($uid);
        $returnMsg=config("msg")["userCon"]["open"];
        $returnMsg["data"]=[$data];
        echo json_encode($returnMsg);
    }//启用
    public function userPawRepair()
    {
        $uid = input('param.id');
        $upwd = new \app\admin\model\User();
        $data = $upwd->userPawRepair($uid);
        $returnMsg=config("msg")["userCon"]["rePsw"];
        $returnMsg["data"]=[$data];
        echo json_encode($returnMsg);
    }//密码重置
    public function userDel()
    {
        $uid=input('param.id');
        $del=new \app\admin\model\User();
        $data = $del->userDel($uid);
        $returnMsg=config("msg")["userCon"]["del"];
        $returnMsg["data"]=[$data];
        echo json_encode($returnMsg);
    }//删除用户
    public function userRepair(){
        $uid=input('param.uid');
        $username=input('param.username');
        $sex=input('param.sex');
        $uphone=input('param.uphone');
        $email=input('param.email');
        $repair=new \app\admin\model\User();
        $data = $repair->userRepair($uid,$username,$sex,$uphone,$email);
        $returnMsg=config("msg")["userCon"]["Repair"];
        $returnMsg["data"]=[$data];
        echo json_encode($returnMsg);
    }//用户修改
}