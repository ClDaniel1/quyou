<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 14:33
 */

namespace app\admin\model;


class Food extends \think\Model
{
    public function foodSpot()
    {
        $sql=db('t_food')->field('count(foodId) COUNT')->select();
        return $sql;

    }
    public function foodRelease()
    {
        $sql=db('t_food')->alias('a')
            ->join('t_region b','a.desId = b.REGION_ID')->field('a.*,b.REGION_NAME')->select();
        return $sql;
    }
    public function foodShelves($id)
    {
        $sql=db('t_food')->where('foodId', $id)->update(['foodType' => '1']);
        return $sql;
    }
    public function foodOn($id)
    {
        $sql=db('t_food')->where('foodId', $id)->update(['foodType' => '0']);
        return $sql;
    }
    public function foodDelete($id)
    {
        $sql=db('t_food')->where('foodId',$id)->delete();
        return $sql;
    }
}