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
    $.ajax({
        type: 'post',
        url: scenicChangeAppend,
        data: scenic,
        async: false,
        dataType: 'json',
        success: function (res) {
            layer.open({
                title: 'OK'
                ,content: '修改成功！'
            });
            window.location.href=scenicIndex;
        }
    })

}