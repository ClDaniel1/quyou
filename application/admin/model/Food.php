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
        $sql=db('t_food')->select();
        return $sql;
    }
}