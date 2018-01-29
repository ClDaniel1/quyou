<?php
namespace app\home\controller;

use app\home\model\User;
use \think\Request;
use \think\Response;
use \think\Db;
use \think\Loader;
use \think\Session;
use org\RadomStr;

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
       $um = new User();
       $result = $um->login($where);

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
        

        //生成登录32位随机字符串，来验证登录是否有效
        $radom = new RadomStr();
        $loginKey = $radom->get(32);

        //登录key存入数据库
        $um->setKey($result['uphone'],$loginKey);

        // 设置
        cookie('uphone',$result['uphone'], 3600);
        cookie('ukey',$loginKey, 3600);



        $returnMsg=[
            'code' =>  10001,
            'msg'  =>  config('msg')['login']['successLogin'],
            'data' =>  []
        ];
        return json($returnMsg);

    }

    public function check(){
        $returnMsg=[
            'code' =>  "",
            'msg'  =>  "",
            'data' =>  []
        ];
        cookie(['prefix' => 'quyou_', 'expire' => 3600,'path'=>'/']);
        //判断是否有用户信息
        if(cookie("uphone")==null){
            if(cookie("ukey")!=null){
                cookie("ukey",null);
            }
            //用户没有登录
            $returnMsg['code'] = 10010;
            return json($returnMsg);
        }
        else{
            //用户key为空，取消登陆状态，需要重新登录
            if(cookie("ukey")==null){
                $returnMsg['code'] = 10009;
                cookie("uphone",null);
                $returnMsg['msg'] = config('msg')['loginChek']['err'];
                return json($returnMsg);
            }
            else{
                $uphone = cookie('uphone');
                $ukey = cookie('ukey');
                $where=[
                    'uphone' =>  $uphone,
                    'loginKey'   =>   $ukey
                ];

                //检查登录信息
                $um = new User();
                $res = $um->checkLogin($where);

                if(empty($res)){
                    //检查失败
                    cookie("uphone",null);
                    cookie("ukey",null);
                    $returnMsg['code'] = 10009;
                    $returnMsg['msg'] = config('msg')['loginChek']['err'];
                    return json($returnMsg);
                }
                else{
                    //检查成功
                    $returnMsg['code'] = 10011;
                    $url = url("home/personal/personal");
                    $returnMsg["data"]=["userImg" => "/quyou/public/static/".$res["uheadImg"],"userUrl"=>$url];
                    return json($returnMsg);
                }
            }
        }
    }
}
