<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/6
 * Time: 16:26
 */

namespace app\admin\model;
use think\Db;


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
            ->where("noteType=1 or noteType=3")->select();
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

    public function escCheck($noteId){
        $noteInfo = Db::table('t_note')->where('noteId',$noteId)->find();
        $uid = $noteInfo["uid"];
        $noteName = $noteInfo["title"];
        Db::startTrans();
        try{
            Db::table('t_note')->where('noteId', $noteId)->update(['noteType' => '2']);
            $data = [
                'uid' => $uid,
                'msgCon' => "您的游记‘{$noteName}’审核结果已被撤回",
                'msgTime' => date("Y-m-d H:i:s")
            ];
            Db::table('t_msg')->insert($data);
            // 提交事务
            Db::commit();
            return true;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
        return false;

    }

    public function pass($noteId){
        $noteInfo = Db::table('t_note')->where('noteId',$noteId)->find();
        $uid = $noteInfo["uid"];
        $noteName = $noteInfo["title"];
        Db::startTrans();
        try{
            Db::table('t_note')->where('noteId', $noteId)->update(['noteType' => '1']);
            $data = [
                'uid' => $uid,
                'msgCon' => "您的游记‘{$noteName}’审核已通过",
                'msgTime' => date("Y-m-d H:i:s")
            ];
            Db::table('t_msg')->insert($data);
            // 提交事务
            Db::commit();
            return true;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
        return false;

    }

    public function unPass($noteId,$unpass){
        $noteInfo = Db::table('t_note')->where('noteId',$noteId)->find();
        $uid = $noteInfo["uid"];
        $noteName = $noteInfo["title"];
        Db::startTrans();
        try{
            Db::table('t_note')->where('noteId', $noteId)->update(['noteType' => '3','unPass'=>$unpass]);
            $data = [
                'uid' => $uid,
                'msgCon' => "很抱歉，您的游记‘{$noteName}’审核未通过，原因是{$unpass}",
                'msgTime' => date("Y-m-d H:i:s")
            ];
            Db::table('t_msg')->insert($data);
            // 提交事务
            Db::commit();
            return true;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
        return false;
    }
}