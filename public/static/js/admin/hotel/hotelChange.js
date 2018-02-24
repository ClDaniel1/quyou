/**
 * Created by yydashen on 2018/2/1.
 */
//二级地区显示
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

//酒店修改编辑
function Release()
{
    var hotel=$('#form-article-add').serialize();
    var hotelId=$('#hotelId').val();
    hotel=hotel+'&'+'img='+JSON.stringify(imgTemporary)+'&'+'id='+hotelId;
    layer.confirm('确定修改！', {
        btn: ['确定','取消'] //按钮
    }, function(){
        var index123 = layer.load();
        $.ajax({
            type: 'post',
            url: hotelChangeAppend,
            data: hotel,
            dataType: 'json',
            success: function (res) {
                layer.close(index123);
                layer.open({
                    title: 'OK'
                    ,content: '修改成功！'
                    ,yes:function(){
                        window.location.href=hotelIndex;
                    }
                });
            }
        })
    }, function(){
        layer.msg('取消', {
            time: 20000, //20s后自动关闭
            btn: ['修改', '取消']
        });
    });


}
