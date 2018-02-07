<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/6
 * Time: 16:26
 */

namespace app\admin\model;


class Note
{
    public function getNoNote(){
        $data = db("t_note")
            ->alias('a')
            ->field("a.*,b.REGION_NAME,c.uname")
            ->join('t_region b','a.desId = b.REGION_ID')
            ->join('t_user c','a.uid = c.uid')
            ->where("noteType=2")->select();
        return $data;
    }

    public function getNote(){
        $data = db("t_note")
            ->alias('a')
            ->field("a.*,b.REGION_NAME,c.uname")
            ->join('t_region b','a.desId = b.REGION_ID')
            ->join('t_user c','a.uid = c.uid')
            ->where("noteType=1")->select();
        return $data;
    }

    /**
     * 获取游记基本信息
     * @param $noteId 游记Id
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNoteInfo($noteId){
        $data =db('t_note')
            ->alias('a')
            ->field("a.*,b.REGION_NAME,c.uname")
            ->join('t_region b','a.desId = b.REGION_ID')
            ->join('t_user c','a.uid = c.uid')
            ->where("noteId= $noteId")
            ->select();
        return $data;
    }

    /**
     * 获取游记内容
     * @param $noteId 游记Id
     * @return mixed
     */
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
}