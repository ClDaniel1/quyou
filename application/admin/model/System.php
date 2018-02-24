<?php
namespace app\admin\model;

class System extends \think\Model{

    public function staffList()
    {
        $sql=db('t_staff')->alias('a')->join('t_role b','a.roleId=b.roleId')->field('a.*,b.roleName')->select();
        return $sql;
    }

    public function staffStop($staffId,$data){
        $sql=db('t_staff')->where('staId',$staffId)->update($data);
        return $sql;
    }

    public function staffDel($staffId){
        $sql=db('t_staff')->where('staId',$staffId)->delete();
        return $sql;
    }

    public function roleList(){
        return db('t_role')->select();
    }
}
