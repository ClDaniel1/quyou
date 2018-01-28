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
           }
           else if(res["code"] == 10011){
               //检查成功
               $("#userLoginZone").empty();
               var userZone = '<li class="layui-nav-item">' +
                   '            <a href="'+res["data"]["userUrl"]+'"><img src="'+res["data"]["userImg"]+'" class="layui-nav-img">我</a>' +
                   '            <dl class="layui-nav-child">' +
                   '                <dd><a href="">我的消息</a></dd>' +
                   '                <dd><a href="javascript:;">退出登录</a></dd>' +
                   '            </dl>' +
                   '        </li>';
               $("#userLoginZone").append(userZone);
           }
       }
   })
});