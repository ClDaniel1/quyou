<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\wamp64\www\quyou\QY\public/../application/home\view\index\index1.html";i:1516880447;s:71:"D:\wamp64\www\quyou\QY\public/../application/home\view\public\base.html";i:1516879349;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="icon" href="__STATIC__/images/logo.png" type="image/x-icon"/>
    <link rel="stylesheet" href="__STATIC__/lib/amazeui/css/amazeui.min.css">
    <link rel="stylesheet" href="__STATIC__/lib/amazeui/css/app.css">
    <link rel="stylesheet" href="__STATIC__\lib\layui\css\layui.css">
    <link rel="stylesheet" href="__CSS__\home\public\public.css">
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    
    <title></title>
    <style>
        .navBg{
            background: #F9851D ;
        }
    </style>
</head>
<body>



<div class="layui-header header layui-show-xs-block layui-hide-sm navBg" id="liteNav" >
    <ul class="layui-nav navBg" lay-filter="" style="text-align: center">
        <i class="layui-icon"  style="float: left;font-size: 30px; line-height: 60px" id="menu">&#xe671;</i>
        <img src="__STATIC__/images/logo2.png" alt="" style="height: 45px;margin-top: 7px">
        <i class="layui-icon" style="float: right;font-size: 30px; line-height: 60px">&#xe615;</i>
    </ul>
</div>
<div class="site-mobile-shade"></div>
<div class="layui-side navBg header layui-show-xs-block layui-hide-sm" id="sideBar">
    <div class="layui-side-scroll">

        <ul class="layui-nav layui-nav-tree site-demo-nav navBg">
            <li class="layui-nav-item layui-this"><a href="<?php echo url('home/Index/index'); ?>">首页</a></li>
            <li class="layui-nav-item"><a href="<?php echo url('home/Desti/desti'); ?>">目的地</a></li>
            <li class="layui-nav-item"><a href="">旅途直播</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">我</a>
                <dl class="layui-nav-child">
                    <dd><a href="">我的消息</a></dd>
                    <dd><a href="">个人中心</a></dd>
                    <dd><a href="">退出登录</a></dd>
                </dl>
            </li>
            <li style="height: 30px; text-align: center"></li>
        </ul>

    </div>
</div>

<div class="navBg layui-show-sm-block layui-hide-xs" style="width: 100%;height: 60px" >
    <img src="__STATIC__/images/logo1.png" alt="" style="float: left;margin: 7px 35px;height:45px;">
    <ul class="layui-nav navBg" lay-filter="" style="float: left" id="navBar">
        <li class="layui-nav-item layui-this"><a href="<?php echo url('home/Index/index'); ?>">首页</a></li>
        <li class="layui-nav-item"><a href="<?php echo url('home/Desti/desti'); ?>">目的地</a></li>
        <li class="layui-nav-item"><a href="">旅途直播</a></li>
    </ul>
    <ul class="layui-nav navBg" lay-filter="" style="float: right">
        <!--<li class="layui-nav-item">
            <a href=""><img src="http://t.cn/RCzsdCq" class="layui-nav-img">我</a>
            <dl class="layui-nav-child">
                <dd><a href="">我的消息</a></dd>
                <dd><a href="javascript:;">退出登录</a></dd>
            </dl>
        </li>-->
        <li class="layui-nav-item"><a href="<?php echo url('home/login/login'); ?>">登录</a></li>
        <li class="layui-nav-item"><a href="<?php echo url('home/register/register'); ?>"> 注册</a></li>
    </ul>
</div>


<div id="baseMain">
    
</div>







<footer style="height: 300px;background: #3c3c3c">
    <div class="layui-row layui-col-space30">
        <div class="layui-col-sm6" id="leftBar">
           sdfaasd

        </div>
        <div class="layui-col-sm6" id="hotNote">

            dsafs

        </div>
    </div>
</footer>
</body>
<script src="__STATIC__\lib\layui\layui.all.js"></script>
<script src="__STATIC__\lib\jquery-3.2.1.js"></script>
<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.js"></script>
<script>
    $("#menu").click(showSideBar);
    function showSideBar() {
        $("#sideBar").addClass("show");
        $("#menu").unbind("click");
        $("#menu").click(hideSideBar);
        $(".site-mobile-shade").css("display","block");
        $(".site-mobile-shade").unbind("click");
        $(".site-mobile-shade").click(hideSideBar);
    }
    function hideSideBar() {
        $("#sideBar").removeClass("show");
        $("#menu").unbind("click");
        $("#menu").click(showSideBar);
        $(".site-mobile-shade").css("display","none");
    }

    function nav(i){
        i = i-1;
        $("#sideBar li").eq(0).removeClass("layui-this");
        $("#navBar li").eq(0).removeClass("layui-this");
        $("#navBar li").eq(i).addClass("layui-this");
        $("#sideBar li").eq(i).addClass("layui-this");
    }

</script>

</html>