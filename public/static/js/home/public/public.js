$(function () {
   $.ajax({
       url:checkUrl,
       type:"get",
       async:false,
       dataType:"json",
       success:function (res) {
           //检查失败
           if(res["code"] != 10010 && res["code"] != 10011){
               layer.msg(res.msg);
               $(".loginIn").remove();
           }
           else if(res["code"] == 10011){
               //检查成功
               $(".nologin").remove();
                $(".loginIn").show();
                $(".uImg").attr("src",res["data"]["userImg"]);
                $(".toCenter").attr("href",res["data"]["userUrl"]);
           }
           else {
               $(".loginIn").remove();
           }
       }
   })
});


function checkLogin(errCallback,succCallback,noLCallback) {
    $.ajax({
        url:checkUrl,
        type:"get",
        async:false,
        dataType:"json",
        success:function (res) {
            //检查失败
            if(res["code"] != 10010 && res["code"] != 10011){
                if(errCallback!=null){
                    errCallback();
                }
            }
            else if(res["code"] == 10011){
                //检查成功
                if(succCallback!=null){
                    succCallback();
                }
            }
            else {
                if(noLCallback!=null){
                    noLCallback();
                }

            }
        }
    })
}



function loginOut() {
    layer.confirm('确定退出登录?', {icon: 3, title:'退出登录'}, function(index){
        //do something
        clearCookie("qy_uphone");
        location.reload();
        layer.close(index);
    });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+ ";path=/";
}
//获取cookie
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}
//清除cookie
function clearCookie(name) {
    setCookie(name, "", -1);
}

function getCookieVal(cookie_name)
{
    var allcookies = document.cookie;
    var cookie_pos = allcookies.indexOf(cookie_name);

// 如果找到了索引，就代表cookie存在，
// 反之，就说明不存在。
    if (cookie_pos != -1)
    {
// 把cookie_pos放在值的开始，只要给值加1即可。
        cookie_pos += cookie_name.length + 1;
        var cookie_end = allcookies.indexOf(";", cookie_pos);

        if (cookie_end == -1)
        {
            cookie_end = allcookies.length;
        }

        var value = unescape(allcookies.substring(cookie_pos, cookie_end));
    }

    return value;
}








function isNumberOrLetter(s)
{
    var regu = "^[a-zA-Z][0-9a-zA-Z\_]+$";   //判断是否是数字、字母、下划线组成，并以字母开头
    var re = new RegExp(regu);       //创建一个正则对象
    if (re.test(s))     //利用test方法校验
    {
        return true;
    }
    else{
        layer.msg('密码由数字、字母、下划线组成，并以字母开头');
        return false;
    }
}


//密码的正则
function isPassword(s){
    var reg=/^(?![^a-zA-Z]+$)(?!\D+$)/;
    if(reg.test(s)){
        return true;
    }else{
        layer.msg('密码必须为6-18位字母加数字');
        return false;
    }
}

//用户名验证
function checkUserName(s){
    var regName= /^[\da-zA-Z_\u4e00-\u9f5a]{4,16}$/;
    if (regName.test(s)) {
        return true;
    } else {
        layer.msg('请输入4到16位（包含中文,数字,字母和下划线）的用户名');
        return false;
    }
}


function samePwd(a,b){
    if(a==b){
        return true;
    }else{
        layer.msg('两次密码不一致');
        return false;
    }
}

//邮箱验证
function checkEmail(s)
{
    var myReg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
    if (myReg.test(s)) {
        return true;
    } else {
        layer.msg('请输入正确的邮箱');
        return false;
    }
}

//年龄验证
function checkAge(age)
{
    var regNum = /^[0-9]{1,2}$/;
    if (regNum.test(age)) {
        return true;
    }
    else {
        layer.msg('请输入正确的年龄');
        return false;
    }
}


