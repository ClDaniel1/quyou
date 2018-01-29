<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/27
 * Time: 19:11
 */
namespace app\home\model;
use \think\Model;
class Region extends Model
{
    public function region($id)//根据地区id查找对应名称
    {
        $sql=db('t_region')->field('REGION_NAME')->where('REGION_ID',$id)->find();
        return $sql;
    }
    public function scenicImg($id)//根据地区id查找对应地区景点图片数量
    {
        $sql=db('t_scenic')->alias('a')->join('t_scenicimg b','a.scenicId=b.scenicId')->where('a.desId',$id)->count();
        return $sql;
    }
    public function scenicMsg($id)//根据地区id查找对应地区景点信息
    {
        $arr=array();
        $sql=db('t_scenic')->where('desId',$id)->limit(0,2)->select();
        $count=db('t_scenic')->where('desId',$id)->count();

        $arr['list']=$sql;
        $arr['count']=$count;
        return $arr;
    }
    public function hotelMsg($id)//根据地区id查找对应地区酒店信息
    {
        $arr=array();
        $sql=db('t_hotel')->where('desId',$id)->limit(0,2)->select();
        $count=db('t_hotel')->where('desId',$id)->count();
        $arr['msg']=$sql;
        $arr['count']=$count;
        return $arr;
    }
    public function foodMsg($id)//根据地区id查找对应地区食物信息
    {
        $arr=array();
        $sql=db('t_food')->where('desId',$id)->limit(0,2)->select();
        $count=db('t_food')->where('desId',$id)->count();
        $arr['msg']=$sql;
        $arr['count']=$count;
        return $arr;
    }
    public function routeCount($id)//根据地区id获取对应的路线总条数
    {
        $count=db('t_route')->where('desId',$id)->count();
        return $count;
    }
    public function routeMsg($id)//根据地区id获取对应的路线信息
    {
        $routeNew=db('t_route')->alias('a')->join('t_routecon b','a.routeId=b.routeId')->join('t_scenic c','c.scenicId=b.scenicId')->where('a.desId',$id)->field('a.title,a.chose,b.routeId,b.num,c.scenicName')->select();
//        $routeMsg=db($routeNew.'d')->fetchSql(true)->select();
        return $routeNew;
    }
}
