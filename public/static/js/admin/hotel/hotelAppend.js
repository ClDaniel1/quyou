/**
 * Created by yydashen on 2018/1/29.
 */
function province()
{
    var regionId=$("#regionId option:selected").val();
    $.ajax({
        type:'post',
        url:hotelSelect,
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
/*酒店添加*/
function Release()//酒店添加并发布
{

    var hotel=$('#form-article-add').serialize();
    if($('#form-article-add input').eq(0).val()=='')
    {
        layer.open({
            title: '酒店名称不能为空'
            ,content: '请填写酒店名称！'
        });
    }
    else if($('#form-article-add input').eq(1).val()=='')
    {
        layer.open({
            title: '酒店描述不能为空'
            ,content: '请填写酒店描述！'
        });
    }
    else if($('#form-article-add input').eq(2).val()<=0)
    {
        layer.open({
            title: '酒店房间量不能为空'
            ,content: '请填写酒店房间量！'
        });
    }
    else if($('#form-article-add input').eq(3).val()<=0)
    {
        layer.open({
            title: '酒店价格不能为空'
            ,content: '请填写酒店价格！'
        });
    }
    else if($('#regionCity').val()==0)
    {
        layer.open({
            title: '酒店位置不能为空'
            ,content: '请填写酒店位置！'
        });
    }
    else if(imgTemporary.length==0)
    {
        layer.open({
            title: '酒店图片不能为空'
            ,content: '请添加酒店图片！'
        });
    }
    else
    {
        $.ajax({
            type:'post',
            url:hotelFind,
            data:hotel,
            async: false,
            dataType: 'json',
            success: function (res) {
                if(res<1)
                {
                    hotel=hotel+'&'+'img='+JSON.stringify(imgTemporary);
                    $.ajax({
                        type: 'post',
                        url: hotelAappend,
                        data: hotel,
                        async: false,
                        dataType: 'json',
                        success: function (res) {
                            layer.open({
                                title: '添加成功'
                                ,content: '发布成功！'
                                ,yes:function(){
                                    window.location.href=hotelIndex;

                                }
                            });
                        }
                    })
                }
                else
                {
                    layer.open({
                        title: '错误'
                        ,content: '酒店名称不能重复！'
                    });
                }
            }
        })
    }
}
function NoRelease()//酒店添加但不发布
{
    var hotel=$('#form-article-add').serialize();
    if($('#form-article-add input').eq(0).val()=='')
    {
        layer.open({
            title: '酒店名称不能为空'
            ,content: '请填写酒店名称！'
        });
    }
    else if($('#form-article-add input').eq(1).val()=='')
    {
        layer.open({
            title: '酒店描述不能为空'
            ,content: '请填写酒店描述！'
        });
    }
    else if($('#form-article-add input').eq(2).val()<=0)
    {
        layer.open({
            title: '酒店房间量不能为空'
            ,content: '请填写酒店房间量！'
        });
    }
    else if($('#form-article-add input').eq(3).val()<=0)
    {
        layer.open({
            title: '酒店价格不能为空'
            ,content: '请填写酒店价格！'
        });
    }
    else if($('#regionCity').val()==0)
    {
        layer.open({
            title: '酒店位置不能为空'
            ,content: '请填写酒店位置！'
        });
    }
    else if(imgTemporary.length==0)
    {
        layer.open({
            title: '酒店图片不能为空'
            ,content: '请添加酒店图片！'
        });
    }
    else
    {
        $.ajax({
            type: 'post',
            url: hotelFind,
            data: hotel,
            async: false,
            dataType: 'json',
            success: function (res) {
                if(res<1)
                {
                    hotel=hotel+'&'+'img='+JSON.stringify(imgTemporary);
                    $.ajax({
                        type:'post',
                        url:hotelAappendNo,
                        data:hotel,
                        async: false,
                        dataType: 'json',
                        success: function (res) {
                            layer.open({
                                title: '添加成功'
                                ,content: '请尽快发布！'
                                ,yes:function(){
                                        window.location.href=hotelIndex;

                                }
                            });

                        }
                    })
                }
                else
                {
                    layer.open({
                        title: '错误'
                        ,content: '酒店名称不能相同！'
                    });
                }
            }
        })
    }
}
