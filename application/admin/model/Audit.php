<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/24
 * Time: 21:03
 */

namespace app\admin\model;


class Audit extends \think\Model
{
    public function audit(){
        $sql=db('t_tenants')->where("tenantsState<>'待审核'")->select();
        return $sql;
    }
    public function auditview($id){
        $sql=db('t_tenants')->where('tenantsId',$id)->select();
        return $sql;
    }
    public function auditDelet($id){
        $sql=db('t_tenants')->where('tenantsId',$id)->delete();
        return $sql;
    }
}