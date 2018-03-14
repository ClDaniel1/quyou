<?php
/**
 * Created by lqr.
 * User: lenovo
 * Date: 2018/1/29
 * Time: 12:05
 */
namespace app\home\controller;
use org\Intro;
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

    public function myMsg(){
        return $this->fetch('msg');
    }

    //登录方法
    public function doLogin(){
        $uphone=input('?post.uphone')? input('uphone'):'';
        $upwd=input('?post.upwd')? input('upwd'):'';
        $code=input('?post.code')? input('code'):'';


        //验证码验证
        if(!captcha_check($code)){
            //验证失败
            $returnMsg=config('msg')['login']['codeError'];
            return json($returnMsg);
        }
        $where=[
            'uphone' =>  $uphone,
            'upwd'   =>   md5($upwd)
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

    public function dowxLogin(){
        $uphone=input('?post.userName')? input('userName'):'';
        $upwd=input('?post.psw')? input('psw'):'';

        $where=[
            'uphone' =>  $uphone,
            'upwd'   =>   md5($upwd)
        ];


        //查询数据库
        $um = new \app\home\model\User();
        $result = $um->login($where);

        //登录失败
        if(empty($result)){
            $returnMsg=config('msg')['login']['accountError'];
            return json($returnMsg);
        }

        $returnMsg=config('msg')['login']['successLogin'];
        $returnMsg["data"] = [$result["uid"]];
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
                    $unreadMsgNum = $um->getUnreadMsgNum($uid);
                    $returnMsg["data"]=["userImg" => "https://quyou.liner.fun/quyou/public/static/".$res["uheadImg"],"userUrl"=>$url,"msgNum"=>$unreadMsgNum,"uname"=>$res["uname"],"uid"=>$res["uid"]];
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
            'upwd' =>md5($upwd), 'uheadImg'=>$defaultImg,'uregTime'=>$nowTime,"payPwd"=>md5($upwd)
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

        //获取系统消息
    public function getSysMsg(){
        $res = $this->checkLogin();
        if($res || input("?param.uid")){
            $um = new \app\home\model\User();
            $uid = cookie('uid');

            $uid = input("?param.uid")?input("param.uid"):$uid;

            $data = $um->getSysMsg($uid);
            $returnMsg = config("msg")["msg"]["getSysMsg"];
            $returnMsg["data"] = $data;
        }
        else{
            $returnMsg = config("msg")["login"]["noLogin"];
        }
        return json($returnMsg);
    }


    public function wxLogin(){
        $code = input("code");

        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".config("APPID")."&secret=".config("APPSECRET")."&js_code=".$code."&grant_type=authorization_code";

        $cu = new Intro();
        $res = json_decode($cu->curlHttp($url),true);
        $openId = $res["openid"];
        $session_key = $res["session_key"];



        $m = new \app\home\model\User();

        $user = $m->wxIdLogin($openId);

        if(count($user)>0){
            $err = "true";
            $data =[$user[0]["uid"]];
        }
        else{
            $err = "10001";
            $data = $openId;
            file_put_contents($openId.".php",json_encode([$openId,$session_key]));
        }

        echo '{"err":"'.$err.'","data":'.json_encode($data).'}';
    }

    public function bind(){
        $userInfo = json_decode(input("param.userInfo"),true);
        $openId = input("param.id");
        $userName = input("param.userName");
        $psw = input("param.psw");
        $type = input("param.type");

        $set = file_exists($openId.".php");



        if($set){
            $userAcc = json_decode(file_get_contents($openId.".php"),true);
            $openId = $userAcc[0];

            $m = new \app\home\model\User();
            $where = [
                "uphone" => $userName,
                "upwd" => md5($psw)
            ];
            $res  = $m->login($where);
            if(!empty($res)){
                $id = $res["uid"];
                if(strlen($res["wechatId"]) > 10 && $type == 0){
                    $reMsg = config("msg")["userCon"]["haveWx"];
                }
                else{
                    $res = $m->bind($id,$openId);
                    if( $res == 1){
                        $user = $m->wxIdLogin($openId);
                        $reMsg = config("msg")["userCon"]["wxBindSucc"];
                        $reMsg["data"]=[$user[0]["uid"]];
                    }
                    else if ($res == "isset"){
                        //该微信号已绑定账号
                        $reMsg = config("msg")["userCon"]["wxBindhave"];
                    }
                    else{
                        //注册失败
                        $reMsg = config("msg")["userCon"]["wxBindErr"];
                    }
                }
            }
            else{
                $reMsg = config("msg")["login"]["accountError"];
            }

        }
        else{
            //没有缓存，重新调用微信登录
            $reMsg = config("msg")["userCon"]["wxBindTimeOut"];
        }

        if($set && $reMsg["code"]!=10003 && $reMsg["code"]!='40006'){
            unlink($openId.".php");
        }


        return json($reMsg);
    }

    public function oneKey(){
        session_start();
        $userInfo = json_decode(stripslashes(input("param.userInfo")),true);
        $openId = input("param.id");
        $uphone = input("param.uphone");

        $rad = new RadomStr();
        $userName = "qu_".$rad->get(9);

        $set = file_exists($openId.".php");
        $model=new \app\home\model\User();
        $arr = $model->checkPhone($uphone);
        if(count($arr) >= 1){
            //用户名重复
            $returnMsg= config('msg')['login']['havePhone'];
            return json($returnMsg);
        }else{
            if($set){
                $userAcc = json_decode(file_get_contents($openId.".php"),true);
                $openId = $userAcc[0];

                $m = new \app\home\model\User();
                $res  = $m->oneKey($userName,$uphone,$userInfo["avatarUrl"],$openId);
                if( $res == 1){
                    $user = $m->wxIdLogin($openId);

                    $reMsg = config("msg")["userCon"]["onKeySucc"];
                    $reMsg["data"]=[$uphone,$user[0]["uid"]];
                }
                else if ($res == "isset"){
                    //该微信号已绑定账号
                    $reMsg = config("msg")["userCon"]["wxBindhave"];
                }
                else{
                    //注册失败
                    $reMsg = config("msg")["login"]["regError"];
                };
            }
            else{
                //没有缓存，重新调用微信登录
                $reMsg = config("msg")["userCon"]["wxBindTimeOut"];
            }
        }



        if($set){
            unlink($openId.".php");
        }


        return json($reMsg);
    }


}