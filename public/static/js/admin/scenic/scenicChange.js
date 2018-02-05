/**
 * Created by yydashen on 2018/2/2.
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
function Release()
{
    var scenic=$('#form-article-add').serialize();
    var scenicId=$('#scenicId').val();
    scenic=scenic+'&'+'img='+JSON.stringify(imgTemporary)+'&'+'id='+scenicId;
    layer.confirm('确定修改？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        var index = layer.load();
        $.ajax({
            type: 'post',
            url: scenicChangeAppend,
            data: scenic,
            dataType: 'json',
            success: function (res) {
                layer.close(index);
                layer.open({
                    title: 'OK'
                    ,content: '修改成功！'
                    ,yes:function(){
                        window.location.href=scenicIndex;
                    }
                });
            }
        })
    }, function(){
        layer.msg('取消修改', {
            time: 20000, //20s后自动关闭
            btn: ['取消修改']
        });
    });
}