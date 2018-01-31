<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/25
 * Time: 17:24
 */

namespace app\admin\controller;


class Scenic extends \think\Controller
{
    public function scenic()
    {
        return $this->fetch('scenic');
    }
    public function scenicAppend(){
        return $this->fetch('scenicAppend');
    }
    public function ScenicSpot()
    {
        $str=new \app\admin\model\Scenic();
        $run=$str->ScenicSpot();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run[0]['COUNT']]
        ];
        echo json_encode($returnMsg);
    }
    public function ScenicRelease()
    {
        $str=new \app\admin\model\Scenic();
        $run=$str->ScenicRelease();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function scenicShelves()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicShelves($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function scenicOn()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicOn($id);
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
    public function  scenicDelete()
    {
        $id=input('param.id');
        $str=new \app\admin\model\Scenic();
        $run=$str->scenicDelete($id);
        echo json_encode($run);
    }
}