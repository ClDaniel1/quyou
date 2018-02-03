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
}
