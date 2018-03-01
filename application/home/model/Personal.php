<?php
namespace app\home\model;

class Personal{
    public function getInfo($data){
        return db('t_user') -> where($data) ->find();
    }


    //更改个人信息
    public function changeInfo($uid,$data){
        return db('t_user')->where('uid',$uid)->update($data);
    }

    //用户名的检查
    public function checkName($data){
        return db('t_user') -> where('uname',$data) ->select();
    }

    //修改密码
    public function changePwd($uid,$data){
        return db('t_user')->where('uid',$uid)->update($data);
    }

    //检查密码
    public function checkPwd($data){
        return db('t_user') -> where($data) ->find();
    }

    //上传头像
    public function upload($uid,$userPath){
        return db("t_user")->where("uid=$uid")->update(["uheadImg"=>$userPath]);
    }


    //获取城市
    public function getCitys($regionId){
        $sql=db('t_region')->where('PARENT_ID',$regionId)->select();
        return $sql;

    }

    //地区一级select列表
    public function region()
    {
        $sql=db('t_region')->where('PARENT_ID',1)->select();
        return $sql;
    }

    //我的足迹
    public function myFootMark($uid){
        $sql=db('t_region')->alias('a')->join('t_footmark b','a.REGION_ID = b.desId')->where('b.uid',$uid)->field('a.REGION_NAME,b.*')->select();
        return $sql;
    }

    //添加足迹
    public function addFooter($uid,$date,$desId){
        $data = [
            "footTime" => $date,
            "desId" => $desId,
            "uid" => $uid
        ];
        db('t_footmark')->insert($data);
    }
    public function focusPersonal($uid)
    {
        $sql=db('t_collect')->where('uid',$uid)->where('type','0')->field('whoId')->select();
        return $sql;
    }
    /*public function collectData($uid){
        $sql=db('t_collect')->where('uid',$uid)->select();
        return $sql;
    }
    public function noteCollect($noteid){
        $sql=db('t_note')->where('noteId',$noteid)->select();
        return $sql;
    }
    public function foodCollect($foodid){
        $sql=db('t_food')->where('foodId',$foodid)->select();
        return $sql;
    }*/
    public function collectData($uid){
        $arr = db('t_collect')
            ->field("a.type,b.hotelName,b.img,c.scenicName,c.scenicImg,d.foodName,d.foodImg,e.title,e.img,b.hotelId,c.scenicId,d.foodId,e.noteId")
            ->alias("a")
            ->join('t_hotel b','a.whoId = b.hotelId and a.type = "4"','LEFT')
            ->join('t_scenic c','a.whoId = c.scenicId and a.type = "3"','LEFT')
            ->join('t_food d','a.whoId = d.foodId and a.type = "2"','LEFT')
            ->join('t_note e','a.whoId = e.noteId and a.type = "1"','LEFT')
            ->where("a.uid = $uid and a.type <> '0'")
            ->select();
        return $arr;
    }

    public function changeNikeName($uid,$nikeName){
        $res = db("t_user")->where("uid",$uid)->update(["uname"=>$nikeName]);
        return $res;
    }

    public function getMyDfOrder($uid,$start,$num){
        $arr = db('t_order')
            ->field("a.*,b.hotelName,b.img,c.scenicName,c.scenicImg")
            ->alias("a")
            -> join('t_hotel b','a.tradeId = b.hotelId and a.tradeType = "hotel"','LEFT')
            ->join('t_scenic c','a.tradeId = c.scenicId and a.tradeType = "scenic"','LEFT')
            ->order('a.orderTime Desc')
            ->where(['orderTypeId'=>1,"uid"=>$uid])
            ->limit($start,$num)
            ->select();
        return $arr;
    }
    public function getMyDfOrderCount($uid){
        $data=db('t_order')->field("count(orderId) allN")->where(['orderTypeId'=>1,"uid"=>$uid])->select();
        return $data[0]["allN"];
    }

    public function getMyyfOrder($uid,$start,$num){
        $arr = db('t_order')
            ->field("a.*,b.hotelName,b.img,c.scenicName,c.scenicImg")
            ->alias("a")
            -> join('t_hotel b','a.tradeId = b.hotelId and a.tradeType = "hotel"','LEFT')
            ->join('t_scenic c','a.tradeId = c.scenicId and a.tradeType = "scenic"','LEFT')
            ->order('a.orderTypeId Desc')
            ->where("orderTypeId <> 1 and uid=$uid")
            ->limit($start,$num)
            ->select();
        return $arr;
    }
    public function getMyyfOrderCount($uid){
        $data=db('t_order')->field("count(orderId) allN")->where("orderTypeId <> 1 and uid=$uid")->select();
        return $data[0]["allN"];
    }

    public function getOrderInfo($orderId){
        $arr = db('t_order')
            ->field("a.*,b.hotelName,b.img,c.scenicName,c.scenicImg")
            ->alias("a")
            -> join('t_hotel b','a.tradeId = b.hotelId and a.tradeType = "hotel"','LEFT')
            ->join('t_scenic c','a.tradeId = c.scenicId and a.tradeType = "scenic"','LEFT')
            ->order('a.orderTypeId Desc')
            ->where("orderId",$orderId)
            ->select();
        return $arr;
    }
}
