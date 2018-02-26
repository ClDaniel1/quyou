<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/25
 * Time: 9:19
 */

namespace app\admin\model;


class Notaudit extends \think\Model
{
    public function notaudit(){
        $sql=db('t_tenants')->select();
        return $sql;
    }
    public function auditadd($id){
        $sql=db('t_tenants')->where('tenantsId',$id)->select();
        return $sql;
    }
    public function auditPass($id){
        $sql=db('t_tenants')->where('tenantsId', $id)->update(['tenantsState' => '已审核']);
        return $sql;
    }
    public function auditPassNot($id){
        $sql=db('t_tenants')->where('tenantsId', $id)->update(['tenantsState' => '审核失败']);
        return $sql;
    }
}