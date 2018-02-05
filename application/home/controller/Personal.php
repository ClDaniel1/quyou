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
        $am=new \app\home\model\Personal();
        $data=$am->region();
        $this->assign("region",$data);
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
        if(count($arr) >1){
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
                $returnMsg=config('msg')['personal']['changeOK'];
                return json($returnMsg);
            }else{
                $returnMsg=config('msg')['personal']['changeErr'];
                return json($returnMsg);
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
            $returnMsg=config('msg')['personal']['repeatPwd'];
            return json($returnMsg);
        }else{
            $res=$model->changePwd($uid,$data);
            if($res){
                $returnMsg=config('msg')['personal']['changeOK'];
                return json($returnMsg);
            }else{
                $returnMsg=config('msg')['personal']['changeErr'];
                return json($returnMsg);
            }
        }
    }


    //头像上传
    public function upload(){
        if(empty($_FILES)){
            $w = input("param.size");
            session("img",$w);
        }
        else{
            $resMsg = ["code"=>50001,
                "msg"=>"",
                "data"=>[]];

            //检查是否有用户文件夹
            $uid = cookie("uid");
            $userDir = "static/images/user/".$uid;
            if(!(is_dir($userDir))){
                mkdir($userDir);
            }
            //移动文件到用户文件夹
            $type = $_FILES["file"]["type"];
            $type = explode("/",$type)[1];
            $path = $userDir."/head".".".$type;
            move_uploaded_file($_FILES["file"]["tmp_name"],$path);

            $image = \think\Image::open($path);// 原图
            $x = $width = $image->width();//获取图片的宽
            $y = $height = $image->height(); //获取图片的高


            //原图宽高确认
           /* if($x<1350 || $y < 480){
                $resMsg["code"] = 50002;
                $resMsg["msg"] = config("msg")["note"]["imgTooSmall"];
                return json($resMsg);
            }*/

            $size = json_decode(session("img"),true);

            $w = $size[0]; //切图时图片宽高
            $sw = $size[1];//选择区域开始x
            $sh = $size[2];//选择区域开始y
            $ew = $size[3];//选择区域结束x
            $eh = $size[4];//选择区域结束y

            //计算比例
            $scale = $w/$x;
            $rsw = $sw/$scale;//实际选择区域开始x
            $rsh = $sh/$scale;//实际选择区域开始y
            $rew = $ew/$scale;//实际选择区域结束x
            $reh = $eh/$scale;//实际选择区域结束y

            //裁剪后大小确认
            /*if($rew-$rsw<900 || $reh-$rsh < 300){
                $resMsg["code"] = 50003;
                $resMsg["msg"] = config("msg")["note"]["imgSelectTooSmall"];
                return json($resMsg);
            }
            //确认裁剪比例
            if(round(($rew-$rsw)/($reh-$rsh)) != 3){
                $resMsg["code"] = 50004;
                $resMsg["msg"] = config("msg")["note"]["scaleErr"];
                return json($resMsg);
            }*/

            //裁图
            $image->crop($rew-$rsw, $reh-$rsh,$rsw,$rsh)->save($path);

            $userPath = "images/user/".$uid."/head".".".$type;

            //存数据库
            $resMsg["data"]["url"] = $userPath;
            $model = new \app\home\model\Personal();
            $model->upload($uid,$userPath);
            return json($resMsg);
        }
    }

    //获取城市
    public function getCitys(){
        $regionId=input('param.regionId');
        $str=new \app\home\model\Personal();
        $run=$str->getCitys($regionId);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
}

