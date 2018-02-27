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
}
