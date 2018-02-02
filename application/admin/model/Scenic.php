<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/25
 * Time: 18:02
 */

namespace app\admin\model;


class Scenic extends \think\Model
{
    public function ScenicSpot()
    {
        $sql=db('t_scenic')->field('count(scenicId) COUNT')->select();
        return $sql;
    }
    public function ScenicRelease()
    {
        $sql=db('t_scenic')->alias('a')
            ->join('t_region b','a.desId = b.REGION_ID')->field('a.*,b.REGION_NAME')->select();
        return $sql;
    }
    public function scenicShelves($id)
    {
        $sql=db('t_scenic')->where('scenicId', $id)->update(['scenicType' => '1']);
        return $sql;
    }
    public function scenicOn($id)
    {
        $sql=db('t_scenic')->where('scenicId', $id)->update(['scenicType' => '0']);
        return $sql;
    }
    public function scenicDelete($id)
    {
        $sql=db('t_scenic')->where('scenicId',$id)->delete();
        return $sql;
    }
    public function region()
    {
        $sql=db('t_region')->where('PARENT_ID',1)->select();
        return $sql;
    }//地区一级select列表
    public function scenicSelect($regionId)
    {
        $sql=db('t_region')->where('PARENT_ID',$regionId)->select();
        return $sql;
    }//地区二级select列表
    public function scenicAappend($scenicName,$scenicDescribe,$scenicNum,$price,$desId)
    {
        $data = [
            'scenicName' => $scenicName,
            'scenicDescribe' => $scenicDescribe,
            'price'=>$price,
            'scenicNum'=>$scenicNum,
            'desId'=>$desId,
            'scenicImg'=>'images/scenic/330/330_0.jpeg',
            'scenicType'=>0
        ];
        $sql=db('t_scenic')->insertGetId($data);
        return $sql;
    }//景点添加且发布
    public function scenicFind($scenicName)
    {
        $sql=db('t_scenic')->where('scenicName',$scenicName)->field('count(scenicId) COUNT')->select();
        return $sql;
    }//景点查重
    public function hotelAappendNo($scenicName,$scenicDescribe,$scenicNum,$price,$desId)
    {
        $data = [
            'scenicName' => $scenicName,
            'scenicDescribe' => $scenicDescribe,
            'price'=>$price,
            'scenicNum'=>$scenicNum,
            'desId'=>$desId,
            'scenicImg'=>'images/scenic/330/330_0.jpeg',
            'scenicType'=>1
        ];
        $sql=db('t_scenic')->insertGetId($data);
        return $sql;
    }//景点添加但不发布
    public function coverImg($scenicId,$sqlNewImg)
    {
        $sql=db('t_scenic')->where('scenicId', $scenicId)->update(['scenicImg' =>$sqlNewImg]);
        return $sql;
    }//数据库存封面图存储
    public function timeImg($scenicId,$sqlNewImg)
    {
        $data = [
            'url'=>$sqlNewImg,
            'scenicId'=>$scenicId
        ];
        $sql=db('t_scenicimg')->insert($data);
        return $sql;
    }//酒店相关图片存储
    public function DeleteScenicImg($id)
    {
        $sql=db('t_scenicimg')->where('scenicId',$id)->delete();
        return $sql;
    }//删除酒店
    public function ImgFindMin($scenicId)
    {
        $sql=db('t_scenic')->where('scenicId',$scenicId)->field('scenicImg')->select();
        return $sql;
    }//封面照片查询  查hotel表的img
    public function ImgFindMan($scenicId)
    {
        $sql=db('t_scenicimg')->where('scenicId',$scenicId)->field('url')->select();
        return $sql;
    }//其余照片查询  查hotelimg表的url
    public function hotelMain($scenicId,$secondary)
    {
        $sql=db('t_scenic')->where('scenicId', $scenicId)->update(['scenicImg' => $secondary]);
        return $sql;
    }//图片替换封面图换上去
    public function hotelSecondary($secondary,$main)
    {
        $sql=db('t_scenicimg')->where('url', $secondary)->update(['url' => $main]);
        return $sql;
    }//图片替换封面图换下来
    public function hotelDeleteMore($val)
    {
        $sql=db('t_scenicimg')->where('url',$val)->delete();
        return $sql;
    }//删除图片操作
    public function scenicInformation($scenicId){
        $sql=db('t_scenic')->where('scenicId',$scenicId)->select();
        return $sql;
    }//获取当前点击的酒店
    public function regionScenic($desId){
        $fid=db('t_region')->where('REGION_ID',$desId)->select()[0]["PARENT_ID"];
        $sql=db('t_region')->where('PARENT_ID',$fid)->select();
        return $sql;
    }//地区表查询
    public function scenicChangeAppend($scenicName,$scenicDescribe,$scenicNum,$price,$desId,$scenicId){
        $sql=db('t_scenic')->where('scenicId', $scenicId)->
        update([
            'scenicName' => $scenicName,
            'scenicDescribe'=>$scenicDescribe,
            'scenicNum'=>$scenicNum,
            'price'=>$price,
            'desId'=>$desId
        ]);
        return $sql;
    }//修改酒店数据


}