<?php
/**
 * Created by lqr.
 * User: lenovo
 * Date: 2018/1/25
 * Time: 11:21
 */
namespace app\home\controller;
use \think\Response;
use \think\Db;
class Register extends \think\Controller
{
    public function register()
    {
        return $this->fetch('register');
    }

    public function doRegister(){
        $uphone=input('?post.uphone')? input('uphone'):'';
        $uname=input('?post.uname')? input('uname'):'';
        $upwd=input('?post.upwd')? input('upwd'):'';
        $code=input('?post.code')? input('code'):'';

        //验证码验证
        if(!captcha_check($code)){
            //验证失败
            $returnMsg=[
                'code'  =>  10002,
                'msg'   =>  config('msg')['login']['codeError'],
                'data'  =>  []
            ];
            return json($returnMsg);
        }


        $data = ['uphone' => $uphone, 'uname' => $uname,
            'upwd' =>$upwd,
        ];
        $where=[
          'uphone' => $uphone
        ];

        //账号查重
        $result=db('t_user') -> where($where) -> find();

        //数据库添加数据
        if(!empty($result)){
            //用户重复
            $returnMsg=[
                'code' =>  10006,
                'msg'  =>  config('msg')['login']['haveUser'],
                'data' =>  []
            ];
            return json($returnMsg);
        }else{
            $addres=Db::table('t_user')->insert($data);
            if($addres){
                //添加成功
                $returnMsg=[
                    'code' =>  10005,
                    'msg'  =>  config('msg')['login']['successReg'],
                    'data' =>  []
                ];
                return json($returnMsg);
            }else{
                //添加失败
                $returnMsg=[
                    'code' =>  10004,
                    'msg'  =>  config('msg')['login']['regError'],
                    'data' =>  []
                ];
                return json($returnMsg);
            }
        }
    }
}