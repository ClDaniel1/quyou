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
use \think\Cookie;
class Region extends \think\Controller
{
    public function region()//显示地区攻略
    {
        $a=new model\Region();
        $rgId=input('?param.des')?input('des'):"";
        $this->assign('sId',$rgId);
        $res=$a->region($rgId);//根据地区id查找对应名称
        cookie('regionName',$res['REGION_NAME']);
        cookie('regionId',$rgId);
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
        return $this->fetch();
    }
    public function hotel()//显示地区酒店
    {

//        $msg=$model->hotelCount($regionId);
//        $this->assign('htCount',$msg);
        return $this->fetch('hotel');
    }
    public function ajaxHotel()//根据ajax发送过来的请求获取酒店信息
    {
        $regionId=cookie('regionId');
        $model=new model\Region();
        $pageIndex=input('?param.page')?input('page'):"";
        $size=input('?param.size')?input('size'):"";
        $count=$model->htCount($regionId);
        $num=ceil($count/$size);
        $start=($pageIndex-1)*$size;
        $end=$start+$size;
        $msg=$model->hotelCount($regionId,$start,$end);
        $arr=[];
        array_push($arr,$num);
        array_push($arr,$msg);
        echo json_encode($arr);
    }
    public function route()//地图处页面加载完成发送ajax请求路线
    {
        $route=new model\Region();
        $regionName=cookie('regionName');
        $regionId=cookie('regionId');
        $routeCount=$route->routeCount($regionId);//根据地区id查找对应路线总条数
        $this->assign('routeCount',$routeCount);
        $routeMsg=$route->routeMsg($regionId);
        $arr=array();
        foreach($routeMsg as $value)
        {
            $arr[$value['routeId']][]=$value;
        }
        $tArr=array_slice($arr,0,2);
        $routeArr=[];
        $routeArr['name']=$regionName;
        $routeArr['msg']=$tArr;
        $routeArr['count']=$routeCount;
        echo json_encode($routeArr);
    }
    public function hotelPay()//酒店下单详情页
    {
        $hotelId=input('?param.id')?input('id'):"";
        $regionName=cookie('regionName');
        $this->assign('reName',$regionName);
        $this->assign('hId',$hotelId);
        $model=new model\Region();
        $msg=$model->oneHotel($hotelId);
        $this->assign('hotelMsg',$msg);
        return $this->fetch('hotelPay');
    }
    public function htComMsg()//获取酒店评论信息
    {
        $id=input("?param.id")?input('id'):"";
        $model=new model\Region();
        $res=$model->htComMsg($id);
        echo json_encode($res);
    }
    public function htImg()//获取酒店图片信息
    {
        $htId=input('?param.htId')?input('htId'):"";
        $model=new model\Region();
        $msg=$model->htImg($htId);
        echo json_encode($msg);
    }
    public function hotelOrder()//酒店下单
    {
        $hId=input("?param.id")?input("id"):"";
        $checkTime=input("?param.checkTime")?input("checkTime"):"";
        $outTime=input("?param.outTime")?input("outTime"):"";
        $days=$this->days($outTime,$checkTime);
        $num=input("?param.num")?input("num"):"";
        $model=new model\Region();
        $msg=$model->oneHotel($hId);
        $price=$num*$msg['hotelPrice'];
        $arr=['checkTime'=>$checkTime,'outTime'=>$outTime,'num'=>$num,'msg'=>$msg,'price'=>$price,'days'=>$days];
        $this->assign('msg',$arr);
        $this->assign('num',$num);
        return $this->fetch('hotelOrder');
    }

    public function days($d1,$d2)
    {
        $second1 = strtotime($d1);
        $second2 = strtotime($d2);
        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return round(($second1 - $second2) / 86400);
    }

    public function addHotel()//确认酒店订单信息
    {
        $user=input("?param.user")?input("user/a"):"";//联系人
        $unitPrice=input("?param.unitPrice")?input("unitPrice"):"";//单价
        $hotalPrice=input("?param.hotalPrice")?input("hotalPrice"):"";//总价
        $num=input("?param.num")?input("num"):"";//订购数
        $days=input("?param.days")?input("days"):"";//使用天数
        $useTime=input("?param.useTime")?input("useTime"):"";//使用时间
        $tradeId=input("?param.tradeId")?input("tradeId"):"";//订购商品id
        $uId=cookie("uid");//用户id
        $orderTime=time();//下单时间
//        foreach($user as $value)//遍历联系人写入数据库
//        {
//            $data=['uid'=>$uId,'conName'=>$value.name,'conIdCard'=>$value.identity,'conPhone'=>$value.phone];
//            echo json_encode($data);
//        }
//        $this->success("新增成功");
    }
    public function hOrderPay()
    {
        return $this->fetch('hOrderPay');
    }


    public function hSuccess()//酒店下单成功页面
    {
//        测试用到时候删除
        $hId=275;
        $checkTime=2018-2-7;
        $outTime=2018-2-9;
        $num=1;
        $model=new model\Region();
        $msg=$model->oneHotel($hId);
        $price=$num*$msg['hotelPrice'];
        $arr=['checkTime'=>$checkTime,'outTime'=>$outTime,'num'=>$num,'msg'=>$msg,'price'=>$price];
        $this->assign('msg',$arr);
//        测试用到时候删除
        return $this->fetch('hSuccess');
    }

    public function scenicShow()//显示地区景点页面
    {
        $id=input('?param.rgId')?input('rgId'):"";
        return $this->fetch('scenic');
    }
    public function scenicMsg()//显示景点详情页
    {
        return $this->fetch('scenicMsg');
    }
    public function scenicPay()//显示景点购买页面
    {
        return $this->fetch('scenicPay');
    }
    public function food()//显示美食页面
    {
        $id=input('?param.rgId')?input('rgId'):"";
        return $this->fetch('food');
    }
    public function foodMsg()//显示美食详情页面
    {
        return $this->fetch('foodMsg');
    }
}
