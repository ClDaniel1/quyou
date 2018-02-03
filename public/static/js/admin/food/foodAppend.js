/**
 * Created by yydashen on 2018/2/2.
 */
function province()
{
    var regionId=$("#regionId option:selected").val();
    $.ajax({
        type:'post',
        url:foodSelect,
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
/*美食添加*/
function Release()//美食添加并发布
{

    var hotel=$('#form-article-add').serialize();
    if($('#form-article-add input').eq(0).val()=='')
    {
        layer.open({
            title: '美食名称不能为空'
            ,content: '请填写美食名称！'
        });
    }
    else if($('#form-article-add input').eq(1).val()=='')
    {
        layer.open({
            title: '美食描述不能为空'
            ,content: '请填写美食描述！'
        });
    }
    else if($('#foodtype').val()==0)
    {
        layer.open({
            title: '美食类型不能为空'
            ,content: '请填写美食类型！'
        });
    }
    else if($('#regionCity').val()==0)
    {
        layer.open({
            title: '美食位置不能为空'
            ,content: '请填写美食位置！'
        });
    }
    else if(imgTemporary.length==0)
    {
        layer.open({
            title: '美食图片不能为空'
            ,content: '美食加酒店图片！'
        });
    }
    else
    {
        $.ajax({
            type:'post',
            url:foodFind,
            data:hotel,
            async: false,
            dataType: 'json',
            success: function (res) {
                if(res<1)
                {
                    hotel=hotel+'&'+'img='+JSON.stringify(imgTemporary);
                    $.ajax({
                        type: 'post',
                        url: foodAappend,
                        data: hotel,
                        async: false,
                        dataType: 'json',
                        success: function (res) {
                            layer.open({
                                title: '添加成功'
                                ,content: '发布成功！'
                            });
                            window.location.href=foodIndex;
                        }
                    })
                }
                else
                {
                    layer.open({
                        title: '错误'
                        ,content: '美食名称不能重复！'
                    });
                }
            }
        })
    }
}
function NoRelease()//美食添加但不发布
{
    var hotel=$('#form-article-add').serialize();
    if($('#form-article-add input').eq(0).val()=='')
    {
        layer.open({
            title: '美食名称不能为空'
            ,content: '请填写美食名称！'
        });
    }
    else if($('#form-article-add input').eq(1).val()=='')
    {
        layer.open({
            title: '美食描述不能为空'
            ,content: '请填写美食描述！'
        });
    }
    else if($('#foodtype').val()==0)
    {
        layer.open({
            title: '美食类型不能为空'
            ,content: '请填写美食类型！'
        });
    }
    else if($('#regionCity').val()==0)
    {
        layer.open({
            title: '美食位置不能为空'
            ,content: '请填写美食位置！'
        });
    }
    else if(imgTemporary.length==0)
    {
        layer.open({
            title: '美食图片不能为空'
            ,content: '请添加美食图片！'
        });
    }
    else
    {
        $.ajax({
            type: 'post',
            url: foodFind,
            data: hotel,
            async: false,
            dataType: 'json',
            success: function (res) {
                if(res<1)
                {
                    hotel=hotel+'&'+'img='+JSON.stringify(imgTemporary);
                    $.ajax({
                        type:'post',
                        url:foodAappendNo,
                        data:hotel,
                        async: false,
                        dataType: 'json',
                        success: function (res) {
                            layer.open({
                                title: '添加成功'
                                ,content: '请尽快发布！'
                            });
                            window.location.href=foodIndex;
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