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

    public function noteList(){
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

    public function escCheck(){
        $id = input("param.id");
        $nm = new \app\admin\model\Note();
        $nm->escCheck($id);

        $resMsg = config("msg")["note"]["escCheckSuccess"];
        return json($resMsg);
    }

    public function pass(){
        $id = input("param.id");
        $nm = new \app\admin\model\Note();
        $nm->pass($id);

        $resMsg = config("msg")["note"]["passSuccess"];
        return json($resMsg);
    }

    public function unPass(){
        $id = input("param.id");
        $unPass = input("param.unPass");

        $nm = new \app\admin\model\Note();
        $res = $nm->unPass($id,$unPass);

        if($res)
            $resMsg = config("msg")["note"]["unPassSuccess"];
        else
            $resMsg = config("msg")["note"]["unPassErr"];
        return json($resMsg);
    }
}