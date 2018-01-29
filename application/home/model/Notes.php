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
        $time = date("Y-m-d H:i:s",time());
        $data =[
            "uid" => $uid,
            "createTime" => $time,
        ];

        $id = db("t_note")->insertGetId($data);

        $data2 =[
            "noteId" => $id,
            "num" => 1,
        ];
        db("t_notecon")->insert($data2);
        return $id;
    }

    public function getNoteCont($noteId){
        $data = db(['t_note'=>'noteId','t_notecon'=>'noteId'])->where("noteId= $noteId")->select();
        var_dump($data);
    }
}