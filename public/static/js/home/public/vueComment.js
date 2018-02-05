/**
 * Created by Administrator on 2018/2/1.
 */
var bus = new Vue();
Vue.component('my-module',{
    template: '<div><div class="layui-row replayArea" v-for="value in home">'+
    '<div class="layui-col-sm2 layui-col-xs2" >'+
    '<a href="" class="userA">'+
    '<img class="headImg" :src="staticUrl+\'/\'+value.uheadImg" alt="">{{value.uname}}</a>'+
    '</div>'+
    '<div class="layui-col-sm10 layui-col-xs10">'+
    '<div>'+
    '<p class="comTxt">{{value.content}}</p>'+
    '<i class="goodIcon good1"></i>'+
    '<div style="clear: both"></div>'+
    '</div>'+
    '<div class="comUpImg">'+
    '<img src="http://n2-q.mafengwo.net/s10/M00/F0/8B/wKgBZ1mOXqWAU_wgAAV_03MjvGY01.jpeg?imageMogr2%2Fthumbnail%2F%21500x300r%2Fgravity%2FCenter%2Fcrop%2F%21500x300%2Fquality%2F90" alt="">'+
    '<img src="http://n2-q.mafengwo.net/s10/M00/F0/8B/wKgBZ1mOXqWAU_wgAAV_03MjvGY01.jpeg?imageMogr2%2Fthumbnail%2F%21500x300r%2Fgravity%2FCenter%2Fcrop%2F%21500x300%2Fquality%2F90" alt="">'+
    '</div>'+
    '<div>'+
    '<i class="starIcon"></i>'+
    '<i class="starIcon"></i>'+
    '<i class="starIcon"></i>'+
    '<i class="starIcon"></i>'+
    '<i class="starIcon"></i>'+
    '<span class="dateSpan">2018-1-31</span>'+
    '<button class="layui-btn layui-btn-warm layui-btn-sm replay" v-on:click="outBtn()" v-if="value.comId==showId">关闭</button>'+
    '<button class="layui-btn layui-btn-warm layui-btn-sm replay" v-on:click="repBtn(value.comId)" v-else>回复</button>'+
    '</div>'+
    '<div style="clear: both"></div>'+

    '<div class="repArea" v-if="value.comId==showId">'+
    '<div>'+
    '<textarea class="textArea"></textarea>'+
    '<button class="layui-btn layui-btn-normal layui-btn-sm replay repBtn">评论</button>'+
    '</div>'+
    '<div class="replayMsg">'+
    '<a href="" class="userA1">'+
    '<img src="http://c4-q.mafengwo.net/s10/M00/42/8D/wKgBZ1i4Vn6ASITyAACHePEuq5M12.jpeg?imageMogr2%2Fthumbnail%2F%2196x96r%2Fgravity%2FCenter%2Fcrop%2F%2196x96%2Fquality%2F90" alt="">哈尼</a>'+
    '<p>交通很便利，出门就是地铁口，这让游天安门广场的我出行省心。酒店不包停车费一晚50有点不开心，但不影响整体居住心情。酒店提供按摩服务，我和老公一个人叫了一个全身和足底，砍了价11002小时2个人，我觉得还行吧</p>'+
    '<div class="operate">'+
    '<span>评论</span>'+
    '<span>删除</span>'+
    '<span>修改</span>'+
    '</div>'+
    '<div style="clear: both"></div>'+
    '</div>'+
    '</div>'+
    '</div>'+
    '</div></div>',
    data: function () {
        return {
            home:[],
            staticUrl : "__STATIC__",
            showId:0
        }
    },
    props: ['url','scenicId'],
    created:function(){
        bus.$on('home', function (res) {
            this.home=res;
        }.bind(this));
        bus.$emit('data',{ajaxUrl:this.url,sid:this.scenicId})
    },
    methods:{
        repBtn: function (id) {
            this.showId=id;
        },
        outBtn: function () {
            this.showId=false;
        }
    }
});
// 创建根实例
new Vue({
    el: '#vueComment',
    data:{
        sId:"",
        url:""
    },
    created:function(){
        bus.$on('data', function (res) {
            console.log(res);
            this.url=res.ajaxUrl;
            this.sId=res.sid;
        }.bind(this));
    },
    mounted: function () {
        var _this=this;
        console.log(_this.url);
        $.ajax({
            type:'get',
            url:_this.url,
            data:{id:this.sId},
            dataType:"json",
            success: function (res) {
                console.log(res);
                bus.$emit('home', res)
            },error: function (res) {
                console.log(res)
            }
        })
    }
})
