<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26
 * Time: 19:26
 */

namespace app\admin\model;


class Order extends \think\Model
{
    public function noOrder()//未支付订单显示
    {
        $hotel=db('t_order')->alias('a')->join('t_user b','a.uid=b.uid')->join('t_hotel c','a.tradeId=c.hotelId')->join('t_ordertype d','a.orderTypeId=d.orderTypeId')->field('a.*,b.uname uname,c.hotelName oName,d.typeName typeName')->where(['tradeType'=>'hotel','a.orderTypeId'=>1])->select();
        $scenic=db('t_order')->alias('a')->join('t_user b','a.uid=b.uid')->join('t_scenic c','a.tradeId=c.scenicId')->join('t_ordertype d','a.orderTypeId=d.orderTypeId')->field('a.*,b.uname uname,c.scenicName oName,d.typeName typeName')->where(['tradeType'=>'hotel','a.orderTypeId'=>1])->select();
        $arr=[$hotel,$scenic];
        return $arr;
    }
    public function cancelOrder($id)//取消订单，改变订单状态
    {
        return db('t_order')->where('orderId',$id)->update(['orderTypeId'=>3]);
    }
    public function payOrderMsg()
    {
        $hotel=db('t_order')->alias('a')->join('t_user b','a.uid=b.uid')->join('t_hotel c','a.tradeId=c.hotelId')->join('t_ordertype d','a.orderTypeId=d.orderTypeId')->field('a.*,b.uname uname,c.hotelName oName,d.typeName typeName')->where(['tradeType'=>'hotel','a.orderTypeId'=>1])->select();
        $scenic=db('t_order')->alias('a')->join('t_user b','a.uid=b.uid')->join('t_scenic c','a.tradeId=c.scenicId')->join('t_ordertype d','a.orderTypeId=d.orderTypeId')->field('a.*,b.uname uname,c.scenicName oName,d.typeName typeName')->where(['tradeType'=>'hotel','a.orderTypeId'=>1])->select();
        $arr=[$hotel,$scenic];
        return $arr;
    }
}