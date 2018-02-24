<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/4
 * Time: 16:06
 */

namespace app\admin\model;


class User extends \think\Model
{
    public function userInformation()
    {
        $sql=db('t_user')->select();
        return $sql;
    }//搜索用户表
    public function userTheShelves($uid)
    {
        $sql=db('t_user')->where('uid', $uid)->update(['ustatus' => '1']);
        return $sql;
    }//用户停用
    public function userShelves($uid)
    {
        $sql=db('t_user')->where('uid', $uid)->update(['ustatus' => '0']);
        return $sql;
    }//用户启用
    public function userPawRepair($uid)
    {
        $sql=db('t_user')->where('uid', $uid)->update(['upwd' => '123456']);
        return $sql;
    }//密码重置
    public function userDel($uid)
    {
        $sql=db('t_user')->where('uid',$uid)->delete();
        return $sql;
    }//用户删除
    public function userCheck($uid)
    {
        $sql=db('t_user')->where('uid',$uid)->select();
        return $sql;
    }//用户信息展开
    public function userRepair($uid,$username,$sex,$uphone,$email)
    {
        $sql=db('t_user')->where('uid',$uid)->update(['uname' => $username,
            'usex'=>$sex,
            'uphone'=>$uphone,
            'email'=>$email]);
        return $sql;
    }
}