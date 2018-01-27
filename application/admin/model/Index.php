<?php

/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/1/25
 * Time: 11:45
 */
namespace app\admin\model;
class Index extends \think\Model
{
    public function getMenu()
    {
        $sql=db('t_menu')->select();
        return $sql;

    }
}