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
    console.log(hotel);
    $.ajax({
        type: 'post',
        url: hotelChangeAppend,
        data: hotel,
        async: false,
        dataType: 'json',
        success: function (res) {
            layer.open({
                title: 'OK'
                ,content: '修改成功！'
            });
            window.location.href=hotelIndex;
        }
    })

}
