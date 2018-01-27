<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 11:09
 */

namespace app\admin\controller;


class Food extends \think\Controller
{
    public function food()
    {
        return $this->fetch('food');
    }

    public function foodAppend(){
        return $this->fetch('foodAppend');
    }
    public function foodSpot()
    {
        $str=new \app\admin\model\Food();
        $run=$str->foodSpot();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run[0]['COUNT']]
        ];
        echo json_encode($returnMsg);
    }
    public function foodRelease()
    {
        $str=new \app\admin\model\Food();
        $run=$str->foodRelease();
        $returnMsg=[
            'code'  =>  "ok",
            'msg'   =>  "",
            'data'  =>  [$run]
        ];
        echo json_encode($returnMsg);
    }
}