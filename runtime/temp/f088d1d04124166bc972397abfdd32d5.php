<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\wamp64\www\quyou\public/../application/home\view\region\region.html";i:1519559115;s:68:"D:\wamp64\www\quyou\public/../application/home\view\public\base.html";i:1519513687;}*/ ?>
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
    <link rel="stylesheet" href="__CSS__\home\chat.css">

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    
<!--页面样式、引用/示例如下-->
<!--引用百度地图需加的meta-->
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="__CSS__/home/region/region.css">

    <title>
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



<div id="chatD">
    <div id="chatZone" class="chat">
        <div id="chatZM">
            <div id="chatHead"><span id="chatname">正在和xx聊天</span><img src="__STATIC__/images/x.png" alt=""></div>
            <div id="chatMain"></div>
            <div id="chatTool">
                <div class="unuse"></div>
                <img src="__STATIC__/images/face.png" alt="" class="toolimg" id="btnface">
                <img src="__STATIC__/images/draw.png" alt="" class="toolimg" id="btndraw">
            </div>
            <div id="chatbar">
                <div class="unuse"></div>
                <div id="chatinput" contenteditable="true" tabindex="0"></div>
                <input type="button" value="发送" id="send">
            </div>
        </div>
    </div>
</div>

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
            <li class="layui-nav-item loginIn"><a href="<?php echo url('home/User/myMsg'); ?>" class="msga">我的消息</a></li>
            <li class="layui-nav-item loginIn">
                <a href="javascript:;">我</a>
                <dl class="layui-nav-child">
                    <dd><a href="">我的游记</a></dd>
                    <dd><a href="javascript:;" class="goCustomer">联系客服</a></dd>
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

        <li class="layui-nav-item loginIn"  style="float: right">
            <a href="" class="toCenter"><img src="http://t.cn/RCzsdCq" class="layui-nav-img uImg">我</a>
            <dl class="layui-nav-child">
                <dd><a href="<?php echo URL('home/personal/personal'); ?>#test1=2">我的游记</a></dd>
                <dd><a href="javascript:;" class="goCustomer">联系客服</a></dd>
                <dd onclick="loginOut()"><a href="javascript:;">退出登录</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item loginIn"  style="float: right"><a href="<?php echo url('home/User/myMsg'); ?>" class="msga">我的消息</a></li>
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
<!--面包屑区域-->
<div id="content2">
    <div class="layui-container navTop">
        <div class="layui-row">
            <div class="layui-col-sm6 layui-col-xs12">
                <div>
                    <span class="layui-breadcrumb" lay-separator=">">
                        <a href="">目的地</a>
                        <a href=""><?php echo $region_name; ?><i class="layui-icon orangeIcon">&#xe625;</i></a>
                        <a ><cite style="color: #ff7000;font-weight: bold;"><span><?php echo $region_name; ?></span>旅游攻略</cite></a>
                    </span>
                </div>
                <div class="siteMsg">
                    <div class="siteName">
                        <h1 class="disB"><?php echo $region_name; ?></h1>
                        <a href="">(<span><?php echo $count; ?></span>张照片)</a>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm3 layui-col-xs12 layui-col-sm-offset3">
               <ul class="imgA am-text-middle">
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
            <ul class="layui-nav catalog " id="navUl">
                <li class="layui-nav-item"><a href=""><i class="icon1 iconPst1"></i>概况</a></li>
                <li class="layui-nav-item"><a href=""><i class="icon1 iconPst2"></i>玩法路线</a></li>
                <li class="layui-nav-item"><a href=""><i class="icon1 iconPst3"></i>景点</a></li>
                <li class="layui-nav-item"><a href="<?php echo url('home/Region/hotel'); ?>?rgId=<?php echo $sId; ?>"><i class="icon1 iconPst4"></i>酒店</a></li>
                <li class="layui-nav-item">
                    <a href="<?php echo url('home/Region/food'); ?>?rgId=<?php echo $sId; ?>"><i class="icon1 iconPst5"></i>美食</a>
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
                            <a href="<?php echo url('home/Region/hotel'); ?>?rgId=<?php echo $sId; ?>">
                                <i class="icon1 iconPst4"></i>酒店
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo url('home/Region/food'); ?>?rgId=<?php echo $sId; ?>"><i class="icon1 iconPst5"></i>美食</a>
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
<!--地区百科信息-->
<div id="regionBk">
    <div class="layui-container">
        <div class="layui-row">
            <div class="layui-col-sm5 layui-col-xs6">
                <div class="msgDiv">
                    <span>攻略：</span>
                    <p class="conP">
                        <?php echo $bkMsg['intro']; ?>
                    </p>
                </div>
            </div>
            <div class="layui-col-sm5 regionImg layui-col-sm-offset2 layui-col-xs-offset1 layui-col-xs5 ">
                <?php echo $bkMsg['img']; ?>
            </div>
        </div>
    </div>
</div>
<!--景点路线区域-->
<div id="content3">
    <div class="layui-container">
        <h1 class="lineFont"><span><?php echo $region_name; ?></span><span>{{routeMsg.count}}</span>条经典路线</h1>
        <div class="layui-row">
            <div class="layui-col-sm6" v-for="(value,key) in routeMsg.msg" v-show="key<showNum">
                <div class="mapBorder1 scenicMsg">
                    <h1>
                        <span class="layui-badge layui-bg-orange mapNo">{{key+1}}</span>
                        <span>
                            {{routeMsg.name}}{{value[0].title}}
                        </span>
                    </h1>
                    <div class="map" :id="mapp+key">

                    </div>
                    <div class="selectLine">
                        <span class="percent">
                            {{value[0].chose}}%
                        </span>
                        <h3>初次访问<span>
                        </span>的蜂蜂会选择这条路线</h3>
                    </div>
                    <div class="pathShow">
                        <div>
                            <span class="pathSpan">D<span>1</span></span>
                            <span v-for="(val,k) in value" class="layui-breadcrumb">
                                <a href=""><cite>{{val.scenicName}}</cite></a>
                                <span v-if="k<value.length-1">-></span>
                            </span>
                        </div>
                        <a href="" class="lookA">查看></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="lookAll">
            <span href="" @click="showMap" v-if="showNum===2">
                <span class="book">
                    <i class="i-blue"></i>
                    <i class="i-orange"></i>
                </span>
                查看全部<span class="numOrange"><span>{{routeMsg.count}}</span>条</span>路线>
            </span>
            <span href="" @click="hideMap" v-else>
                <span class="book">
                    <i class="i-blue"></i>
                    <i class="i-orange"></i>
                </span>
                收起
            </span>
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
                    <h2 class="hotelMsg"><a href="<?php echo url('home/Region/hotel'); ?>?rgId=<?php echo $sId; ?>">酒店住宿攻略<i class="innerIcon"></i></a></h2>
                    <?php if(is_array($hotelMsg['msg']) || $hotelMsg['msg'] instanceof \think\Collection || $hotelMsg['msg'] instanceof \think\Paginator): $i = 0; $__LIST__ = $hotelMsg['msg'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo url('home/Region/hotel'); ?>?rgId=<?php echo $sId; ?>">
                        <div class="innerDiv">
                            <h3>
                                <span class="layui-badge layui-bg-orange"><?php echo $i; ?></span>
                                <span><?php echo $value['hotelName']; ?></span>
                            </h3>
                            <div class="pst">
                                <img class="hotelMap" src="__STATIC__/<?php echo $value['img']; ?>" alt="">
                                <div class="introduceMsg">
                                    <span><?php echo $value['hotelDescribe']; ?></span>
                                </div>
                            </div>
                            <div class="comTop">
                                <img class="headImg" src="__STATIC__/<?php echo $value['content']['uheadImg']; ?>" alt="加载失败">
                                <span class="comName"><?php echo $value['content']['uname']; ?></span>
                                <span class="comMsg">“<?php echo $value['content']['content']; ?>”</span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="dashed">
                        <a href="<?php echo url('home/Region/hotel'); ?>?rgId=<?php echo $sId; ?>"><span><?php echo $hotelMsg['count']; ?></span>家酒店<i class="orgIcon"></i></a>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm4">
                <div class="hotelW middleDiv">
                    <h2 class="hotelMsg"><a href="<?php echo url('home/Region/scenicShow'); ?>?rgId=<?php echo $sId; ?>">必游景点排行<i class="innerIcon"></i></a></h2>
                    <?php if(is_array($scenicMsg['list']) || $scenicMsg['list'] instanceof \think\Collection || $scenicMsg['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $scenicMsg['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo url('home/Region/scenicShow'); ?>?rgId=<?php echo $sId; ?>">
                        <div class="innerDiv">
                            <h3>
                                <span class="layui-badge layui-bg-orange"><?php echo $i; ?></span>
                                <span><?php echo $value['scenicName']; ?></span>
                            </h3>
                            <div class="pst">
                                <img class="hotelMap" src="__STATIC__/<?php echo $value['scenicImg']; ?>" alt="加载失败">
                                <div class="introduceMsg">
                                    <span><?php echo $value['scenicDescribe']; ?></span>
                                </div>
                            </div>
                            <div class="comTop">
                                <img class="headImg" src="__STATIC__/<?php echo $value['content']['uheadImg']; ?>" alt="加载失败">
                                <span class="comName"><?php echo $value['content']['uname']; ?></span>
                                <span class="comMsg">“<?php echo $value['content']['content']; ?></span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="dashed">
                        <a href="<?php echo url('home/Region/scenicShow'); ?>?rgId=<?php echo $sId; ?>"><span><?php echo $scenicMsg['count']; ?></span>个景点<i class="orgIcon"></i></a>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm4">
                <div class="hotelW rightDiv">
                    <h2 class="hotelMsg"><a href="<?php echo url('home/Region/food'); ?>?rgId=<?php echo $sId; ?>">必吃美食排行<i class="innerIcon"></i></a></h2>
                    <?php if(is_array($foodMsg['msg']) || $foodMsg['msg'] instanceof \think\Collection || $foodMsg['msg'] instanceof \think\Paginator): $i = 0; $__LIST__ = $foodMsg['msg'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo url('home/Region/food'); ?>?rgId=<?php echo $sId; ?>">
                        <div class="innerDiv">
                            <h3>
                                <span class="layui-badge layui-bg-orange"><?php echo $i; ?></span>
                                <span><?php echo $value['foodName']; ?></span>
                            </h3>
                            <div class="pst">
                                <img class="hotelMap" src="__STATIC__/<?php echo $value['foodImg']; ?>" alt="">
                                <div class="introduceMsg">
                                    <span><?php echo $value['foodDescribe']; ?></span>
                                </div>
                            </div>
                            <div class="comTop">
                                <img class="headImg" src="__STATIC__/<?php echo $value['content']['uheadImg']; ?>" alt="加载失败">
                                <span class="comName"><?php echo $value['content']['uname']; ?></span>
                                <span class="comMsg">“<?php echo $value['content']['content']; ?>”</span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="dashed">
                        <a href="<?php echo url('home/Region/food'); ?>?rgId=<?php echo $sId; ?>"><span><?php echo $foodMsg['count']; ?></span>种美食<i class="orgIcon"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--景点游记-->
<div id="content5">
    <div class="layui-container">
        <h6 class="siteColor"><span><?php echo $region_name; ?></span>游记</h6>
        <div class="layui-row">
            <div>
                <a href="<?php echo url('home/Notes/show'); ?>?id= <?php echo $note['noteId']; ?>">
                    <img class="scenicImg" src="__STATIC__/<?php echo $note['img']; ?>" alt="加载失败">
                    <div class="mgLeft">
                        <dl class="msgDl">
                            <dt>
                                <?php echo $note['title']; ?>
                            </dt>
                            <dd>
                                <?php echo $note['content']; ?>...
                            </dd>
                        </dl>
                        <div class="headDiv">
                            <img class="upHead" src="__STATIC__/<?php echo $note['uheadImg']; ?>" alt="加载失败">
                            <span><?php echo $note['uname']; ?></span>
                            <a href=""><i class="iconUp"></i><span class="upNum">255</span></a>
                        </div>
                    </div>
                </a>
            </div>
            <div style="clear: both"></div>
            <div class="lookAll">
                <a href="">
                <span class="book">
                    <i class="i-blue"></i>
                    <i class="i-orange"></i>
                </span>
                    查看全部<span class="numOrange"><?php echo $region_name; ?></span>游记>
                </a>
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
                      <li><a href="">商家入驻</a></li>
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
    var qqFace = "__STATIC__/images/expression/";
</script>
<script src="__JS__/home/chat.js"></script>
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
<!--引用百度地图api文件-->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=TRYU1lcQ2YkgXRzerqXODMOKkAGrETrL"></script>
<script>
    nav(2);
    layui.use('element', function(){
        var element = layui.element;
    });
//   到时候需要封装起来
    new Vue({
        el: '#baseMain',
        data:{
            routeMsg:[],
            routeS:false,
            type:false,
            mapp:"map",
            region:"<?php echo $region_name; ?>",
            showNum:2
        },
        created: function () {
            var _this=this;
            $.ajax({
                type:"get",
                url:"<?php echo url('home/Region/route'); ?>",
                dataType:"json",
                success: function (res) {
                    console.log(res);
                    _this.routeMsg=res;
                    var routeArr=[];
                    setTimeout(function () {
                        for(var i=0;i<res.msg.length;i++)
                        {
                            routeArr=[];
                            for(var j=0;j<res.msg[i].length;j++)
                            {
                                routeArr.push(_this.region+res.msg[i][j].scenicName);
                            }
                                _this.bdMap(_this.mapp+i,routeArr,13);
                        }
                    },1000);

                    _this.type=true;
                },error: function (res) {
                    console.log(res);
                }
            });
        },
        methods: {

            bdMap:function(showId,scenicArr,max) {
                var map = new BMap.Map(showId);//创建地图实例
                map.enableScrollWheelZoom(true);//地图的鼠标滚轮缩放默认是关闭的，需要配置开启。
                var opts = {type: BMAP_NAVIGATION_CONTROL_LARGE};//平移控件外观
                map.addControl(new BMap.NavigationControl(opts));//添加平移缩放控件
                var myGeo = new BMap.Geocoder();
                myGeo.getPoint('<?php echo $region_name; ?>', function (point) {
                    if (point) {
                        var address = new BMap.Point(point.lng, point.lat);
                        map.centerAndZoom(address, max);           // 初始化地图，设置中心点坐标和地图级别
                    }
                });
                var arr = scenicArr;
                var marArr = [];
                var index = 0;
                bdGEO();
                for (var i = 0; i < arr.length; i++) {
                    go(i);
                    function go(i) {
                        myGeo.getPoint(arr[i], function (point) {
                            if (point) {
                                var address = new BMap.Point(point.lng, point.lat);
                                var marker = new BMap.Marker(address);
                                map.addOverlay(marker);
                                marArr.push(address);
                                if(i == arr.length-1){
                                    setLine();
                                }
                            }
                        });
                    }

                }
                function bdGEO() //做到加载每一个景点
                {
                    var add = arr[index];
                    geocodeSearch(add);
                    index++;
                }
                function geocodeSearch(add) {
                    if (index < arr.length) {
                        setTimeout(window.bdGEO, 400);//如果缺少，for循环和地图加载异步，线程速度不一样，会造成只显示最后一个标注点。
                    }
                    myGeo.getPoint(add, function (point) {
                        if (point) {
                            var address = new BMap.Point(point.lng, point.lat);
                            addMarker(address, new BMap.Label(index + ":" + add, {offset: new BMap.Size(20, -10)}));
                        }
                    });
                }
                function addMarker(point, label) {
                    var marker = new BMap.Marker(point);
                    map.addOverlay(marker);
                    marker.setLabel(label);
                }
                function setLine() {
                    var polyline = new BMap.Polyline(marArr,
                        {strokeColor: "orange", strokeWeight: 4, strokeOpacity: 1}//设置属性
                    );
                    map.addOverlay(polyline);//跟polyline一块使用，添加上线
                }
            },
            showMap: function () {
                var _this=this;
                _this.showNum=this.routeMsg.count;
            },
            hideMap: function () {
                this.showNum=2;
            }
        }
    });
</script>

</html>