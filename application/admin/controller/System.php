<?php
namespace app\admin\controller;



class System extends \think\Controller{

    public function role()
    {
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

    public function staffEditShow(){
        $am=new \app\admin\model\System();
        $data=$am->roleList();
        $this->assign("roleList",$data);
        return $this->fetch('staffEdit');
    }

}