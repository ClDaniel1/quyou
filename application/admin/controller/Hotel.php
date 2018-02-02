<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 11:03
 */

namespace app\admin\controller;


class Hotel extends \think\Controller
{
    public function hotel()
    {
        return $this->fetch('hotel');
    }
    public function hotelAppend(){
        $am=new \app\admin\model\Hotel();
        $data=$am->region();
        $this->assign("region",$data);
        return $this->fetch('hotelAppend');
    }
    public function hotelPicture()
    {
        $hotelId=input("param.id");
        $am=new \app\admin\model\Hotel();
        $hotelData=$am->ImgFindMin($hotelId);
        $hotelImgData=$am->ImgFindMan($hotelId);
        $this->assign("hotelData",$hotelData);
        $this->assign("hotelImgData",$hotelImgData);
        return $this->fetch('hotelPicture');
    }
    public function hotelChange(){
        $hotelId=input("param.id");
        $am=new \app\admin\model\Hotel();
        $hotelInformation=$am->hotelInformation($hotelId);
        $desId=$hotelInformation[0]['desId'];
        $region=$am->region();
        $regionHotel=$am->regionHotel($desId);
        $this->assign("hotelInformation",$hotelInformation);
        $this->assign("region",$region);
        $this->assign("regionHotel",$regionHotel);
        return $this->fetch('hotelChange');
    }
    public function hotelSpot()
    {
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelSpot();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run[0]['COUNT']]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelRelease()
    {
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelRelease();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelShelves()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelShelves($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelOn()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelOn($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelDelete()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Hotel();
        $path="static/images/hotel/".$id;
        $this->delDirr($path);
        $str->DeleteHotelImg($id);
        $run=$str->hotelDelete($id);
        echo json_encode($run);
    }
    public function hotelSelect()
    {
        $regionId=input('param.regionId');
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelSelect($regionId);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelAappend()
    {
        $hotelName=input('param.hotelName');
        $hotelDescribe=input('param.hotelDescribe');
        $hotelNum=intval(input('param.hotelNum'));
        $hotelPrice=intval(input('param.hotelPrice'));
        $desId=input('param.desId');
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Hotel();
        $hotelId=$str->hotelAappend($hotelName,$hotelDescribe,$hotelNum,$hotelPrice,$desId);
        mkdir("static/images/hotel/".$hotelId,0777,true);//创建文件夹
        $dir = "static/images/hotel/".$hotelId."/";
        $hm = new \app\admin\model\Hotel();
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $newPath = $dir.$hotelId."_".$key.".".$type;//图片规范化名字
            $sqlNewImg = "images/hotel/".$hotelId."/".$hotelId."_".$key.".".$type;//存入数据库的图片名字
            copy($path,$newPath);//添加图片到该路径
            unlink($path);//删除图片
           if($key==0){
               $hm->coverImg($hotelId,$sqlNewImg);
           }
            else{
                $hm->timeImg($hotelId,$sqlNewImg);
            }
        }
        echo 1;
    }
    public function hotelFind()
    {
        $hotelName=input('param.hotelName');
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelFind($hotelName);
        echo $run[0]['COUNT'];
    }
    public function hotelAappendNo()
    {
        $hotelName=input('param.hotelName');
        $hotelDescribe=input('param.hotelDescribe');
        $hotelNum=intval(input('param.hotelNum'));
        $hotelPrice=intval(input('param.hotelPrice'));
        $desId=input('param.desId');
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Hotel();
        $hotelId=$str->hotelAappendNo($hotelName,$hotelDescribe,$hotelNum,$hotelPrice,$desId);
        mkdir("static/images/hotel/".$hotelId,0777,true);//创建文件夹
        $dir = "static/images/hotel/".$hotelId."/";
        $hm = new \app\admin\model\Hotel();
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $newPath = $dir.$hotelId."_".$key.".".$type;//图片规范化名字
            $sqlNewImg = "images/hotel/".$hotelId."/".$hotelId."_".$key.".".$type;//存入数据库的图片名字
            copy($path,$newPath);//添加图片到该路径
            unlink($path);//删除图片
            if($key==0){
                $hm->coverImg($hotelId,$sqlNewImg);
            }
            else{
                $hm->timeImg($hotelId,$sqlNewImg);
            }
        }
        echo 1;
    }//
    public function uploadImg(){
        $temp = $_FILES["file"]["tmp_name"];//临时文件的路径
        $type=explode("/",$_FILES["file"]["type"]);//文件的格式后缀
        while(1)//循环遍历是否存在自动生成的照片名
        {
            $fileName = mt_rand(0, 999) . time() . '.' . $type[1];//随机生成的照片名
            $path = "static/upload/{$fileName}";//照片保存路劲
            if (file_exists($path))
            {}
            else{
                break;
            }
        }
        move_uploaded_file($temp,$path);//添加图片到该路径
        echo $fileName;
    }//把酒店照片暂时存放临时文件夹，上传图片操作
    public function delDirr($filename){
        if(is_dir($filename)){
            $filehand = opendir($filename);
            while(($filesname = readdir($filehand))!=false){
                if($filesname!="."&&$filesname!=".."){
                    if(is_dir($filename."/".$filesname)){
                        delDirr($filename."/".$filesname);
                    }
                    else{
                        unlink($filename."/".$filesname);
                    }
                }
            }
            rmdir($filename);
            closedir($filehand);
        }
    }//删除文件夹封装好的
    public function hotelPictureImg(){
        $main=input('param.main');
        $secondary=input('param.secondary');
        $hotelId=input("param.hotelId");
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelMain($hotelId,$secondary);
        if($run==1)
        {
            $data=$str->hotelSecondary($secondary,$main);
            echo $data;
        }

    }//封面图更换
    public function hotelDeleteMore()
    {
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Hotel();
        foreach($img as $key=>$val)
        {
            $path = "static/{$val}";//照片保存路劲
            $str->hotelDeleteMore($val);
            unlink($path);
        }
        echo 1;
    }//删除照片操作
    public function hotelChangeAppend(){
        $hotelName=input('param.hotelName');
        $hotelDescribe=input('param.hotelDescribe');
        $hotelNum=intval(input('param.hotelNum'));
        $hotelPrice=intval(input('param.hotelPrice'));
        $desId=input('param.desId');
        $hotelId=input("param.id");
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelChangeAppend($hotelName,$hotelDescribe,$hotelNum,$hotelPrice,$desId,$hotelId);
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $dir = "static/images/hotel/".$hotelId."/";
            while(1)//循环遍历是否存在自动生成的照片名
            {
                $fileName = $hotelId.'_'.mt_rand(0,999).'.'.$type;//随机生成的照片名
                $newpath = $dir.$fileName;//照片保存路劲

                if (file_exists($newpath))
                {}
                else{
                    break;
                }
            }

            copy($path,$newpath);//添加图片到该路径
            unlink($path);//删除图片
            $sqlNewImg="images/hotel/".$hotelId."/".$fileName;
            $str->timeImg($hotelId,$sqlNewImg);
        }
        echo 1;
    }
}