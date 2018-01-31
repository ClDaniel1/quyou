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
    public function scenicShelves($id)
    {
        $sql=db('t_scenic')->where('scenicId', $id)->update(['scenicType' => '1']);
        return $sql;
    }
    public function scenicOn($id)
    {
        $sql=db('t_scenic')->where('scenicId', $id)->update(['scenicType' => '0']);
        return $sql;
    }
    public function scenicDelete($id)
    {
        $sql=db('t_scenic')->where('scenicId',$id)->delete();
        return $sql;
    }
}