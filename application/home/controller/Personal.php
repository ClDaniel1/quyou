<?php
/**
 * Created by lqr.
 * User: lenovo
 * Date: 2018/1/26
 * Time: 10:35
 */

namespace app\home\controller;
use \think\Response;
use \think\Db;

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

    //显示信息
    public function getInfo(){
        $uid=input('?post.uid')? input('uid'):'';
        $where=[
            'uid' =>  $uid
        ];
        //查询数据库
        $um = new \app\home\model\Personal();
        $result = $um->getInfo($where);
        return json($result);

    }


    //更改信息
    public function changeInfo(){
        $uid=input('?post.uid')? input('uid'):'';
        $uname=input('?post.uname')? input('uname'):'';
        $email=input('?post.email')? input('email'):'';
        $usex=input('?post.usex')? input('usex'):'';
        $uage=input('?post.uage')? input('uage'):'';

        $data = ['uname' => $uname, 'email' => $email,
            'usex' =>$usex,'uage'=>$uage
        ];

        //账号查重
        $model=new \app\home\model\Personal();
        $arr = $model->checkName($uname);
        if(count($arr) >= 2){
            //用户名重复
            $returnMsg=[
                'code' =>  "haveName",
                'msg'  =>  config('msg')['personal']['haveName'],
                'data' =>  []
            ];
            return json($returnMsg);
        }else{
            $model=new \app\home\model\Personal();
            $res=$model->changeInfo($uid,$data);
            if($res){
                $returnMsg=[
                    'code'  =>  "changeOK",
                    'msg'   =>  config('msg')['personal']['changeOK'],
                    'data'  =>  []
                ];
                return json($returnMsg);
            }else{
                $returnMsg=[
                    'code'  =>  "changeErr",
                    'msg'   =>  config('msg')['personal']['changeErr'],
                    'data'  =>  []
                ];return json($returnMsg);
            }
        }
    }



    //修改密码
    public function changePwd(){
        $uid=input('?post.uid')? input('uid'):'';
        $upwd=input('?post.upwd')? input('upwd'):'';
        $data=[
            'upwd'=>$upwd
        ];

        //密码查重
        $model=new \app\home\model\Personal();

        $where=[
            'uid' =>  $uid,
            'upwd'   =>   $upwd
        ];
        $result = $model->checkPwd($where);

        if(!empty($result)){
            $returnMsg=[
                'code'  =>  "repeat",
                'msg'   =>  config('msg')['personal']['repeatPwd'],
                'data'  =>  []
            ];
            return json($returnMsg);
        }else{
            $res=$model->changePwd($uid,$data);
            if($res){
                $returnMsg=[
                    'code'  =>  "changeOK",
                    'msg'   =>  config('msg')['personal']['changeOK'],
                    'data'  =>  []
                ];
                return json($returnMsg);
            }else{
                $returnMsg=[
                    'code'  =>  "changeErr",
                    'msg'   =>  config('msg')['personal']['changeErr'],
                    'data'  =>  []
                ];return json($returnMsg);
            }
        }
    }

}

