<?php
namespace app\admin\controller;



class System extends \think\Controller{

    public function role()
    {
        $am=new \app\admin\model\System();
        $data=$am->roleList();
        $this->assign("role",$data);
        return $this->fetch('role');
    }
    public function staff()
    {
        $am=new \app\admin\model\System();
        $data=$am->staffList();
        $this->assign("staff",$data);
        return $this->fetch('staff');
    }

    public function staffStop(){
        $staffId=input('?post.staffId')? input('staffId'):'';
        $staStatus=input('?post.staStatus')? input('staStatus'):'';
        $model=new \app\admin\model\System();
        $data=[];
        if($staStatus=="使用"){
            $data=[
                'staStatus'=>"锁定"
            ];
        }elseif($staStatus=="锁定"){
            $data=[
                'staStatus'=>"使用"
            ];
        }
        $res=$model->staffStop($staffId,$data);
        if($res){
            $returnMsg=config('msg')['manager']['changeOK'];
            return json($returnMsg);
        }else{
            $returnMsg=config('msg')['manager']['changeErr'];
            return json($returnMsg);
        }
    }


    public function staffDel(){
        $staffId=input('?post.staffId')? input('staffId'):'';
        $model=new \app\admin\model\System();
        $res=$model->staffDel($staffId);
        if($res){
            $returnMsg=config('msg')['manager']['delOK'];
            return json($returnMsg);

        }else{
            $returnMsg=config('msg')['manager']['delErr'];
            return json($returnMsg);
        }
    }


    public function roleEditShow(){
        $roleId=input('?get.id')?input('get.id'):'';
        $this->assign("roleId",$roleId);
        return $this->fetch('roleEdit');
    }


    public function roleAddShow(){
        $roleId=input('?get.id')?input('get.id'):'';
        $this->assign("roleId",$roleId);
        return $this->fetch('roleAdd');
    }

    public function staffEditShow(){
        $am=new \app\admin\model\System();
        $data=$am->roleList();
        $staId=input('?get.id')?input('get.id'):'';
        $this->assign("staId",$staId);
        $this->assign("roleList",$data);
        $where=[
            'staId' => $staId
        ];
        $staInfo=$am->staInfo($where);
        return $this->fetch('staffEdit');
    }

    public function getStaInfo(){
        $staId=input('?post.staId')? input('staId'):'';
        $am=new \app\admin\model\System();
        $where=[
            'staId' => $staId
        ];
        $staInfo=$am->staInfo($where);
        return json($staInfo);
    }

    //员工编辑
    public function staffEdit(){
        $adminName=input('?post.adminName')? input('adminName'):'';
        $password=input('?post.password')? input('password'):'';
        $phone=input('?post.phone')? input('phone'):'';
        $roleId=input('?post.roleId')? input('roleId'):'';
        $staId=input('?post.staId')? input('staId'):'';
        $model=new \app\admin\model\System();
        $data = ['staName' => $adminName, 'staPwd' => $password,
            'staPhone' =>$phone,'roleId'=>$roleId
        ];
        $res=$model->changeStaff($staId,$data);

        if($res){
            $returnMsg=config('msg')['staff']['changeOK'];
            return json($returnMsg);
        }else{
            $returnMsg=config('msg')['staff']['changeErr'];
            return json($returnMsg);
        }
    }
}