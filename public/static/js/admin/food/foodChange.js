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
//美食修改编辑
function Release()
{
    var food=$('#form-article-add').serialize();
    var foodId=$('#foodId').val();
    food=food+'&'+'img='+JSON.stringify(imgTemporary)+'&'+'id='+foodId;
    layer.confirm('确定修改？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        var index = layer.load();
        $.ajax({
            type: 'post',
            url: foodChangeAppend,
            data: food,
            dataType: 'json',
            success: function (res) {
                layer.close(index);
                layer.open({
                    title: 'OK'
                    ,content: '修改成功！'
                    ,yes:function(){
                        window.location.href=foodIndex;
                }
                });
            }
        })
    }, function(){
        layer.msg('取消', {
            time: 20000, //20s后自动关闭
            btn: ['取消', '修改']
        });
    });


}