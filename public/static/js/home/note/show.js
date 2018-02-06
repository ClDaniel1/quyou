
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
        }
    },
    created:function () {
        this.init();
        setTimeout(function () {
            $("#catalNav").scrollspynav();
        },3000);

    }
});
