<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/26
 * Time: 14:21
 */

namespace app\admin\model;


class Hotel extends \think\Model
{
    public function hotelSpot()
    {
        $sql=db('t_hotel')->field('count(hotelId) COUNT')->select();
        return $sql;

    }
    public function hotelRelease()
    {
        $sql=db('t_hotel')->alias('a')
            ->join('t_region b','a.desId = b.REGION_ID')->field('a.*,b.REGION_NAME')->select();
        return $sql;
    }
    public function foodShelves($id)
    {
        $sql=db('t_hotel')->where('hotelId', $id)->update(['hotelType' => '1']);
        return $sql;
    }
    public function foodOn($id)
    {
        $sql=db('t_hotel')->where('hotelId', $id)->update(['hotelType' => '0']);
        return $sql;
    }
}