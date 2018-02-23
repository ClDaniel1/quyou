<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2017/12/1
 * Time: 11:27
 */
namespace org;


class Page
{
    private $all;
    private $oneNum;
    private $allPage;
    private $nowPage;
    private $lastPage;
    private $nextPage;

    public function __construct($all,$num,$nowPage)
    {
        $this->all = $all;
        $this->oneNum=$num;
        $this->allPage = ceil($this->all/$this->oneNum);
        $this->nowPage=$nowPage;
        $this->lastPage = $this->nowPage-1;
        $this->nextPage = $this->nowPage+1;

        if($this->lastPage==0){
            $this->lastPage=1;
        }
        if($this->nextPage>$this->allPage){
            $this->nextPage = $this->allPage;
        }
    }

    public function getStart(){
        return $this->oneNum*($this->nowPage-1);
    }

    public function getNum(){
        return $this->oneNum;
    }


    public function getAllPage()
    {
        return $this->allPage;
    }

    public function showBtn(){
        echo "<input type='button' value='首页'/>";
        echo "<input type='button' value='上一页'/>";
        for($i=0;$i<$this->allPage;$i++){
            echo "<input type='button' value=".($i+1)." />";
        }
        echo "<input type='button' value='下一页' idx='{$this->allPage}'/>";
        echo "<input type='button' value='尾页' idx='{$this->allPage}' />";
    }

    public function exp(){
        $arr = [
          'last'=>$this->lastPage,
            'next'=>$this->nextPage,
            'now'=>$this->nowPage,
            'total'=>$this->allPage
        ];
        return $arr;
    }
}