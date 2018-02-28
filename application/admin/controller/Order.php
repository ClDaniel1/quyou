<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26
 * Time: 13:48
 */

namespace app\admin\controller;


use think\Db;
use app\admin\model;
class Order extends \think\Controller
{
    public function nopay()//未支付订单页面显示
    {
        return $this->fetch();
    }
    public function noOrderMsg()//未支付订单ajax信息查找
    {
        $model=new model\Order();
        $order=$model->noOrder();
        echo json_encode($order);
    }
    public function cancelOrder()//未支付取消订单
    {
        $id=input('?param.id')?input('id'):"";
        $model=new model\Order();
        $res=$model->cancelOrder($id);
        if($res>0)
        {
            echo json_encode(config('msg')['order']['cancelT']);
        }
        else
        {
            echo json_encode(config('msg')['order']['cancelF']);
        }
    }
    public function pay()//已支付订单页面显示
    {
        return $this->fetch();
    }
    public function payOrderMsg()
    {
        $model=new model\Order();
        $order=$model->noOrder();
        echo json_encode($order);
    }

}