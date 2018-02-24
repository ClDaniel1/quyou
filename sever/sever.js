var dataOper = require("dataOper");
var ws = require("ws");
var Sever = ws.Server;
var sever = new Sever({port:"8808"});

var redis = require("redis");
var client = redis.createClient();

var userArr = [];
var vistorArr = [];
var customerArr = [];
var customerChatArr = [];
var littleQChatArr = [];
var customerOnline = [];

dataOper.visitorChatRecord.clear();

sever.on("connection",function (socket) {
    console.log("连接成功");
    socket.on("message",function (msg) {
        var remsg = '';
        msg = JSON.parse(msg);
        //首页加载完成
        if(msg.type == 'indexReady'){
            if(msg.content != ''){
                if(msg.content.type == 'visitor'){
                    vistorArr[msg.content.id] = socket;
                }
                else{
                    userArr[msg.content.id] = socket;
                }
            }
            remsg = {
                sender:'server',
                receiver:'client',
                type:'indexRes',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(socket.readyState==ws.OPEN){
                socket.send(JSON.stringify(remsg));
            }
        }
        //有用户登录
        else if(msg.type == 'haveuserlogin'){

                    if(msg.content.type == 'visitor'){
                        vistorArr[msg.content.id] = socket;
                    }
                    else{

                                userArr[msg.content.id] = socket;

                    }


            }
        //商品详情加载完成
        else if(msg.type == 'detailsReady'){
            remsg = {
                sender:'server',
                receiver:'client',
                type:'detailsRes',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(socket.readyState==ws.OPEN){
                socket.send(JSON.stringify(remsg));
            }

        }
        else if(msg.type == 'getCosOnline'){
            remsg = {
                sender:'server',
                receiver:'client',
                type:'getCosOnlineRES',
                content:customerOnline,
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(socket.readyState==ws.OPEN){
                socket.send(JSON.stringify(remsg));
            }
        }
      /*  //个人中心加载完成
        else if(msg.type == 'centerReady'){
            if(msg.content != ''){
                if(msg.content.type == 'visitor'){
                    vistorArr[msg.content.id] = socket;
                }
                else{
                    userArr[msg.content.id] = socket;
                }
            }
            remsg = {
                sender:'server',
                receiver:'client',
                type:'centerRes',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(socket.readyState==ws.OPEN){
                socket.send(JSON.stringify(remsg));
            }
        }
        //注册检查用户名
        else if(msg.type == 'checkUserPhone'){
            var userPhone = msg.content;
            var remsg = {
                sender:'server',
                receiver:'client',
                type:'checkUserPhoneRES',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            dataOper.user.checkUserPhone(userPhone,function (res) {
                if(res){
                    remsg.content = true;
                }
                else {
                    remsg.content = false;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            });
        }
        //登录
        else if(msg.type == 'login'){
            var userPhone = msg.content.user;
            var psw = msg.content.psw;
            psw = md5(psw);
                remsg = {
                sender:'server',
                receiver:'client',
                type:'loginRES',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            dataOper.user.login(userPhone,psw,function (res,userTop) {
                if(res){
                    var username = userTop.userName;
                    remsg.content = {res:true,userTop:userTop};
                    userArr[userPhone] = socket;
                    if(msg.content.vistorId != undefined){
                        dataOper.visitorChatRecord.move(msg.content.vistorId,userPhone,username);
                    }
                }
                else {
                    remsg.content = {res:false};
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }
        //注册
        else if(msg.type == 'sign'){
            var userPhone = msg.content.user;
            var psw = msg.content.psw;
            var safetyCode = parseInt(Math.random()*99999999999);
            psw = md5(psw);
            var nickname = msg.content.nickname;
            remsg = {
                sender:'server',
                receiver:'client',
                type:'signRES',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            dataOper.user.sign(userPhone,psw,nickname,safetyCode,function (res) {
                if(res){
                    if(msg.content.vistorId!=undefined){
                        dataOper.visitorChatRecord.move(msg.content.vistorId,userPhone,nickname);
                    }
                    remsg.content = true;
                    dataOper.user.getUserInfo(userPhone,function (data) {
                        var key = "u"+userPhone;
                        var value = JSON.stringify(data[0]);
                        client.set(key,value);
                    })
                }
                else {
                    remsg.content = false;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }*/
        //秒杀时间段
        else if(msg.type == 'sk'){
            remsg = {
                sender:'server',
                receiver:'client',
                type:'skRES',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            var all = '';
            dataOper.time.getAll(function (data) {
                all = data;
                var nowHour = new Date().getHours();
                var nowId = '';
                dataOper.time.getNowId(nowHour,function (res,data) {
                    if(res){
                        nowId = data;
                    }
                    else {
                        if(nowHour<all[0].skStartTime){
                            nowId = 'all';
                        }
                        else {
                            nowId = 'none';
                        }
                    }
                    dataOper.order.latelyOrder(function (res,data) {
                        if(res){
                            remsg.content = {
                                all:all,
                                nowId:nowId,
                                lastOrder:data
                            };
                            if(socket.readyState==ws.OPEN){
                                socket.send(JSON.stringify(remsg));
                            }
                        }
                    })
                });
            });
        }
        //商品分类
        else if(msg.type == 'classify'){
            remsg = {
                sender:'server',
                receiver:'client',
                type:'classifyRES',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            dataOper.tradeClassify.getClassify(function (data) {
                    remsg.content = data;
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                    }
                });
            }
        //获取时间段商品
        else if(msg.type == 'getTrade'){
            if(msg.content.classify == undefined){
                dataOper.trade.getTradeByTime(msg.content.timeid,function (data) {
                    remsg = {
                        sender:'server',
                        receiver:'client',
                        type:'getTradeRES',
                        content:data,
                        msgid:1,
                        msgtime:(new Date()).getTime()
                    };
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                    }
                })
            }
            else{
                dataOper.trade.getTradeByTimeC(msg.content.timeid,msg.content.classify,function (data) {
                    remsg = {
                        sender:'server',
                        receiver:'client',
                        type:'getTradeRES',
                        content:data,
                        msgid:1,
                        msgtime:(new Date()).getTime()
                    };
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                    }
                })
            }

        }
        //获取商品详情
        else if(msg.type == 'getTradeInfo'){
            var buyNum = 0;
            function getTradeInfo() {
                dataOper.trade.getTradeByID(msg.content,function (data) {
                    var tradeInfo = data;
                    dataOper.tradePhoto.getPhoto(msg.content,function (data) {
                        var tradeImg = data;
                        dataOper.time.getAll(function (data) {
                            var alltime = data;
                            var nowhour = new Date().getHours();
                            dataOper.time.getNow(nowhour,function (res,data) {
                                var nowtime = '';
                                if(res){
                                    nowtime = data;
                                }
                                else {
                                    if (nowhour < alltime[0].skStartTime){
                                        nowtime = 'all';
                                    }
                                    else {
                                        nowtime = 'none'
                                    }
                                }
                                if(tradeInfo.length > 0){
                                    var tradeid = tradeInfo[0].tradeId;
                                    dataOper.comment.getComment(tradeid,function (res,data) {
                                        if(res){
                                            var comment = data;
                                            dataOper.order.getTradeOrder(tradeid,function (data) {
                                                var noworder = data;
                                                remsg = {
                                                    sender:'server',
                                                    receiver:'client',
                                                    type:'getTradeInfoRES',
                                                    content:{tradeInfo:tradeInfo,tradeImg:tradeImg,alltime:alltime,nowtime:nowtime,comment:comment,order:noworder},
                                                    msgid:1,
                                                    msgtime:(new Date()).getTime()
                                                };
                                                if(buyNum != 0){
                                                    remsg.content = {tradeInfo:tradeInfo,tradeImg:tradeImg,alltime:alltime,nowtime:nowtime,comment:comment,order:noworder,buyNum:buyNum}
                                                }
                                                if(socket.readyState==ws.OPEN){
                                                    socket.send(JSON.stringify(remsg));
                                                }
                                            })
                                        }
                                    });
                                }

                            })

                        });
                    })
                })
            }
            if(msg.sender == 'client'){
                getTradeInfo();
            }
            else {
                var year = new Date().getFullYear();
                var mon = new Date().getMonth()+1;
                var day = new Date().getDate();
                if(mon < 10){
                    mon = '0'+mon;
                }
                if(day < 10){
                    day= '0'+day;
                }
                dataOper.order.getbuyNum(year,mon,day,msg.sender,msg.content,function (res,data) {
                    if(res){
                        if(data.length>0){
                            for(var i = 0;i < data.length;i++){
                                buyNum = buyNum + parseInt(data[i].orderBuyNum);
                            }
                        }
                        getTradeInfo();
                    }
                })
            }
        }
        /*//用户中心信息获取
        else if(msg.type == 'userCenter'){
            var userPhone = msg.content;
            dataOper.user.getUserInfo(userPhone,function (data) {
                var userInfo = data;
                dataOper.order.getUserOrder(userPhone,function (data) {
                    var userOrder = data;
                    dataOper.address.getUserAddress(userPhone,function (data) {

                        var userAddress = data;
                        dataOper.chatRecord.getRecord(userPhone,function (res,data) {
                            if(res){
                                var userChatHisotry = data;
                                var remsg = {
                                    sender:'server',
                                    receiver:'client',
                                    type:'userCenterRES',
                                    content:{userInfo:userInfo,userOrder:userOrder,userAddress:userAddress,userChatHisotry:userChatHisotry},
                                    msgid:1,
                                    msgtime:(new Date()).getTime()
                                };
                                if(socket.readyState==ws.OPEN){
                                    socket.send(JSON.stringify(remsg));
                                }
                            }
                        });
                    })
                })
            })
        }
        //充值
        else if(msg.type == 'getMoney'){
            var userPhone =msg.content.user;
            var money = parseInt(msg.content.money);
            dataOper.user.getMoney(userPhone,money,function (res,data) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'getMoneyRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };

                if(res){
                    dataOper.user.getUserInfo(userPhone,function (data) {
                        var key = 'u'+userPhone;
                        var value = JSON.stringify(data[0]);
                        client.set(key,value);
                    });
                    remsg.content = {res:true,money:data};
                }
                else {
                    remsg.content =  {res:false,money:data};
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }
        //修改昵称
        else if(msg.type == 'changeNickname'){
            var userPhone = msg.content.user;
            var nickName = msg.content.nickname;
            dataOper.user.changeNickname(userPhone,nickName,function (res) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'changeNicknameRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(res){
                    dataOper.user.getUserInfo(userPhone,function (data) {
                        var key = 'u'+userPhone;
                        var value = JSON.stringify(data[0]);
                        client.set(key,value);
                    });
                    remsg.content = {res:true,nickname:nickName};
                }
                else {
                    remsg.content =  {res:false,nickname:nickName};
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }
        //修改密码
        else if(msg.type == 'changePassword'){
            var userPhone = msg.content.user;
            var psw = msg.content.psw;
            psw = md5(psw);
            dataOper.user.changePassword(userPhone,psw,function (res) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'changePasswordRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };

                if(res){
                    dataOper.user.getUserInfo(userPhone,function (data) {
                        var key = 'u'+userPhone;
                        var value = JSON.stringify(data[0]);
                        client.set(key,value);
                    });
                    remsg.content = true;
                }
                else {
                    remsg.content =  false;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }*/
        //删除地址
        else if(msg.type == 'delAddress'){
            var addressid = msg.content.addressid;
            var userPhone = msg.content.user;
            dataOper.address.delAddress(userPhone,addressid,function (res) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'delAddressRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(res){
                    dataOper.address.getUserAddress(userPhone,function (data) {
                        var key = 'a'+userPhone;
                        var value = JSON.stringify(data);
                        if(data.length <=0){
                            client.del(key);
                        }
                        else{
                            client.set(key,value);
                        }
                    });
                    remsg.content = {res:true,addressid:addressid};
                }
                else {
                    remsg.content = {res:true,addressid:addressid};
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }
        //设置默认地址
        else if(msg.type == 'defaultAddress'){
            var addressid = msg.content.addressid;
            var userPhone = msg.content.user;
            dataOper.address.changeDefault(userPhone,addressid,function (res) {
                console.log(res);
                if(res){
                    var remsg = {
                        sender:'server',
                        receiver:'client',
                        type:'defaultAddressRES',
                        content:'',
                        msgid:1,
                        msgtime:(new Date()).getTime()
                    };
                    if(res){
                        dataOper.address.getUserAddress(userPhone,function (data) {
                            var key = 'a'+userPhone;
                            var value = JSON.stringify(data);
                            if(data.length <=0){
                                client.del(key);
                            }
                            else{
                                client.set(key,value);
                            }
                        });
                        remsg.content =true;
                    }
                    else {
                        remsg.content =false;
                    }
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                    }
                }
            })
        }
        //添加地址
        else if(msg.type == 'addAddress'){
            var userPhone = msg.content.user;
            var receiverName = msg.content.receiverName;
            var receiverPhone = msg.content.receiverPhone;
            var addressName = msg.content.addressName;
            dataOper.address.addAddress(userPhone,receiverName,receiverPhone,addressName,function (res) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'addAddressRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(res){
                    dataOper.address.getUserAddress(userPhone,function (data) {
                        var key = 'a'+userPhone;
                        var value = JSON.stringify(data);
                        if(data.length <=0){
                            client.del(key);
                        }
                        else{
                            client.set(key,value);
                        }
                    });
                    remsg.content = true;
                }
                else {
                    remsg.content = false;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }
        else if(msg.type == 'addAddresscheck'){
            var userPhone = msg.content.user;
            var receiverName = msg.content.receiverName;
            var receiverPhone = msg.content.receiverPhone;
            var addressName = msg.content.addressName;
            dataOper.address.addAddress(userPhone,receiverName,receiverPhone,addressName,function (res) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'addAddresscRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(res){
                    dataOper.address.getUserAddress(userPhone,function (data) {
                        var key = 'a'+userPhone;
                        var value = JSON.stringify(data);
                        if(data.length <=0){
                            client.del(key);
                        }
                        else{
                            client.set(key,value);
                        }
                    });
                    remsg.content = true;
                }
                else {
                    remsg.content = false;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }
        //修改地址
        else if(msg.type == 'changeAddress'){
            var addressId = msg.content.addressId;
            var receiverName = msg.content.receiverName;
            var receiverPhone = msg.content.receiverPhone;
            var addressName = msg.content.addressName;
            dataOper.address.changeAddress(addressId,receiverName,receiverPhone,addressName,function (res) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'changeAddressRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(res){
                    dataOper.address.getUserAddress(userPhone,function (data) {
                        var key = 'a'+userPhone;
                        var value = JSON.stringify(data);
                        if(data.length <=0){
                            client.del(key);
                        }
                        else{
                            client.set(key,value);
                        }
                    });
                    remsg.content = true;
                }
                else {
                    remsg.content = false;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })
        }
        /*//评论
        else if(msg.type == 'comment'){
            var user = msg.content.user;
            var orderId = msg.content.orderId;
            var comment = msg.content.comment;
            var tradeId = msg.content.tradeId;
            dataOper.comment.addComment(user,orderId,comment,tradeId,function (res) {
                var remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'commentRES',
                    content:res,
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            })

        }*/
        //游客消息
        else if(msg.type == 'visitorMessage'){
            if(msg.sender == 'visitor'){
                var i = vistorArr.length;
                vistorArr[i] = socket;
                remsg = {
                    sender:'littleQ',
                    receiver:i,
                    type:'Message',
                    content:{vistorId:i,tips:["系统已将你重命名为游客"+i],message:"你好呀，我是小Q，你可以问我比如\"我的订单\",\"我的收货地址\"之类的问题哦，也可以输入\"人工\"转到人工客服",headImg:"public/image/headImg/LQ.jpeg",name:"小Q"},
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                littleQChatArr.push("v"+i);
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            }
            else{
                vistorArr[msg.sender] = socket;
                if(msg.content != ""){
                    dataOper.visitorChatRecord.addRecord(msg.sender,msg.receiver,JSON.stringify(msg));
                }
                if(msg.receiver == 'littleQ'){
                    littleQ(msg.content,msg.sender,'visitor',socket);
                }
                else{
                    if( customerArr[msg.receiver]!= undefined && customerArr[msg.receiver].readyState==ws.OPEN){
                        customerArr[msg.receiver].send(JSON.stringify(msg));
                    }
                    else{
                        for(var a=0;a < customerChatArr.length;a++){
                            if(customerChatArr[i] == "v"+msg.sender){
                                customerChatArr.splice(i,1);
                                littleQChatArr.push("v"+msg.sender);
                                break;
                            }
                        }
                         remsg= {
                            sender:'littleQ',
                            receiver:msg.sender,
                            type:'customerOffline',
                            content:{tips:["当前客服已离线"]},
                            msgid:1,
                            msgtime:(new Date()).getTime()
                        };
                        socket.send(JSON.stringify(remsg));
                        remsg.content = {message:"你好呀，小Q又回来为您服务啦",headImg:"public/image/headImg/LQ.jpeg",name:"小Q"};
                        socket.send(JSON.stringify(remsg));

                    }

                }
            }
        }
        //用户消息
        else if(msg.type == 'userMessage'){
            userArr[msg.sender] = socket;
            if(msg.content != ""){
                dataOper.chatRecord.addRecord(msg.sender,msg.receiver,JSON.stringify(msg));
            }
            if(msg.receiver == 'littleQ'){
                littleQ(msg.content,msg.sender,'user',socket);
            }
            else{
                if(customerArr[msg.receiver]!= undefined && customerArr[msg.receiver].readyState==ws.OPEN){
                    customerArr[msg.receiver].send(JSON.stringify(msg));
                }
                else{
                    for(var a=0;a < customerChatArr.length;a++){
                        if(customerChatArr[i] == "v"+msg.sender){
                            customerChatArr.splice(i,1);
                            littleQChatArr.push("v"+msg.sender);
                            break;
                        }
                    }
                    remsg= {
                        sender:'littleQ',
                        receiver:msg.sender,
                        type:'customerOffline',
                        content:{tips:["当前客服已离线"]},
                        msgid:1,
                        msgtime:(new Date()).getTime()
                    };
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                    }
                    remsg.content = {message:"你好呀，小Q又回来为您服务啦",headImg:"public/image/headImg/LQ.jpeg",name:"小Q"};
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                    }

                }
            }
        }
        //用户客户端关闭
        else if(msg.type == 'close'){
            var isl = 0;
            var idx = '';
            if(msg.content == 'visitor'){
                idx = "v"+msg.sender;
                vistorArr.splice(msg.sender,1);
            }
            else{
                idx = "u"+msg.sender;
                userArr.splice(msg.sender,1);
            }
            for(var i = 0;i < littleQChatArr.length;i++){
                    if(littleQChatArr[i] == idx){
                        isl = 1;
                        littleQChatArr.splice(i,1);
                        break;
                    }
            }
            if(isl == 0){
                for(var i = 0;i < customerChatArr.length;i++){
                    if(customerChatArr[i] == idx){
                        isl = 2;
                        customerChatArr.splice(i,1);
                        break;
                    }
                }
            }
            if(isl == 2){
                remsg = {
                    sender:msg.sender,
                    receiver:'cus',
                    type:'userOffline',
                    content:{userType:msg.content},
                    msgid:1,
                    msgtime:(new Date()).getTime()
                }
            }
            for(var i in customerArr){
                if(customerArr[i].readyState==ws.OPEN){
                    customerArr[i].send(JSON.stringify(remsg));
                }

            }

        }
        //客服登录
        else if(msg.type == 'customerLogin'){
            var customerId = msg.content.customerId;
            var customerName = msg.content.customerName;
            customerArr[customerId] = socket;
            customerOnline[customerId] = customerName;
        }
        //获取聊天记录
        else if(msg.type== 'getRecord'){
            var chatmsg = {
                sender:msg.content.userId,
                receiver:msg.sender,
                type:'chatHistory',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(msg.content.userType == 'visitor'){
                dataOper.visitorChatRecord.getRecord(msg.content.userId,function (res,data) {
                    if(res){
                        chatmsg.content = data;
                    }
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(chatmsg));
                    }
                });
            }
            else{
                dataOper.chatRecord.getRecord(msg.content.userId,function (res,data) {
                    if(res){
                        chatmsg.content = data;
                    }
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(chatmsg));
                    }
                });
            }
        }
        //给游客的消息
        else if(msg.type == 'tovMessage'){
            dataOper.visitorChatRecord.addRecord(msg.sender,msg.receiver,JSON.stringify(msg));
            msg.type = 'Message';
            if(vistorArr[msg.receiver] != undefined && vistorArr[msg.receiver].readyState==ws.OPEN){
                console.log(123);
                vistorArr[msg.receiver].send(JSON.stringify(msg));
            }
        }
        //给用户的消息
        else if(msg.type == 'touMessge'){
            dataOper.chatRecord.addRecord(msg.sender,msg.receiver,JSON.stringify(msg));
            msg.type = 'Message';
            if(userArr[msg.receiver] != undefined && userArr[msg.receiver].readyState==ws.OPEN){
                userArr[msg.receiver].send(JSON.stringify(msg));
            }
        }
        //客服客户端关闭
        else if(msg.type == 'cusclose'){
            customerArr.splice(msg.content,1);
            customerOnline.splice(msg.content,1);
        }
        //链接客服
        else if(msg.type == 'clientLink'){
            if(msg.sender == 'visitor'){
                var i = vistorArr.length;
                vistorArr[i] = socket;
                remsg = {
                    sender:'littleQ',
                    receiver:i,
                    type:'Message',
                    content:{vistorId:i,tips:["系统已将你重命名为游客"+i]},
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                customerChatArr.push("v"+i);
                socket.send(JSON.stringify(remsg));

                msg.sender = i;
                msg.content.name = "游客"+i;
                if(customerArr[msg.receiver] != undefined && customerArr[msg.receiver].readyState==ws.OPEN){
                    customerArr[msg.receiver].send(JSON.stringify(msg));
                    var remsg = {
                        sender:msg.receiver,
                        receiver:msg.sender,
                        type:'connectCustomer',
                        content:{tips:["已为您连接客服"]},
                        msgid:1,
                        msgtime:(new Date()).getTime()
                    };
                    socket.send(JSON.stringify(remsg));
                }
            }
            else{
                var chatmsg = {
                    sender:'sever',
                    receiver:msg.sender,
                    type:'chatHistory',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                var arrname = '';
                var userType = msg.content.type;
                if(userType == 'visitor'){
                    arrname = "v"+msg.sender;
                    dataOper.visitorChatRecord.getRecord(msg.sender,function (res,data) {
                        if(res){
                            chatmsg.content = data;
                        }
                        socket.send(JSON.stringify(chatmsg));
                        if(customerArr[msg.receiver] != undefined && customerArr[msg.receiver].readyState==ws.OPEN){
                            customerArr[msg.receiver].send(JSON.stringify(msg));
                            var remsg = {
                                sender:msg.receiver,
                                receiver:msg.sender,
                                type:'connectCustomer',
                                content:{tips:["已为您连接客服"]},
                                msgid:1,
                                msgtime:(new Date()).getTime()
                            };
                            socket.send(JSON.stringify(remsg));
                        }
                    });
                }
                else {
                    arrname = "u"+msg.sender;
                    dataOper.chatRecord.getRecord(msg.sender,function (res,data) {
                        if(res){
                            chatmsg.content = data;
                        }
                        socket.send(JSON.stringify(chatmsg));
                        if(customerArr[msg.receiver] != undefined && customerArr[msg.receiver].readyState==ws.OPEN){
                            customerArr[msg.receiver].send(JSON.stringify(msg));
                            var remsg = {
                                sender:msg.receiver,
                                receiver:msg.sender,
                                type:'connectCustomer',
                                content:{tips:["已为您连接客服"]},
                                msgid:1,
                                msgtime:(new Date()).getTime()
                            };
                            socket.send(JSON.stringify(remsg));
                        }
                    });
                }

                customerChatArr.push(arrname);
            }


        }
        //取消订单
        else if(msg.type == 'escOrder'){
            var orderId = msg.content.orderid;
            var userPhone = msg.content.userPhone;
            var tradeId =msg.content.tradeId;
            var orderNum = msg.content.orderBuyNum;
            dataOper.order.timeOut(orderId,function () {
                dataOper.order.getUserOrder(userPhone,function (data) {
                    var key = 'o'+userPhone;
                    var value = JSON.stringify(data);
                    client.set(key,value);
                    dataOper.order.timeOut(orderId);
                    client.get("t"+tradeId,function (err,data) {
                        if(err == undefined){
                            var tradeInfo = JSON.parse(data);
                            tradeInfo.tradeInventory = parseInt(tradeInfo.tradeInventory) + parseInt(orderNum);
                            client.set("t" + tradeId, JSON.stringify(tradeInfo));
                            client.rpush("myTrade", JSON.stringify(tradeInfo));
                        }
                    })
                });
                remsg = {
                    sender:'server',
                    receiver:'client',
                    type:'escOrderRES',
                    content:'',
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(msg.content.click!=undefined){
                    remsg.content = {click:''}
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            });
        }
        //秒杀
        else if(msg.type == 'buyTrade'){
            var userPhone = msg.content.userPhone;
            var safetyCode = msg.content.safetyCode;
            var tradeId = msg.content.tradeId;
            var num = msg.content.num;
            var tradeInfo = '';
            var userInfo = '';
            var userOrder ='';
            var userAddress = '';
            var remsg = {
                sender:'sever',
                receiver:userPhone,
                type:'buyRES',
                content:{res:false,message:"秒杀失败，请重新登录后重试"},
                msgid:1,
                msgtime:(new Date()).getTime()
            };


                if(userArr[userPhone]!=undefined){
                    client.get("t"+tradeId,function (err,data) {
                        if(err == undefined){
                            tradeInfo = JSON.parse(data);
                            client.get("u"+userPhone,function (err,data) {
                                if(err == undefined){
                                    userInfo = JSON.parse(data);
                                    client.get("o"+userPhone,function (err,data) {
                                        if(err == undefined){
                                            userOrder = JSON.parse(data);
                                            client.get("a"+userPhone,function (err,data) {
                                                if(err == undefined){
                                                    userAddress = JSON.parse(data);
                                                    if (tradeInfo == null || userInfo == null || tradeInfo == '' || userInfo == '') {
                                                        if (socket.readyState == ws.OPEN) {
                                                            socket.send(JSON.stringify(remsg));
                                                            remsg.type = 'detailsRes';
                                                            remsg.content = '';
                                                            if (socket.readyState == ws.OPEN) {
                                                                socket.send(JSON.stringify(remsg));
                                                            }
                                                        }
                                                    }
                                                    else {
                                                        //判断用户信息是否匹配
                                                        if(userInfo.userPhone == userPhone && userInfo.safetyCode == safetyCode) {
                                                            //判断是否有默认地址
                                                            if (userAddress == null || userAddress == '' || userAddress.length <= 0) {

                                                                remsg.content = {res:false,message:"秒杀失败，请先设置默认收货地址",con:"1"};
                                                                if (socket.readyState == ws.OPEN) {
                                                                    socket.send(JSON.stringify(remsg));
                                                                    remsg.type = 'detailsRes';
                                                                    remsg.content = '';
                                                                    if (socket.readyState == ws.OPEN) {
                                                                        socket.send(JSON.stringify(remsg));
                                                                    }
                                                                }
                                                            }
                                                            else {
                                                                //判断是否在秒杀时段
                                                                var nowHour = new Date().getHours();
                                                                var tradeStart = tradeInfo.skStartTime;
                                                                var tradeEnd = tradeInfo.skEndTime;
                                                                if (tradeStart <= nowHour && tradeEnd > nowHour) {
                                                                    //判断限购数量
                                                                    var year = new Date().getFullYear();
                                                                    var mon = new Date().getMonth() + 1;
                                                                    var day = new Date().getDate();
                                                                    if (mon < 10) {
                                                                        mon = '0' + mon;
                                                                    }
                                                                    if (day < 10) {
                                                                        day = '0' + day;
                                                                    }
                                                                    var date = year + "-" + mon + "-" + day;
                                                                    var todaybuynum = 0;
                                                                    if (userOrder != '' && userOrder != null && userOrder.length > 0) {
                                                                        for (var i = 0; i < userOrder.length; i++) {
                                                                            if (userOrder[i].tradeId == tradeId && userOrder[i].orderTime.match(date) == date && userOrder[i].orderStartId != 0 && userOrder[i].state==0) {
                                                                                todaybuynum = todaybuynum + userOrder[i].orderBuyNum;
                                                                            }
                                                                        }
                                                                    }
                                                                    else{
                                                                        userOrder = []
                                                                    }
                                                                    var tradeLimit = parseInt(tradeInfo.tradeLimit);
                                                                    if (num <= (tradeLimit - todaybuynum)) {
                                                                        //判断是否有货
                                                                        var tradeInventory = parseInt(tradeInfo.tradeInventory);
                                                                        if (tradeInventory >= num) {
                                                                            tradeInfo.tradeInventory = tradeInventory - num;
                                                                            client.set("t" + tradeId, JSON.stringify(tradeInfo));
                                                                            client.rpush("myTrade", JSON.stringify(tradeInfo));
                                                                            var addressId = '';
                                                                            for(i = 0;i < userAddress.length;i++){
                                                                                if(userAddress[i].type = 1){
                                                                                    addressId = userAddress[i].addressId;
                                                                                    break;
                                                                                }
                                                                            }
                                                                            var orderTime = new Date().toLocaleString();
                                                                            var newOrder = {tradeId:tradeId,userPhone:userPhone,addressId:addressId,orderStartId:2,orderTime:orderTime,orderMoney:tradeInfo.tradeSalePrice,orderBuyNum:num,orderAllMoney:parseInt(tradeInfo.tradeSalePrice)*parseInt(num)};
                                                                            userOrder.push(newOrder);
                                                                            client.set("o"+userPhone,JSON.stringify(userOrder));
                                                                            client.rpush("myOrder", JSON.stringify(newOrder));
                                                                            setTimeout(function () {
                                                                                client.get("o"+userPhone,function (err,data) {
                                                                                    if(err == undefined){
                                                                                        data = JSON.parse(data);
                                                                                        for(var i =0;i < data.length;i++){

                                                                                            if (data[i].orderTime == orderTime){
                                                                                                if(data[i].orderStartId == 0){
                                                                                                    data[i].orderStartId = 2;
                                                                                                    var orderId = data[i].orderId;
                                                                                                    var tradeId = data[i].tradeId;
                                                                                                    var orderNum = data[i].orderBuyNum;
                                                                                                    client.set("o"+userPhone,JSON.stringify(data));
                                                                                                    dataOper.order.timeOut(orderId);
                                                                                                    client.get("t"+tradeId,function (err,data) {
                                                                                                        if(err == undefined){
                                                                                                            var tradeInfo = JSON.parse(data);
                                                                                                            tradeInfo.tradeInventory = parseInt(tradeInfo.tradeInventory) + parseInt(orderNum);
                                                                                                            client.set("t" + tradeId, JSON.stringify(tradeInfo));
                                                                                                            client.rpush("myTrade", JSON.stringify(tradeInfo));
                                                                                                        }
                                                                                                    })
                                                                                                }
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                })
                                                                            },1800000);
                                                                            remsg.content.message = "秒杀成功";
                                                                            remsg.content.res = true;
                                                                            if (socket.readyState == ws.OPEN) {
                                                                                socket.send(JSON.stringify(remsg));
                                                                                remsg.type = 'detailsRes';
                                                                                remsg.content = '';
                                                                                if (socket.readyState == ws.OPEN) {
                                                                                    socket.send(JSON.stringify(remsg));
                                                                                }
                                                                            }
                                                                        }
                                                                        else {
                                                                            remsg.content.message = "秒杀失败，您购买的数量超过了商品的库存，请重新检查";
                                                                            if (socket.readyState == ws.OPEN) {
                                                                                socket.send(JSON.stringify(remsg));
                                                                                remsg.type = 'detailsRes';
                                                                                remsg.content = '';
                                                                                if (socket.readyState == ws.OPEN) {
                                                                                    socket.send(JSON.stringify(remsg));
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    else {
                                                                        remsg.content.message = "秒杀失败，您购买的数量超过了商品的限购数量";
                                                                        if (socket.readyState == ws.OPEN) {
                                                                            socket.send(JSON.stringify(remsg));
                                                                            remsg.type = 'detailsRes';
                                                                            remsg.content = '';
                                                                            if (socket.readyState == ws.OPEN) {
                                                                                socket.send(JSON.stringify(remsg));
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                else {
                                                                    remsg.content.message = "秒杀失败，非当前时段商品";
                                                                    if (socket.readyState == ws.OPEN) {
                                                                        if (socket.readyState == ws.OPEN) {
                                                                            socket.send(JSON.stringify(remsg));
                                                                            remsg.type = 'detailsRes';
                                                                            remsg.content = '';
                                                                            if (socket.readyState == ws.OPEN) {
                                                                                socket.send(JSON.stringify(remsg));
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            remsg.content.message = "秒杀失败，用户登录异常，请重新登录";
                                                            remsg.content.con = "";
                                                            if(socket.readyState == ws.OPEN){
                                                                socket.send(JSON.stringify(remsg));
                                                                remsg.type = 'detailsRes';
                                                                remsg.content = '';
                                                                if(socket.readyState == ws.OPEN){
                                                                    socket.send(JSON.stringify(remsg));
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                else{
                                                    console.log(err);
                                                    if(socket.readyState == ws.OPEN){
                                                        socket.send(JSON.stringify(remsg));
                                                        remsg.type = 'detailsRes';
                                                        remsg.content = '';
                                                        if(socket.readyState == ws.OPEN){
                                                            socket.send(JSON.stringify(remsg));
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                        else{
                                            console.log(err);
                                            if(socket.readyState == ws.OPEN){
                                                socket.send(JSON.stringify(remsg));
                                                remsg.type = 'detailsRes';
                                                remsg.content = '';
                                                if(socket.readyState == ws.OPEN){
                                                    socket.send(JSON.stringify(remsg));
                                                }
                                            }
                                        }
                                    });
                                }
                                else{
                                    console.log(err);
                                    if(socket.readyState == ws.OPEN){
                                        socket.send(JSON.stringify(remsg));
                                        remsg.type = 'detailsRes';
                                        remsg.content = '';
                                        if(socket.readyState == ws.OPEN){
                                            socket.send(JSON.stringify(remsg));
                                        }
                                    }
                                }
                            });
                        }
                        else{
                            console.log(err);
                            if(socket.readyState == ws.OPEN){
                                socket.send(JSON.stringify(remsg));
                                remsg.type = 'detailsRes';
                                remsg.content = '';
                                if(socket.readyState == ws.OPEN){
                                    socket.send(JSON.stringify(remsg));
                                }
                            }
                        }
                    });
                }
                else{
                    remsg.content.message = "秒杀失败，当前用户不在线，请重新登陆";
                    if(socket.readyState == ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                        remsg.type = 'detailsRes';
                        remsg.content = '';
                        if(socket.readyState == ws.OPEN){
                            socket.send(JSON.stringify(remsg));
                        }
                    }
                }


        }
        //结算
        else if(msg.type == 'checkOut'){
            var orderId = msg.content.orderid;
            var userPhone = msg.content.userPhone;
            remsg = {
                sender:'server',
                receiver:'client',
                type:'checkOutRES',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            dataOper.order.checkOrder(orderId,function (res,data) {
                if(res){
                    dataOper.user.checkUserMoney(userPhone,data,function (res) {
                        if(res){
                            dataOper.order.checkOut(orderId,userPhone,data,function () {
                                remsg.content = {res:true,message:"结算成功"};
                                if(socket.readyState==ws.OPEN){
                                    socket.send(JSON.stringify(remsg));
                                }
                                dataOper.user.getUserInfo(userPhone,function (data) {
                                    var key = 'u'+userPhone;
                                    var value = JSON.stringify(data[0]);
                                    client.set(key,value);
                                    dataOper.order.getUserOrder(userPhone,function (data) {
                                        var key = 'o'+userPhone;
                                        var value = JSON.stringify(data);
                                        client.set(key,value);
                                    })
                                })
                            })
                        }
                        else {
                            remsg.content = {res:false,message:"结算失败，用户余额不足，请充值"};
                            if(socket.readyState==ws.OPEN){
                                socket.send(JSON.stringify(remsg));
                            }
                        }
                    })
                }
                else{
                    remsg.content = {res:false,message:"结算失败，当前订单已过期"};
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(remsg));
                    }
                }
            })

        }
    });
});

function littleQ(message,sender,userType,socket) {
    var chatmsg = {
        sender:'sever',
        receiver:sender,
        type:'chatHistory',
        content:'',
        msgid:1,
        msgtime:(new Date()).getTime()
    };

    var remsg = {
        sender:'littleQ',
        receiver:sender,
        type:'Message',
        content:{message:"你好呀，我是小Q，你可以问我比如\"我的订单\",\"我的收货地址\"之类的问题哦，也可以输入\"人工\"转到人工客服",headImg:"public/image/headImg/LQ.jpeg",name:"小Q"},
        msgid:1,
        msgtime:(new Date()).getTime()
    };

    var conMsg = {
        sender:'littleQ',
        receiver:sender,
        type:'control',
        content:'',
        msgid:1,
        msgtime:(new Date()).getTime()
    };

    var tipsMsg = {
        sender:'littleQ',
        receiver:sender,
        type:'Message',
        content:"",
        msgid:1,
        msgtime:(new Date()).getTime()
    };

    var oo = 0;
    if(message == ''){
        var arrname = '';
        if(userType == 'visitor'){
            arrname = "v"+sender;
        }
        else {
            arrname = "u"+sender;
        }
        for(var n = 0;n < littleQChatArr.length;n++){
            if(littleQChatArr[n] == arrname){
                oo = 1;
            }
        }
        if(oo == 0){
            if(userType == 'visitor'){
                dataOper.visitorChatRecord.getRecord(sender,function (res,data) {
                    if(res){
                        chatmsg.content = data;
                    }
                    socket.send(JSON.stringify(chatmsg));
                    dataOper.visitorChatRecord.addRecord(remsg.sender,remsg.receiver,JSON.stringify(remsg));
                    littleQChatArr.push(arrname);
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(chatmsg));
                    }
                });
            }
            else {
                dataOper.chatRecord.getRecord(sender,function (res,data) {
                    if(res){
                        chatmsg.content = data;
                    }
                    socket.send(JSON.stringify(chatmsg));
                    dataOper.chatRecord.addRecord(remsg.sender,remsg.receiver,JSON.stringify(remsg));
                    littleQChatArr.push(arrname);
                    if(socket.readyState==ws.OPEN){
                        socket.send(JSON.stringify(chatmsg));
                    }
                });
            }
            if(socket.readyState==ws.OPEN){
                socket.send(JSON.stringify(remsg));
            }
        }
    }
    else{
        var newMessage = message.message;
        var con = 0;
        var tips = 0;
        if(newMessage == '跳转登录'  || newMessage == '登录'){
            if(userType == 'visitor'){
                conMsg.content = "login";
                con = 1;
            }
            else{
                tipsMsg.content = {tips:["您已登录"]};
                tips = 1;
            }

        }
        else if(newMessage == "跳转注册"  || newMessage == '注册'){
            if(userType == 'visitor'){
                conMsg.content = "sigin";
                con = 1;
            }
            else{
                tipsMsg.content = {tips:["请注销后再注册，可回复\"注销\"来注销"]};
                tips = 1;
            }
        }
        else if(newMessage == "跳转首页"  || newMessage == '首页'){
            conMsg.content = "index";
            con = 1;
        }
        else if(newMessage == '注销'){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["您尚未登录"]};
                tips = 1;
            }
            else{
                conMsg.content = "goout";
                con = 1;
            }
        }
        else if(newMessage == "跳转个人中心"  || newMessage == '个人中心'){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "userCenter";
                con = 1;
            }
        }
        else if(newMessage == "跳转收货地址" || newMessage == "我的收货地址" || newMessage == "我的地址"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "address";
                con = 1;
            }
        }
        else if(newMessage == "跳转个人资料" || newMessage == "我的个人资料" || newMessage == "我的资料" || newMessage == "个人资料"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "info";
                con = 1;
            }
        }
        else if(newMessage == "跳转我的订单" || newMessage == "我的订单"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "order";
                con = 1;
            }
        }
        else if(newMessage == "跳转我的消息" || newMessage == "我的消息"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "message";
                con = 1;
            }
        }
        else if(newMessage == "添加地址"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "addadd";
                con = 1;
            }
        }
        else if(newMessage == "充值"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "congetmon";
                con = 1;
            }
        }
        else if(newMessage == "修改昵称"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "connickname";
                con = 1;
            }
        }
        else if(newMessage == "修改密码"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "conpsw";
                con = 1;
            }
        }
        else if(newMessage == "全部订单" ){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "conall";
                con = 1;
            }
        }
        else if(newMessage == "未支付订单" || newMessage == "待付款订单" || newMessage == "待支付订单" || newMessage == "未付款订单"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "conwait";
                con = 1;
            }
        }
        else if(newMessage == "已支付订单" || newMessage == "已付款订单"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "conpayed";
                con = 1;
            }
        }
        else if(newMessage == "已过期订单" ){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "conclose";
                con = 1;
            }
        }
        else if(newMessage == "购物车" || newMessage == "我的购物车"){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "conmycar";
                con = 1;
            }
        }
        else if(newMessage == "修改支付密码" ){
            if(userType == 'visitor'){
                tipsMsg.content = {tips:["请登录后进行该操作"]};
                tips = 1;
            }
            else{
                conMsg.content = "conmyPayPsw";
                con = 1;
            }
        }
        else if(newMessage == "秒杀" || newMessage == "秒杀平台" || newMessage == "限时秒杀"){
                conMsg.content = "conSK";
                con = 1;
        }
        else if(newMessage == "人工" || newMessage == "人工客服" || newMessage == "在线客服" ||  newMessage == "客服"){
            tipsMsg.content = {tips:["正在转接人工客服，请稍等"]};
            tips = 2;
            littleQSend(tipsMsg);
            goPeople(message,sender,userType,socket,function (res) {
                if(!res){
                    tipsMsg.content = {tips:["十分抱歉，目前暂无人工客服在线"]};
                    tips = 1;
                }
            })
        }
        if(con == 1){
            tipsMsg.content = {tips:["操作成功"]};
            littleQSend(tipsMsg);
            littleQSend(conMsg);
        }
        else if(tips == 1 || tips == 2){
            if(tips == 1){
                littleQSend(tipsMsg);
            }
        }
        else {
            dataOper.littleQ.findQ(newMessage,function (res,data) {
                    if(res){
                        if(data.length == 0){
                            remsg.content.message = "小Q很抱歉哦，无法理解你所说的内容";
                            littleQSend(remsg);
                        }
                        else {
                            for(var i = 0;i < data.length;i++){
                                if(i== 0){
                                    remsg.content.message = "小Q为你找到了一下信息哦<br/><br/>Q："+data[i].qusetion+"<br/><br/>A："+data[i].answer;
                                    littleQSend(remsg);
                                }
                                else {
                                    remsg.content.message = "Q："+data[i].qusetion+"<br/><br/>A："+data[i].answer;
                                    littleQSend(remsg);
                                }
                            }
                        }

                    }
            })
        }

    }

    function littleQSend(sendmsg) {
        if(userType == 'visitor'){
            dataOper.visitorChatRecord.addRecord(sendmsg.sender,sendmsg.receiver,JSON.stringify(sendmsg));
        }
        else {
            dataOper.chatRecord.addRecord(sendmsg.sender,sendmsg.receiver,JSON.stringify(sendmsg));
        }
        if(socket.readyState==ws.OPEN){
            socket.send(JSON.stringify(sendmsg));
        }
    }
}

function goPeople(message,userid,userType,socket,callback) {
    var customerOnline = [];
    for(var i in customerArr){
        customerOnline.push(i);
    }
    if(customerOnline.length == 0){
        callback(false);
    }
    else{
        var usertip = '';
        if(userType == 'visitor'){
            usertip = 'v'+userid;
        }
        else {
            usertip = 'u'+userid;
        }
        for(var a = 0;a<littleQChatArr.length;a++){
            if(littleQChatArr[a] == usertip){
                littleQChatArr.splice(a,1);
                break;
            }
        }
        customerChatArr.push(usertip);
        var x = parseInt(Math.random()*customerOnline.length);
        var customerid = customerOnline[x];
        var customerName = '';
        dataOper.customer.customerName(customerid,function (data) {
             customerName = data;
            var msg = {
                sender:customerid,
                receiver:userid,
                type:'connectCustomer',
                content:{tips:["已为您连接"+customerName,"请勿刷新页面,否则会再次分配客服"]},
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(socket.readyState==ws.OPEN){
                socket.send(JSON.stringify(msg));
            }

            var tocustomer = {
                sender:userid,
                receiver:customerid,
                type:'clientLink',
                content:{headImg:message.headImg,name:message.name,type:userType},
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(customerArr[customerid]!=undefined && customerArr[customerid].readyState == ws.OPEN){
                customerArr[customerid].send(JSON.stringify(tocustomer));
            }
        });
    }
}


function md5(pwd) {
    var crypto = require('crypto');
    var md5 = crypto.createHash('md5');
    var pswmd5 = md5.update(pwd).digest('base64');
    return pswmd5;
}

client.get('u15606911111',function (err,data) {
    data = JSON.parse(data);
});

setTimeout(function () {
    for(var i in userArr){
        if(userArr[i].readyState != ws.OPEN){
            userArr.splice(i,1);
            var a = 0;
            for(var x =0;x < customerChatArr.length;x++){
                if(i == customerChatArr[x]){
                    customerChatArr.splice(x,1);
                    a = 1;
                    break;
                }
            }
            if(a == 0){
                for(x = 0;x < littleQChatArr.length;x++){
                    if(i == littleQChatArr[x]){
                        littleQChatArr.splice(x,1);
                        break;
                    }
                }
            }
        }
    }
    for(var n in customerArr){
        if(customerArr[n].readyState != ws.OPEN){
            customerArr.splice(n,1)
        }
    }
},500);
/*var tradeId = 10001;

function a() {
    var sql = 'select * from t_trade where traimdeId = ?';
    dataOper.user.ada.all(sql,[tradeId],function (res,data) {
        var total = data[0].tradeInventory+data[0].tradeSale;
        sql = 'update t_trade set wantSaleNum = ? where tradeId=?';
        dataOper.user.ada.run(sql,[total,tradeId],function () {
            console.log(total,tradeId);
            tradeId++;
            if(tradeId < 100066){
                a();
            }

        })
    })
}
a()*/















