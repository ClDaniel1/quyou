/**
 * Created by yydashen on 2018/1/31.
 */

function Switch()//更换封面图
{
    /*attr -》 获取DOM标签的字符串属性
       prop -> 获取dom标签的boolean 属性 checkbox / radio*/
    var isChecked = $("input:checkbox[name='main']").prop('checked');
    if(isChecked==true)
    {
        layer.open({
            title: '你选中的图片已为封面图'
            ,content: '请重新选择！'
        });
    }
    else {
        var i=[];
        $("input:checkbox[name='secondary']:checked").each(function() { // 遍历name=test的多选框
            i.push($(this).val());  // 每一个被选中项的值
        });
        if(i.length>1){
            layer.open({
                title: '错误'
                ,content: '封面图只能为一张！'
            });
        }
        else if(i.length==1)
        {
            var main=$("input:checkbox[name='main']").val();
            var secondary=i[0];
            var hotelId=$('#hotelId').val();
             $.ajax({
             type: 'post',
             url: hotelPictureImg,
             data:{'main':main,'secondary':secondary,'hotelId':hotelId},
             async: false,
             dataType: 'json',
             success: function (res) {
                 layer.open({
                     title: '正确'
                     ,content: '修改成功！'
                 });
                 window.location.href='';
             }
             })
        }
        else
        {
            layer.open({
                title: '错误'
                ,content: '请选择你要修改的图片！'
            });
        }
    }

}
function datadel()//删除图片
{
    var isChecked = $("input:checkbox[name='main']").prop('checked');
    if(isChecked==true)
    {
        layer.open({
            title: '你选中的图片为封面图'
            ,content: '封面图不可以删除，请重新选择！'
        });
    }
    else
    {
        layer.confirm('确定删除？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var index = layer.load(); //换了种风格
            var i=[];
            $("input:checkbox[name='secondary']:checked").each(function() { // 遍历name=test的多选框
                i.push($(this).val());  // 每一个被选中项的值
            });
            var img=JSON.stringify(i);
            $.ajax({
                type: 'post',
                url: hotelDeleteMore,
                data:{'img':img},
                dataType: 'json',
                success: function (res) {
                    layer.close(index);
                    layer.open({
                        title: 'OK'
                        ,content: '删除成功！'
                        ,yes:function() {
                            window.location.href='';
                        }
                    });
                }
            })
        }, function(){
            layer.msg('取消', {
                time: 20000, //20s后自动关闭
                btn: ['取消删除']
            });
        });


    }
}

