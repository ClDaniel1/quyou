<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 19:08
 */
namespace app\home\controller;
use \think\Request;
use \app\home\model;
use \org\Intro;
class Region extends \think\Controller
{
    public function region()//显示地区攻略
    {
        $a=new model\Region();
        $rgId=input('?param.des')?input('des'):"";
        $res=$a->region($rgId);//根据地区id查找对应名称
        $this->assign('region_name',$res['REGION_NAME']);
        $bk=new Intro();
        $bkMsg=$bk->getIntro($res['REGION_NAME']);//查找地区对应百科信息
        $this->assign('bkMsg',$bkMsg);
        $count=$a->scenicImg($rgId);//根据地区id查找对应地区景点图片数量
        $this->assign('count',$count);
        $scenicMsg=$a->scenicMsg($rgId);//根据地区id查找对应地区景点信息
        $this->assign('scenicMsg',$scenicMsg);
        $hotel=$a->hotelMsg($rgId);//根据地区id查找对应地区酒店信息
        $this->assign('hotelMsg',$hotel);
        $food=$a->foodMsg($rgId);//根据地区id查找对应地区食物信息
        $this->assign('foodMsg',$food);
        $routeCount=$a->routeCount($rgId);//根据地区id查找对应路线总条数
        $routeMsg=$a->routeMsg($rgId);
        $arr=array();
        foreach($routeMsg as $value)
        {
            $arr[$value['routeId']][]=$value;
        }
//        for($i = 0;$i < 2;$i++){
//            $arr[$routeMsg[$i]["routeId"]][] = $routeMsg[$i];
//        }

        dump($arr);
//        $this->assign('foodMsg',$food);
//        return $this->fetch();
    }
    public function hotel()//显示地区酒店
    {
        $rgId=isset($_GET['rgId'])?$_GET['rgId']:"";
        return $this->fetch('hotel');
    }

}
