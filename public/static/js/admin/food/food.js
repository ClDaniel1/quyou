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
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',foodPicture,'+res.data[0][i]['foodId']+')">'+
                    '<img width="210" class="picture-thumb" src="'+staticc+res.data[0][i]['foodImg']+'"></a></td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-success radius">已发布</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_stop(this,'+res.data[0][i]['foodId']+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_food(\'图库编辑\',foodChange,'+res.data[0][i]['foodId']+')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'+res.data[0][i]['foodId']+')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }
            else if(res.data[0][i]['foodType']!=0)
            {
                $('#foodList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['foodId']+'</td>'+
                    '<td>'+res.data[0][i]['foodName']+'</td>'+
                    '<td>'+res.data[0][i]['foodDescribe']+'</td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',foodPicture,'+res.data[0][i]['foodId']+')">'+
                    '<img width="210" class="picture-thumb" src="'+staticc+res.data[0][i]['foodImg']+'"></a></td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_start(this,'+res.data[0][i]['foodId']+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_food(\'图库编辑\',foodChange,'+res.data[0][i]['foodId']+')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'+res.data[0][i]['foodId']+')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }
        }
    }
})

/* 美食上下架*/
function picture_stop(obj,id) {

    layer.confirm('确认要下架吗？', function (index) {
        $.ajax({
            type: 'post',
            url: foodShelves,
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
/*美食-发布*/
function picture_start(obj,id){

    layer.confirm('确认要发布吗？',function(index){
        $.ajax({
            type: 'post',
            url: foodOn,
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
/*美食删除*/
function picture_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: foodDelete,
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
            body.find('#foodId').val(id)
        }
    });
    layer.full(index);
}
/*酒店信息修改*/
function picture_food(title,url,id){
    var index = layer.open({
        type: 2,
        title: title,
        content: url+"?id="+id,
        success:function(){
            var body = layer.getChildFrame('body', index);
            body.find('#foodId').val(id)
        }
    });
    layer.full(index);
}