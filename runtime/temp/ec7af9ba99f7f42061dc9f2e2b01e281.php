<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\AppServ\www\quyou\public/../application/home\view\desti\desti.html";i:1517187160;s:69:"D:\AppServ\www\quyou\public/../application/home\view\public\base.html";i:1517729242;}*/ ?>
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

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    
<!--页面样式、引用/示例如下-->
<style>
    #bannerText{
        transition: all 0.5s;
        display: inline-block;
        left: auto;
        right: 15%;
    }
    #bannerText div{
        display: inline-block;
        padding: 25px;
    }
    #editer{
        text-align: right;
        margin-top: 15px;
    }
    #search{
        width: 300px;
        display: inline-block;
    }
    #searchBar{
        transition: all 0.5s;
        display: inline-block;
        bottom: 35%;
        left: 15%;
    }
    #searchBar>div{
        padding: 30px;
        padding-top: 35px;
        display: inline-block;
    }
    @media (max-width: 768px) {
        #searchBar{
            display: none;
        }
    }
    #banner li{
        display: block;
        max-height: 800px;
        overflow: hidden;
    }
    #banner img{
        margin-top: -35px;
    }
    #title{
        font-size: 2em;
        text-align: center;
        line-height: 75px;
        height: 75px;
        width: 100%;
        display: inline-block;
    }
    dl{
        width: 100%;
        border-bottom: dashed 1px #EEEEEE;
        padding: 20px 0;
        list-style: none;
        padding-left: 130px;
    }
    #des dt{
        float: left;
        font-size: 1.2em;
        display: inline-block;
        font-weight: normal;
        padding-right: 15px;
        margin-left: -130px;
    }
    #des a{
        transition: all 0.3s;
        margin-right: 10px;
    }
    #des a:hover{
        color: #F9851D;

    }
    #des dd{
        display: inline-block;
        margin-top: 0;
    }
    #des dd a{

        line-height: 30px;
        color: grey;
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
                <ul class="layui-nav catalog " id="navUl">
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst1"></i>首页</a></li>
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst2"></i>玩法路线</a></li>
                    <li class="layui-nav-item"><a href="<?php echo url('home/Region/scenicShow'); ?>?rgId=1000"><i class="icon1 iconPst3"></i>景点</a></li>
                    <li class="layui-nav-item"><a href="<?php echo url('home/Region/hotel'); ?>?rgId=1000"><i class="icon1 iconPst4"></i>酒店</a></li>
                    <li class="layui-nav-item">
                        <a href="<?php echo url('home/Region/food'); ?>"><i class="icon1 iconPst5"></i>美食</a>
                    </li>
                    <li class="layui-nav-item"><a href=""><i class="icon1 iconPst6"></i>游记</a></li>
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

<div data-am-widget="" class="am-slider am-slider-d2" data-am-slider='{&quot;directionNav&quot;:false}'  id="banner">
    <ul class="am-slides">
        <li>
            <img src="https://b2-q.mafengwo.net/s11/M00/A9/F2/wKgBEFpd5fCASAWeAApM2WMZ60s74.jpeg">
            <div class="am-slider-desc" id="bannerText">
                <div class="am-slider-content">
                    <h2 class="am-slider-title" id="text"></h2>
                    <p id="editer"></p>
                </div>
            </div>
            <div class="am-slider-desc"  id="searchBar">
                <div class="am-slider-content">
                    <form class="layui-form" action="" >
                        <h2 class="am-slider-title">请输入目的地</h2>
                        <input type="text" name="title" required  lay-verify="required" placeholder="请输入搜索内容" autocomplete="off" class="layui-input"    id="search">
                        <div class="layui-form-item" style="display: inline-block;" >
                            <div class="layui-input-block" style="margin-left: 10px">
                                <button class="layui-btn" lay-submit lay-filter="formDemo"><i class="layui-icon">&#xe615;</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</div>

<div id="title">
    热门目的地
</div>
<div class="layui-container" id="des">
    <div class="layui-row layui-col-space30" >
        <div class="layui-col-sm6">
            <dl class=" am-text-top">
                <dt>直辖市</dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=2'); ?>">北京</a>
                    <a href="<?php echo url('home/region/region','des=10'); ?>">上海</a>
                    <a href="<?php echo url('home/region/region','des=23'); ?>">重庆</a>
                    <a href="<?php echo url('home/region/region','des=3'); ?>">天津</a>
                </dd>
            </dl>
            <dl class=" am-text-top">
                <dt><a href="<?php echo url('home/region/region','des=26'); ?>">云南</a></dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=308'); ?>">丽江</a>
                    <a href="<?php echo url('home/region/region','des=3038'); ?>">大理</a>
                    <a href="<?php echo url('home/region/region','des=303'); ?>">昆明</a>
                    <a href="<?php echo url('home/region/region','des=3059'); ?>">香格里拉</a>
                    <a href="<?php echo url('home/region/region','des=314'); ?>">西双版纳</a>
                    <a href="<?php echo url('home/region/region','des=2963'); ?>">腾冲</a>
                </dd>
            </dl>
            <dl class=" am-text-top">
                <dt>
                    <a href="<?php echo url('home/region/region','des=24'); ?>">四川</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=273'); ?>">成都</a>
                    <a href="<?php echo url('home/region/region','des=2790'); ?>">九寨沟</a>
                    <a href="<?php echo url('home/region/region','des=2815'); ?>">稻城</a>
                    <a href="<?php echo url('home/region/region','des=2811'); ?>">色达</a>
                    <a href="<?php echo url('home/region/region','des=2797'); ?>">若尔盖</a>
                    <a href="<?php echo url('home/region/region','des=2651'); ?>">都江堰</a>
                    <a href="<?php echo url('home/region/region','des=2796'); ?>">阿坝</a>
                    <a href="<?php echo url('home/region/region','des=2724'); ?>">峨眉山</a>
                </dd>
            </dl>
            <dl class=" am-text-top">
                <dt>
                    <a href="<?php echo url('home/region/region','des=12'); ?>">浙江</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=122'); ?>">杭州</a>
                    <a href="<?php echo url('home/region/region','des=123'); ?>">宁波</a>
                    <a href="<?php echo url('home/region/region','des=126'); ?>">湖州</a>
                    <a href="<?php echo url('home/region/region','des=127'); ?>">绍兴</a>
                    <a href="<?php echo url('home/region/region','des=1346'); ?>">南浔</a>
                </dd>
            </dl>
            <dl class=" am-text-top">
                <dt>
                    <a href="<?php echo url('home/region/region','des=14'); ?>">福建</a>
                    <a href="<?php echo url('home/region/region','des=22'); ?>">海南</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=268'); ?>">三亚</a>
                    <a href="<?php echo url('home/region/region','des=267'); ?>">海口</a>
                    <a href="<?php echo url('home/region/region','des=151'); ?>">厦门</a>
                    <a href="<?php echo url('home/region/region','des=1594'); ?>">武夷山</a>
                    <a href="<?php echo url('home/region/region','des=154'); ?>">泉州</a>
                </dd>
            </dl>
            <dl class=" am-text-top">
                <dt>
                    <a href="<?php echo url('home/region/region','des=11'); ?>">江苏</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=109'); ?>">南京</a>
                    <a href="<?php echo url('home/region/region','des=113'); ?>">苏州</a>
                    <a href="<?php echo url('home/region/region','des=110'); ?>">无锡</a>
                    <a href="<?php echo url('home/region/region','des=118'); ?>">扬州</a>
                    <a href="<?php echo url('home/region/region','des=112'); ?>">常州</a>
                    <a href="<?php echo url('home/region/region','des=115'); ?>">连云港</a>
                </dd>
            </dl>
            <dl class=" am-text-top">
                <dt>
                    <a href="<?php echo url('home/region/region','des=20'); ?>">广东</a>
                    <a href="<?php echo url('home/region/region','des=21'); ?>">广西</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=232'); ?>">广州</a>
                    <a href="<?php echo url('home/region/region','des=234'); ?>">深圳</a>
                    <a href="<?php echo url('home/region/region','des=235'); ?>">珠海</a>
                    <a href="<?php echo url('home/region/region','des=236'); ?>">汕头</a>
                    <a href="<?php echo url('home/region/region','des=255'); ?>">桂林</a>
                    <a href="<?php echo url('home/region/region','des=2477'); ?>">阳朔</a>
                    <a href="<?php echo url('home/region/region','des=257'); ?>">北海</a>
                </dd>
            </dl>
        </div>
        <div class="layui-col-sm6">
            <dl>
                <dt>
                    <a href="<?php echo url('home/region/region','des=27'); ?>">西藏</a>
                    <a href="<?php echo url('home/region/region','des=25'); ?>">贵州</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=319'); ?>">拉萨</a>
                    <a href="<?php echo url('home/region/region','des=325'); ?>">林芝</a>
                    <a href="<?php echo url('home/region/region','des=324'); ?>">阿里</a>
                    <a href="<?php echo url('home/region/region','des=2901'); ?>">镇远</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    西北
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=326'); ?>">西安</a>
                    <a href="<?php echo url('home/region/region','des=350'); ?>">西宁</a>
                    <a href="<?php echo url('home/region/region','des=3366'); ?>">祁连</a>
                    <a href="<?php echo url('home/region/region','des=3307'); ?>">敦煌</a>
                    <a href="<?php echo url('home/region/region','des=336'); ?>">兰州</a>
                    <a href="<?php echo url('home/region/region','des=349'); ?>">甘南</a>
                    <a href="<?php echo url('home/region/region','des=342'); ?>">张掖</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?php echo url('home/region/region','des=16'); ?>">山东</a>
                    <a href="<?php echo url('home/region/region','des=5'); ?>">山西</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=171'); ?>">青岛</a>
                    <a href="<?php echo url('home/region/region','des=1811'); ?>">泰山</a>
                    <a href="<?php echo url('home/region/region','des=180'); ?>">日照</a>
                    <a href="<?php echo url('home/region/region','des=179'); ?>">威海</a>
                    <a href="<?php echo url('home/region/region','des=175'); ?>">烟台</a>
                    <a href="<?php echo url('home/region/region','des=1776'); ?>">长岛</a>
                    <a href="<?php echo url('home/region/region','des=1780'); ?>">蓬莱</a>
                    <a href="<?php echo url('home/region/region','des=663'); ?>">平遥</a>
                    <a href="<?php echo url('home/region/region','des=49'); ?>">大同</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?php echo url('home/region/region','des=19'); ?>">湖南</a>
                    <a href="<?php echo url('home/region/region','des=18'); ?>">湖北</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=212'); ?>">荆州</a>
                    <a href="<?php echo url('home/region/region','des=2301'); ?>">凤凰</a>
                    <a href="<?php echo url('home/region/region','des=227'); ?>">郴州</a>
                    <a href="<?php echo url('home/region/region','des=204'); ?>">武汉</a>
                    <a href="<?php echo url('home/region/region','des=216'); ?>">恩施</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?php echo url('home/region/region','des=13'); ?>">安徽</a>
                    <a href="<?php echo url('home/region/region','des=15'); ?>">江西</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=141'); ?>">黄山</a>
                    <a href="<?php echo url('home/region/region','des=1723'); ?>">婺源</a>
                    <a href="<?php echo url('home/region/region','des=160'); ?>">景德镇</a>
                    <a href="<?php echo url('home/region/region','des=1637'); ?>">庐山</a>
                    <a href="<?php echo url('home/region/region','des=159'); ?>">南昌</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?php echo url('home/region/region','des=4'); ?>">河北</a>
                    <a href="<?php echo url('home/region/region','des=17'); ?>">河南</a>
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=456'); ?>">北戴河</a>
                    <a href="<?php echo url('home/region/region','des=39'); ?>">秦皇岛</a>
                    <a href="<?php echo url('home/region/region','des=44'); ?>">承德</a>
                    <a href="<?php echo url('home/region/region','des=533'); ?>">张北</a>
                    <a href="<?php echo url('home/region/region','des=189'); ?>">洛阳</a>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?php echo url('home/region/region','des=6'); ?>">内蒙古</a>
                    东北
                </dt>
                <dd>
                    <a href="<?php echo url('home/region/region','des=65'); ?>">呼伦贝尔</a>
                    <a href="<?php echo url('home/region/region','des=816'); ?>">阿尔山</a>
                    <a href="<?php echo url('home/region/region','des=782'); ?>">海拉尔</a>
                    <a href="<?php echo url('home/region/region','des=94'); ?>">哈尔滨</a>
                    <a href="<?php echo url('home/region/region','des=1159'); ?>">漠河</a>
                    <a href="<?php echo url('home/region/region','des=72'); ?>">大连</a>
                </dd>
            </dl>
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
<script src="__STATIC__/lib/vue.js"></script>
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
<script type="text/javascript" src="http://yiju.ml/api/word.php?m=js"></script>
<script>
    $("#text").html(str[0]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
    $("#editer").text("---"+str[1]);

    nav(2);
</script>

</html>