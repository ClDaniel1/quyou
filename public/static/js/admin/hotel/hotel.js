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
/*酒店列表打印*/
$.ajax({
    type: 'get',
    url: hotelUrl,
    async: false,
    dataType: 'json',
    success: function (res) {
        for(var i=0;i<res.data[0].length;i++)
        {
            if(res.data[0][i]['hotelType']==0)
            {
                $('#foodList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['hotelId']+'</td>'+
                    '<td>'+res.data[0][i]['hotelName']+'</td>'+
                    '<td>'+res.data[0][i]['hotelDescribe']+'</td>'+
                    '<td class="text-l"><a class="maincolor" href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+res.data[0][i]['hotelNum']+'人</a></td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+
                    '<img width="210" class="picture-thumb" src="/QY/public/static/'+res.data[0][i]['img']+'"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['hotelPrice']+'.00</td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-success radius">已发布</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_stop(this,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_edit(\'图库编辑\',\'picture-add.html\',\'10001\')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,\'10001\')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }
            else if(res.data[0][i]['hotelType']!=0)
            {
                $('#foodList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['hotelId']+'</td>'+
                    '<td>'+res.data[0][i]['hotelName']+'</td>'+
                    '<td>'+res.data[0][i]['hotelDescribe']+'</td>'+
                    '<td class="text-l"><a class="maincolor" href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+res.data[0][i]['hotelNum']+'人</a></td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',\'picture-show.html\',\'10001\')">'+
                    '<img width="210" class="picture-thumb" src="/QY/public/static/'+res.data[0][i]['img']+'"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['hotelPrice']+'.00</td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_start(this,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_edit(\'图库编辑\',\'picture-add.html\',\'10001\')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,\'10001\')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }

        }
    }
})

/* 酒店上下架*/
function picture_stop(obj,id) {

    layer.confirm('确认要下架吗？', function (index) {
       $.ajax({
         type: 'post',
         url: hotelShelves,
         async: false,
         data:{'id':id},
         dataType: 'json',
         success: function (res) {
                 $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_start(this,'+id+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
                 $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
                 $(obj).remove();
                 layer.msg('已下架!', {icon: 5, time: 1000});
         }
         })

    });

}
/*酒店-发布*/
function picture_start(obj,id){

    layer.confirm('确认要发布吗？',function(index){
        $.ajax({
            type: 'post',
            url: hotelOn,
            async: false,
            data: {'id': id},
            dataType: 'json',
            success: function (res) {
                if(res.data[0])
                {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_stop(this,'+id+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                    $(obj).remove();
                    layer.msg('已发布!',{icon: 6,time:1000});
                }
            }
        })

    });
}