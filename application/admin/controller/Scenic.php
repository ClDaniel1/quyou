<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/25
 * Time: 17:24
 */

namespace app\admin\controller;


class Scenic extends \think\Controller
{
    public function scenic()
    {
        return $this->fetch('scenic');
    }
    public function scenicAppend(){
        $am=new \app\admin\model\Scenic();
        $data=$am->region();
        $this->assign("region",$data);
        return $this->fetch('scenicAppend');
    }
    public function scenicPicture()
    {
        $scenicId=input("param.id");
        $am=new \app\admin\model\Scenic();
        $scenicData=$am->ImgFindMin($scenicId);
        $scenicImgData=$am->ImgFindMan($scenicId);
        $this->assign("scenicData",$scenicData);
        $this->assign("scenicImgData",$scenicImgData);
        return $this->fetch('scenicPicture');
    }
    public function scenicChange(){
        $scenicId=input("param.id");
        $am=new \app\admin\model\Scenic();
        $scenicInformation=$am->scenicInformation($scenicId);
        $desId=$scenicInformation[0]['desId'];
        $region=$am->region();
        $regionScenic=$am->regionScenic($desId);
        $this->assign("scenicInformation",$scenicInformation);
        $this->assign("region",$region);
        $this->assign("regionScenic",$regionScenic);
        return $this->fetch('scenicChange');
    }
    public function ScenicSpot()
    {
        $str=new \app\admin\model\Scenic();
        $run=$str->ScenicSpot();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run[0]['COUNT']]
        ];
        echo json_encode($returnMsg);
    }
    public function ScenicRelease()
    {
        $str=new \app\admin\model\Scenic();
        $run=$str->ScenicRelease();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function scenicShelves()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicShelves($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function scenicOn()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicOn($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function scenicDelete()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Scenic();
        $path="static/images/scenic/".$id;
        $this->delDirr($path);
        $str->DeleteScenicImg($id);
        $run=$str->scenicDelete($id);
        echo json_encode($run);
    }
    public function scenicSelect()
    {
        $regionId=input('param.regionId');
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicSelect($regionId);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function scenicAappend()
    {
        $scenicName=input('param.scenicName');
        $scenicDescribe=input('param.scenicDescribe');
        $scenicNum=intval(input('param.scenicNum'));
        $price=intval(input('param.scenicPrice'));
        $desId=input('param.desId');
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Scenic();
        $scenicId=$str->scenicAappend($scenicName,$scenicDescribe,$scenicNum,$price,$desId);
        mkdir("static/images/scenic/".$scenicId,0777,true);//创建文件夹
        $dir = "static/images/scenic/".$scenicId."/";
        $hm = new \app\admin\model\Scenic();
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $newPath = $dir.$scenicId."_".$key.".".$type;//图片规范化名字
            $sqlNewImg = "images/scenic/".$scenicId."/".$scenicId."_".$key.".".$type;//存入数据库的图片名字
            copy($path,$newPath);//添加图片到该路径
            unlink($path);//删除图片
            if($key==0){
                $hm->coverImg($scenicId,$sqlNewImg);
            }
            else{
                $hm->timeImg($scenicId,$sqlNewImg);
            }
        }
        echo 1;
    }
    public function scenicFind()
    {
        $scenicName=input('param.scenicName');
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicFind($scenicName);
        echo $run[0]['COUNT'];
    }
    public function scenicAappendNo()
    {
        $scenicName=input('param.scenicName');
        $scenicDescribe=input('param.scenicDescribe');
        $scenicNum=intval(input('param.scenicNum'));
        $price=intval(input('param.scenicPrice'));
        $desId=input('param.desId');
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Scenic();
        $scenicId=$str->hotelAappendNo($scenicName,$scenicDescribe,$scenicNum,$price,$desId);
        mkdir("static/images/scenic/".$scenicId,0777,true);//创建文件夹
        $dir = "static/images/scenic/".$scenicId."/";
        $hm = new \app\admin\model\Scenic();
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $newPath = $dir.$scenicId."_".$key.".".$type;//图片规范化名字
            $sqlNewImg = "images/scenic/".$scenicId."/".$scenicId."_".$key.".".$type;//存入数据库的图片名字
            copy($path,$newPath);//添加图片到该路径
            unlink($path);//删除图片
            if($key==0){
                $hm->coverImg($scenicId,$sqlNewImg);
            }
            else{
                $hm->timeImg($scenicId,$sqlNewImg);
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
    }//把景点照片暂时存放临时文件夹，上传图片操作
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
    public function scenicPictureImg(){
        $main=input('param.main');
        $secondary=input('param.secondary');
        $scenicId=input("param.scenicId");
        $str=new \app\admin\model\Scenic();
        $run=$str->hotelMain($scenicId,$secondary);
        if($run==1)
        {
            $data=$str->hotelSecondary($secondary,$main);
            echo $data;
        }

    }//封面图更换
    public function scenicDeleteMore()
    {
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Scenic();
        foreach($img as $key=>$val)
        {
            $path = "static/{$val}";//照片保存路劲
            $str->hotelDeleteMore($val);
            unlink($path);
        }
        echo 1;
    }//删除照片操作
    public function scenicChangeAppend(){
        $scenicName=input('param.scenicName');
        $scenicDescribe=input('param.scenicDescribe');
        $scenicNum=intval(input('param.scenicNum'));
        $price=intval(input('param.price'));
        $desId=input('param.desId');
        $scenicId=input("param.id");
        $img=json_decode(stripslashes(input('param.img')));
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicChangeAppend($scenicName,$scenicDescribe,$scenicNum,$price,$desId,$scenicId);
        foreach($img as $key=>$val)
        {
            $path = "static/upload/{$val}";//照片保存路劲
            $type =explode(".",$val)[1];//文件的格式后缀
            $dir = "static/images/scenic/".$scenicId."/";
            while(1)//循环遍历是否存在自动生成的照片名
            {
                $fileName = $scenicId.'_'.mt_rand(0,999).'.'.$type;//随机生成的照片名
                $newpath = $dir.$fileName;//照片保存路劲

                if (file_exists($newpath))
                {}
                else{
                    break;
                }
            }

            copy($path,$newpath);//添加图片到该路径
            unlink($path);//删除图片
            $sqlNewImg="images/scenic/".$scenicId."/".$fileName;
            $str->timeImg($scenicId,$sqlNewImg);
        }
        echo 1;
    }
}