<?php
namespace app\home\controller;
use \think\Request;
use \think\Response;
use \think\Db;
use \think\Loader;
use \think\Session;

class Login extends \think\Controller
{
    public function login()
    {
        return $this->fetch('login');
    }

    //登录方法
    public function doLogin(){
        $uphone=input('?post.uphone')? input('uphone'):'';
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
        $where=[
            'uphone' =>  $uphone,
            'upwd'   =>   $upwd
        ];
        //查询数据库
        $result=db('t_user') -> where($where) ->find();

        //登录失败
        if(empty($result)){
            $returnMsg=[
                'code' =>  10003,
                'msg'  =>  config('msg')['login']['accountError'],
                'data' =>  []
            ];
            return json($returnMsg);
        }
        //登录成功 存入session
        Session::set('userInfo',$result);

        //登录成功 存入cookie
        // 初始化
        cookie(['prefix' => 'quyou_', 'expire' => 3600]);

        // 设置
        cookie('uphone',$result['uphone'], 3600);
        cookie('uheadImg',$result['uheadImg'], 3600);

        $returnMsg=[
            'code' =>  10001,
            'msg'  =>  config('msg')['login']['successLogin'],
            'data' =>  []
        ];
        return json($returnMsg);

    }
}
