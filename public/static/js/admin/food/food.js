/**
 * Created by yydashen on 2018/1/26.
 */
$.ajax({
    type: 'get',
    url: menuUrl,
    async: false,
    dataType: 'json',
    success: function (res) {
        $('#foodSpot').html(res.data[0]);
    }
})
$.ajax({
    type: 'get',
    url: foodUrl,
    async: false,
    dataType: 'json',
    success: function (res) {
        for(var i=0;i<res.data[0].length;i++)
        {
            if(res.data[0][i]['foodType']==0)
            {
                $('#foodList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['foodId']+'</td>'+
                    '<td>'+res.data[0][i]['foodName']+'</td>'+
                    '<td>'+res.data[0][i]['foodDescribe']+'</td>'+
                    '<td class="text-l"><a class="maincolor" href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+res.data[0][i]['foodNum']+'人</a></td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+
                    '<img width="210" class="picture-thumb" src="https://dimg04.c-ctrip.com/images/300s0a0000004nrms3EBC_C_125_70.jpg"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['foodMoney']+'.00</td>'+
                    '<td>中国黑龙江</td>'+
                    '<td class="td-status"><span class="label label-success radius">已发布</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_stop(this,\'10001\')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_edit(\'图库编辑\',\'picture-add.html\',\'10001\')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,\'10001\')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }
            else if(res.data[0][i]['foodType']!=0)
            {
                $('#foodList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['foodId']+'</td>'+
                    '<td>'+res.data[0][i]['foodName']+'</td>'+
                    '<td>'+res.data[0][i]['foodDescribe']+'</td>'+
                    '<td class="text-l"><a class="maincolor" href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+res.data[0][i]['foodNum']+'人</a></td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+
                    '<img width="210" class="picture-thumb" src="https://dimg04.c-ctrip.com/images/300s0a0000004nrms3EBC_C_125_70.jpg"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['foodMoney']+'.00</td>'+
                    '<td>中国黑龙江</td>'+
                    '<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_start(this,\'10001\')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_edit(\'图库编辑\',\'picture-add.html\',\'10001\')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,\'10001\')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }

        }
    }
})