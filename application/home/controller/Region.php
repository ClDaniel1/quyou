<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 19:08
 */
namespace app\home\controller;
use app\admin\model\User;
use org\RadomStr;
use think\console\command\make\Controller;
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

        $nm = new model\Notes();
        $note = $nm->getNoteByRe($rgId,0,1);
        $this->assign('note',$note);
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
        $tArr=array_slice($arr,0,$routeCount);
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
        if(Cookie::has('uid')){
            $uid = cookie("uid");
        }
        else{
            $uid = "";
        }
        $this->assign('uid',$uid);
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
        $userId=Cookie::has('uid');
        if($userId==false)
        {
            $this->error('请登录后在进行预订');
        }
        else{
            $hId=input("?param.id")?input("id"):"";
            $checkTime=input("?param.checkTime")?input("checkTime"):"";
            $outTime=input("?param.outTime")?input("outTime"):"";
            $days=$this->days($outTime,$checkTime);
            $num=input("?param.num")?input("num"):"";
            $model=new model\Region();
            $msg=$model->oneHotel($hId);
            $price=$num*$days*$msg['hotelPrice'];
            $arr=['checkTime'=>$checkTime,'outTime'=>$outTime,'num'=>$num,'msg'=>$msg,'price'=>$price,'days'=>$days];
            $this->assign('msg',$arr);
            $this->assign('hotel',$msg);
            $this->assign('num',$num);
            return $this->fetch('hotelOrder');
        }

    }
    public function contact()//获取当前用户联系人列表
    {
        $userCon = new \app\home\Controller\User();
        $res=$userCon->checkLogin();
        if($res==true)
        {
            $user=cookie('uid');
            $contact=new model\Region();
            $contactRes=$contact->contactM($user);
            echo json_encode($contactRes);
        }
        else
        {
            $returnMsg=config('msg')['login']['noLogin'];
            echo json_encode($returnMsg);
        }
    }
    public function addContact()//添加联系人
    {
        $userCon = new \app\home\Controller\User();
        $res=$userCon->checkLogin();
        if($res==true)
        {
            $uId=cookie('uid');
            $name=input('?param.name')?input('name'):"";
            $phone=input('?param.phone')?input('phone'):"";
            $identity=input('?param.identity')?input('identity'):"";
            $arr=['uid'=>$uId,'conName'=>$name,'conIdCard'=>$identity,'conPhone'=>$phone];
            $model=new model\Region();
            $res=$model->addUser($arr);
            if($res==true)
            {
                $returnMsg=config('msg')['contact'];
                echo json_encode($returnMsg);
            }
        }
        else
        {
            $returnMsg=config('msg')['login']['noLogin'];
            echo json_encode($returnMsg);
        }
    }
    public function days($d1,$d2)//相差天数
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
        $user=input("?param.user")?input("user/a"):"";//联系人数组

        $userArr=json_encode($user);
        $unitPrice=input("?param.unitPrice")?input("unitPrice"):"";//单价
        $hotalPrice=input("?param.hotalPrice")?input("hotalPrice"):"";//总价
        $num=input("?param.num")?input("num"):"";//订购数
        $days=input("?param.days")?input("days"):"";//使用天数
        $useTime=input("?param.useTime")?input("useTime"):"";//使用时间
        $tradeId=input("?param.tradeId")?input("tradeId"):"";//订购商品id
        $uId=cookie("uid");//用户id
        $orderTime=date('Y-m-d H-i-s',time());//下单时间
        $arr=['uid'=>$uId,'orderTime'=>$orderTime,'unitPrice'=>$unitPrice,'totalPrice'=>$hotalPrice,'num'=>$num,'orderTypeId'=>1,'useDate'=>$useTime,'valid'=>$days,'conId'=>$userArr,'tradeId'=>$tradeId,'tradeType'=>'hotel'];
        $model=new model\Region();
        $res=$model->hotelOrder($arr);
        if(empty($user)||count($user)!=$num)
        {
            $returnMsg=config('msg')['order']['numF'];
            echo json_encode($returnMsg);
        }
        else
        {
            if($res==true)
            {
                $returnMsg=config('msg')['order']['orderT'];
                array_push($returnMsg['data'],$res);
                echo json_encode($returnMsg);
            }
            else
            {
                $returnMsg=config('msg')['order']['orderF'];
                echo json_encode($returnMsg);
            }
        }
    }
    public function hOrderPay()//酒店下单付款页面
    {
        $orderId=input('?param.orderId')?input('orderId'):"";
        $model=new model\Region();
        $res=$model->gainOrder($orderId);
        $hotelId=$res["tradeId"];
        $hotelMsg=$model->oneHotel($hotelId);
        $arr=[];
        $arr['order']=$res;
        $arr['hotel']=$hotelMsg;
        $this->assign('msg',$arr);
        return $this->fetch('hOrderPay');
    }
    public function hPay()//酒店支付，配对密码
    {
        $userCon = new \app\home\Controller\User();
        $res=$userCon->checkLogin();
        $pwd=input("?param.pwd")?input("pwd"):"";
        $price=input("?param.price")?input("price"):"";
        $orderId=input("?param.orderId")?input("orderId"):"";
        if($res==false)
        {
            $returnMsg=config('msg')['login']['noLogin'];
            echo json_encode($returnMsg);
        }
        else
        {
            $uId=cookie('uid');
            $model=new model\Region();
            $data=$model->hPay($uId,$pwd);
            if(!empty($data))
            {
                if($price>$data['ubalance'])
                {
                    $returnMsg=config('msg')['order']['payF'];
                    echo json_encode($returnMsg);
                }
                else
                {
                    $balance=sprintf("%.2f",$data['ubalance']-$price);
                    $upRes=$model->upBalance($uId,$balance);
                    if($upRes!=false)
                    {
                        $radom=new RadomStr();
                        while(1)
                        {
                            $radomStr=$radom->get();
                            $raRes=$model->radomStr($orderId,$radomStr);
                            if($raRes)
                            {
                                break;
                            }
                        }
                        $returnMsg=config('msg')['order']['payT'];
                        echo json_encode($returnMsg);
                    }
                }
            }
            else
            {
                $returnMsg=config('msg')['order']['pwdF'];
                echo json_encode($returnMsg);
            }
        }
    }

    public function hSuccess()//酒店下单成功页面
    {
        $orderId=input('?param.orderId')?input('orderId'):"";
        $model=new model\Region();
        $res=$model->gainOrder($orderId);
        $hotelId=$res["tradeId"];
        $stact=$res["conId"];//获取到联系人数组进行分析，
        $contact=$model->contact($stact);
        $this->assign('contact',$contact);
        $hotelMsg=$model->oneHotel($hotelId);
        $arr=[];
        $arr['order']=$res;
        $arr['hotel']=$hotelMsg;
        $this->assign('msg',$arr);
        return $this->fetch('hSuccess');
    }

    public function scenicShow()//显示地区景点页面
    {
        $id=input('?param.rgId')?input('rgId'):"";
        $a=new model\Region();
        $res=$a->region($id);//根据地区id查找对应名称
        $this->assign('region_name',$res['REGION_NAME']);
        $bk=new Intro();
        $bkMsg=$bk->getIntro($res['REGION_NAME']);//查找地区对应百科信息
        $this->assign('regionMsg',$bkMsg);
        //查找对应5条景点数据
        $resS=$a->fiveScenic($id);
//        分页显示全部景点
        $all=$a->allScenic($id);
        $this->assign('all',$all);
        $this->assign('scenic',$resS);
        return $this->fetch('scenic');
    }
    public function scenicMsg()//显示景点详情页
    {
        $id=input('?param.id')?input('id'):"";
        $model=new model\Region();
        $arr=$model->idScenic($id);
        $this->assign('msg',$arr);
        return $this->fetch('scenicMsg');
    }
    public function scenicPay()//显示景点购买页面
    {
        $id=input('?param.id')?input('id'):"";
        $model=new model\Region();
        $arr=$model->payScenic($id);
        $this->assign('msg',$arr);
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
    public function addhCom(){
        $hid = input("param.hid");
        $com = input("param.com");
        $time = date("Y-m-d H:i:s");
        $uid = cookie("uid");
        $fid = input("param.fid");

        $rm = new model\Region();
        $rm->addhCom($hid,$com,$time,$uid,$fid);
    }
    public function delhCom(){
        $comId = input("param.comId");
        var_dump($comId);
        $rm = new model\Region();
        $rm->delhCom($comId);
    }
}
