var upload = layui.upload;
var laydate = layui.laydate;
var jcropApi;

var $modal = $('#my-modal-loading');

//设置标题
function setTitle() {
    var newTitle = $("#title input").eq(0).val();
    if(newTitle != title){
        $.ajax({
            url:titleUrl,
            data:{title:newTitle,id:noteId},
            type:"post",
            dataType:"json",
            success:function (res) {
                if(res["code"]==20010){
                    layer.msg(res["msg"]);
                }
                else {
                    layer.open({
                        content:res["msg"],
                        yes: function(index, layero){
                            //do something
                            if(res["code"]==20001){
                                toIndex();
                            }
                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                        }
                    });
                }
            }
        })
    }
}

//设置头图
upload.render({
    elem: '#aspectration'
    ,url: imgUrl
    ,auto: false
    ,accept:"imgaes"
    ,number:1
    //,multiple: true
    ,bindAction: '#subBI'
    ,data:{noteId:noteId}
    ,bgOpacity:0.1
    ,choose: function(obj){
        //预读本地文件示例，不支持ie8
        obj.preview(function(index, file, result){
            $('#imgShow').attr('src', result); //图片链接（base64）

            setTimeout(function () {
                var wid = document.getElementById('imgShow').naturalWidth;
                var hei = document.getElementById('imgShow').naturalHeight;
                if(wid<1350 || hei < 480){
                    layer.open({
                        content:"请选择宽度大于1350，并且高度大于480的图片",
                        yes: function(index, layero){
                            //do something
                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                        }
                    });
                }
                else {
                    $("#imgView").fadeIn(300,function () {

                        $('#imgShow').Jcrop({
                            allowSelect:false,
                            aspectRatio:3/1
                        }, function() {
                            jcropApi = this;
                        });
                        var size = jcropApi.getBounds();

                        var scale = wid/size[0];

                        var x = 900/scale;
                        var y = 300/scale;

                        jcropApi.setOptions({
                            setSelect:[0,0,size[0],size[0]/3],
                            minSize:[x,y]
                        })
                    });
                }

            },300)

        });
    }
    ,before:function () {
        $modal.modal();
        var select = jcropApi.tellSelect();
        var size = jcropApi.getBounds();
        console.log(select);
        var data = [size[0],select["x"],select["y"],select["x2"],select["y2"]];
        $.ajax({
            url: imgUrl,
            data:{"size":JSON.stringify(data),noteId:noteId},
            async:false
        })
    }
    ,done: function(res){
        $modal.modal('close');
        if(res["code"]== 20006){
            $("#aspectration div").empty();
            $img = "<img src='/quyou/public/static/"+res["data"]["url"]+"?"+Math.random()+"'/>";
            $("#aspectration div").append($img);

            layer.msg(res["msg"]);
        }
        else{
            layer.open({
                content:res["msg"],
                yes: function(index, layero){
                    //do something
                    if(res["code"]==20001){
                        toIndex();
                    }
                    layer.close(index); //如果设定了yes回调，需进行手工关闭
                }
            });
        }
        $("#imgView").fadeOut(300,function () {
            jcropApi.destroy();
        });
    }
});


//取消头图设置
$("#escBI").click(function () {

    $("#imgView").fadeOut(300,function () {
        jcropApi.destroy();
    })
});

var bus = new Vue();
var con = new Vue({
    el:"#noteConten",
    data:{
        conData:[],
        imgurl:staticDir,
        id:"#",
        conId:"C",
        textArea:"",
        saving:0
    },
    methods:{
        //获取数据
        init:function () {
            $.ajax({
                url:getCon,
                type:"post",
                data:{"id":noteId},
                dataType:"json",
                success:function (res) {
                    if(res["code"]==20014){
                        this.conData = res.data;
                    }
                    else {
                        layer.open({
                            content:res["msg"],
                            yes: function(index, layero){
                                //do something
                                if(res["code"]==20001){
                                    toIndex();
                                }
                                layer.close(index); //如果设定了yes回调，需进行手工关闭
                            }
                        });
                    }

                }.bind(this)
            })
        },
        //保存草稿
        save:function () {
            var _this = this;
            if(  this.saving==0){
                this.saving=1;
                $("#toSave").fadeOut(300,function () {
                    $("#saving").fadeIn(300);
                    $.ajax({
                        url: saveUrl,
                        data: {id: noteId, sData: this.conData},
                        type: "post",
                        textType: "json",
                        success: function (res) {
                            if(res["code"] == 20016){
                                $("#saving").fadeOut(300, function () {
                                    $("#saved").fadeIn(300);
                                });

                                setTimeout(function () {
                                    $("#saved").fadeOut(300, function () {
                                        $("#toSave").fadeIn(300);
                                        _this.saving = 0;
                                    });

                                }, 2000)
                            }
                            else {
                                $("#saving").fadeOut(300, function () {
                                    $("#toSave").fadeIn(300);
                                });
                                layer.open({
                                    content:res["msg"],
                                    yes: function(index, layero){
                                        //do something
                                        if(res["code"]==20001){
                                            toIndex();
                                        }
                                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                                    }
                                });
                            }

                        }
                    })
                    setTimeout(function () {
                        $("#catalNav").scrollspynav();
                    },3000);
                }.bind(this));
            }
        },
        //添加段落
        add:function () {
            layer.prompt({title: '请输入段落名', formType: 3}, function(pass, index){
                layer.close(index);
                var conData = this.conData;
                var id = this.textArea;
                var num = id.substring(1);
                var tx = document.getElementById(id);
                if(tx == null){
                    var newCon1 ={num:0,conId:0,content:"",title:pass,type:0,noteId:conData[0]["noteId"]};
                    this.conData.push(newCon1);
                }
                else if(tx.src != undefined){
                    for(var i = 0;i < conData.length;i++){
                        if(conData[i]["num"] == num){
                            var newCon0 ={num:0,conId:0,content:"",title:pass,type:0,noteId:conData[i]["noteId"]};
                            this.conData.splice(i+2,0,newCon0);
                        }
                    }
                }
                else {
                    var arr =  cursorPosition.re(tx);

                    for(var i = 0;i < conData.length;i++){
                        if(conData[i]["num"] == num){
                            this.conData[i]["content"] = arr[0];
                            var newCon ={num:0,conId:0,content:arr[1],title:pass,type:0,noteId:conData[i]["noteId"]};
                            this.conData.splice(i+1,0,newCon);
                            break;
                        }
                    }
                }
                for(var i = 0;i < this.conData.length;i++){
                    this.conData[i]["num"] = i+1;
                }
                this.save();

            }.bind(this));
        },
        //点击监测
        foc:function (event){
            var id = event.target.id;
            this.textArea = id;
        },
        //删除游记图片
        removeImg:function (num) {
            var _this = this;
            layer.confirm('确定删除该图片？', {icon: 3, title:'删除图片？'}, function(index){
                //do something
                $modal.modal();
                layer.close(index);
                var conData = this.conData;
                for(var i = 0;i < conData.length;i++){
                    if(conData[i]["num"] == num){
                        $.ajax({
                            url:delImgUrl,
                            data:{src:conData[i]["content"],noteId:noteId},
                            async:false,
                            success:function (res) {
                                $modal.modal('close');
                                if(res["code"]==20018){
                                    layer.msg(res["msg"]);
                                    var nextId = "C"+(i+2);
                                    var preId = "C"+(i);
                                    var value1 = document.getElementById(nextId).value;
                                    var value2 = document.getElementById(preId).value;
                                    value2 = value2+'\r'+value1;
                                    conData[i-1]["content"] = value2;
                                    document.getElementById(preId).value = value2;
                                    _this.conData.splice(i,2);
                                }
                                else {
                                    layer.open({
                                        content:res["msg"],
                                        yes: function(index, layero){
                                            //do something
                                            if(res["code"]==20001){
                                                toIndex();
                                            }
                                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                                        }
                                    });
                                }
                            }
                        })
                        break;
                    }
                }
                for(var i = 0;i < this.conData.length;i++){
                    this.conData[i]["num"] = i+1;
                }

                this.save();
            }.bind(this));
        },
        //移除段落标题
        removeTitle:function (num) {
            layer.confirm('确定删除该段落标题？段落内容会移至上一段', {icon: 3, title:'删除段落标题？'}, function(index){
                //do something
                var conData = this.conData;
                for(var i = 0;i < conData.length;i++){
                    if(conData[i]["num"] == num){
                        var myId = "C"+(i+1);
                        var preId = "C"+(i);
                        var value1 = document.getElementById(myId).value;
                        var value2 = document.getElementById(preId).value;

                        value2 = value2+'\r'+value1;
                        conData[i-1]["content"] = value2;
                        document.getElementById(preId).value = value2;
                        this.conData.splice(i,1);
                        break;
                    }
                }
                for(var i = 0;i < this.conData.length;i++){
                    this.conData[i]["num"] = i+1;
                }
                layer.close(index);
                this.save();
            }.bind(this));
        },
        //添加新段落标题
        editTitle:function (num) {
            var ovalue = this.conData[num-1]["title"];
            layer.prompt({title: '请输入新段落名', formType: 3, value: ovalue}, function(pass, index){
                layer.close(index);
                this.conData[num-1]["title"]=pass;
                this.save();

            }.bind(this));
        },
        //发布游记
        submitNote:function () {
            //请求省份
            if($("#aspectration img").length > 0){
                if($("#title input").eq(0).val() == ""){
                    layer.open({
                        content:"请先设置游记标题",
                        yes: function(index, layero){
                            //do something
                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                        }
                    });
                }
                else {
                    $.ajax({
                        url:regionUrl,
                        success:function (res) {
                            for(var i = 0;i < res["data"][0].length;i++){
                                var op = "<option value='"+res["data"][0][i]["REGION_ID"]+"'>"+res["data"][0][i]["REGION_NAME"]+"</option>";
                                $("#pr").append(op);
                            }
                            for(var i = 0;i < res["data"][1].length;i++){
                                var op = "<option value='"+res["data"][1][i]["REGION_ID"]+"'>"+res["data"][1][i]["REGION_NAME"]+"</option>";
                                $("#city").append(op);
                            }
                            form.render('select');
                        }
                    });
                    $("#submit").fadeIn(500);
                }

            }
            else {
                layer.open({
                    content:"请先设置游记头图",
                    yes: function(index, layero){
                        //do something
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                    }
                });
            }

        }
    },
    created:function () {
        this.init();
        setTimeout(function () {
            $("#catalNav").scrollspynav();
        },3000);

        bus.$on('addImg', function (url) {
            var conData = this.conData;
            var id = this.textArea;
            var num = id.substring(1);
            var tx = document.getElementById(id);
            if(tx == null){
                var newCon ={num:0,conId:0,content:url,title:"",type:1,noteId:conData[0]["noteId"]};
                this.conData.push(newCon);
                var newCon1 ={num:0,conId:0,content:"",title:"",type:0,noteId:conData[0]["noteId"]};
                this.conData.push(newCon1);
            }
            else if(tx.src != undefined){
                for(var i = 0;i < conData.length;i++){
                    if(conData[i]["num"] == num){
                        var newCon0 ={num:0,conId:0,content:url,title:"",type:1,noteId:conData[i]["noteId"]};
                        this.conData.splice(i+2,0,newCon0);
                        var newCon1 ={num:0,conId:0,content:"",title:"",type:0,noteId:conData[i]["noteId"]};
                        this.conData.splice(i+3,0,newCon1);
                        break;
                    }
                }
            }
            else {
                var arr =  cursorPosition.re(tx);

                for(var i = 0;i < conData.length;i++){
                    if(conData[i]["num"] == num){
                        this.conData[i]["content"] = arr[0];
                        var newCon ={num:0,conId:0,content:url,title:"",type:1,noteId:conData[i]["noteId"]};
                        this.conData.splice(i+1,0,newCon);
                        var newCon1 ={num:0,conId:0,content:arr[1],title:"",type:0,noteId:conData[i]["noteId"]};
                        this.conData.splice(i+2,0,newCon1);
                        break;
                    }
                }
            }

            for(var i = 0;i < this.conData.length;i++){
                this.conData[i]["num"] = i+1;
            }
            this.save();
        }.bind(this))
    }
});

//textArea处理函数
var cursorPosition = {
    get: function (textarea) {
        var rangeData = { text: "", start: 0, end: 0 };
        if (textarea.setSelectionRange) { // W3C
            textarea.focus();
            rangeData.start = textarea.selectionStart;
            rangeData.end = textarea.selectionEnd;
            rangeData.text = (rangeData.start != rangeData.end) ? textarea.value.substring(rangeData.start, rangeData.end) : "";
        } else if (document.selection) { // IE
            textarea.focus();
            var i,
                oS = document.selection.createRange(),
                // Don't: oR = textarea.createTextRange()
                oR = document.body.createTextRange();
            oR.moveToElementText(textarea);

            rangeData.text = oS.text;
            rangeData.bookmark = oS.getBookmark();

            // object.moveStart(sUnit [, iCount])
            // Return Value: Integer that returns the number of units moved.
            for (i = 0; oR.compareEndPoints('StartToStart', oS) < 0 && oS.moveStart("character", -1) !== 0; i++) {
                // Why? You can alert(textarea.value.length)
                if (textarea.value.charAt(i) == '\r') {
                    i++;
                }
            }
            rangeData.start = i;
            rangeData.end = rangeData.text.length + rangeData.start;
        }

        return rangeData;
    },

    re: function (textarea) {
        var oValue, value1, value2;
        var rangeData = this.get(textarea);

        oValue = textarea.value;
        value1 = oValue.substring(0, rangeData.start);
        value2 = oValue.substring(rangeData.end);

        return[value1,value2];

    }
};

//添加图片
upload.render({
    elem: '#addImg'
    ,url:addImgUrl
    ,accept:"imgaes"
    ,number:1
    ,data:{noteId:noteId}
    ,bgOpacity:0.1
    ,before:function () {
        $modal.modal();
    }
    ,done: function(res){
        $modal.modal("close");
        if(res["code"]==20012){
            layer.msg(res["msg"]);
            bus.$emit('addImg',res["data"][0]);
        }
        else {
            layer.open({
                content: res["msg"],
                yes: function (index, layero) {
                    //do something
                    if (res["code"] == 20001) {
                        toIndex();
                    }
                    layer.close(index); //如果设定了yes回调，需进行手工关闭
                }
            });
        }
    }
});

//添加游记音乐
upload.render({
    elem: '#addMusic'
    ,url: addMusicUrl
    ,accept:"audio"
    ,number:1
    ,data:{noteId:noteId}
    ,bgOpacity:0.1
    ,before:function () {
        $modal.modal();
    }
    ,done: function(res){
        $modal.modal("close");
        if(res["code"]==20004){
            layer.msg(res["msg"]);
            var music = $('<audio  controls style="width: 85%;margin-top:10px" autoplay  loop><source src="'+staticDir+''+res["data"][0]+'" ></audio>');
            $("#title").append(music);
            $("#addMusic").after(' <button class="layui-btn layui-btn-radius" onclick="removeMusic()">' +
                '                    <i class="layui-icon">&#xe6fc;</i> 移除音乐' +
                '                </button>')
        }
        else {
            layer.open({
                content:res["msg"],
                yes: function(index, layero){
                    //do something
                    if(res["code"]==20001){
                        toIndex();
                    }
                    layer.close(index); //如果设定了yes回调，需进行手工关闭
                }
            });
        }
    }
});

//移除游记音乐
function removeMusic() {
    layer.confirm('确定移除游记音乐?', {icon: 3, title:'移除游记音乐'}, function(index){
        //do something
        $.ajax({
            url:reMusicUrl,
            data:{noteId:noteId},
            success:function (res) {
                if(res["code"]==20005){
                    layer.msg(res["msg"]);
                    $("audio").remove();
                    $("#addMusic").next().remove();
                }
                else {
                    layer.open({
                        content:res["msg"],
                        yes: function(index, layero){
                            //do something
                            if(res["code"]==20001){
                                toIndex();
                            }
                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                        }
                    });
                }
            }
        })
        layer.close(index);
    });
}
var form = layui.form;

function escSub() {
    $("#submit").fadeOut(500);
}
$("#noteId").val(noteId);
//请求城市
form.on('select(pr)', function(data){
    $.ajax({
        url:regionUrl,
        data:{pr:data.value},
        success:function (res) {
            $("#city").empty();
            for(var i = 0;i < res["data"][0].length;i++){
                var op = "<option value='"+res["data"][0][i]["REGION_ID"]+"'>"+res["data"][0][i]["REGION_NAME"]+"</option>";
                $("#city").append(op);
            }

            form.render('select');
        }
    })
});

//游记发布
form.on('submit()', function(data){

    $.ajax({
        url:subUrl,
        data:data.field,
        success:function (res) {
            if(res["code"] == 20022){
                layer.msg(res["msg"]);
                location.href = subSuccessUrl;
            }
            else {
                layer.open({
                    content: res["msg"],
                    yes: function (index, layero) {
                        //do something
                        if (res["code"] == 20001) {
                            toIndex();
                        }
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                    }
                });
            }
        }
    });
    return false;
});

laydate.render({
    elem: '#date',
    max: 0 //7天后
});

function toIndex() {
    location.herf=indexUrl;
}
