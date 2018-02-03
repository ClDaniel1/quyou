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
            $returnMsg=config('msg')['login']['accountError'];
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
        cookie('uid',$result['uid']);
        cookie('ukey',$loginKey);

        $returnMsg=config('msg')['login']['successLogin'];
        return json($returnMsg);

    }

    public function checkLogin(){

        //判断是否有用户信息
        if(cookie("uid")==null){
            if(cookie("ukey")!=null){
                cookie("ukey",null);
            }
            //用户没有登录
            return false;
        }
        else{
            //用户key为空，取消登陆状态，需要重新登录
            if(cookie("ukey")==null){
                cookie("uid",null);
                return false;
            }
            else{
                $uid = cookie('uid');
                $ukey = cookie('ukey');
                $where=[
                    'uid' =>  $uid,
                    'loginKey'   =>   $ukey
                ];

                //检查登录信息
                $um = new \app\home\model\User();
                $res = $um->checkLogin($where);

                if(empty($res)){
                    //检查失败
                    cookie("uid",null);
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
        if(cookie("uid")==null){
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
                cookie("uid",null);
                $returnMsg=config('msg')['loginChek']['err'];
                return json($returnMsg);
            }
            else{
                $uid = cookie('uid');
                $ukey = cookie('ukey');
                $where=[
                    'uid' =>  $uid,
                    'loginKey'   =>   $ukey
                ];

                //检查登录信息
                $um = new \app\home\model\User();
                $res = $um->checkLogin($where);

                if(empty($res)){
                    //检查失败
                    cookie("uid",null);
                    cookie("ukey",null);
                    $returnMsg = config('msg')['loginChek']['err'];
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
            $returnMsg=config('msg')['login']['codeError'];
            return json($returnMsg);
        }
        //新建时间
        $nowTime=date("Y-m-d H:i:s",time());
        $defaultImg="images/default.jpg";
        $data = ['uphone' => $uphone, 'uname' => $uname,
            'upwd' =>$upwd, 'uheadImg'=>$defaultImg,'uregTime'=>$nowTime
        ];
        $where=[
            'uphone' => $uphone
        ];

        //手机号查重
        $uphone=input('?post.uphone')? input('uphone'):'';
        $model=new \app\home\model\User();
        $phoneArr = $model->checkPhone($uphone);


        //账号查重
        $result=db('t_user') -> where($where) -> find();
        $model=new \app\home\model\Personal();
        $nameArr = $model->checkName($uname);

        //数据库添加数据
        if(!empty($result)){
            //用户重复
            $returnMsg=config('msg')['login']['haveUser'];;
            return json($returnMsg);
        }else if(count($phoneArr) >= 1){
            //手机号重复
            $returnMsg=config('msg')['login']['havePhone'];
            return json($returnMsg);
        }else if(count($nameArr) >= 1){
            //用户名重复
            $returnMsg=config('msg')['personal']['haveName'];
            return json($returnMsg);
        }else{
            $addres=Db::table('t_user')->insert($data);
            if($addres){
                //添加成功
                $returnMsg=config('msg')['login']['successReg'];
                return json($returnMsg);
            }else{
                //添加失败
                $returnMsg=config('msg')['login']['regError'];
                return json($returnMsg);
            }
        }
    }

    //手机号查重
    public function checkPhone(){
        $uphone=input('?post.uphone')? input('uphone'):'';
        $model=new \app\home\model\User();
        $arr = $model->checkPhone($uphone);
        if(count($arr) >= 1){
            //用户名重复
            $returnMsg= config('msg')['login']['havePhone'];
            return json($returnMsg);
        }else{
            $returnMsg=config('msg')['login']['withoutPhone'];
            return json($returnMsg);
        }
    }
        //昵称查重
    public function checkName(){
        $uname=input('?post.uname')? input('uname'):'';
        $model=new \app\home\model\User();
        $arr = $model->checkName($uname);
        if(count($arr) >= 1){
            //用户名重复
            $returnMsg=config('msg')['personal']['haveName'];
            return json($returnMsg);
        }else{
            $returnMsg=config('msg')['personal']['withoutName'];;
            return json($returnMsg);
        }
    }
}