<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/24
 * Time: 9:49
 */

namespace app\home\controller;


class Checkin extends \think\Controller
{
    public function checkin(){
        return $this->fetch("checkin");
    }
    public function tenantsImg()
    {
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
        $tenantsImg=config("msg")["tenants"]["tenantsImg"];
        array_push($tenantsImg["data"],$fileName);
        echo json_encode($tenantsImg);
    }//把营业执照暂时存放临时文件夹，上传图片操作
    public function tenantsAdd(){
        $tenantsName=input("param.tenantsName");
        $tenantsNick=input("param.tenantsNick");
        $tenantsPhone=input("param.tenantsPhone");
        $tenantsAdd=input("param.tenantsAdd");
        $tenantsType=input("param.tenantsType");
        $tenantsAccount=input("param.tenantsAccount");
        $tenantsPsw=input("param.tenantsPsw");
        $license=input("param.license");
        $str=new \app\home\model\Checkin();
        $heavy=$str->tenantsHeavy($tenantsAccount);
        if($heavy[0]['COUNT']==0){
            $tenantsId=$str->tenantsAdd($tenantsName,$tenantsNick,$tenantsPhone,$tenantsAdd,$tenantsType,$tenantsAccount,$tenantsPsw,$license);
            mkdir("static/images/tenants/".$tenantsId,0777,true);//创建文件夹
            $dir = "static/images/tenants/".$tenantsId."/";
            $path = "static/upload/$license";
            $type =explode(".",$license)[1];//文件的格式后缀
            $newPath = $dir.$tenantsId."_".$tenantsId.".".$type;//图片规范化名字
            $sqlNewImg = "images/tenants/".$tenantsId."/".$tenantsId."_".$tenantsId.".".$type;//存入数据库的图片名字
            copy($path,$newPath);//添加图片到该路径
            unlink($path);//删除图片
            $data=$str->coverImg($tenantsId,$sqlNewImg);
            $tenantsImg=config("msg")["tenants"]["coverImg"];
            array_push($tenantsImg["data"],$data);
            echo json_encode($tenantsImg);
        }
        else{
            $tenantsImg=config("msg")["tenants"]["coverNot"];
            echo json_encode($tenantsImg);
        }

    }
}