<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/28
 * Time: 18:04
 */

namespace app\home\controller;


use org\Page;
use org\RadomStr;


class Notes extends \think\Controller
{
    /**
     * 写游记入口
     * @return mixed
     */
    public function notes(){
        //用户控制器
        $um = new User();
        //验证是否登录
        $res = $um->checkLogin();
        //获取登录用户Id
        $uid = cookie("uid");
        //新建游记模型对象
        $nm = new \app\home\model\Notes();
        if($res){
            //获取游记草稿数据
            $data = $nm->draft($uid);
            //判断是否有游记草稿
            if(count($data)>0 && !input("?param.new")){
                //有，绑定数据到notes变量，引用草稿列表页面
                $this->assign("notes",$data);
                return $this->fetch("draft");
            }
            else{
                //创建游记
                $id = $nm->creatNote($uid);

                //转到游记编辑方法，附上游记Id
                $this->redirect('home/Notes/edit',["id"=>$id]);
            }

        }else{
            //用户没登陆
            $im = new Index();
            return $im->err("很抱歉，请先登录",url("home/User/login"));
        }
    }


    /**
     * 用户上传游记头图
     * @return \think\response\Json
     */
    public function setUp(){
        $noteId = input("param.noteId");
        $res = $this->isUserNote($noteId);
        //获取裁图数据
        if($res){
            if(empty($_FILES)){
                $w = input("param.size");
                session("img",$w);
            }
            else{
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
                    $resMsg = config("msg")["note"]["imgTooSmall"];
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
                    $resMsg = config("msg")["note"]["imgSelectTooSmall"];
                    return json($resMsg);
                }
                //确认裁剪比例
                if(round(($rew-$rsw)/($reh-$rsh)) != 3){
                    $resMsg= config("msg")["note"]["scaleErr"];
                    return json($resMsg);
                }

                //裁图
               $image->crop($rew-$rsw, $reh-$rsh,$rsw,$rsh)->save($path);

                $userPath = "images/user/".$uid."/note/".$noteId."/head".".".$type;



                $nm = new \app\home\model\Notes();
                $nm->setUp($noteId,$userPath);
                $resMsg= config("msg")["note"]["upImgSuccess"];
                $resMsg["data"]["url"] = $userPath;
                return json($resMsg);
            }
        }
        else{
            $resMsg = config("msg")["note"]["notUserNote"];
            return json($resMsg);
        }


    }

    /**
     * 用户编辑游记
     * @return mixed
     */
    public function edit(){
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $id = input("param.id");
        if($res){
            //是否用户游记
            $res = $this->isUserNote($id);

            if($res){
                $nm = new \app\home\model\Notes();


                //获取游记基本信息
                $info = $nm->getNoteInfo($id)[0];
                if($info["noteType"] == 2){
                    $im = new Index();
                    return $im->err("该游记审核中，请审核结束后再修改",url("home/personal/personal")."#test1=2");
                }
                else{
                    //获取游记内容
                    $con = $nm->getNoteCont($id);

                    $this->assign("info",$info);
                    $this->assign("con",$con);
                    $this->assign("noteId",$id);

                    return $this->fetch("note");
                }


            }
            else{
                $im = new Index();
                return $im->err();
            }

        }else{
            $im = new Index();
            return $im->err("很抱歉，请先登录",url("home/User/login"));
        }
    }

    /**
     * 获取游记内容
     * @return \think\response\Json
     */
    public function getCon(){
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $id = input("param.id");
        $res2 = $this->isUserNote($id);
        if($res && $res2){
            $nm = new \app\home\model\Notes();
            $con = $nm->getNoteCont($id);

            $reMsg=config("msg")["note"]["getCon"];
            $reMsg["data"]=$con;
            return json($reMsg);
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }

    }

    /**
     * 保存游记草稿
     * @return \think\response\Json
     */
    public function save(){
       $data = input("param.sData/a");
       $noteId = input("param.id");
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $res2 = $this->isUserNote($noteId);//是否本人游记

        if($res && $res2){
            $nm = new \app\home\model\Notes();
            $res = $nm->upCon($noteId,$data);
            if($res){
                $reMsg=config("msg")["note"]["saveSuccess"];
            }
            else{
                $reMsg=config("msg")["note"]["saveErr"];
            }
            return json($reMsg);
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }

    }

    /**
     * 添加图片
     * @return \think\response\Json
     */
    public function addImg(){
        $noteId = input("param.noteId");
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $res2 = $this->isUserNote($noteId);//是否本人游记

        if($res && $res2){
            $nm = new \app\home\model\Notes();
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
            $res = move_uploaded_file($_FILES["file"]["tmp_name"],$path);

            if ($res){
                $userPath = "images/user/".$uid."/note/".$noteId."/".$fileName.".".$type;

                $reMsg=config("msg")["note"]["imgSuccess"];
                $reMsg["data"]=[$userPath];
            }
            else{
                $reMsg=config("msg")["note"]["imgErr"];
            }


            return json($reMsg);
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }

    }

    /**
     * 添加游记音乐
     * @return \think\response\Json
     */
    public function addMusic(){
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $noteId = input("param.noteId");
        $res2 = $this->isUserNote($noteId);
        if($res && $res2){
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
            $res = $nm->setMusic($noteId,$userPath);
            if($res){
                $reMsg = config("msg")["note"]["musicSuccess"];
                $reMsg["data"]=[$userPath];
            }
            else{
                $reMsg = config("msg")["note"]["musicErr"];
            }


            return json($reMsg);
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }


    }

    /**
     * 移除游记图片
     * @return \think\response\Json
     */
    public function removeImg(){
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $noteId = input("param.noteId");
        $res2 = $this->isUserNote($noteId);
        if($res && $res2){

            $path = "static/".input("param.src");
            if(file_exists($path)){
                $res = unlink($path);
                if ($res){
                    $reMsg=config("msg")["note"]["reImgSuccess"];
                    return json($reMsg);
                }
                else{
                    $reMsg=config("msg")["note"]["reImgErr"];
                    return json($reMsg);
                }
            }
            else{
                $reMsg=config("msg")["note"]["reImgErr"];
                return json($reMsg);
            }
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }

    }


    /**
     * 设置游记标题
     * @return \think\response\Json
     */
    public function setTitle(){
        $title = input("param.title");
        $noteId = input("param.id");
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $res2 = $this->isUserNote($noteId);
        if($res && $res2){
            $nm = new \app\home\model\Notes();
            $res = $nm->setTitle($noteId,$title);
           if($res){
               $reMsg=config("msg")["note"]["titleSuccess"];
           }
           else{
               $reMsg=config("msg")["note"]["titleErr"];
           }
            return json($reMsg);
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }

    }

    /**
     * 移除游记音乐
     * @return \think\response\Json
     */
    public function reMusic(){
        $noteId = input("param.noteId");
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $res2 = $this->isUserNote($noteId);
        if($res && $res2){
            $uid = cookie("uid");
            $userDir = "static/music/user/".$uid."/note/".$noteId;
            $filehand = opendir($userDir);
            while(($filesname = readdir($filehand))!=false){
                if($filesname!="."&&$filesname!=".."){
                    unlink($userDir."/".$filesname);
                }
            }
            closedir($filehand);
            $nm = new \app\home\model\Notes();
            $res = $nm->reMusic($noteId);
           if ($res){
               $reMsg=config("msg")["note"]["remusicSuccess"];
           }
           else{
               $reMsg=config("msg")["note"]["remusicErr"];
           }
            return json($reMsg);
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }

    }


    /**
     * 获取目的地
     * @return \think\response\Json
     */
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

    /**
     * 是否该用户游记
     * @param $noteId 游记Id
     * @return bool
     */
    public function isUserNote($noteId){
        $uid = cookie("uid");
        $nm = new \app\home\model\Notes();

        $noteInfo = $nm->getNoteInfo($noteId);
        if(count($noteInfo)==0){
            return false;
        }
        else{
            if ($noteInfo[0]["uid"]==$uid){
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * 提交游记
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function subMit(){

        $noteId = input("param.noteId");
        $um = new User();
        $res = $um->checkLogin();//验证是否登录
        $res2 = $this->isUserNote($noteId);
        $nm = new \app\home\model\Notes();
        if($res && $res2){
            //判断数据是否有误
            if(input("?param.num") && input("?param.price") && input("?param.date") && input("?param.pr") && input("?param.city")){
                $num = input("param.num");
                $price = input("param.price");
                $date = input("param.date");
                $pr = input("param.pr");
                $city = input("param.city");
                //判断数据是否为空
                if(empty($num) || empty($price) || empty($date) || empty($pr) || empty($city)){
                    $reMsg=config("msg")["note"]["submitErr"];
                    return json($reMsg);
                }
                else{
                    $noteInfo = $nm->getNoteInfo($noteId);
                    //判断游记标题是否设置
                    if($noteInfo[0]["title"] == ""){
                        $reMsg=config("msg")["note"]["submitTitleErr"];
                        return json($reMsg);
                    }
                    //判断游记头图是否设置
                    else if($noteInfo[0]["img"] == ""){
                        $reMsg=config("msg")["note"]["submitImgErr"];
                        return json($reMsg);
                    }
                    else{
                        $regionInfo = $nm->regionInfo($city);
                        if(count($regionInfo) == 0){
                            $reMsg=config("msg")["note"]["submitErr"];
                            return json($reMsg);
                        }
                        else{
                            if($regionInfo[0]["REGION_NAME"] == "市辖区" || $regionInfo[0]["REGION_NAME"] == "县"){
                                $desId = $pr;
                            }
                            else{
                                $desId = $city;
                            }

                            $res = $nm->submit($noteId,$num,$price,$date,$desId);

                            if($res){
                                $reMsg=config("msg")["note"]["submitSuccess"];
                                return json($reMsg);
                            }
                            else{
                                $reMsg=config("msg")["note"]["submitErr"];
                                return json($reMsg);
                            }
                        }
                    }

                }
            }
            else{
                $reMsg=config("msg")["note"]["submitErr"];
                return json($reMsg);
            }
        }
        else{
            $reMsg=config("msg")["note"]["notUserNote"];
            return json($reMsg);
        }


    }


    public function subSuccess(){
            $im = new Index();
            return $im->succ("游记提交成功，请等待审核",url("home/personal/personal")."#test1=2",1);
    }

    public function lists(){
        $page = input("param.page");

        $nm = new \app\home\model\Notes();
        $all = $nm->countNote();
        $p = new Page($all,10,$page);

        $start = $p -> getStart();
        $num = $p -> getNum();

        $data = $nm -> getNote($start,$num);
        $allPage = $p->getAllPage();

        $resMsg = config("msg")["note"]["getNoteList"];
        $resMsg["data"] = [$data,$allPage];
        return json($resMsg);
    }

    public function show(){

                $id = input("param.id");
                $nm = new \app\home\model\Notes();

                //获取游记基本信息
                $info = $nm->getNoteInfoS($id)[0];
                if ($info["noteType"] == 2) {
                    $im = new Index();
                    return $im->err("该游记审核中", url("home/index/index") . "#test1=2");
                } else {
                    //获取游记内容
                    $con = $nm->getNoteCont($id);

                    $this->assign("info", $info);
                    $this->assign("con", $con);
                    $this->assign("noteId", $id);

                    return $this->fetch("show");
                }

    }

    public function getConS(){
            $id = input("param.id");
            $nm = new \app\home\model\Notes();
            $con = $nm->getNoteCont($id);

            $reMsg=config("msg")["note"]["getCon"];
            $reMsg["data"]=$con;
            return json($reMsg);
    }
}