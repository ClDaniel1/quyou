<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/28
 * Time: 11:38
 */

namespace app\home\model;

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
}