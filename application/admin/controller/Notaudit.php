<?php
/**
 * Created by PhpStorm.
 * User: yydashen
 * Date: 2018/2/25
 * Time: 9:17
 */

namespace app\admin\controller;


class Notaudit extends \think\Controller
{
    public function notaudit(){
        $am=new \app\admin\model\Notaudit();
        $data=$am->notaudit();
        $this->assign("notaudit",$data);
        return $this->fetch('notaudit');
    }
    public function auditadd()
    {
        $id=input('param.id');
        $audit=new \app\admin\model\Notaudit();
        $data=$audit->auditadd($id);
        $this->assign('auditadd',$data);
        return $this->fetch('auditadd');
    }
    public function auditPass()
    {
        $id=input('param.id');
        $audit=new \app\admin\model\Notaudit();
        $data=$audit->auditPass($id);
        $auditPass=config("msg")["audit"]["auditPass"];
        array_push($auditPass["data"],$data);
        echo json_encode($auditPass);
    }
    public function auditPassNot()
    {
        $id=input('param.id');
        $audit=new \app\admin\model\Notaudit();
        $data=$audit->auditPassNot($id);
        $auditPassNot=config("msg")["audit"]["auditPassNot"];
        array_push($auditPassNot["data"],$data);
        echo json_encode($auditPassNot);
    }
}