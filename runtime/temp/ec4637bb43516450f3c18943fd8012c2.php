<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\wamp64\www\quyou\QY\public/../application/home\view\register\register.html";i:1516880765;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>趣游注册</title>
</head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="icon" href="__STATIC__/images/logo.png" type="image/x-icon"/>
<link rel="stylesheet" href="__STATIC__\lib\layui\css\layui.css">
<link rel="stylesheet" href="__CSS__\home\public\public.css">
<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.css">
<style>
    #background{
        /*background-image: url("https://api.i-meto.com/bing?type=T");*/
        background-image: url("https://images.mafengwo.net/images/signup/wallpaper/27.jpg");
        background-position: 50% 50%;
        background-size: cover;
        bottom: 0;
        right: 0;
        position: fixed;
        overflow: hidden;
        left: 0;
        top: 0;
        background-color: #F9851D;
    }

    #logo{
        margin: 0 auto;
        width: 180px;
        height: 72px;
    }

    #center{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 380px;
        height: 100%;
    }

    #loginBox{
        margin: 35px 0;
        width: 380px;
        height: 500px;
        padding-top: 26px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 3px 3px rgba(0,0,0,.4);
        border: 1px solid #b1b1b1;
    }
    .logInput{
        width: 250px;
        height: 36px;
        /*border-radius: 3px;*/
        margin: 5px 60px;
        font-size:14px;
        text-align: center;
    }
    .logBtn{
        width: 250px;
        height: 36px;
        margin: 10px 60px;
        color: #F9851D;
    }
    .logBtn p{
        font-size: 20px;
        line-height: 33px;
        color: #fff;
        /*font-weight: bold;*/
        cursor: pointer;
    }

    #thirdParty span{
        position: absolute;
        left: 7px;
        top: 6px;
        padding: 5px 0 10px 10px;
        font-size: 14px;
        color: #999;
    }

    #goToLog{
        margin: -28px 110px;
        /*background-color: #00a0e9;*/
    }
    #goToLog p{
        display: inline-block;
        font-size: 14px;
    }
    #regFrom{
        margin: 40px 0;

    }
    #title{
        height: 56px;
        background-color: #F5F5F5;
        border-bottom: 1px solid #D8D8D8;
        line-height: 56px;
        font-size: 18px;
        color: #666;
        padding: 0 26px;
        border-radius: 5px 5px 0 0;
        text-align: left;
        margin: -25px 0;
    }
    .codeImg{
        float: left;
        width: 120px;
        height: 36px;
        border: 1px solid #b2b2b2;
        text-align: center;
        background: -webkit-gradient(linear,0 0,0 100%,from(#fff),to(#f2f2f2));
        border-radius: 4px;
        line-height: 34px;
    }
    .codeImg p{
        color: #8e8e8e;
        font-size: 14px;
    }



</style>
<body>
<!--amzUI-->
<div id="background">
    <div class="layui-container">
        <div id="center">
            <div id="logo">
                <a href="<?php echo url('home/index/index'); ?>">
                    <img src="__STATIC__/images/logo1.png" alt="" style="margin: 30px 20px;height: 60px;">
                </a>
            </div>
            <div id="loginBox">
                <div id="title">
                    账号注册
                </div>
                <div id="regFrom">
                    <p><input id="uphone" type="text" class="am-form-field am-round logInput" placeholder="您的账号/手机号"/></p>
                    <p><input id="uname" type="text" class="am-form-field am-round logInput" placeholder="您的昵称"/></p>
                    <p><input id="upwd" type="text" class="am-form-field am-round logInput" placeholder="您的密码"/></p>
                    <p><input id="repwd" type="text" class="am-form-field am-round logInput" placeholder="确认密码"/></p>
                    <div class="logInput">
                        <p><input id="code"  style="width: 120px;float: right;font-size:14px;height: 36px;text-align: center" type="text" class="am-form-field am-round" placeholder="验证码"/></p>
                        <img class="codeImg" style="height: 38px" src="<?php echo captcha_src(); ?>" alt="captcha" onclick="changeCode(this)"/>
                    </div>
                    <div class="logInput">
                        <button class="codeImg" type="button" class="am-btn am-btn-default"><p>免费获取验证码</p></button>
                        <p><input  style="width: 120px;float: right;font-size:14px;height: 36px;text-align: center" type="text" class="am-form-field am-round" placeholder="短信验证码"/></p>
                    </div>
                    <button id="regBtn" class="layui-btn layui-btn-radius layui-btn-warm logBtn"><p>注&nbsp;&nbsp;册</p></button>
                </div>
                <div id="goToLog">
                    <p>已经有账号？</p>
                    <a href="<?php echo url('home/login/login'); ?>"><p>马上登录</p></a>
                </div>
            </div>
        </div>

    </div>



</div>
</body>
<script src="__STATIC__\lib\layui\layui.all.js"></script>
<script src="__STATIC__\lib\jquery-3.2.1.js"></script>
<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.js"></script>
<script>
    var doRegUrl='<?php echo url("home/Register/doRegister"); ?>';

    function changeCode(obj){
        $(obj).attr('src','<?php echo captcha_src(); ?>?'+Math.random());
    }

    $('#regBtn').click(function () {
        var uphone=$('#uphone').val();
        var uname=$('#uname').val();
        var upwd=$('#upwd').val();
        var repwd=$('#repwd').val();
        var code=$('#code').val();
        console.log(code);
        $.ajax({
            url:doRegUrl,
            data:{uphone:$uphone,uname:uname,upwd:$upwd,code:$code},
            dataType:'json',
            type:'post',

            success: function (res){

                console.log(res);
                if(res.code==10002){
                    layer.msg(res.msg);
                }










            }



        })








    })






</script>
</html>