/**
 * Created by yydashen on 2018/2/1.
 */
function province()
{
    var regionId=$("#regionId option:selected").val();
    $.ajax({
        type:'post',
        url:scenicSelect,
        data:{'regionId':regionId},
        async: false,
        dataType: 'json',
        success: function (res) {
            $('#regionCity').empty();
            for(var i=0;i<res.data[0].length;i++)
            {
                $('#regionCity').append('<option value="'+res.data[0][i]['REGION_ID']+'">'+res.data[0][i]['REGION_NAME']+'</option>')
            }
        }
    })
}
/*景点添加*/
function Release()//景点添加并发布
{

    var hotel=$('#form-article-add').serialize();
    if($('#form-article-add input').eq(0).val()=='')
    {
        layer.open({
            title: '景点名称不能为空'
            ,content: '请填写景点名称！'
        });
    }
    else if($('#form-article-add input').eq(1).val()=='')
    {
        layer.open({
            title: '景点描述不能为空'
            ,content: '请填写景点描述！'
        });
    }
    else if($('#form-article-add input').eq(2).val()<=0)
    {
        layer.open({
            title: '景点门票不能为空'
            ,content: '请填写景点门票！'
        });
    }
    else if($('#form-article-add input').eq(3).val()<=0)
    {
        layer.open({
            title: '景点票价不能为空'
            ,content: '请填写景点票价！'
        });
    }
    else if($('#regionCity').val()==0)
    {
        layer.open({
            title: '景点位置不能为空'
            ,content: '请填写景点位置！'
        });
    }
    else if(imgTemporary.length==0)
    {
        layer.open({
            title: '景点图片不能为空'
            ,content: '请添加景点图片！'
        });
    }
    else
    {
        layer.confirm('确定添加？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var index = layer.load();
            $.ajax({
                type:'post',
                url:scenicFind,
                data:hotel,
                dataType: 'json',
                success: function (res) {
                    if(res<1)
                    {
                        hotel=hotel+'&'+'img='+JSON.stringify(imgTemporary);
                        $.ajax({
                            type: 'post',
                            url: scenicAappend,
                            data: hotel,
                            dataType: 'json',
                            success: function (res) {
                                layer.close(index);
                                layer.open({
                                    title: '添加成功'
                                    ,content: '发布成功！'
                                    ,yes:function(){
                                        window.location.href=scenicIndex;
                                    }
                                });
                            }
                        })
                    }
                    else
                    {
                        layer.open({
                            title: '错误'
                            ,content: '景点名称不能重复！'
                        });
                    }
                }
            })
        }, function(){
            layer.msg('取消添加', {
                time: 20000, //20s后自动关闭
                btn: ['取消添加']
            });
        });
    }
}
function NoRelease()//景点添加但不发布
{
    var hotel=$('#form-article-add').serialize();
    if($('#form-article-add input').eq(0).val()=='')
    {
        layer.open({
            title: '景点名称不能为空'
            ,content: '请填写景点名称！'
        });
    }
    else if($('#form-article-add input').eq(1).val()=='')
    {
        layer.open({
            title: '景点描述不能为空'
            ,content: '请填写景点描述！'
        });
    }
    else if($('#form-article-add input').eq(2).val()<=0)
    {
        layer.open({
            title: '景点门票不能为空'
            ,content: '请填写景点门票！'
        });
    }
    else if($('#form-article-add input').eq(3).val()<=0)
    {
        layer.open({
            title: '景点票价不能为空'
            ,content: '请填写景点票价！'
        });
    }
    else if($('#regionCity').val()==0)
    {
        layer.open({
            title: '景点位置不能为空'
            ,content: '请填写景点位置！'
        });
    }
    else if(imgTemporary.length==0)
    {
        layer.open({
            title: '景点图片不能为空'
            ,content: '请添加景点图片！'
        });
    }
    else
    {
        layer.confirm('确定添加？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var index = layer.load();
            $.ajax({
                type: 'post',
                url: scenicFind,
                data: hotel,
                dataType: 'json',
                success: function (res) {
                    if(res<1)
                    {
                        hotel=hotel+'&'+'img='+JSON.stringify(imgTemporary);
                        $.ajax({
                            type:'post',
                            url:scenicAappendNo,
                            data:hotel,
                            dataType: 'json',
                            success: function (res) {
                                layer.close(index);
                                layer.open({
                                    title: '添加成功'
                                    ,content: '请尽快发布！'
                                    ,yes:function(){
                                        window.location.href=scenicIndex;
                                    }
                                });
                            }
                        })
                    }
                    else
                    {
                        layer.open({
                            title: '错误'
                            ,content: '景点名称不能相同！'
                        });
                    }
                }
            })
        }, function(){
            layer.msg('取消添加', {
                time: 20000, //20s后自动关闭
                btn: ['取消添加']
            });
        });

    }
}