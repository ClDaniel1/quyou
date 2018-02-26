<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/24
 * Time: 20:09
 */

namespace app\admin\controller;


class Audit extends \think\Controller
{
    public function audit(){
        $am=new \app\admin\model\Audit();
        $data=$am->audit();
        $this->assign("audit",$data);
        return $this->fetch('audit');
    }
    public function auditview()
    {
        $id=input('param.id');
        $audit=new \app\admin\model\Audit();
        $data=$audit->auditview($id);
        $this->assign('auditview',$data);
        return $this->fetch('auditview');
    }
    public function auditDelet(){
        $id=input('param.id');
        $audit=new \app\admin\model\Audit();
        $data=$audit->auditDelet($id);
    }
}