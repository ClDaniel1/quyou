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
    //创建游记
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

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

    //获取游记基本信息
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function getNoteInfo($noteId){
        $data =db('t_note')
            ->where("noteId= $noteId")
            ->select();
        return $data;
    }

    //获取游记内容
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function getNoteCont($noteId){
        $data =db('t_note')
            ->alias('a')
            ->join('t_notecon b','a.noteId = b.noteId')
            ->field("b.*")
            ->where("a.noteId= $noteId")
            ->order("num ASC")
            ->select();
        return $data;
    }

    //将头图传到数据库
    //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function setUp($noteId,$path){
        db("t_note")->where("noteId=$noteId")->update(["img"=>$path]);
    }


    public function delCon($noteId){
        db('t_notecon')->where('noteId',$noteId)->delete();
    }

    public function upCon($noteId,$con,$type,$num,$title){
        $data = [
            "noteId" => $noteId,
            "title" => $title,
            "content" => $con,
            "type" => $type,
            "num"=>$num
        ];
        db('t_notecon')->insert($data);

    }
}