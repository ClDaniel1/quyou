<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 11:03
 */

namespace app\admin\controller;


class Hotel extends \think\Controller
{
    public function hotel()
    {
        return $this->fetch('hotel');
    }

    public function hotelAppend(){
        return $this->fetch('hotelAppend');
    }
    public function hotelSpot()
    {
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelSpot();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run[0]['COUNT']]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelRelease()
    {
        $str=new \app\admin\model\Hotel();
        $run=$str->hotelRelease();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelShelves()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Hotel();
        $run=$str->foodShelves($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function hotelOn()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Hotel();
        $run=$str->foodOn($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
}