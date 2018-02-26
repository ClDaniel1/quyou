<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/24
 * Time: 16:01
 */

namespace app\home\model;


class Checkin extends \think\Model
{
    public function tenantsAdd($tenantsName,$tenantsNick,$tenantsPhone,$tenantsAdd,$tenantsType,$tenantsAccount, $tenantsPsw,$license){
            $data = [
                'tenantsName' => $tenantsName,
                'tenantsPhone' => $tenantsPhone,
                'tenantsAdd'=>$tenantsAdd,
                'tenantsNick'=>$tenantsNick,
                'tenantsType'=>$tenantsType,
                'tenantsAccount'=>$tenantsAccount,
                'tenantsPsw'=>$tenantsPsw,
                'roleId'=>'4',
                'license'=>$license,
                'regisData'=>date('Y-m-d H:i:s',time()),
                'tenantsState'=>'待审核'
            ];
            $sql=db('t_tenants')->insertGetId($data);
            return $sql;
        }//商家注册
    public function coverImg($tenantsId,$sqlNewImg)
    {
        $sql=db('t_tenants')->where('tenantsId', $tenantsId)->update(['license' =>$sqlNewImg]);
        return $sql;
    }//营业执照储存
    public function tenantsHeavy($tenantsAccount)
    {
        $sql=db('t_tenants')->where('tenantsAccount',$tenantsAccount)->field('count(tenantsId) COUNT')->select();
        return $sql;
    }
}