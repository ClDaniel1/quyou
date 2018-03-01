<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 11:09
 */

namespace app\admin\controller;


class Food extends \think\Controller
{
    public function food()
    {
        return $this->fetch('food');
    }
    public function foodAppend(){
        $am=new \app\admin\model\Food();
        $data=$am->region();
        $this->assign("region",$data);
        $data=$am->foodType();
        $this->assign("foodtype",$data);
        return $this->fetch('foodAppend');
    }
    public function foodPicture()
    {
        $foodId=input("param.id");
        $am=new \app\admin\model\Food();
        $foodData=$am->ImgFindMin($foodId);
        $foodImgData=$am->ImgFindMan($foodId);
        $this->assign("foodData",$foodData);
        $this->assign("foodImgData",$foodImgData);
        return $this->fetch('foodPicture');
    }
    public function foodChange(){
        $foodId=input("param.id");
        $am=new \app\admin\model\Food();
        $foodInformation=$am->foodInformation($foodId);
        $desId=$foodInformation[0]['desId'];
        $region=$am->region();
        $regionFood=$am->regionfood($desId);
        $foodtype=$am->foodType();
        $this->assign('foodtype',$foodtype);
        $this->assign("foodInformation",$foodInformation);
        $this->assign("region",$region);
        $this->assign("regionFood",$regionFood);
        return $this->fetch('foodChange');
    }
    public function foodSpot()
    {
        $str=new \app\admin\model\Food();
        $run=$str->foodSpot();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run[0]['COUNT']]
        ];
        echo json_encode($returnMsg);
    }
    public function foodRelease()
    {
        $str=new \app\admin\model\Food();
        $run=$str->foodRelease();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function foodShelves()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Food();
        $run=$str->foodShelves($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function foodOn()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Food();
        $run=$str->foodOn($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function foodDelete()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Food();
        $path="static/images/food/".$id;
        $this->delDirr($path);
        $str->DeleteFoodImg($id);
        $run=$str->foodDelete($id);
        echo json_encode($id);
    }
    public function foodSelect()
    {
        $regionId=input('param.regionId');
        $str=new \app\admin\model\Food();
        $run=$str->foodSelect($regionId);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function foodAappend()
    {
        $foodName=input('param.foodName');
        $foodDescribe=input('param.foodDescribe');
        $desId=input('param.desId');
        $foodType=input('param.foodType');
        $address=input('param.address');
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Food();
        $foodId=$str->foodAappend($foodName,$foodDescribe,$desId,$foodType,$address);
        mkdir("static/images/food/".$foodId,0777,true);//创建文件夹
        $dir = "static/images/food/".$foodId."/";
        $hm = new \app\admin\model\Food();
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $newPath = $dir.$foodId."_".$key.".".$type;//图片规范化名字
            $sqlNewImg = "images/food/".$foodId."/".$foodId."_".$key.".".$type;//存入数据库的图片名字
            copy($path,$newPath);//添加图片到该路径
            unlink($path);//删除图片
            if($key==0){
                $hm->coverImg($foodId,$sqlNewImg);
            }
            else{
                $hm->timeImg($foodId,$sqlNewImg);
            }
        }
        echo 1;
    }
    public function foodFind()
    {
        $foodName=input('param.foodName');
        $str=new \app\admin\model\Food();
        $run=$str->foodFind($foodName);
        echo $run[0]['COUNT'];
    }
    public function foodAappendNo()
    {
        $foodName=input('param.foodName');
        $foodDescribe=input('param.foodDescribe');
        $desId=input('param.desId');
        $foodType=input('param.foodType');
        $address=input('param.address');
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Food();
        $foodId=$str->foodAappendNo($foodName,$foodDescribe,$desId,$foodType,$address);
        mkdir("static/images/food/".$foodId,0777,true);//创建文件夹
        $dir = "static/images/food/".$foodId."/";
        $hm = new \app\admin\model\Food();
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $newPath = $dir.$foodId."_".$key.".".$type;//图片规范化名字
            $sqlNewImg = "images/food/".$foodId."/".$foodId."_".$key.".".$type;//存入数据库的图片名字
            copy($path,$newPath);//添加图片到该路径
            unlink($path);//删除图片
            if($key==0){
                $hm->coverImg($foodId,$sqlNewImg);
            }
            else{
                $hm->timeImg($foodId,$sqlNewImg);
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
    }//把美食照片暂时存放临时文件夹，上传图片操作
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
    public function foodPictureImg(){
        $main=input('param.main');
        $secondary=input('param.secondary');
        $foodId=input("param.foodId");
        $str=new \app\admin\model\Food();
        $run=$str->foodMain($foodId,$secondary);
        if($run==1)
        {
            $data=$str->foodSecondary($secondary,$main);
            echo $data;
        }

    }//封面图更换
    public function foodDeleteMore()
    {
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Food();
        foreach($img as $key=>$val)
        {
            $path = "static/{$val}";//照片保存路劲
            $str->foodDeleteMore($val);
            unlink($path);
        }
        echo 1;
    }//删除照片操作
    public function foodChangeAppend(){
        $foodName=input('param.foodName');
        $foodDescribe=input('param.foodDescribe');
        $foodType=input('param.foodType');
        $address=input('param.address');
        $desId=input('param.desId');
        $foodId=input("param.id");
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Food();
        $run=$str->foodChangeAppend($foodName,$foodDescribe,$foodType,$address,$desId,$foodId);
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $dir = "static/images/food/".$foodId."/";
            while(1)//循环遍历是否存在自动生成的照片名
            {
                $fileName = $foodId.'_'.mt_rand(0,999).'.'.$type;//随机生成的照片名
                $newpath = $dir.$fileName;//照片保存路劲

                if (file_exists($newpath))
                {}
                else{
                    break;
                }
            }

            copy($path,$newpath);//添加图片到该路径
            unlink($path);//删除图片
            $sqlNewImg="images/food/".$foodId."/".$fileName;
            $str->timeImg($foodId,$sqlNewImg);
        }
        echo 1;
    }
    public function regionWx(){
        $id=input('param.id');
        $str=new \app\admin\model\Food();
        $data=$str->regionWx($id);
        $foodRegion=config("msg")["food"]["foodRegion"];
        array_push($foodRegion["data"],$data);
        echo json_encode($foodRegion);
    }
    public function fooddetailsWx()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Food();
        $data=$str->fooddetailsWx($id);
        $foodRegion=config("msg")["food"]["foodRegion"];
        array_push($foodRegion["data"],$data);
        echo json_encode($foodRegion);
    }
    public function foodImgWx()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Food();
        $data=$str->foodImgWx($id);
        $foodImg=config("msg")["food"]["foodRegion"];
        array_push($foodImg["data"],$data);
        echo json_encode($foodImg);
    }

    public function foodCommentWx()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Food();
        $data=$str->foodCommentWx($id);
        $foodComment=config("msg")["food"]["foodRegion"];
        array_push($foodComment["data"],$data);
        echo json_encode($foodComment);
    }
}