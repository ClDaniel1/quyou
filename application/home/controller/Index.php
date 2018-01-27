<?php
namespace app\home\controller;

use org\Intro;

class Index extends \think\Controller
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function ex()
    {
        $intro = new Intro();

        $intro->getAll(23, 10208);
    }


}
