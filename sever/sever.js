var dataOper = require("dataOper");
var ws = require("ws");
var Sever = ws.Server;
var sever = new Sever({port:"8808"});

var userArr = [];
var customerArr = [];
var customerOnline = [];

sever.on("connection",function (socket) {
    console.log("连接成功");
    socket.on("message",function (msg) {
        var remsg = '';
        msg = JSON.parse(msg);
        if(msg.type == 'userReady'){
            userArr[msg.sender] = socket;
            var chatmsg = {
                sender:"server",
                receiver:msg.sender,
                type:'chatHistory',
                content:'',
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            dataOper.chatRecord.getRecord(msg.sender,function (res,data) {
                if(res){
                    chatmsg.content = data;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(chatmsg));
                }
                remsg= {
                    sender:'system',
                    receiver:msg.sender,
                    type:'Message',
                    content:{tips:["正在为您连接客服，请稍候"]},
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
                linkCostomer(socket,msg);
            });


        }
        //用户消息
         else if(msg.type == 'userMessage'){
            userArr[msg.sender] = socket;

            if(msg.content != ""){
                dataOper.chatRecord.addRecord(msg.sender,msg.receiver,JSON.stringify(msg.content));
            }

            if(customerArr[msg.receiver]!= undefined && customerArr[msg.receiver].readyState==ws.OPEN){
                console.log(123);
                customerArr[msg.receiver].send(JSON.stringify(msg));
            }
            else if(msg.receiver == "server"){
            }
            else{
                remsg= {
                    sender:'system',
                    receiver:msg.sender,
                    type:'customerOffline',
                    content:{tips:["当前客服已离线"]},
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
            }
        }
        //用户客户端关闭
        else if(msg.type == 'close'){
            console.log()
            var idx = '';
            idx = "u"+msg.sender;
            userArr.splice(msg.sender,1);
            remsg = {
                sender:msg.sender,
                receiver:'cus',
                type:'userOffline',
                content:{userType:msg.content},
                msgid:1,
                msgtime:(new Date()).getTime()
            }
            for(var i in customerArr){
                if(customerArr[i].readyState==ws.OPEN){
                    customerArr[i].send(JSON.stringify(remsg));
                }
            }
        }
        //客服登录
        else if(msg.type == 'customerLogin'){
            var customerId = msg.sender;
            var flag = 0;
            customerArr[customerId] = socket;
            for(var i = 0;i < customerOnline.length;i++){
                if(customerOnline[i] == msg.content){
                  flag = 1;
                  break;
                }
            }
            if(flag == 0){
                customerOnline.push(customerId);
            }

            remsg= {
                sender:'system',
                receiver:msg.sender,
                type:'loginRes',
                content:{},
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            if(socket.readyState==ws.OPEN){
                socket.send(JSON.stringify(remsg));
            }
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
            dataOper.chatRecord.getRecord(msg.content.userId,function (res,data) {
                if(res){
                    chatmsg.content = data;
                }
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(chatmsg));
                }
            });

        }
        //给用户的消息
        else if(msg.type == 'touMessge'){
            dataOper.chatRecord.addRecord(msg.sender,msg.receiver,JSON.stringify(msg.content));
            msg.type = 'Message';
            if(userArr[msg.receiver] != undefined && userArr[msg.receiver].readyState==ws.OPEN){
                userArr[msg.receiver].send(JSON.stringify(msg));
            }
        }
        //客服客户端关闭
        else if(msg.type == 'cusclose'){
            console.log(msg.content);
            customerArr.splice(msg.content,1);
            for(var i = 0;i < customerOnline.length;i++){
                if(customerOnline[i] == msg.content){
                    console.log(customerOnline);
                    customerOnline.splice(i,1);
                    console.log(customerOnline);
                    break;
                }
            }
        }
    });
});

function linkCostomer(socket,msg) {
    if(customerOnline.length == 0){
        var remsg = {
            sender:msg.receiver,
            receiver:msg.sender,
            type:'noCustomer',
            content:{tips:["很抱歉，当前没有客服在线"]},
            msgid:1,
            msgtime:(new Date()).getTime()
        };
        socket.send(JSON.stringify(remsg));

    }
    else {
            var num = radom(customerOnline.length);
            var customerId = customerOnline[num];
            dataOper.customer.customerName(customerId,function (data) {
                var customerName = data;
                var remsg = {
                    sender:customerId,
                    receiver:msg.sender,
                    type:'connectCustomer',
                    content:{tips:["已为您连接"+customerName,"请勿刷新页面,否则会再次分配客服"],customerName:customerName},
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(socket.readyState==ws.OPEN){
                    socket.send(JSON.stringify(remsg));
                }
                var tocustomer = {
                    sender:msg.sender,
                    receiver:customerId,
                    type:'clientLink',
                    content:{headImg:msg.content.headImg,name:msg.content.name},
                    msgid:1,
                    msgtime:(new Date()).getTime()
                };
                if(customerArr[customerId]!=undefined && customerArr[customerId].readyState == ws.OPEN){
                    customerArr[customerId].send(JSON.stringify(tocustomer));
                }
            })
    }
}

function radom(num) {
    var str = parseInt(Math.random()*num);
    return str;
}















