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
    public function userTheShelves()
    {
        $uid=input('param.id');
        $ustatus=new \app\admin\model\User();
        $data=$ustatus->userTheShelves($uid);
        echo $data;

    }//停用
    public function userShelves()
    {
        $uid=input('param.id');
        $ustatus=new \app\admin\model\User();
        $data=$ustatus->userShelves($uid);
        echo $data;
    }//启用
    public function userPawRepair()
    {
        $uid = input('param.id');
        $upwd = new \app\admin\model\User();
        $data = $upwd->userPawRepair($uid);
        if($data==1)
        {
            $returnMsg=[
                'code'  =>  "ok",
                'msg'   =>  "密码重置成功!",
                'data'  =>  [$data]
            ];
            echo json_encode($returnMsg);
        }
        else
        {
            $returnMsg=[
                'code'  =>  "no",
                'msg'   =>  "密码重置失败",
                'data'  =>  [$data]
            ];
            echo json_encode($returnMsg);
        }

    }//密码重置
}