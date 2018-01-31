<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/28
 * Time: 18:04
 */

namespace app\home\controller;


use org\RadomStr;

class Notes extends \think\Controller
{
    //编辑游记入口
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function notes(){
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $uid = cookie("uid");
        if($res){
            $nm = new \app\home\model\Notes();
            $data = $nm->draft($uid);
            if(count($data)>0 && !input("?param.new")){
                $this->assign("notes",$data);
                return $this->fetch("draft");
            }
            else{
                $id = cookie("uid");
                $nm = new \app\home\model\Notes();
                //创建游记
                $id = $nm->creatNote($id);

                $this->redirect('home/Notes/edit',["id"=>$id]);
            }

        }else{
            $this->error('很抱歉，请登录后再试');
        }
    }


    //设置游记头图
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function setUp(){

        if(empty($_FILES)){
            $w = input("param.size");
            session("img",$w);
        }
        else{

            $resMsg = ["code"=>50001,
                                "msg"=>"",
                                "data"=>[]];

            $noteId = input("param.noteId");
            //检查是否有用户文件夹
            $uid = cookie("uid");
            $userDir = "static/images/user/".$uid;
            if(!(is_dir($userDir))){
                mkdir($userDir);
            }
            $userDir = $userDir."/note/";
            if(!(is_dir($userDir))){
                mkdir($userDir);
            }
            $userDir = $userDir.$noteId;
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
            if($x<1350 || $y < 480){
                $resMsg["code"] = 50002;
                $resMsg["msg"] = config("msg")["note"]["imgTooSmall"];
                return json($resMsg);
            }

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
            if($rew-$rsw<900 || $reh-$rsh < 300){
                $resMsg["code"] = 50003;
                $resMsg["msg"] = config("msg")["note"]["imgSelectTooSmall"];
                return json($resMsg);
            }
            //确认裁剪比例
            if(round(($rew-$rsw)/($reh-$rsh)) != 3){
                $resMsg["code"] = 50004;
                $resMsg["msg"] = config("msg")["note"]["scaleErr"];
                return json($resMsg);
            }

            $image->crop($rew-$rsw, $reh-$rsh,$rsw,$rsh)->save($path);

            $userPath = "images/user/".$uid."/note/".$noteId."/head".".".$type;

            $resMsg["data"]["url"] = $userPath;

            $nm = new \app\home\model\Notes();
            $nm->setUp($noteId,$userPath);

            return json($resMsg);
        }



    }

    public function edit(){
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        if($res){
        $id = input("param.id");
        $nm = new \app\home\model\Notes();


        //获取游记基本信息
        $info = $nm->getNoteInfo($id)[0];

        //获取游记内容
        $con = $nm->getNoteCont($id);

        $this->assign("info",$info);
        $this->assign("con",$con);
        $this->assign("noteId",$id);

        return $this->fetch("note");
        }else{
            $this->error('很抱歉，请登录后再试',url("home/User/login"));
        }
    }

    public function getCon(){
        $id = input("param.id");
        $nm = new \app\home\model\Notes();
        $con = $nm->getNoteCont($id);

        $reMsg=[
            "code" =>"",
            "msg" =>"",
            "data"=>$con
        ];

        return json($reMsg);
    }

    public function save(){
       $data = input("param.sData/a");
       $noteId = input("param.id");

       $nm = new \app\home\model\Notes();
       $nm ->delCon($noteId);

       foreach ($data as $val){
           $nm->upCon($noteId,$val["content"],$val["type"],$val["num"],$val["title"]);
       }
    }

    public function addImg(){
        $noteId = input("param.noteId");
        //检查是否有用户文件夹
        $uid = cookie("uid");
        $userDir = "static/images/user/".$uid;
        if(!(is_dir($userDir))){
            mkdir($userDir);
        }
        $userDir = $userDir."/note/";
        if(!(is_dir($userDir))){
            mkdir($userDir);
        }
        $userDir = $userDir.$noteId;
        if(!(is_dir($userDir))){
            mkdir($userDir);
        }

        $radom = new RadomStr();
        $fileName = $radom->get("16").time();

        //移动文件到用户文件夹
        $type = $_FILES["file"]["type"];
        $type = explode("/",$type)[1];
        $path = $userDir."/".$fileName.".".$type;
        move_uploaded_file($_FILES["file"]["tmp_name"],$path);

        $userPath = "images/user/".$uid."/note/".$noteId."/".$fileName.".".$type;

        $reMsg=[
            "code"=>50005,
            "msg" => "",
            "data"=>[$userPath]
        ];

        return json($reMsg);
    }

    public function addMusic(){
        $noteId = input("param.noteId");
        //检查是否有用户文件夹
        $uid = cookie("uid");
        $userDir = "static/music/user/".$uid;
        if(!(is_dir($userDir))){
            mkdir($userDir);
        }
        $userDir = $userDir."/note/";
        if(!(is_dir($userDir))){
            mkdir($userDir);
        }
        $userDir = $userDir.$noteId;
        if(!(is_dir($userDir))){
            mkdir($userDir);
        }
        else{
            $filehand = opendir($userDir);
            while(($filesname = readdir($filehand))!=false){
                if($filesname!="."&&$filesname!=".."){
                        unlink($userDir."/".$filesname);
                }
            }
            closedir($filehand);
        }

        $radom = new RadomStr();
        $fileName = $radom->get("16").time();

        //移动文件到用户文件夹
        $type = $_FILES["file"]["type"];
        $type = explode("/",$type)[1];
        $path = $userDir."/".$fileName.".".$type;
        move_uploaded_file($_FILES["file"]["tmp_name"],$path);

        $userPath = "music/user/".$uid."/note/".$noteId."/".$fileName.".".$type;

        $nm = new \app\home\model\Notes();
        $nm->setMusic($noteId,$userPath);

        $reMsg=[
            "code"=>50007,
            "msg" => config("msg")["note"]["musicSuccess"],
            "data"=>[$userPath]
        ];
        return json($reMsg);
    }

    public function removeImg(){
        $path = "static/".input("param.src");
        if(file_exists($path)){
            unlink($path);
        }
    }

    public function setTitle(){
        $title = input("param.title");
        $noteId = input("param.id");
        $nm = new \app\home\model\Notes();
        $nm->setTitle($noteId,$title);
        $resMsg=[
            "code"=>"50006"
        ];
        return json($resMsg);
    }

    public function reMusic(){
        $uid = cookie("uid");
        $noteId = input("param.noteId");
        $userDir = "static/music/user/".$uid."/note/".$noteId;
        $filehand = opendir($userDir);
        while(($filesname = readdir($filehand))!=false){
            if($filesname!="."&&$filesname!=".."){
                unlink($userDir."/".$filesname);
            }
        }
        closedir($filehand);
        $nm = new \app\home\model\Notes();
        $nm->reMusic($noteId);
        $reMsg=[
            "code"=>50008,
            "msg" => config("msg")["note"]["remusicSuccess"],
            "data"=>[]
        ];
        return json($reMsg);
    }

    public function getRegion(){
        $resMsg =[
          "code"=>"",
          "msg" => "",
          "data" => []
        ];
        $nm = new \app\home\model\Notes();
        if(input("?param.pr")){
            $data = $nm->getCity(input("param.pr"));
            $resMsg["data"][0]=$data;
        }
        else{
            $data1 = $nm->getRegion();
            $data2 = $nm->getCity($data1[0]["REGION_ID"]);

            $resMsg["data"][0]=$data1;
            $resMsg["data"][1]=$data2;


        }
        return json($resMsg);
    }
}