<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\AppServ\www\quyou\public/../application/home\view\login\login.html";i:1517043262;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>趣游登录</title>
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
        width: 270px;
        height: 40px;
        /*border-radius: 3px;*/
        margin: 16px 50px;
        text-align: center;
    }
    .logBtn{
        width: 250px;
        height: 48px;
        margin: 10px 60px;
        color: #F9851D;
    }
    .logBtn p{
        font-size: 25px;
        line-height: 45px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
    }
    #line{
        width: 100%;
        height: 1px;
        background: silver;
        margin: 16px 0;
    }

    #thirdParty{
        position: relative;
        text-align: center;
    }
    #thirdParty span{
        position: absolute;
        left: 7px;
        top: 6px;
        padding: 5px 0 10px 10px;
        font-size: 14px;
        color: #999;
    }

    .otherImg{
        width: 50px;
        height: 50px;
        margin: 25px 30px;
        cursor: pointer;
        color: yellow;
    }
    .otherItem{
        float: left;
        /*background-color: #00a0e9;*/
        margin-left: 12px;
        cursor: pointer;
    }
    .otherItem p{
        margin: -16px 0;
        font-size: 14px;
        color: #999;
    }

    .otherItem p:hover{
        color: black;
    }
    #goToReg{
        margin: 150px 0;
        /*background-color: #00a0e9;*/
    }
    #goToReg p{
        display: inline-block;
        font-size: 14px;
    }

    #codeImg{
        float: left;
        width: 120px;
        height: 40px;
        border: 1px solid #b2b2b2;
        border-radius: 4px;
    }
</style>
<body>
<div id="background">
    <div class="layui-container">
            <div id="center">
                <div id="logo">
                    <a href="<?php echo url('home/index/index'); ?>">
                        <img src="__STATIC__/images/logo1.png" alt="" style="margin: 30px 20px;height: 60px;">
                    </a>
                </div>
                <div id="loginBox">
                    <p><input id="uphone" type="text" class="am-form-field am-round logInput" value="1001" placeholder="您的手机号"/></p>
                    <p><input id="upwd" type="password" class="am-form-field am-round logInput" value="123123" placeholder="您的密码"/></p>
                    <div class="logInput">
                        <img id="codeImg" style="" src="<?php echo captcha_src(); ?>" alt="captcha" onclick="changeCode(this)"/>
                        <p><input id="code" style="width: 120px;height:40px;float: right;text-align: center" type="text" class="am-form-field am-round" placeholder="验证码"/></p>
                    </div>
                    <button id="loginBtn" class="layui-btn layui-btn-radius layui-btn-warm logBtn"><p>登&nbsp;&nbsp;录</p></button>
                    <div id="thirdParty">
                        <div id="line"></div>
                        <span>用合作网站账户直接登录</span>
                        <div>
                            <div class="otherItem">
                                <img class="otherImg" src="__STATIC__/images/weibo.png" alt="">
                                <p>新浪微博</p>
                            </div>
                            <div class="otherItem">
                                <img class="otherImg" src="__STATIC__/images/qq.png" alt="">
                                <p>QQ</p>
                            </div>
                            <div class="otherItem">
                                <img class="otherImg" src="__STATIC__/images/wechat.png" alt="">
                                <p>微信</p>
                            </div>
                        </div>
                        <div id="goToReg">
                            <p>还没有账号？</p>
                            <a href="<?php echo url('home/register/register'); ?>"><p>马上注册</p></a>
                        </div>
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
    var dologinUrl='<?php echo url("home/Login/doLogin"); ?>';
    var userCenterUrl='<?php echo url("home/index/index"); ?>';
    function changeCode(obj){
        $(obj).attr('src','<?php echo captcha_src(); ?>?'+Math.random());
    }

    $('#loginBtn').click(function(){
        var data={
          'uphone': $('#uphone').val(),
            'upwd': $('#upwd').val(),
            'code': $('#code').val()
        };
//        console.log(data);

        $.ajax({
            url:dologinUrl,
            data:data,
            dataType:'json',
            type:'post',
            success: function (res) {
                console.log(res);
//                console.log(json.stringify(res));
                if(res.code==10001){
                    layer.open({
                        content:res.msg,
                        yes: function(index, layero){
                            //do something
                            location.href=userCenterUrl;
                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                        }
                    });
                }else if(res.code==10003){    //账号密码错误
                    layer.msg(res.msg);
                }else if(res.code==10002){    //验证码错误
                    layer.msg(res.msg);
                }
            }
        });
    });


</script>
</html>