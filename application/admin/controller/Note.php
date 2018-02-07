<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/2/4
 * Time: 15:55
 */

namespace app\admin\controller;


class Note extends \think\Controller
{
    public function note(){
        return $this->fetch("note");
    }

    public function noNoteList(){
        $nm = new \app\admin\model\Note();
        $data = $nm->getNoNote();

        $resMsg=config("msg")["note"]["getNoNoteListSuccess"];
        $resMsg["data"]= [$data];
        return json($resMsg);
    }

    public function NoteList(){
        $nm = new \app\admin\model\Note();
        $data = $nm->getNote();

        $resMsg=config("msg")["note"]["getNoteListSuccess"];
        $resMsg["data"]= [$data];
        return json($resMsg);
    }

    public function check(){
        $id = input("param.id");
        $nm=new \app\admin\model\Note();
        $info = $nm->getNoteInfo($id)[0];
        $con = $nm->getNoteCont($id);

        $this->assign("info", $info);
        $this->assign("con", $con);
        $this->assign("noteId", $id);
        return $this->fetch("check");
    }
}