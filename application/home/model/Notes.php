<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/29
 * Time: 14:54
 */

namespace app\home\model;


use think\Db;
use think\Model;

class Notes extends Model
{
    /**
     * 创建新游记
     * @param $uid 用户Id
     * @return int|string 返回游记Id
     */
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

    /**
     * 设置游记头图
     * @param $noteId 游记Id
     * @param $path 头图路径
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function setUp($noteId,$path){
        db("t_note")->where("noteId=$noteId")->update(["img"=>$path]);
    }



    /**
     * 保存游记内容
     * @param $noteId 游记Id
     * @param $datas 游记数据 Arr
     * @return bool 返回成功失败
     */
    public function upCon($noteId,$datas){
        Db::startTrans();
        try{
            Db::table('t_notecon')->where('noteId',$noteId)->delete();
            foreach ($datas as $val){
                $data = [
                    "noteId" => $noteId,
                    "title" => $val["title"],
                    "content" => $val["content"],
                    "type" => $val["type"],
                    "num"=>$val["num"]
                ];
                Db::table('t_notecon')->insert($data);
            }
            // 提交事务
            Db::commit();
            return true;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }

    }

    /**
     * 修改游记标题
     * @param $noteId 游记ID
     * @param $title 游记标题
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function setTitle($noteId,$title){
        $res = db("t_note")->where("noteId=$noteId")->update(["title"=>$title]);
        return $res;
    }

    /**
     * 获取用户游记草稿
     * @param $userId 用户Id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function draft($userId){
        $data =db('t_note')
            ->where("uid= $userId")
            ->where('noteType',0)
            ->select();
        return $data;
    }

    /**
     * 设置游记音乐
     * @param $noteId 游记ID
     * @param $path 音乐路径
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function setMusic($noteId,$path){
        $res = db("t_note")->where("noteId=$noteId")->update(["music"=>$path]);
        return $res;
    }

    /**
     * 删除游记音乐
     * @param $noteId 游记ID
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function reMusic($noteId){
        $res = db("t_note")->where("noteId=$noteId")->update(["music"=>""]);
        return $res;
    }

    /**
     * 获取省份
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getRegion(){
        $data = db("t_region")->where("PARENT_ID=1")->select();
        return $data;
    }

    /**
     * 获取城市
     * @param $prId 省份ID
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCity($prId){
        $data = db("t_region")->where("PARENT_ID=$prId")->select();
        return $data;
    }

    public function regionInfo($id){
        $data = db("t_region")->where("REGION_ID=$id")->select();
        return $data;
    }


    public function submit($noteId,$num,$price,$date,$desId){
        $data=[
            "travelDay" => $date,
            "travelNum" => $num,
            "noteType"=>2,
            "ppMoney" => $price,
            "desId" => $desId,
        ];

        $res = db("t_note")->where("noteId=$noteId")->update($data);
        return $res;
    }

    public function countNote(){
        $data = db("t_note")
                        ->field('COUNT(noteId) num')
                        ->where("noteType=1")->select();
        return $data[0]["num"];
    }

    public function getNote($start,$num){
        $data = db("t_note")
                        ->alias('a')
                        ->field("a.*,b.REGION_NAME,c.uname,d.content")
                        ->join('t_region b','a.desId = b.REGION_ID')
                        ->join('t_user c','a.uid = c.uid')
                        ->join('t_notecon d','a.noteId = d.noteId')
                        ->limit($start,$num)
                        ->where("a.noteType=1 and d.num =1")
                        ->order('tapNum desc')->select();
        return $data;
    }





    public function getNewNote($start,$num){
        $data = db("t_note")
            ->alias('a')
            ->field("a.*,b.REGION_NAME,c.uname,d.content")
            ->join('t_region b','a.desId = b.REGION_ID')
            ->join('t_user c','a.uid = c.uid')
            ->join('t_notecon d','a.noteId = d.noteId')
            ->limit($start,$num)
            ->where("a.noteType=1 and d.num =1")
            ->order('createTime desc')->select();
        return $data;
    }

    public function getNoteInfoS($noteId){
        $data =db('t_note')
            ->alias('a')
            ->field("a.*,b.REGION_NAME,c.uname,c.uheadImg")
            ->join('t_region b','a.desId = b.REGION_ID')
            ->join('t_user c','a.uid = c.uid')
            ->where("noteId= $noteId")
            ->select();
        db('t_note')->where('noteId',$noteId)->setInc('tapNum');
        return $data;
    }

    /**
     * 获取用户游记
     * @param $userId 用户Id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function allNote($userId){
        $data =db('t_note')
            ->where("uid= $userId")
            ->select();
        return $data;
    }

    public function allNotes($userId,$start,$num){
        $data =db('t_note')
            ->alias('a')
            ->field("a.*,b.REGION_NAME")
            ->join('t_region b','a.desId = b.REGION_ID')
            ->where("a.uid= $userId")
            ->order("createTime desc")
            ->limit($start,$num)
            ->select();
        return $data;
    }

    public function countAllNote($userId){
        $data =db('t_note')
            ->field("count(noteId) allN")
            ->where("uid= $userId")
            ->select();
        return $data[0]["allN"];
    }

    public function toDraft($noteId){
        db('t_note')->where('noteId', $noteId)->update(['noteType' => '0']);
    }

    public function getNoteByRe($desId,$start,$num){
        $data = db("t_note")
            ->alias('a')
            ->field("a.*,c.uname,d.content,c.uheadImg")
            ->join('t_user c','a.uid = c.uid')
            ->join('t_notecon d','a.noteId = d.noteId')
            ->limit($start,$num)
            ->where("a.noteType=1 and d.num =1 and a.desId = $desId")
            ->order('createTime desc')->select();
        return $data;
    }
    public function collectionShow($uid,$noteId)
    {
        $data = [
            'uid'=>$uid,
            'whoId'=>$noteId,
            'type'=>'1'
        ];
        $sql=db('t_collect')->insert($data);
        return $sql;
    }
    public function focusShow($uid,$Uid)
    {
        $data = [
            'uid'=>$uid,
            'whoId'=>$Uid,
            'type'=>'0'
        ];
        $sql=db('t_collect')->insert($data);
        return $sql;
    }
}