/**
 * Created by Administrator on 2018/2/1.
 */
var date=new Date();
$y=date.getFullYear();
$m=date.getMonth()+1;
if($m<10)
{
    $m="0"+$m;
}
$d=date.getDate();
$d2=$d+1;
if($d<10)
{
    $d="0"+$d;
}
if($d2<10)
{
    $d2="0"+$d2;
}
$now=$y+"-"+$m+"-"+$d;
$tDay=$y+"-"+$m+"-"+$d2;

var bus = new Vue();
Vue.component('my-module',{
    template: '<div>' +
    '<div v-if="showU"><h1>暂无相关评论</h1></div>'+
    '<div class="layui-row replayArea" v-for="value in home" v-if="value.fid == 0 && showU==false">'+
    '<div class="layui-col-sm2 layui-col-xs2">'+
    '<a href="" class="userA">'+
    '<img class="headImg" :src="staticUrl+\'/\'+value.uheadImg" alt="" style="margin-right: 10px">{{value.uname}}</a>'+
    '</div>'+
    '<div class="layui-col-sm10 layui-col-xs10">'+
    '<div>'+
    '<p class="comTxt">{{value.content}}</p>'+

    '<div style="clear: both"></div>'+
    '</div>'+
    '<div style="margin-top: 25px">'+
    '<span class="dateSpan1">{{value.comTime}}</span>'+
    '<button class="layui-btn layui-btn-warm layui-btn-sm replay" v-on:click="outBtn()" v-if="value.comId==showId">关闭</button>'+
    '<button class="layui-btn layui-btn-warm layui-btn-sm replay" v-on:click="repBtn(value.comId)" v-else>回复</button>'+
    '</div>'+
    '<div style="clear: both"></div>'+

    '<div class="repArea" v-if="value.comId==showId">'+
    '<div>'+
    '<textarea class="textArea" v-model="replayCon"></textarea>'+
    '<button class="layui-btn layui-btn-normal layui-btn-sm replay repBtn" @click="replay(value.comId)">评论</button>'+
    '</div>'+
    '<div class="replayMsg" v-for="replay in home" v-if="replay.fid == value.comId">'+
    '<a href="" class="userA1">'+
    '<img :src="staticUrl+\'/\'+replay.uheadImg" alt="" style="margin-right: 15px">{{replay.uname}}</a>'+
    '<p>{{replay.content}}</p>'+
    '<div class="operate">'+
    //'<span>评论</span>'+
    '<span v-if="uid==replay.uid" @click="delhCom(replay.comId)">删除</span>'+
    //'<span>修改</span>'+
    '</div>'+
    '<div style="clear: both"></div>'+
    '</div>'+
    '</div>'+
    '</div>'+
    '</div></div>',
    data: function () {
        return {
            home:[],
            staticUrl : staticUrl,
            showId:0,
            showU:false,
            replayCon:"",
            uid:uid
        }
    },
    props: ['url','scenicId'],
    created:function(){
        bus.$on('home', function (res) {
            this.home=res;
        }.bind(this));
        bus.$on('showU', function (res) {
            this.showU=res;
        }.bind(this));
        bus.$on('newCom', function (res) {
            var _this=this;
            $.ajax({
                type:'post',
                url:addComUrl,
                data:{hid:this.scenicId,com:res,fid:0},
                dataType:"text",
                success: function (res) {
                    layer.msg("点评成功");
                    _this.getCom();
                },error: function (res) {
                    console.log(res)
                }
            })
        }.bind(this));
        bus.$emit('data',{ajaxUrl:this.url,sid:this.scenicId})
    },
    methods:{
        repBtn: function (id) {
            this.showId=id;
            this.replayCon = "";
        },
        outBtn: function () {
            this.showId=false;
        },
        delhCom:function (comId) {

            var _this = this;
            layer.confirm('确认删除该评论?', function(index){
                //do something
                $.ajax({
                    type:'get',
                    url:delComUrl,
                    data:{comId:comId},
                    dataType:"text",
                    success: function (res) {
                        layer.msg("删除评论成功");
                        _this.getCom();
                    },error: function (res) {
                        console.log(res)
                    }
                })
                layer.close(index);
            });

        },
        getCom:function () {
            $.ajax({
                type:'get',
                url:this.url,
                data:{id:this.scenicId},
                dataType:"json",
                success: function (res) {
                    console.log(res);
                    if(res.length<=0)
                    {
                        bus.$emit('showU',true)
                    }
                    bus.$emit('home', res)
                },error: function (res) {
                    console.log(res)
                }
            })
        },
        replay:function (comId) {
            if($(".loginIn").length > 0){
                var _this=this;
                $.ajax({
                    type:'post',
                    url:addComUrl,
                    data:{hid:this.scenicId,com:this.replayCon,fid:comId},
                    dataType:"text",
                    success: function (res) {
                        layer.msg("回复评论成功");
                        _this.replayCon = "";
                        _this.getCom();
                    },error: function (res) {
                        console.log(res)
                    }
                })
            }
            else {
                layer.alert("请先登录")
            }
            console.log(comId);
        }
    }
});
// 创建根实例

new Vue({
    el: '#vueComment',
    data:{
        sId:"",
        url:"",
        checkTime:$now,
        outTime:$tDay,
        payUrl:url
    },
    created:function(){
        var _this=this;
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#time1'//指定元
                ,value: $now
                ,done: function(value){
                    console.log(value);
                    _this.checkTime=value;
                }
            });
            laydate.render({
                elem: '#time2'//指定元
                ,value: $tDay
                ,done: function(value){
                    console.log(value);
                    _this.outTime=value;
                }
            });
        });
        bus.$on('data', function (res) {
            console.log(res);
            this.url=res.ajaxUrl;
            this.sId=res.sid;
        }.bind(this));
    },
    mounted: function () {
        var _this=this;

        $.ajax({
            type:'get',
            url:_this.url,
            data:{id:this.sId},
            dataType:"json",
            success: function (res) {
                console.log(res);
                if(res.length<=0)
                {
                    bus.$emit('showU',true)
                }
                bus.$emit('home', res)
            },error: function (res) {
                console.log(res)
            }
        })
    }
});

function comment() {
    if($(".loginIn").length > 0){
        layer.prompt({
            formType: 2,
            title: '请输入点评内容',
            area: ['800px', '350px'] //自定义文本域宽高
        }, function(value, index, elem){
            bus.$emit('newCom',value);
            layer.close(index);
        });
    }
    else {
        layer.alert("请先登录")
    }
}