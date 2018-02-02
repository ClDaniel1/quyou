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
                    '<td class="text-l">'+res.data[0][i]['hotelNum']+'间</td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',hotelPicture,'+res.data[0][i]['hotelId']+')">'+
                    '<img width="210" class="picture-thumb" src="'+staticc+res.data[0][i]['img']+'"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['hotelPrice']+'</td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-success radius">已发布</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_stop(this,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_hotel(\'图库编辑\',hotelChange,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }
            else if(res.data[0][i]['hotelType']!=0)
            {
                $('#foodList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['hotelId']+'</td>'+
                    '<td>'+res.data[0][i]['hotelName']+'</td>'+
                    '<td>'+res.data[0][i]['hotelDescribe']+'</td>'+
                    '<td class="text-l">'+res.data[0][i]['hotelNum']+'间</td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',hotelPicture,'+res.data[0][i]['hotelId']+')">'+
                    '<img width="210" class="picture-thumb" src="'+staticc+res.data[0][i]['img']+'"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['hotelPrice']+'</td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_start(this,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_hotel(\'图库编辑\',hotelChange,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'+res.data[0][i]['hotelId']+')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
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
/*酒店删除*/
function picture_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: hotelDelete,
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:id});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}
/*修改酒店封面*/
function picture_edit(title,url,id){
    var index = layer.open({
        type: 2,
        title: title,
        content: url+"?id="+id,
        success:function(){
            var body = layer.getChildFrame('body', index);
            body.find('#hotelId').val(id)
        }
    });
    layer.full(index);
}
/*酒店信息修改*/
function picture_hotel(title,url,id){
    var index = layer.open({
        type: 2,
        title: title,
        content: url+"?id="+id,
        success:function(){
            var body = layer.getChildFrame('body', index);
            body.find('#hotelId').val(id)
        }
    });
    layer.full(index);
}