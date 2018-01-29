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