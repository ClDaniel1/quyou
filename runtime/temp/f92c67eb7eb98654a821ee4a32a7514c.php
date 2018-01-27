<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\wamp64\www\quyou\QY\public/../application/home\view\personal\personal.html";i:1517040643;s:71:"D:\wamp64\www\quyou\QY\public/../application/home\view\public\base.html";i:1517040643;}*/ ?>
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
<!--<link rel="stylesheet" href="__CSS__/scenic/region/region.css">-->
<style>
    #myFootmark{
        width: 100%;
        height: 480px;
        background-color: #b2e2fa;
    }

    #tags_bar{
        height: 58px;
        background-color: #fff;
        background-color: rgba(255,255,255,0.95);
        border-bottom: #d6d6d6 1px solid;
        box-shadow: 0 2px 5px rgba(0,0,0,0.12);
        /*float: left;*/
    }
    .safewidth{
        width: 980px;
        height: 1000px;
        margin: 0 auto;
        background-color: #3f3f3f;
    }
    #left{
        width: 280px;
        height: 500px;
        background-color: #ffffff;
        float: left;
        border: 1px solid #fff;
    }

    #right{
        width: 682px;
        height: 800px;
        background-color: white ;
        float: right;
    }
    #uheadImg{
        width: 100px;
        height: 100px;
        border-radius: 120px;
        background-color: #00a0e9;
        margin: 15px 90px;
    }
    #uname{
        font-size: 20px;
        line-height: 24px;
        margin-top: 16px;
        color: #2E2D3C;
        text-align: center;
        padding: 0;
        word-wrap: break-word;
    }
    .setBtn{
        margin: 20px 90px;
    }
    .myPation{
        text-align: center;
        float: left;
        width: 33.33%;
        padding: 10px 0;
        border: 1px solid #d8d8d8;

    }
    .myPation a{
        color:  #444;;
    }
    .rightList li{
        width: 130px;
        height: 46px;
        text-align: center;
        font-size: 18px;
        float: left;
    }
    .rightBtn{
        margin: 20px 280px;
    }





</style>

    <title>
个人中心
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
<div>
    <div id="myFootmark"></div>
    <!--<div id="tags_bar">-->
    <div class="safewidth">
        <div id="left">
            <div id="uheadImg"></div>
            <div id="uname">用户名</div>
            <a href="<?php echo url('home/Setting/setting'); ?>" class="layui-btn layui-btn-radius setBtn">设置中心</a>
            <div class="myPation">
                <a href="">3</a>
                <p>关注</p>
            </div>
            <div class="myPation">
                <a href="">3</a>
                <p>粉丝</p>
            </div>
            <div class="myPation">
                <a href="">3</a>
                <p>收藏</p>
            </div>
        </div>
        <div id="right">
            <div class="layui-tab layui-tab-brief" lay-filter="test1">
                <ul class="layui-tab-title rightList">
                    <li class="layui-this " lay-id="1" >我的足迹</li>
                    <li lay-id="2">我的游记</li>
                    <li lay-id="3">我的点评</li>
                    <li lay-id="4">订单管理</li>
                    <li lay-id="5">我的收藏</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <ul class="layui-timeline">
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                <div class="layui-timeline-content layui-text">
                                    <h3 class="layui-timeline-title">8月18日</h3>
                                    <p>
                                        layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
                                        <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                                        <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
                                    </p>
                                </div>
                            </li>
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                <div class="layui-timeline-content layui-text">
                                    <h3 class="layui-timeline-title">8月16日</h3>
                                    <p>杜甫的思想核心是儒家的仁政思想，他有“<em>致君尧舜上，再使风俗淳</em>”的宏伟抱负。个人最爱的名篇有：</p>
                                    <ul>
                                        <li>《登高》</li>
                                        <li>《茅屋为秋风所破歌》</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                <div class="layui-timeline-content layui-text">
                                    <h3 class="layui-timeline-title">8月15日</h3>
                                    <p>
                                        中国人民抗日战争胜利72周年
                                        <br>常常在想，尽管对这个国家有这样那样的抱怨，但我们的确生在了最好的时代
                                        <br>铭记、感恩
                                        <br>所有为中华民族浴血奋战的英雄将士
                                        <br>永垂不朽
                                    </p>
                                </div>
                            </li>
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                <div class="layui-timeline-content layui-text">
                                    <div class="layui-timeline-title">过去</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="layui-tab-item">
                        <a href="" class="layui-btn layui-btn-radius rightBtn">写游记</a>





                    </div>
                    <div class="layui-tab-item">
                        <a href="" class="layui-btn layui-btn-radius rightBtn">写点评</a>
                    </div>
                    <div class="layui-tab-item">
                        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                            <ul class="layui-tab-title">
                                <li class="layui-this">已支付订单</li>
                                <li>未支付订单</li>
                            </ul>
                            <div class="layui-tab-content" style="height: 100px;">
                                <div class="layui-tab-item layui-show">1</div>
                                <div class="layui-tab-item">2</div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-tab-item">5</div>
                </div>
            </div>
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

<script>
    nav(4);
</script>
<script>
    layui.use('element', function(){
        var element = layui.element;

        //获取hash来切换选项卡，假设当前地址的hash为lay-id对应的值
        var layid = location.hash.replace(/^#test1=/, '');
        element.tabChange('test1', layid); //假设当前地址为：http://a.com#test1=222，那么选项卡会自动切换到“发送消息”这一项

        //监听Tab切换，以改变地址hash值
        element.on('tab(test1)', function(){
            location.hash = 'test1='+ this.getAttribute('lay-id');
        });
    });
</script>
<!--JS、引用 /示例如下-->

</html>