if(sessionStorage.getItem("userInfo")!=undefined){
    var userInfo = JSON.parse(sessionStorage.getItem("userInfo"));
    var sender = userInfo["uid"];
    var headImg = userInfo["userImg"];
    var name = userInfo["uname"];

    var ws = new WebSocket("wss://www.liner.fun:8808");

    function WsMessage() {}
    WsMessage.prototype.getMessage = function (callback) {
        ws.onmessage = function (remsg) {
            var msg = JSON.parse(remsg.data);
            callback(msg);
        };
    };

    var wm = new WsMessage();

    wm.getMessage(function (msg) {
        //消息
        if(msg.type == 'Message'){
            showMessage(msg,msg.receiver,1);
            if($("#chatD").css("display") != "block"){
                layer.msg("您有新客服消息")
            }
        }
        else if(msg.type == 'chatHistory'){
            $("#chatMain").empty();
            for(var i = 0;i < msg.content.length;i++){
                var oldmsg = msg.content[i];
                showMessage(oldmsg,msg.receiver,1);
            }
        }
        else  if(msg.type == 'connectCustomer'){
            showMessage(msg,msg.receiver);
            sessionStorage.setItem("msgTo",msg.sender);
            var content = msg.content;
            $("#chatname").text(content.customerName);
            canuse();
        }
        else if(msg.type == 'customerOffline'){
            showMessage(msg,msg.receiver);
            unuse();
            sessionStorage.removeItem("msgTo");
        }
        else if(msg.type == 'noCustomer'){
            showMessage(msg,msg.receiver,1);
            unuse();
            sessionStorage.removeItem("msgTo");
        }
    });

//qq表情
    function QQFace(imgF,type,num,btnid,divid,thisid,callback) {
        this.imgF = imgF;
        this.divid =divid;
        this.num = num;
        this.btnid =btnid;
        this.callback = callback;
        this.type = type;
        this.thisid = thisid;
    }

    QQFace.prototype.add = function () {
        var $facediv = $("<div   id='"+this.thisid+"'></div>");
        $facediv.css({
            width: "390px",
            background:"white",
            position: "absolute",
            bottom: "50px",
            left: "10px",
            padding: "5px",
            boxShadow: "black 0 0 10px 2px",
            borderRadius: "5px",
            display: "none"
        });
        for(var i = 1;i <= this.num;i++ ){
            var $img = $("<img src='"+this.imgF+""+i+"."+this.type+"'/>");
            $img.css("padding","3px");

            $img.click(this.callback);

            $facediv.append($img);
        }
        $("#"+this.divid).append( $facediv);
    };

    QQFace.prototype.tog = function (num) {
        if(num == undefined){
            num = 0;
        }
        $("#"+this.thisid).toggle(num);
    };

    QQFace.prototype.dis = function (num) {
        if(num == undefined){
            num = 0;
        }
        $("#"+this.thisid).show(num);
    };

    QQFace.prototype.hid = function (num) {
        if(num == undefined){
            num = 0;
        }
        $("#"+this.thisid).hide(num);
    };

//画板
    function Canvas(divid,exdivid) {
        this.divid = divid;
        this.exdivid = exdivid;
        this.startx = 0;
        this.starty =0;
        this.endx = 0;
        this.endy = 0;
        this.type = '';
        this.canurl = '';
        this.value = '';
    }

    Canvas.prototype.add = function () {

        this.$div = $("<div id='draw'></div>");
        this.$div.css({
            position: 'absolute',
            bottom: '50px',
            left: '10px',
            width: '330px',
            height: '235px',
            background: 'white',
            boxShadow: 'black 0 0 10px 2px',
            display: 'none'
        });

        this.$canvas = $("<canvas width='328px' height='200px'></canvas>");
        this.$canvas.css({
            border: '1px red solid'
        });

        this.$div.append(this.$canvas);
        this.$div.append("<input type='button' value='随笔'>" +
            "<input type='button' value='直线'>" +
            "<input type='button' value='矩形'>" +
            "<input type='button' value='圆形'>" +
            "<input type='button' value='文字'>" +
            "<input type='button' value='橡皮'>" +
            "<input type='button' value='清空'>"+
            "<input type='button' value='添加'>");

        $("#"+this.divid).append(this.$div);
        this.$div.find("input").css("margin","0 3px");
        this.canvasAble();

    };

    Canvas.prototype.canvasAble = function () {
        var can = this.$canvas[0];
        var draw = can.getContext("2d");
        var tmp = this;
        this.$div.click(function () {
            event.stopPropagation();
        });

        this.$div.find("input").click(function () {
                value = this.value;
                if(value == '清空'){
                    draw.clearRect(0, 0, can.width, can.height);
                    var img = new Image();
                    img.src = '';
                    draw.drawImage(img, 0, 0, can.width, can.height);
                    canurl = tmp.$canvas[0].toDataURL();
                }
                else if(value == '添加'){
                    var tmpimg = new Image();
                    tmpimg.src = canurl;
                    $("#"+tmp.exdivid).append(tmpimg);
                    draw.clearRect(0, 0, can.width, can.height);
                    canurl = tmp.$canvas[0].toDataURL();
                    tmp.hid(300);
                    placeCaretAtEnd($("#chatinput")[0]);
                    $("#chatinput")[0].scrollTop = $("#chatinput")[0].scrollHeight;
                }
                else {
                    tmp.type = value;
                    if(tmp.type == '随笔'){
                        tmp.type = '';
                    }
                }
            }
        );


        this.$canvas.mousedown(function (event) {
            startx = event.offsetX;
            starty = event.offsetY;
            draw.strokeStyle = 'black';
            draw.lineWidth = 2;
            draw.lineCap = "round";
            draw.lineJoin = "round";

            $(this).mousemove(function (event) {
                endx = event.offsetX;
                endy = event.offsetY;
                if (tmp.type != '' && tmp.type != '橡皮') {
                    draw.clearRect(0, 0, can.width, can.height);
                    var img = new Image();
                    img.src = canurl;
                    draw.drawImage(img, 0, 0, can.width, can.height);
                }


                if(tmp.type == "直线" || tmp.type == '' || tmp.type == '橡皮') {
                    if(tmp.type == '橡皮') {
                        draw.strokeStyle = 'white';
                        draw.lineWidth = 10;
                    }

                    draw.beginPath();
                    draw.moveTo(startx, starty);
                    draw.lineTo(endx, endy);
                    draw.closePath();
                    draw.stroke();



                    if (tmp.type == '' || tmp.type == '橡皮') {
                        startx = endx;
                        starty = endy;
                    }
                }

                else if(tmp.type == "矩形"){
                    draw.drawImage(img, 0, 0, can.width, can.height);
                    draw.beginPath();
                    draw.rect(startx,starty,endx-startx,endy-starty);
                    draw.closePath();
                    draw.stroke();
                }

                else if(tmp.type == "圆形"){
                    draw.drawImage(img, 0, 0, can.width, can.height);
                    draw.beginPath();
                    var rx = endx - startx;
                    var ry = endy - starty;
                    var r = Math.sqrt(rx*rx + ry*ry);
                    draw.arc(startx,starty,r,0,2*Math.PI);
                    draw.closePath();
                    draw.stroke();
                }
            });

            if(tmp.type == '文字'){
                $(this).unbind("mousemove");
                var text = prompt("请输入文字");
                if(text == null){
                    text = '';
                }
                draw.font="20px Arial";
                draw.fillText(text,startx,starty);
                canurl = this.toDataURL();
            }
        });

        this.$canvas.mouseup(function () {

            $(this).unbind("mousemove");
            canurl = this.toDataURL();
        });

        this.$canvas.mouseout(function () {
            $(this).unbind("mousemove");
            canurl = this.toDataURL();
        });
    };

    Canvas.prototype.dis = function (num) {
        if(num == undefined){
            num = 0;
        }
        this.$div.show(num);
    };

    Canvas.prototype.hid = function (num) {
        if(num == undefined){
            num = 0;
        }
        this.$div.hide(num);
    };

    Canvas.prototype.toggle = function (num) {
        if(num == undefined){
            num = 0;
        }
        this.$div.toggle(num);
    };


    function showMessage(msg,id,type,div,tmp) {
        if(msg.receiveId == id || msg.receiver == id){
            if(type == undefined){
                $("#chatname").text(msg.content.name);
            }
            if(isJSON(msg.content)){
                var msgBody = JSON.parse(msg.content);
            }
            else {
                var msgBody = msg.content;
            }

            if(msgBody.message != undefined){
                //$("#chatname").text(msgBody.name);
                if(msg.recordTime != undefined){
                    var time = new Date(msg.recordTime);
                }
                else {
                    var time = new Date(msg.msgtime);
                }
                var year = time.getFullYear();
                var mon = time.getMonth()+1;
                var day = time.getDate();
                var hour = time.getHours();
                var min = time.getMinutes();
                var sec = time.getSeconds();

                if(hour < 10){
                    hour = "0"+hour;
                }
                if(min < 10){
                    min = "0"+min;
                }
                if(sec < 10){
                    sec = "0"+sec;
                }


                var $get = $("<div class='get'><div class='ChatHeadImg'><img src='"+msgBody.headImg+"' alt=''></div>" +
                    "<div class='massgaeManin'>" +
                    "<div class='ChatName'>"+msgBody.name+"<span>"+year+"-"+mon+"-"+day+"  "+hour+":"+min+":"+sec+"</span></div>" +
                    "<div class='ChatText'>"+msgBody.message+"</div></div></div>");

                if(div==undefined){

                    $("#chatMain").append($get);
                }
                else{
                    $("#"+div).append($get);
                }
            }


            if(msgBody.tips != undefined){
                for(var i = 0;i<msgBody.tips.length;i++){
                    var $tips = $("<div class='chatTips'><div class='chatTipsMain'>"+msgBody.tips[i]+"</div></div>");
                    if(div==undefined){

                        $("#chatMain").append($tips);
                    }
                    else{
                        $("#"+div).append($tips);
                    }
                }
            }
        }
        else {
            if(msg.recordTime != undefined){
                var time = new Date(msg.recordTime);
            }
            else {
                var time = new Date(msg.msgtime);
            }

            var year = time.getFullYear();
            var mon = time.getMonth()+1;
            var day = time.getDate();
            var hour = time.getHours();
            var min = time.getMinutes();
            var sec = time.getSeconds();

            if(hour < 10){
                hour = "0"+hour;
            }
            if(min < 10){
                min = "0"+min;
            }
            if(sec < 10){
                sec = "0"+sec;
            }

            if(isJSON(msg.content)){
                var msgCon = JSON.parse(msg.content);
            }
            else {
                var msgCon = msg.content;
            }

            var $send = $("<div class='send'>" +
                "<div class='ChatHeadImg'>" +
                "<img src='"+msgCon.headImg+"' alt=''></div>" +
                "<div class='massgaeManin'>" +
                "<div class='ChatName'>"+msgCon.name+"<span>"+year+"-"+mon+"-"+day+"  "+hour+":"+min+":"+sec+"</span></div>" +
                "<div class='ChatText'>"+msgCon.message+"</div></div></div>");

            if(div==undefined){

                $("#chatMain").append($send);
            }
            else{
                $("#"+div).append($send);
            }
        }
        if(tmp == undefined){
            if(div==undefined){

                $("#chatMain")[0].scrollTop = $("#chatMain")[0].scrollHeight;
            }
            else{
                $("#"+div)[0].scrollTop = $("#"+div)[0].scrollHeight;
            }
        }
    }


    $("#chatinput").keydown(function ($event) {
        var keycode = window.event ? $event.keyCode : $event.which;
        var evt = $event || window.event;
        // 回车-->发送消息
        if (keycode == 13 && !(evt.ctrlKey)) {
            $("#send").click();
            $event.preventDefault();
            return false;
        }
        // ctrl+回车-->换行
        if (evt.ctrlKey && evt.keyCode == 13) {
            $("#chatinput").html($("#chatinput").html()+'<br/>');
            $("#chatinput")[0].scrollTop = $("#chatinput")[0].scrollHeight;
            placeCaretAtEnd($("#chatinput")[0]);
        }
    });

    function placeCaretAtEnd(el) {
        el.focus();
        if (typeof window.getSelection != "undefined"
            && typeof document.createRange != "undefined") {
            var range = document.createRange();
            range.selectNodeContents(el);
            range.collapse(false);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        }
        else if (typeof document.body.createTextRange != "undefined") {
            var textRange = document.body.createTextRange();
            textRange.moveToElementText(el);
            textRange.collapse(false);
            textRange.select();
        }
    }


    $(".goCustomer").click(function () {
       /* $(this).css({background:"rgb(160,0,0)",color:"white"});
        $(this).text("联系客服");*/
        $("#chatD").toggle(300);
        $("#chatD")[0].focus();
        if(sessionStorage.msgTo != undefined){
           // ws.send(JSON.stringify(msg));
        }
        else{
            linkCustom();
            $("#chatname").text("请稍候");
        }
        $("#chatMain")[0].scrollTop = $("#chatMain")[0].scrollHeight;
    });

    $("#send").click(function () {
        var message = $("#chatinput").html();
        var receiver = "";
        if(sessionStorage.getItem("msgTo") == undefined){
            receiver = "server"
        }
        else {
            receiver = sessionStorage.getItem("msgTo");
        }
        $("#chatinput").html("");
        if(message == ''){
            layer.msg("请输入内容后发送")
        }
        else {
            var msg={
                sender:sender,
                receiver:receiver,
                type:'userMessage',
                content:{message:message,headImg:headImg,name:name},
                msgid:1,
                msgtime:(new Date()).getTime()
            };
            showMessage(msg,msg.sender);
            ws.send(JSON.stringify(msg));
        }
    });

    $("#chatHead img").click(function () {
        $("#chatD").fadeOut(300)
    });

    var qqface = new QQFace(qqFace,"gif",75,"","chatTool","face",function () {
        var face = $(this).clone();
        $("#chatinput").append(face);
        placeCaretAtEnd($("#chatinput")[0]);
        $("#chatinput")[0].scrollTop = $("#chatinput")[0].scrollHeight;
        qqface.hid();
    });
    qqface.add();

    $("#btnface").click(function () {
        qqface.tog(300);
    });


    var canvas = new Canvas("chatTool","chatinput");
    canvas.add();
    $("#btndraw").click(function () {
        canvas.toggle(300)
    });

    function linkCustom() {
        var msg={
            sender:sender,
            receiver:'server',
            type:'userReady',
            content:{message:'',headImg:headImg,name:name},
            msgid:1,
            msgtime:(new Date()).getTime()
        };

        ws.send(JSON.stringify(msg));
    }

    function unuse() {
        $(".unuse").fadeIn(300);
    }
    function canuse() {
        $(".unuse").fadeOut(300);
    }

    unuse();
}

function isJSON(str) {
    if (typeof str == 'string') {
        try {
            var obj=JSON.parse(str);
            if(typeof obj == 'object' && obj ){
                return true;
            }else{
                return false;
            }

        } catch(e) {
            //console.log('error：'+str+'!!!'+e);
            return false;
        }
    }
    //console.log('It is not a string!')
    return false;
}

window.onbeforeunload=function (){

    if(sessionStorage.msgTo != undefined){
        var msg = {
            sender:sender,
            receiver:'server',
            type:'close',
            content:'user',
            msgid:1,
            msgtime:(new Date()).getTime()
        };
        ws.send(JSON.stringify(msg));
        sessionStorage.removeItem("msgTo");
    }
};
