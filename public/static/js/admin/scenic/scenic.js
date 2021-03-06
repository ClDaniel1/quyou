/**
 * Created by yydashen on 2018/1/25.
 */
$.ajax({
    type: 'get',
    url: menuUrl,
    async: false,
    dataType: 'json',
    success: function (res) {
        $('#scenicSpot').html(res.data[0]);
    }
});
$.ajax({
    type: 'get',
    url: scenicUrl,
    async: false,
    dataType: 'json',
    success: function (res) {
        for(var i=0;i<res.data[0].length;i++)
        {
            if(res.data[0][i]['scenicType']==0)
            {
                $('#scenicList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['scenicId']+'</td>'+
                    '<td>'+res.data[0][i]['scenicName']+'</td>'+
                    '<td>'+res.data[0][i]['scenicDescribe'].substring(0,15)+'...</td>'+
                    '<td class="text-l"><a class="maincolor" href="javascript:;">'+res.data[0][i]['scenicNum']+'人</a></td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',scenicPicture,'+res.data[0][i]['scenicId']+')">'+
                    '<img width="210" class="picture-thumb" style="width: 100px;height: 100px" src="'+staticc+res.data[0][i]['scenicImg']+'"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['price']+'</td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-success radius">已发布</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_stop(this,'+res.data[0][i]['scenicId']+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_scenic(\'图库编辑\',scenicChange,'+res.data[0][i]['scenicId']+')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'+res.data[0][i]['scenicId']+')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }
            else if(res.data[0][i]['scenicType']!=0)
            {
                $('#scenicList').append('<tr class="text-c">'+
                    '<td><input name="" type="checkbox" value=""></td>'+
                    '<td>'+res.data[0][i]['scenicId']+'</td>'+
                    '<td>'+res.data[0][i]['scenicName']+'</td>'+
                    '<td>'+res.data[0][i]['scenicDescribe'].substring(0,15)+'...</td>'+
                    '<td class="text-l"><a class="maincolor" href="javascript:;">'+res.data[0][i]['scenicNum']+'人</a></td>'+
                    '<td><a href="javascript:;" onClick="picture_edit(\'图库编辑\',scenicPicture,'+res.data[0][i]['scenicId']+')">'+
                    '<img width="210" class="picture-thumb" style="width: 100px;height: 100px" src="'+staticc+res.data[0][i]['scenicImg']+'"></a></td>'+
                    '<td class="text-c">'+res.data[0][i]['price']+'</td>'+
                    '<td>'+res.data[0][i]['REGION_NAME']+'</td>'+
                    '<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>'+
                    '<td class="td-manage"><a style="text-decoration:none" onClick="picture_start(this,'+res.data[0][i]['scenicId']+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_scenic(\'图库编辑\',scenicChange,'+res.data[0][i]['scenicId']+')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>'+
                    '<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'+res.data[0][i]['scenicId']+')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>'+
                    '</tr>');
            }

        }
    }
});

/* 景点下架*/
function picture_stop(obj,id) {

    layer.confirm('确认要下架吗？', function (index) {
        $.ajax({
            type: 'post',
            url: scenicShelves,
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
/*景点-发布*/
function picture_start(obj,id){

    layer.confirm('确认要发布吗？',function(index){
        $.ajax({
            type: 'post',
            url: scenicOn,
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
/*景点删除*/
function picture_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: scenicDelete,
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
/*修改景点封面*/
function picture_edit(title,url,id){
    var index = layer.open({
        type: 2,
        title: title,
        content: url+"?id="+id,
        success:function(){
            var body = layer.getChildFrame('body', index);
            body.find('#scenicId').val(id)
        }
    });
    layer.full(index);
}
/*酒店景点修改*/
function picture_scenic(title,url,id){
    var index = layer.open({
        type: 2,
        title: title,
        content: url+"?id="+id,
        success:function(){
            var body = layer.getChildFrame('body', index);
            body.find('#scenicId').val(id)
        }
    });
    layer.full(index);
}