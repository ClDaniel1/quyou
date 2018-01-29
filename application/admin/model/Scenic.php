<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/25
 * Time: 18:02
 */

namespace app\admin\model;


class Scenic extends \think\Model
{
    public function ScenicSpot()
    {
        $sql=db('t_scenic')->field('count(scenicId) COUNT')->select();
        return $sql;

    }
    public function ScenicRelease()
    {
        $sql=db('t_scenic')->alias('a')
            ->join('t_region b','a.desId = b.REGION_ID')->field('a.*,b.REGION_NAME')->select();
        return $sql;
    }
}