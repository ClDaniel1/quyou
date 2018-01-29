<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/29
 * Time: 14:54
 */

namespace app\home\model;


use think\Model;

class Note extends Model
{
    public function creatNote($uphone){
        $data =[

        ];
        db("t_note")->insert($data);
    }
}