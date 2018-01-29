<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/29
 * Time: 14:54
 */

namespace app\home\model;


use think\Model;

class Notes extends Model
{
    public function creatNote($uid){
        $data =[
            "uid"
        ];
        db("t_note")->insert($data);
    }
}