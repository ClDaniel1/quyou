<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 14:21
 */

namespace app\admin\model;

class Hotel extends \think\Model
{
    public function hotelSpot()
    {
        $sql=db('t_hotel')->field('count(hotelId) COUNT')->select();
        return $sql;

    }//查看数据有多少条
    public function hotelRelease()
    {
        $sql=db('t_hotel')->alias('a')
            ->join('t_region b','a.desId = b.REGION_ID')->field('a.*,b.REGION_NAME')->select();
        return $sql;
    }//酒店列表显示的数据
    public function hotelShelves($id)
    {
        $sql=db('t_hotel')->where('hotelId', $id)->update(['hotelType' => '1']);
        return $sql;
    }//酒店下架
    public function hotelOn($id)
    {
        $sql=db('t_hotel')->where('hotelId', $id)->update(['hotelType' => '0']);
        return $sql;
    }//酒店发布
    public function hotelDelete($id)
   {
       $sql=db('t_hotel')->where('hotelId',$id)->delete();
       return $sql;
   }//酒店删除
    public function region()
    {
        $sql=db('t_region')->where('PARENT_ID',1)->select();
        return $sql;
    }//地区一级select列表
    public function hotelSelect($regionId)
    {
        $sql=db('t_region')->where('PARENT_ID',$regionId)->select();
        return $sql;
    }//地区二级select列表
    public function hotelAappend($hotelName,$hotelDescribe,$hotelNum,$hotelPrice,$desId)
    {
        $data = [
            'hotelName' => $hotelName,
            'hotelDescribe' => $hotelDescribe,
            'hotelPrice'=>$hotelPrice,
            'hotelNum'=>$hotelNum,
            'desId'=>$desId,
            'img'=>'images/hotel/330/330_0.jpeg',
            'hotelType'=>0
        ];
        $sql=db('t_hotel')->insertGetId($data);
        return $sql;
    }//酒店添加且发布
    public function hotelFind($hotelName)
    {
        $sql=db('t_hotel')->where('hotelName',$hotelName)->field('count(hotelId) COUNT')->select();
        return $sql;
    }//酒店查重
    public function hotelAappendNo($hotelName,$hotelDescribe,$hotelNum,$hotelPrice,$desId)
    {
        $data = [
            'hotelName' => $hotelName,
            'hotelDescribe' => $hotelDescribe,
            'hotelPrice'=>$hotelPrice,
            'hotelNum'=>$hotelNum,
            'desId'=>$desId,
            'img'=>'images/hotel/330/330_0.jpeg',
            'hotelType'=>1
        ];
        $sql=db('t_hotel')->insertGetId($data);;
        return $sql;
    }//酒店添加但不发布
    public function coverImg($hotelId,$sqlNewImg)
    {
        $sql=db('t_hotel')->where('hotelId', $hotelId)->update(['img' =>$sqlNewImg]);
        return $sql;
    }//数据库存封面图存储
    public function timeImg($hotelId,$sqlNewImg)
    {
        $data = [
            'url'=>$sqlNewImg,
            'hotelId'=>$hotelId
        ];
        $sql=db('t_hotelimg')->insert($data);
        return $sql;
    }//酒店相关图片存储

    public function DeleteHotelImg($id)
    {
        $sql=db('t_hotelimg')->where('hotelId',$id)->delete();
        return $sql;
    }//删除酒店
    public function ImgFindMin($hotelId)
    {
        $sql=db('t_hotel')->where('hotelId',$hotelId)->field('img')->select();
        return $sql;
    }//封面照片查询  查hotel表的img
    public function ImgFindMan($hotelId)
    {
        $sql=db('t_hotelimg')->where('hotelId',$hotelId)->field('url')->select();
        return $sql;
    }//其余照片查询  查hotelimg表的url
    public function hotelMain($hotelId,$secondary)
    {
        $sql=db('t_hotel')->where('hotelId', $hotelId)->update(['img' => $secondary]);
        return $sql;
    }//图片替换封面图换上去
    public function hotelSecondary($secondary,$main)
    {
        $sql=db('t_hotelimg')->where('url', $secondary)->update(['url' => $main]);
        return $sql;
    }//图片替换封面图换下来
    public function hotelDeleteMore($val)
    {
        $sql=db('t_hotelimg')->where('url',$val)->delete();
        return $sql;
    }//删除图片操作
    public function hotelInformation($hotelId){
        $sql=db('t_hotel')->where('hotelId',$hotelId)->select();
        return $sql;
    }//获取当前点击的酒店
    public function regionHotel($desId){
        $fid=db('t_region')->where('REGION_ID',$desId)->select()[0]["PARENT_ID"];
        $sql=db('t_region')->where('PARENT_ID',$fid)->select();
        return $sql;
    }//地区表查询
    public function hotelChangeAppend($hotelName,$hotelDescribe,$hotelNum,$hotelPrice,$desId,$hotelId){
        $sql=db('t_hotel')->where('hotelId', $hotelId)->
        update([
            'hotelName' => $hotelName,
            'hotelDescribe'=>$hotelDescribe,
            'hotelNum'=>$hotelNum,
            'hotelPrice'=>$hotelPrice,
            'desId'=>$desId
        ]);
        return $sql;
    }//修改酒店数据
}