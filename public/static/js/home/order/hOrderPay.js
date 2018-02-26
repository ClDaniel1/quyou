/**
 * Created by Administrator on 2018/2/24.
 */
$(function () {
   $(".payBtn").click(function () {
       layui.use('layer', function(){
           var layer = layui.layer;
           layer.prompt({
               formType: 1,
               value: '',
               title: '请输入支付密码'
           }, function(value,index){
               layer.close(index);
               $.ajax({
                   type:"post",
                   url:payUrl,
                   data:{pwd:value,price:price,orderId:hotelId},
                   dataType:"json",
                   success: function (res) {
                       console.log(res);
                       if(res.code==60004)
                       {
                           layer.msg(res.msg, {icon: 5});
                       }
                       else if(res.code==60005)
                       {
                           layer.msg(res.msg, {icon: 5});
                       }
                       else if(res.code==60006)
                       {
                           layer.msg(res.msg, {icon: 6,time: 2000}, function () {
                               window.location.href=hrefUrl+"orderId="+hotelId+"";
                           });
                       }
                       else if(res.code==19000)
                       {
                           layer.msg(res.msg, {icon: 5});
                       }
                   },error: function (res) {
                       console.log(res);
                   }
               });

           });

       });
   })
});