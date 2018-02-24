var redis = require("redis");

var client = redis.createClient();

var dataOper = require("dataOper");

client.on("error",function (err) {
    console.log(err);
});



//用户表key                    u+用户id
//订单表key                    o+用户id
//地址表key                    a+用户id
//商品表+秒杀时段key   t+商品id

//存用户信息  定时3s
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
setInterval(function () {
    dataOper.user.getAll(function (res,data) {
        console.log(res);
        if(res){
            for(var i =0;i < data.length;i++){
                var key = "u"+data[i].userPhone;
                var value = JSON.stringify(data[i]);
                client.set(key,value,redis.print);
                dataOper.address.getUserAddress(data[i].userPhone,function (data) {
                    if(data.length>0){
                        var keya = 'a'+data[0].userPhone;
                        var value = JSON.stringify(data);
                        client.set(keya,value,redis.print);
                    }
                });
                dataOper.order.getUserOrder(data[i].userPhone,function (data) {
                    if(data.length>0){
                        var keyb = 'o'+data[0].userPhone;
                        var value = JSON.stringify(data);
                        client.set(keyb,value,redis.print);
                    }
                })
            }
        }
    });
},3000);

//存商品和秒杀时段 定时3s
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
setInterval(function () {
    dataOper.trade.getAllandTime(function (res,data) {
        if(res){
            for(var i =0;i < data.length;i++){
                var key = "t"+data[i].tradeId;
                var value = JSON.stringify(data[i]);
                client.set(key,value,redis.print);
            }
        }
    });
},3000);

//将商品信息写回数据库 定时0.5s
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
setInterval(function () {
    client.lpop("myTrade", function (err,values) {
        if(err){}
        else{
            if(values!=null){
                var value = JSON.parse(values);
                var tradeId = value.tradeId;
                var tradeInventory = value.tradeInventory;
                dataOper.trade.fromredis(tradeInventory,tradeId);
            }
        }
    });
},500);

//将订单信息写回数据库 定时0.5s
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
setInterval(function () {
    client.lpop("myOrder", function (err,values) {
        if(err){}
        else{
            if(values!=null){
                var value = JSON.parse(values);
                var userPhone = value.userPhone;
                dataOper.order.fromredis(value,function () {
                    dataOper.order.getUserOrder(userPhone,function (data) {
                        if(data.length>0){
                            var keya = 'o'+data[0].userPhone;
                            var value = JSON.stringify(data);
                            client.set(keya,value,redis.print);
                        }
                    });
                });
            }
        }
    });
},500);

