<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/28
 * Time: 11:38
 */

namespace app\home\model;

use org\Intro;

class User
{
    public function login($data){
        return db('t_user') -> where($data) ->find();
    }

    public function checkLogin($data){
        return db('t_user') -> where($data) ->find();
    }

    public function setKey($id,$key){
        db('t_user')->where('uphone',$id)->setField('loginKey', $key);
    }

    //手机号的检查
    public function checkPhone($data){
        return db('t_user') -> where('uphone',$data) ->select();
    }

    //用户名的检查
    public function checkName($data){
        return db('t_user') -> where('uname',$data) ->select();
    }

    //获取未读消息数量
    public function getUnreadMsgNum($uid){
        $res = db('t_msg')->field('count("msgId") num')->where('uid',$uid)->where('readType',0)->select();
        return $res[0]["num"];
    }

    //获取系统消息
    public function getSysMsg($uid){
        $res = db('t_msg')->where('uid',$uid)->where('msgType',0)->order('readType desc,msgTime desc')->select();
        db('t_msg')->where('uid',$uid)->setField('readType','1');
        return $res;
    }

    public function getUserInfo($uid){
        $data =db('t_user')
            ->alias('a')
            ->field("a.uname,a.uheadImg,count(b.collectId) collectNum,count(c.collectId) byCollectNum")
            ->join('t_collect b','a.uid = b.uid')
            ->join('t_collect c','a.uid = c.whoId')
            ->where("a.uid= $uid")
            ->where("c.type= 0")
            ->select();
        return $data;
    }



    public function wxIdLogin($openId){
        $data =db('t_user')
            ->where(['wechatId'=>$openId] )
            ->select();
        return $data;
    }
}