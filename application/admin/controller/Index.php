<?php
namespace app\admin\controller;



use org\RadomStr;

class Index extends \think\Controller
{
    public function index()
    {
        $res = $this->checkLogin();
        if($res){
            $am=new \app\admin\model\Index();
            $data=$am->getMenu();
            $this->assign("menu",$data);
            return $this->fetch('index');
        }
        else{
            $this->error('对不起,您还没有登录,正跳转至登录面...', 'admin/Index/login');
        }
    }

    public function welcome(){
        return $this->fetch('welcome');
    }

    public function login(){
        $res = $this->checkLogin();
        if($res){
            $this->redirect('admin/Index/index');
        }
        else{
            return $this->fetch('login');
        }

    }

    public function doLogin(){
        $userName = input("param.userName");
        $password = input("param.password");
        $captcha = input("param.captcha");

        if(!captcha_check($captcha)){
            //验证失败
            $resMsg = config("msg")["login"]["codeError"];
        }
        else{
            $sm = new \app\admin\model\System();
            $res = $sm -> doLogin($userName,md5($password));

            if(count($res)>0){
                $resMsg = config("msg")["login"]["successLogin"];
                $resMsg["data"] = ["staffId"=>$res[0]["staId"],"headImg"=>"images/cus.png","staffName"=>$res[0]["staName"]];
                cookie("adminId",$res[0]["staId"]);
                $ram = new RadomStr();
                $key = $ram->get(32);
                $sm->setKey($key,$res[0]["staId"]);
                cookie("adminKey",$key);
            }
            else{
                $resMsg = config("msg")["login"]["accountError"];
            }
        }
        return json($resMsg);
    }

    public function checkLogin(){
        //判断是否有用户信息
        if(cookie("adminId")==null){
            if(cookie("adminKey")!=null){
                cookie("adminKey",null);
            }
            //用户没有登录
            return false;
        }
        else{
            //用户key为空，取消登陆状态，需要重新登录
            if(cookie("adminKey")==null){
                cookie("adminId",null);
                return false;
            }
            else{
                $uid = cookie('adminId');
                $ukey = cookie('adminKey');
                $where=[
                    'staId' =>  $uid,
                    'key'   =>   $ukey
                ];

                //检查登录信息
                $sm = new \app\admin\model\System();
                $res = $sm->checkLogin($where);

                if(empty($res)){
                    //检查失败
                    cookie("adminId",null);
                    cookie("adminKey",null);
                    return false;
                }
                else{
                    //检查成功
                    return true;
                }
            }
        }
    }

    public function folderAppend()
    {
        $id=10001;
        mkdir("static/".$id,0777,true);
    }
}
