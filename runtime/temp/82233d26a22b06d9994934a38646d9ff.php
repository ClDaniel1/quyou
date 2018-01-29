<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"E:\phpstudy\WWW\quyou\public/../application/home\view\region\hotel.html";i:1517189173;s:75:"E:\phpstudy\WWW\quyou\public/../application/home\view\public\regionNav.html";i:1517043587;s:70:"E:\phpstudy\WWW\quyou\public/../application/home\view\public\base.html";i:1517152143;}*/ ?>
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
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    
<style>
    #desNav{
        display: block;
    }
</style>
<link rel="stylesheet" href="__CSS__/home/region/hotel.css">

    <title>
趣游
</title>
    <style>
        .navBg{
            background: #F9851D ;
        }
        .body {
            background-color: #efefef;
        }
        footer{
            margin-top:25px;
        }
    </style>
</head>
<body class="body">




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
            <li class="layui-nav-item nologin"><a href="<?php echo url('home/login/login'); ?>">登录</a></li>
            <li class="layui-nav-item nologin"><a href="<?php echo url('home/register/register'); ?>"> 注册</a></li>
            <li class="layui-nav-item loginIn">
                <a href="javascript:;">我</a>
                <dl class="layui-nav-child">
                    <dd><a href="">我的消息</a></dd>
                    <dd><a href="" class="toCenter">个人中心</a></dd>
                    <dd  onclick="loginOut()"><a href="javascript:;">退出登录</a></dd>
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
    <ul class="layui-nav navBg" id="userLoginZone" lay-filter="" style="float: right">
        <li class="layui-nav-item loginIn">
            <a href="" class="toCenter"><img src="http://t.cn/RCzsdCq" class="layui-nav-img uImg">我</a>
            <dl class="layui-nav-child">
                <dd><a href="">我的消息</a></dd>
                <dd onclick="loginOut()"><a href="javascript:;">退出登录</a></dd>
            </dl>
        </li>
       <li class="layui-nav-item nologin"><a href="<?php echo url('home/login/login'); ?>">登录</a></li>
        <li class="layui-nav-item nologin"><a href="<?php echo url('home/register/register'); ?>"> 注册</a></li>
    </ul>
</div>

<div id="baseMain">
    <div id="desNav">
        <div class="layui-container" >
            <div class="layui-row siteNav">
                 <span class="layui-breadcrumb" lay-separator=">">
                    <a href="">目的地</a>
                    
    <a href="">厦门<i class="layui-icon orangeIcon">&#xe625;</i></a>
    <a><cite style="color: #ff7000;font-weight: bold;">重庆酒店预订</cite></a>

                </span>
            </div>
            <div class="layui-row layui-hide-xs">
                <ul class="layui-nav catalog">
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst1"></i>首页</a></li>
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst2"></i>玩法路线</a></li>
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst3"></i>景点</a></li>
                    <li class="layui-nav-item"><a href="<?php echo url('home/Region/hotel'); ?>?rgId=1000"><i class="icon1 iconPst4"></i>酒店</a></li>
                    <li class="layui-nav-item">
                        <a href=""><i class="icon1 iconPst5"></i>美食</a>
                        <dl class="layui-nav-child"> <!-- 二级菜单 -->
                            <dd><a href="">移动模块</a></dd>
                            <dd><a href="">后台模版</a></dd>
                            <dd><a href="">电商平台</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item"><a href="0"><i class="icon1 iconPst6"></i>游记</a></li>
                </ul>
            </div>
            <div class="layui-hide-sm">
                <ul class="layui-nav catalog">
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst1"></i>概况</a></li>
                    <li class="layui-nav-item allMsg">
                        <a href=""><i class="icon1 iconPst7"></i>展开全部</a>
                        <ul class="catalog treeNav">
                            <li class="">
                                <a href="">
                                    <i class="icon1 iconPst2"></i>玩法路线
                                </a>
                            </li>
                            <li class="">
                                <a href="">
                                    <i class="icon1 iconPst3"></i>景点
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo url('home/Region/hotel'); ?>?rgId=1000">
                                    <i class="icon1 iconPst4"></i>酒店
                                </a>
                            </li>
                            <li class="">
                                <a href=""><i class="icon1 iconPst5"></i>美食</a>
                            </li>
                            <li class="">
                                <a href=""><i class="icon1 iconPst6"></i>游记</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="layui-container">
        <div class="layui-row priContent">
            <div class="layui-col-sm5 ">
                    <span class="priceF">价格:</span>
                    <input type="text" name="title"  placeholder="请输入价格" class="layui-input">
                    <span>-</span>
                    <input type="text" name="title"   placeholder="请输入价格" class="layui-input">
                    <i class="layui-icon souIcon">&#xe615;</i>
            </div>
            <div class="layui-col-sm5  layui-col-sm-offset2">
                <div class="layui-form textR">
                    <input type="checkbox" name="" title="收藏">
                    <input type="text" name="title"   placeholder="请输酒店名" class="layui-input">
                    <i class="layui-icon souIcon">&#xe615;</i>
                    <span class="mgLeft">价格</span><i class="icon5"></i>
                </div>
                <div>
            </div>
        </div>
        </div>
        <div class="layui-row hotelBd">
            <div class="layui-col-sm4 layui-col-xs6">
                <img src="http://p1-q.mafengwo.net/s8/M00/C8/AD/wKgBpVWR1OWATgwpAAC6kG1-XPU02.jpeg?imageMogr2%2Fthumbnail%2F%21660x480r%2Fgravity%2FCenter%2Fcrop%2F%21660x480%2Fquality%2F90" alt="加载失败">
            </div>
            <div class="layui-col-sm8 layui-col-xs6">
                <div class="hotelR">
                    <div class="hTile">
                        <span>杭州尚途酒店公寓 </span>
                        <a class="addA">
                            <i class="layui-icon">&#xe658;</i>
                            <i>收藏</i>
                        </a>
                    </div>
                    <div class="reply">
                        <a href="">
                            <span><span>2</span>条</span><br>
                            <span>峰峰评价</span>
                        </a>
                        <p>房间很大，很干净，旁边就是超市和丁兰广场，很方便，下次还住！</p>
                    </div>
                    <div class="payBt">
                        <a href="">
                            立即预订
                            <span>￥<span>2000</span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>







<footer style="background: #3c3c3c">
    <div class="layui-container">
        <div class="layui-row layui-col-space30">
            <div class="layui-col-sm10"  id="footL">
                <div class="footer">
                  <ul class="footerUl">
                      <li class="footerHd">关于我们</li>
                      <li><a href="">关于趣游</a></li>
                      <li><a href="">联系我们</a></li>
                      <li><a href="">关于趣游</a></li>
                  </ul>
                </div>
                <div class="footer">
                    <ul class="footerUl">
                        <li class="footerHd">友情链接</li>
                        <li><a href="">乐淘</a></li>
                        <li><a href="">蚂蜂窝</a></li>
                        <li><a href="">穷游网</a></li>
                    </ul>
                </div>
                <div class="footer">
                    <ul class="footerUl">
                        <li class="footerHd">网站条款</li>
                        <li><a href="">会员条款</a></li>
                        <li><a href="">版权声明</a></li>
                        <li><a href="">免责声明</a></li>
                    </ul>
                </div>
                <div class="footer">
                    <ul class="footerUl">
                        <li class="footerHd">帮助中心</li>
                        <li><a href="">新手上路</a></li>
                        <li><a href="">使用帮助</a></li>
                        <li><a href="">网站地图</a></li>
                    </ul>
                </div>
            </div>
            <div class="layui-col-sm2" id="footerR">
                <img src="__STATIC__/images/logof1.png" alt="">
                <p>2017 © 趣游</p>
                <p>All rights reserved</p>
            </div>
        </div>
    </div>
</footer>
</body>
<script src="__STATIC__\lib\layui\layui.all.js"></script>
<script src="__STATIC__\lib\jquery-3.2.1.js"></script>
<script src="__STATIC__/lib/amazeui/js/amazeui.js"></script>
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

    var checkUrl = "<?php echo url('home/Login/check'); ?>";

</script>
<script src="__JS__/home/public/public.js"></script>


</html>