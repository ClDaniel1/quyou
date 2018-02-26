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
        foreach($sql as $key=>$value )
        {
            $scenicCom=db('t_sceniccomment')->alias('a')->join('t_user b','a.uid=b.uid')->where('a.scenicId',$sql[$key]['scenicId'])->field('a.content,b.uheadImg,b.uname')->order('a.comTime desc')->find();
            $sql[$key]['content']=$scenicCom;
        }
        $arr['list']=$sql;
        $arr['count']=$count;
        return $arr;
    }
    public function fiveScenic($id)//根据地区id查找5条景点信息
    {
        $sql=db('t_scenic')->alias('a')->field('a.scenicName,a.scenicDescribe,a.scenicId')->where('a.desId',$id)->limit(0,5)->select();
//            查找图片
        foreach($sql as $key=>$value)
        {
            $img=db('t_scenicimg')->field('url')->where('scenicId',$value['scenicId'])->limit(0,3)->select();
            $count=db('t_sceniccomment')->where('scenicId',$value['scenicId'])->count();
            $sql[$key]['img']=$img;
            $sql[$key]['count']=$count;
        }
        return $sql;
    }
    public function allScenic($id)//全部景点信息分页显示
    {
        return db('t_scenic')->where('desId',$id)->paginate(10,false,['query'=>['rgId'=>$id]]);
    }
    public function idScenic($id)//根据景点id获取景点信息
    {

        $msgArr=db('t_scenic')->alias('a')->join('t_region b','a.desId=b.REGION_ID')->where('a.scenicId',$id)->field('a.*,b.REGION_NAME rName')->find();

        $img=db('t_scenicimg')->field('url')->where('scenicId',$id)->limit(0,3)->select();
        $msgArr['imgMsg']=$img;
        return $msgArr;
    }
    public function payScenic($id)//根据id获取景点信息，购买页面
    {
        $msgArr=db('t_scenic')->alias('a')->join('t_region b','a.desId=b.REGION_ID')->where('a.scenicId',$id)->field('a.*,b.REGION_NAME rName')->find();
        $img=db('t_scenicimg')->field('url')->where('scenicId',$id)->limit(0,5)->select();
        $msgArr['sImg']=$img;
        return $msgArr;
    }

    public function hotelMsg($id)//根据地区id查找对应地区酒店2条信息
    {
        $arr=array();
        $sql=db('t_hotel')->where('desId',$id)->limit(0,2)->select();
        $count=db('t_hotel')->where('desId',$id)->count();
        foreach($sql as $key=>$value )
        {
            $scenicCom=db('t_hotelcomment')->alias('a')->join('t_user b','a.uid=b.uid')->where('a.hotelId',$sql[$key]['hotelId'])->field('a.content,b.uheadImg,b.uname')->order('a.comTime desc')->find();
            $sql[$key]['content']=$scenicCom;
        }
        $arr['msg']=$sql;
        $arr['count']=$count;
        return $arr;
    }
    public function htCount($id)//酒店总数
    {
        $sql=db('t_hotel')->where('desId',$id)->count();
        return $sql;
    }
    public function hotelCount($id,$start,$end)//根据地区id查找对应地区酒店全部信息
    {
        $sql=db('t_hotel')->where('desId',$id)->limit($start,$end)->select();
        return $sql;
    }
    public function oneHotel($id)//根据酒店id查找对应的酒店信息 单条
    {
        return db('t_hotel')->where('hotelId',$id)->find();
    }
    public function htImg($id)//根据酒店id查找显示的七张图片
    {
        return db('t_hotelimg')->field('url')->where('hotelId',$id)->limit(0,6)->select();
    }
    public function addUser($data)//添加联系人
    {
        return db('t_contact')->insert($data);
    }
    public function contactM($uId)//根据用户id获取联系人列表
    {
        return db('t_contact')->where('uid',$uId)->select();
    }
    public function foodMsg($id)//根据地区id查找对应地区食物信息
    {
        $arr=array();
        $sql=db('t_food')->where('desId',$id)->limit(0,2)->select();
        $count=db('t_food')->where('desId',$id)->count();
        foreach($sql as $key=>$value )
        {
            $scenicCom=db('t_foodcomment')->alias('a')->join('t_user b','a.uid=b.uid')->where('a.foodId',$sql[$key]['foodId'])->field('a.content,b.uheadImg,b.uname')->order('a.comTime desc')->find();
            $sql[$key]['content']=$scenicCom;
        }
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
    public function htComMsg($id)//获取酒店评价信息
    {
        $res=db('t_hotelcomment')->alias('a')->join('t_user b','a.uid = b.uid')->field('a.*,b.uname,b.uheadImg')->where('a.hotelId',$id)->select();
        return $res;
    }
    public function hotelOrder($data)//添加订单
    {
        return db('t_order')->insertGetId($data);
    }
    public function gainOrder($orderId)//根据订单id获取订单信息
    {
        return db('t_order')->where('orderId',$orderId)->find();
    }
    public function hPay($uid,$pwd)//判断支付密码是否正确
    {
        return db('t_user')->where('uid',$uid)->where('payPwd',md5($pwd))->find();
    }
    public function upBalance($uid,$balance)//更新用户数据库金额
    {
        return db('t_user')->where('uid',$uid)->update(['ubalance' => $balance]);
    }
    public function contact($arr)//根据联系人id获取联系人信息
    {
        $data['conId'] = array('IN',json_decode($arr,true));
        return db('t_contact')->where($data)->select();
    }
    public function radomStr($str)//随机码查重
    {
        $res=db('t_order')->where('orderCode',$str)->count();
        if($res>0){
            return false;
        }
        else
        {
            db('t_order')->insert(['orderCode'=>$str]);
            return true;
        }
    }
}
