<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\wamp64\www\quyou\QY\public/../application/home\view\setting\setting.html";i:1517040643;s:71:"D:\wamp64\www\quyou\QY\public/../application/home\view\public\base.html";i:1517040643;}*/ ?>
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
.setting{
    width: 100%;
    height: 800px;
    background-color: #00b7ee;
}
.menuList{
    position: absolute;
    border-bottom-style:none;
    margin: 20px 100px;
    width: 200px;
    height: 300px;

}
.menuList li{
    display: table;
    /*width: 130px;*/
    height: 46px;
    text-align: center;
    font-size: 18px;

}
.menuCon{
    margin: 20px 260px;
    /*background-color: #00b7ee;*/
    height: 800px;
    /*border: 1px solid black;*/
    /*width: 600px;*/
    /*height: 600px;*/
}
.title{
    padding-bottom: 18px;
    margin: 0 0 20px 0;
    border-bottom: 1px solid #eee;
}
.title p{
    font-size: 24px;
    color: #444;
    font-weight: normal;
}
.setTitle{
    font-size: 15px;
    color: #969696;
}
#myInfo tr td{
    padding: 20px 0;
    width: 150px;
    height: 74px;
}
.setInput{
    padding: 5px 10px;
    width: 200px;
    font-size: 15px;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    text-align: center;
    background-color: hsla(0,0%,71%,.1);
}
#myInfo tr{
    border-bottom: 1px solid #f0f0f0;
    display: table-row;
    vertical-align: inherit;
    /*border-color: inherit;*/
}
.setRadio{
    font-size: 15px;
    color: #969696;
    float: left;
}
.setRadio input{
    margin: 0 20px;
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


<div id="menuList">
    <div class="layui-tab layui-tab-brief" lay-filter="test1">
        <ul class="layui-tab-title menuList">
            <li class="layui-this " lay-id="myInfo" >我的信息</li>
            <li lay-id="2">我的头像</li>
            <li lay-id="3">账号安全</li>
            <li lay-id="4">我的钱包</li>
            <li lay-id="5">绑定设置</li>
        </ul>
        <div class="layui-tab-content menuCon">
            <div class="layui-tab-item layui-show">
                <div class="title">
                    <p>我的信息</p>
                </div>
                <table id="myInfo">
                    <tr>
                        <td class="setTitle">昵称</td>
                        <td><input class="am-form-field am-round setInput" type="text" placeholder="请输入昵称"></td>
                    </tr>
                    <tr>
                        <td class="setTitle">电子邮箱</td>
                        <td><input class="am-form-field am-round setInput" type="text" placeholder="请输入您的常用邮箱"></td>
                    </tr>
                    <tr>
                        <td class="setTitle">性别</td>
                        <td class="setRadio">
                            <input type="radio" value="1">男

                            <input style=""  type="radio" value="2">女

                        </td>
                    </tr>
                    <tr>
                        <td class="setTitle">年龄</td>
                        <td><input class="am-form-field am-round setInput" type="text" placeholder="请输入您的年龄"></td>
                    </tr>



                </table>






            </div>
            <div class="layui-tab-item">
                <div class="title">
                    <p>我的头像</p>
                </div>




            </div>
            <div class="layui-tab-item">
                <div class="title">
                    <p>账号安全</p>
                </div>


            </div>
            <div class="layui-tab-item">
                <div class="title">
                    <p>我的钱包</p>
                </div>
            </div>
            <div class="layui-tab-item">
                <div class="title">
                    <p>绑定设置</p>
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
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;

    });
</script>
<!--JS、引用 /示例如下-->

</html>