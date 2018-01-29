<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\AppServ\www\quyou\public/../application/home\view\region\region.html";i:1517043262;s:69:"D:\AppServ\www\quyou\public/../application/home\view\public\base.html";i:1517043262;}*/ ?>
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
    
<!--页面样式、引用/示例如下-->
<!--引用百度地图需加的meta-->
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="__CSS__/home/region/region.css">

    <title>
这个是某地区总体概览
</title>
    <style>
        .navBg{
            background: #F9851D ;
        }
<<<<<<< HEAD
        .body{
            background-color: #efefef;
=======
        footer{
            margin-top:25px;
>>>>>>> e79f6f254ff1825636c527baa2f2ad3069c1603d
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
        <li class="layui-nav-item">
            <a href=""><img src="http://t.cn/RCzsdCq" class="layui-nav-img">我</a>
            <dl class="layui-nav-child">
                <dd><a href="">我的消息</a></dd>
                <dd><a href="javascript:;">退出登录</a></dd>
            </dl>
        </li>
       <!-- <li class="layui-nav-item"><a href="<?php echo url('home/login/login'); ?>">登录</a></li>
        <li class="layui-nav-item"><a href="<?php echo url('home/register/register'); ?>"> 注册</a></li>-->
    </ul>
</div>

<div id="baseMain">
    <div id="desNav">
        <div class="layui-container" >
            <div class="layui-row siteNav">
                 <span class="layui-breadcrumb" lay-separator=">">
                    <a href="">目的地</a>
                    
                    
                </span>
            </div>
            <div class="layui-row layui-hide-xs">
                <ul class="layui-nav catalog">
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst1"></i>概况</a></li>
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
    
<!--页面内容 /示例如下-->
<!--面包屑区域-->
<div id="content2">
    <div class="layui-container navTop">
        <div class="layui-row">
            <div class="layui-col-sm6 siteNav">
                <div>
                    <span class="layui-breadcrumb" lay-separator=">">
                        <a href="">目的地</a>
                        <a href="">美国<i class="layui-icon orangeIcon">&#xe625;</i></a>
                        <a href="">旧金山<i class="layui-icon orangeIcon">&#xe625;</i></a>
                        <a ><cite style="color: #ff7000;font-weight: bold;">旧金山旅游攻略</cite></a>
                    </span>
                </div>
                <div class="siteMsg">
                    <div class="siteName">
                        <h1 class="disB">喜马拉雅山脉</h1>
                        <a href="">(<span>42344</span>张照片)</a>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm3 layui-col-sm-offset3">
               <ul class="imgA">
                   <li>
                       <a href=""><i class="icon imgPst1"></i>收藏</a>
                   </li>
                   <li>
                       <a href=""><i class="icon imgPst2"></i>去过</a>
                   </li>
               </ul>
            </div>
        </div>
        <div class="layui-row layui-hide-xs">
            <ul class="layui-nav catalog">
                <li class="layui-nav-item"><a href=""><i class="icon1 iconPst1"></i>概况</a></li>
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
<!--景点路线区域-->
<div id="content3">
    <div class="layui-container">
        <h1 class="lineFont"><span>厦门</span><span>3</span>条景点路线</h1>
        <div class="layui-row">
            <div class="layui-col-sm6">
                <div class="mapBorder1 scenicMsg">
                    <h1>
                        <span class="layui-badge layui-bg-orange mapNo">1</span>
                        <span>厦门鼓浪屿5日游</span>
                    </h1>
                    <div class="map">

                    <div id="map">

                    </div></div>
                    <div class="selectLine">
                        <span class="percent">45%</span>
                        <h3>初次访问<span>旧金山</span>的蜂蜂会选择这条路线</h3>
                    </div>
                    <div class="pathShow">
                        <div>
                            <span class="pathSpan">D<span>1</span></span>
                            <span class="layui-breadcrumb" lay-separator="->">
                              <a href=""><cite>西湖</cite></a>
                              <a href=""><cite>大学城</cite></a>
                              <a href=""><cite>光亚广场</cite></a>
                              <a><cite>花海公园</cite></a>
                            </span>
                        </div>
                        <div>
                            <span class="pathSpan">D<span>1</span></span>
                            <span class="layui-breadcrumb" lay-separator="->">
                              <a href=""><cite>西湖</cite></a>
                              <a href=""><cite>大学城</cite></a>
                              <a href=""><cite>光亚广场</cite></a>
                              <a><cite>花海公园</cite></a>
                            </span>
                        </div>
                        <a href="" class="lookA">查看></a>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm6 ">
                <div class="mapBorder2 scenicMsg">
                    <h1>
                        <span class="layui-badge layui-bg-orange mapNo">1</span>
                        <span>厦门鼓浪屿5日游</span>
                    </h1>
                    <div class="map1">

                    </div>
                </div>
            </div>
        </div>
        <div class="lookAll">
            <a href="">
                <span class="book">
                    <i class="i-blue"></i>
                    <i class="i-orange"></i>
                </span>
                查看全部<span class="numOrange"><span>3</span>条</span>路线>
            </a>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<!--景点美食酒店攻略区域-->
<div id="content4">
    <div class="layui-container c4Top">
        <div class="layui-row strategy">
            <div class="layui-col-sm4">
                <div class="hotelW">
                    <h2 class="hotelMsg"><a href="">酒店住宿攻略<i class="innerIcon"></i></a></h2>
                    <div class="innerDiv">
                        <h3>
                            <span class="layui-badge layui-bg-orange">1</span>
                            <span>中山路-步行街</span>
                        </h3>
                        <div class="pst">
                            <img class="hotelMap" src="__STATIC__/images/region/hotel/hotel1.gif" alt="">
                            <div class="introduceMsg">
                                <span>四季如季如春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾酒店+赠往返船票+VI北京往返厦门4-5天自由行（鼓浪屿四季如春度假酒店+市区君帝湾酒店+赠往返船票+VIP专车接送机）</span>
                            </div>
                        </div>
                        <div class="comTop">
                            <img class="headImg" src="__STATIC__/images/region/head/head1.jpeg" alt="加载失败">
                            <span class="comName">梨窝浅浅</span>
                            <span class="comMsg">“呆过四年，每个来厦门旅游的必选，四年，每个来厦门旅游的必选，四年，每个来厦门旅游的必选，四年，每个来厦门旅游的必选，四年，每个来厦门旅游的必选，钢琴之岛，音乐之岛。万国建筑。日光岩。琴之岛，音乐之岛。万国建筑。日光岩。怀怀念以前念书的日...”</span>
                        </div>
                    </div>
                    <div class="innerDiv">
                        <h3>
                            <span class="layui-badge layui-bg-orange">1</span>
                            <span>中山路-步行街</span>
                        </h3>
                        <div class="pst">
                            <img class="hotelMap" src="__STATIC__/images/region/hotel/hotel1.gif" alt="">
                            <div class="introduceMsg">
                                <span>四季如季如春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾酒店+赠往返船票+VI北京往返厦门4-5天自由行（鼓浪屿四季如春度假酒店+市区君帝湾酒店+赠往返船票+VIP专车接送机）</span>
                            </div>
                        </div>
                        <div class="comTop">
                            <img class="headImg" src="__STATIC__/images/region/head/head1.jpeg" alt="加载失败">
                            <span class="comName">梨窝浅浅</span>
                            <span class="comMsg">“四年，每个来厦门旅游的必选，四年，每个来厦门旅游的必选，四年，每个来厦门旅游的必选，呆过四年，每个来厦门旅游的必选，钢琴之岛，音乐之岛。万国建筑。日光岩。琴之岛，音乐之岛。万国建筑。日光岩。怀怀念以前念书的日...”</span>
                        </div>
                    </div>
                    <div class="dashed">
                        <a href=""><span>600</span>家酒店<i class="orgIcon"></i></a>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm4">
                <div class="hotelW middleDiv">
                    <h2 class="hotelMsg"><a href="">必游景点排行<i class="innerIcon"></i></a></h2>
                    <div class="innerDiv">
                        <h3>
                            <span class="layui-badge layui-bg-orange">1</span>
                            <span>中山路-步行街</span>
                        </h3>
                        <div class="pst">
                            <img class="hotelMap" src="__STATIC__/images/region/hotel/hotel1.gif" alt="">
                            <div class="introduceMsg">
                                <span>四季如季如春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾酒店+赠往返船票+VI北京往返厦门4-5天自由行（鼓浪屿四季如春度假酒店+市区君帝湾酒店+赠往返船票+VIP专车接送机）</span>
                            </div>
                        </div>
                        <div class="comTop">
                            <img class="headImg" src="__STATIC__/images/region/head/head1.jpeg" alt="加载失败">
                            <span class="comName">梨窝浅浅</span>
                            <span class="comMsg">“呆过四年，每个来厦门旅游的必选，钢琴之岛，音乐之岛。万国建筑。日光岩。琴之岛，音乐之岛。万国建筑。日光岩。怀怀念以前念书的日...”</span>
                        </div>
                    </div>
                    <div class="dashed">
                        <a href=""><span>600</span>家酒店<i class="orgIcon"></i></a>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm4">
                <div class="hotelW rightDiv">
                    <h2 class="hotelMsg"><a href="">必吃美食排行<i class="innerIcon"></i></a></h2>
                    <div class="innerDiv">
                        <h3>
                            <span class="layui-badge layui-bg-orange">1</span>
                            <span>中山路-步行街</span>
                        </h3>
                        <div class="pst">
                            <img class="hotelMap" src="__STATIC__/images/region/hotel/hotel1.gif" alt="">
                            <div class="introduceMsg">
                                <span>四季如季如春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾春度假酒店+市区君帝湾酒店+赠往返船票+VI北京往返厦市区君帝湾酒店+赠往返船票+VI北京往返厦门4-5天自由行（鼓浪屿四季如春度假酒店+市区君帝湾酒店+赠往返船票+VIP专车接送机）</span>
                            </div>
                        </div>
                        <div class="comTop">
                            <img class="headImg" src="__STATIC__/images/region/head/head1.jpeg" alt="加载失败">
                            <span class="comName">梨窝浅浅</span>
                            <span class="comMsg">“呆过四年，每个来厦门旅游的必选，钢琴之岛，音乐之岛。万国建筑。日光岩。琴之岛，音乐之岛。万国建筑。日光岩。怀怀念以前念书的日...”</span>
                        </div>
                    </div>
                    <div class="dashed">
                        <a href=""><span>600</span>家酒店<i class="orgIcon"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--景点游记-->
<div id="content5">
    <div class="layui-container">
        <h6 class="siteColor"><span>香格里拉</span>游记</h6>
        <div class="layui-row">
            <div>
                <img class="scenicImg" src="__STATIC__/images/region/scenic/scenic1.jpeg" alt="加载失败">
                <div class="mgLeft">
                    <dl class="msgDl">
                        <dt>
                            <a href="">滇北第二站：独克宗的意思是月光城</a>
                        </dt>
                        <dd>
                            <a href="">带着第一站梅里朝圣的圆满一站梅里朝圣的圆满，悟空又坐上班车小巴从飞来寺观一站梅里朝圣的圆满，悟空又坐上班车小巴从飞来寺观一站梅里朝圣的圆满，悟空又坐上班车小巴从飞来寺观，悟空又坐上班车小巴从飞来寺观景台返回 香格里拉 。回程的路上，依然要 盘山 翻越两座大雪山，旅途依然艰苦而遥远，悟空却倍感轻松，对梅里的期盼已被满足，对高反的紧张不知所踪，五个小时一晃而过，便到了 香格里拉 。 悟空发现，很多想到这里旅行...</a>
                        </dd>
                    </dl>
                    <div class="headDiv">
                        <img class="upHead" src="__STATIC__/images/region/head/head2.jpeg" alt="加载失败">
                        <span>小巴黎xiaoYu</span>
                        <a href=""><i class="iconUp"></i><span class="upNum">255</span></a>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
            <div class="lookAll">
                <a href="">
                <span class="book">
                    <i class="i-blue"></i>
                    <i class="i-orange"></i>
                </span>
                    查看全部<span class="numOrange">香格里拉</span>游记>
                </a>
            </div>
        </div>
    </div>
</div>

</div>





<<<<<<< HEAD


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
=======
>>>>>>> af1153db015604462702e242cb521fd40c46e4e9
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

</script>

<!--JS、引用 /示例如下-->
<!--引用百度地图api文件-->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=TRYU1lcQ2YkgXRzerqXODMOKkAGrETrL"></script>
<script>
    nav(2);
    layui.use('element', function(){
        var element = layui.element;
    });

//   到时候需要封装起来
    var map = new BMap.Map("map");//创建地图实例
    map.enableScrollWheelZoom(true);//地图的鼠标滚轮缩放默认是关闭的，需要配置开启。
    var opts = {type: BMAP_NAVIGATION_CONTROL_LARGE};//平移控件外观
    map.addControl(new BMap.NavigationControl(opts));//添加平移缩放控件
//    var point = new BMap.Point(116.402, 39.915);//设置坐标定义区域
//    var point1 = new BMap.Point(116.405, 39.920);//设置坐标定义区域
//    var marker = new BMap.Marker(point);        // 创建标注
//    var marker1 = new BMap.Marker(point1);        // 创建标注
    var myGeo = new BMap.Geocoder();
    var arr=['福建省'];
    var marArr=[];
    var index=0;
//    bdGEO();
//    for(var i=0;i<arr.length;i++)
//    {
//        myGeo.getPoint(arr[i], function (point) {
//            if (point) {
//                var address = new BMap.Point(point.lng, point.lat);
//                var marker = new BMap.Marker(address);
//                map.addOverlay(marker);
//                marArr.push(address);
//                console.log(marArr);
//            }
//        });
//    }

//    function bdGEO(){
//        var add = arr[index];
//        geocodeSearch(add);
//        index++;
//    }
//    function geocodeSearch(add){
//        if(index < arr.length){
//            setTimeout(window.bdGEO,400);
//        }
//        else {
//            var polyline = new BMap.Polyline(marArr,
//                    {strokeColor:"orange", strokeWeight:4, strokeOpacity:1}//设置属性
//            );
//            map.addOverlay(polyline);//跟polyline一块使用，添加上线
//        }
//        myGeo.getPoint(add, function(point){
//            if (point) {
//                var address = new BMap.Point(point.lng, point.lat);
//                var marker = new BMap.Marker(address);
//                map.addOverlay(marker);
//
//                marArr.push(address);
////                document.getElementById("result").innerHTML +=  index + "、" + add + ":" + point.lng + "," + point.lat + "</br>";
////                var address = new BMap.Point(point.lng, point.lat);
////                addMarker(address,new BMap.Label(index+":"+add,{offset:new BMap.Size(20,-10)}));
//            }
//        }, "福建省");
//    }
    myGeo.getPoint('福建省', function (point) {
        if (point) {
            var address = new BMap.Point(point.lng, point.lat);
            var marker = new BMap.Marker(address);
            map.addOverlay(marker);
            map.centerAndZoom(address,12);//设置地图中心点和地图缩放级别
        }
    });

//    var marker1 = new BMap.Marker(point1);        // 创建标注
//    map.addOverlay(marker1);// 将标注添加到地图中
//    map.addOverlay(marker);                     // 将标注添加到地图中


</script>

</html>