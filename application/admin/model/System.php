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

    public function doLogin($userName,$password){
        $data = db('t_staff')->where('staName',$userName)->where('staPwd',$password)->select();
        return $data;
    }

    public function setKey($key,$userId){
        $sql=db('t_staff')->where('staId',$userId)->update(["key"=>$key]);
        return $sql;
    }

    public function checkLogin($data){
        return db('t_staff') -> where($data) ->find();
    }
}
