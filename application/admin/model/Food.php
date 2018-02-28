<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 14:33
 */

namespace app\admin\model;


class Food extends \think\Model
{
    public function foodSpot()
    {
        $sql=db('t_food')->field('count(foodId) COUNT')->select();
        return $sql;

    }
    public function foodRelease()
    {
        $sql=db('t_food')->alias('a')
            ->join('t_region b','a.desId = b.REGION_ID')->field('a.*,b.REGION_NAME')->select();
        return $sql;
    }
    public function foodShelves($id)
    {
        $sql=db('t_food')->where('foodId', $id)->update(['foodType' => '1']);
        return $sql;
    }
    public function foodOn($id)
    {
        $sql=db('t_food')->where('foodId', $id)->update(['foodType' => '0']);
        return $sql;
    }
    public function foodDelete($id)
    {
        $sql=db('t_food')->where('foodId',$id)->delete();
        return $sql;
    }
    public function region()
    {
        $sql=db('t_region')->where('PARENT_ID',1)->select();
        return $sql;
    }//地区一级select列表
    public function foodType()
    {
        $sql=db('t_foodtype')->select();
        return $sql;
    }//美食类型
    public function foodSelect($regionId)
    {
        $sql=db('t_region')->where('PARENT_ID',$regionId)->select();
        return $sql;
    }//地区二级select列表
    public function foodAappend($foodName,$foodDescribe,$desId,$foodType,$address)
    {
        $data = [
            'foodName' => $foodName,
            'foodDescribe' => $foodDescribe,
            'foodMoney'=>null,
            'foodNum'=>null,
            'desId'=>$desId,
            'foodImg'=>'images/food/330/330_0.jpeg',
            'foodType'=>0,
            'foodTypeId'=>$foodType,
            'address'=>$address
        ];
        $sql=db('t_food')->insertGetId($data);
        return $sql;
    }//美食添加且发布
    public function foodFind($foodName)
    {
        $sql=db('t_food')->where('foodName',$foodName)->field('count(foodId) COUNT')->select();
        return $sql;
    }//美食查重
    public function foodAappendNo($foodName,$foodDescribe,$desId,$foodType,$address)
    {
        $data = [
            'foodName' => $foodName,
            'foodDescribe' => $foodDescribe,
            'foodMoney'=>null,
            'foodNum'=>null,
            'desId'=>$desId,
            'foodImg'=>'images/food/330/330_0.jpeg',
            'foodType'=>1,
            'foodTypeId'=>$foodType,
            'address'=>$address
        ];
        $sql=db('t_food')->insertGetId($data);;
        return $sql;
    }//美食添加但不发布
    public function coverImg($foodId,$sqlNewImg)
    {
        $sql=db('t_food')->where('foodId', $foodId)->update(['foodImg' =>$sqlNewImg]);
        return $sql;
    }//数据库存封面图存储
    public function timeImg($foodId,$sqlNewImg)
    {
        $data = [
            'url'=>$sqlNewImg,
            'foodId'=>$foodId
        ];
        $sql=db('t_foodimg')->insert($data);
        return $sql;
    }//美食相关图片存储
    public function DeleteFoodImg($id)
    {
        $sql=db('t_foodimg')->where('foodId',$id)->delete();
        return $sql;
    }//删除美食
    public function ImgFindMin($foodId)
    {
        $sql=db('t_food')->where('foodId',$foodId)->field('foodImg')->select();
        return $sql;
    }//封面照片查询  查food表的img
    public function ImgFindMan($foodId)
    {
        $sql=db('t_foodimg')->where('foodId',$foodId)->field('url')->select();
        return $sql;
    }//其余照片查询  查foodimg表的url
    public function foodMain($foodId,$secondary)
    {
        $sql=db('t_food')->where('foodId', $foodId)->update(['foodImg' => $secondary]);
        return $sql;
    }//图片替换封面图换上去
    public function foodSecondary($secondary,$main)
    {
        $sql=db('t_foodimg')->where('url', $secondary)->update(['url' => $main]);
        return $sql;
    }//图片替换封面图换下来
    public function foodDeleteMore($val)
    {
        $sql=db('t_foodimg')->where('url',$val)->delete();
        return $sql;
    }//删除图片操作
    public function foodInformation($foodId){
        $sql=db('t_food')->where('foodId',$foodId)->select();
        return $sql;
    }//获取当前点击美食
    public function regionFood($desId){
        $fid=db('t_region')->where('REGION_ID',$desId)->select()[0]["PARENT_ID"];
        $sql=db('t_region')->where('PARENT_ID',$fid)->select();
        return $sql;
    }//地区表查询
    public function foodChangeAppend($foodName,$foodDescribe,$foodType,$address,$desId,$foodId){
        $sql=db('t_food')->where('foodId', $foodId)->
        update([
            'foodName' => $foodName,
            'foodDescribe'=>$foodDescribe,
            'foodTypeId'=>$foodType,
            'address'=>$address,
            'desId'=>$desId
        ]);
        return $sql;
    }//修改酒店数据
    public function regionWx($id){
        $sql=db('t_food')->where('desId',$id)->select();
        return $sql;
    }
    public function fooddetailsWx($id)
    {
        $sql=db('t_food')->where('foodId',$id)->select();
        return $sql;
    }
    public function foodImgWx($id){
        $sql=db('t_foodimg')->where('foodId',$id)->select();
        return $sql;
    }
    public function foodCommentWx($id)
    {
        $sql=db('t_foodcomment')->alias('a')
            ->join('t_user b','a.uid=b.uid')->field('a.*,b.uname,b.uheadImg')->select();
        return $sql;
    }
}