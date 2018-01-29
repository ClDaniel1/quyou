<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\wamp64\www\quyou\public/../application/home\view\index\index.html";i:1517211698;s:68:"D:\wamp64\www\quyou\public/../application/home\view\public\base.html";i:1517206921;}*/ ?>
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
<style>
    #searchBar{
        width: 50%;
        position: absolute;
        background: rgba(0,0,0,0.7);
        height: 125px;
        z-index: 1;
        left: 25%;
        bottom: 20%;
        border-radius: 10px;
        box-shadow: 0 0 10px  black;
    }
    #searchContent{
        width: 89%;
        transition: all 0.5s;
        margin-top: 10px;
    }
    @media(max-width: 1550px) {
        #searchContent{
            width: 87%;
        }
    }
    @media(max-width: 1350px) {
        #searchContent{
            width: 83%;
        }
    }

    @media(max-width: 1050px) {
        #searchContent{
            width: 80%;
        }

    }
    @media(max-width: 846px) {
        #searchContent{
            width: 75%;
        }

    }

    .listImg{
        overflow: hidden;
        text-align: center;
    }
    .listImg a{
         width: 100%;
         display: inline-block;
         text-align: center;
     }
    .am-list-main a{
        transition: all 0.5s;
    }
    .am-list-main a:hover{
        color: #F9851D;
    }
    .am-list-main div{
       font-size: 17px;
        margin-top: 15px;
    }
    .listImg img{
        height: 175px;
        display: inline-block;
    }
    .am-list li{
        transition: all 0.5s;
    }
    .am-list li:hover{
        background: #f7f7f7;
    }
    #ad {
        width: 100%;
    }
    @media(max-width: 768px) {
        #searchBar{
            display: none;
        }
        .listImg{
            display: inline;
            width: 100%;
        }
        .am-list-main{
            display: inline;
            width: 100%;
            padding: 15px 35px;
        }
        .am-list-item-hd a{
            font-size: 18px;
        }
        .am-list-main div{
            font-size: 14px;
        }

    }
    @media (min-width: 768px) {

    }
</style>

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
            <li class="layui-nav-item nologin"><a href="<?php echo url('home/User/login'); ?>">登录</a></li>
            <li class="layui-nav-item nologin"><a href="<?php echo url('home/User/register'); ?>"> 注册</a></li>
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

       <li class="layui-nav-item nologin"><a href="<?php echo url('home/User/login'); ?>">登录</a></li>
        <li class="layui-nav-item nologin"><a href="<?php echo url('home/User/register'); ?>"> 注册</a></li>

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
    
<!--页面内容 /示例如下-->
<div data-am-widget="slider" class="am-slider am-slider-c3" data-am-slider='{&quot;controlNav&quot;:false}' >
    <ul class="am-slides">
        <li>
            <img src="https://n4-q.mafengwo.net/s11/M00/C6/B0/wKgBEFpnJsSAAqlhAAi_DZlFIR042.jpeg?imageMogr2%2Finterlace%2F1">
            <div class="am-slider-desc"><div class="am-slider-counter"><span class="am-active">1</span>/4</div>远方 有一个地方 那里种有我们的梦想</div>
        </li>
        <li>
            <img src="https://b4-q.mafengwo.net/s11/M00/9E/70/wKgBEFplvumAEU6GAAuwkxzWAm802.jpeg?imageMogr2%2Finterlace%2F1">
            <div class="am-slider-desc"><div class="am-slider-counter"><span class="am-active">2</span>/4</div>某天 也许会相遇 相遇在这个好地方</div>

        </li>
        <li>
            <img src="https://b1-q.mafengwo.net/s11/M00/62/8D/wKgBEFpiDjGAY3QYAAd13CQEx5c24.jpeg?imageMogr2%2Finterlace%2F1">
            <div class="am-slider-desc"><div class="am-slider-counter"><span class="am-active">3</span>/4</div>不要太担心 只因为我相信 终会走过这条遥远的道路</div>

        </li>
        <li>
            <img src="https://n4-q.mafengwo.net/s11/M00/19/36/wKgBEFpkuyaASpXSAAVeGFv-0eA31.jpeg?imageMogr2%2Finterlace%2F1">
            <div class="am-slider-desc"><div class="am-slider-counter"><span class="am-active">4</span>/4</div>OH PARA PARADISE 是否那么重要 你是否那么地遥远</div>

        </li>

    </ul>
    <div id="searchBar" class="am-slider-desc">
        <form class="layui-form" action="" >
            <div class="layui-form-item" style="display: inline-block;" id="searchContent">
                <div class="layui-input-block" style="margin-left: 35px;">
                    <input type="radio" name="search" value="all" title="全部" checked>
                    <input type="radio" name="search" value="des" title="目的地" >
                    <input type="radio" name="search" value="hotel" title="酒店" >
                </div>
                <div class="layui-input-block" style="margin-left: 35px;margin-top: 10px    ">
                    <input type="text" name="title" required  lay-verify="required" placeholder="请输入搜索内容" autocomplete="off" class="layui-input"    >
                </div>
            </div>
            <div class="layui-form-item" style="display: inline-block;" >
                <div class="layui-input-block" style="margin-left: 10px">
                    <button class="layui-btn" lay-submit lay-filter="formDemo"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="layui-container">
    <div class="layui-row layui-col-space30" >
        <div style="position: sticky" class="layui-col-md3" id="leftBar">
            <div class="am-panel am-panel-primary panel" id="ad">
                <div class="am-panel-hd">广告</div>
                <div class="am-panel-bd">
                    <img src="https://b4-q.mafengwo.net/s11/M00/9E/70/wKgBEFplvumAEU6GAAuwkxzWAm802.jpeg?imageMogr2%2Finterlace%2F1" alt="我很囧，你保重....晒晒旅行中的那些囧！"  class="am-img-responsive"/>
                </div>
            </div>

            <div class="am-panel am-panel-primary panel" id="hot">
                <div class="am-panel-hd">热门活动</div>
                <div class="am-panel-bd">
                    <img src="https://b4-q.mafengwo.net/s11/M00/9E/70/wKgBEFplvumAEU6GAAuwkxzWAm802.jpeg?imageMogr2%2Finterlace%2F1" alt="我很囧，你保重....晒晒旅行中的那些囧！"  class="am-img-responsive"/>
                    <img src="https://b4-q.mafengwo.net/s11/M00/9E/70/wKgBEFplvumAEU6GAAuwkxzWAm802.jpeg?imageMogr2%2Finterlace%2F1" alt="我很囧，你保重....晒晒旅行中的那些囧！"  class="am-img-responsive"/>
                    <img src="https://b4-q.mafengwo.net/s11/M00/9E/70/wKgBEFplvumAEU6GAAuwkxzWAm802.jpeg?imageMogr2%2Finterlace%2F1" alt="我很囧，你保重....晒晒旅行中的那些囧！"  class="am-img-responsive"/>
                    <img src="https://b4-q.mafengwo.net/s11/M00/9E/70/wKgBEFplvumAEU6GAAuwkxzWAm802.jpeg?imageMogr2%2Finterlace%2F1" alt="我很囧，你保重....晒晒旅行中的那些囧！"  class="am-img-responsive"/>

                </div>
            </div>

        </div>
        <div class="layui-col-md9" id="hotNote">
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this">热门游记</li>
                    <li>最新游记</li>
                    <a href="<?php echo url('home/Notes/notes'); ?>"><input class="layui-btn" type="button" value="写游记" style="float: right;margin-bottom: 10px"></a>
                </ul>

                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">

                        <ul class="am-list" id="list">
                            <!--缩略图在标题左边-->

                        </ul >

                    </div>
                    <div class="layui-tab-item">内容2</div>

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

    var checkUrl = "<?php echo url('home/User/check'); ?>";

</script>
<script src="__JS__/home/public/public.js"></script>

<!--JS、引用 /示例如下-->

<script>
    var flow = layui.flow;
    flow.load({
        elem: '#list',
        isAuto:false//指定列表容器
        ,done: function(page, next){ //到达临界点（默认滚动触发），触发下一页
            var lis = [];
            //以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
            for(var i =0;i<10;i++){
                lis.push('<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">'+
                    '<div class="am-u-sm-4 am-list-thumb listImg">'+
                    '<a href="http://www.douban.com/online/11614662/" class="">'+
                    '<img src="https://b4-q.mafengwo.net/s11/M00/9E/70/wKgBEFplvumAEU6GAAuwkxzWAm802.jpeg?imageMogr2%2Finterlace%2F1" alt="我很囧，你保重....晒晒旅行中的那些囧！" />'+
                    '</a>'+
                    '</div>'+
                    ' <div class=" am-u-sm-8 am-list-main">'+
                    '<h1 class="am-list-item-hd"><a href="http://www.douban.com/online/11614662/" class="">我很囧，你保重....晒晒旅行中的那些囧！</a></h1>'+
                    '<div class="am-list-item-text">囧人囧事囧照，人在囧途，越囧越萌。标记《带你出发，陪我回家》http://book.douban.com/subject/25711202/为“想读”“在读”或“读过”，有机会获得此书本活动进行3个月，每月送出三本书。会有不定期bonus！</div>'+
                    '<div class="am-list-item-text am-vertical-align-bottom "><i class="layui-icon">&#xe715;</i> 云南  <i class="layui-icon">by</i></div>'+
                    ' </div>'+
                    '</li>');
            }



                //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                next(lis.join(''), page < 10);
            }
    });
</script>

</html>