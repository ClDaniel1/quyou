<?php
/**
 * Created by lqr.
 * User: lenovo
 * Date: 2018/1/29
 * Time: 12:05
 */
namespace app\home\controller;
use \think\Response;
use \think\Db;
use \think\Session;
use org\RadomStr;

class User extends \think\Controller
{
    //登录页面显示
    public function login()
    {
        return $this->fetch('login');
    }

    //注册页面显示
    public function register()
    {
        return $this->fetch('register');
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
        $um = new \app\home\model\User();
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
        cookie('uphone',$result['uid']);
        cookie('ukey',$loginKey);



        $returnMsg=[
            'code' =>  10001,
            'msg'  =>  config('msg')['login']['successLogin'],
            'data' =>  []
        ];
        return json($returnMsg);

    }

    public function checkLogin(){

        //判断是否有用户信息
        if(cookie("uphone")==null){
            if(cookie("ukey")!=null){
                cookie("ukey",null);
            }
            //用户没有登录
            return false;
        }
        else{
            //用户key为空，取消登陆状态，需要重新登录
            if(cookie("ukey")==null){
                cookie("uphone",null);
                return false;
            }
            else{
                $uphone = cookie('uphone');
                $ukey = cookie('ukey');
                $where=[
                    'uid' =>  $uphone,
                    'loginKey'   =>   $ukey
                ];

                //检查登录信息
                $um = new \app\home\model\User();
                $res = $um->checkLogin($where);

                if(empty($res)){
                    //检查失败
                    cookie("uphone",null);
                    cookie("ukey",null);
                    return false;
                }
                else{
                    //检查成功
                    return true;
                }
            }
        }
    }

    public function check(){
        $returnMsg=[
            'code' =>  "",
            'msg'  =>  "",
            'data' =>  []
        ];
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
                    'uid' =>  $uphone,
                    'loginKey'   =>   $ukey
                ];

                //检查登录信息
                $um = new \app\home\model\User();
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