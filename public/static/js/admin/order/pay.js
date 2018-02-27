/**
 * Created by Administrator on 2018/2/26.
 */
/**
 * Created by Administrator on 2018/2/26.
 */
/**
 * Created by yydashen on 2018/1/26.
 */
/*订单列表*/
$.ajax({
    type: 'get',
    url: orderUrl,
    async: false,
    dataType: 'json',
    success: function (res) {
        console.log(res);
        for(var i=0;i<res.length;i++)
        {
            for(var j=0;j<res[i].length;j++)
            {
                $('#foodList').append('<tr class="text-c">'+
                    '<td>'+res[i][j]['orderId']+'</td>'+
                    '<td>'+res[i][j]['tradeType']+'</td>'+
                    '<td>'+res[i][j]['oName']+'</td>'+
                    '<td class="text-l">'+res[i][j]['num']+'</td>'+
                    '<td>'+res[i][j].totalPrice+'</td>'+
                    '<td class="text-c">'+res[i][j]['typeName']+'</td>'+
                    '<td>'+res[i][j]['orderTime']+'</td>'+
                    '<td class="td-status">'+res[i][j]['uname']+'</td>'+
                    '<td class="td-manage">' +
                    '<a style="text-decoration:none" onClick="picture_stop(this,'+res[i][j]['orderId']+')" href="javascript:;" title="取消订单"><i class="Hui-iconfont">&#xe6de;</i>' +
                    '</a>'+
                    '</td>'+
                    '</tr>');
            }
        }
    }
});

/* 取消订单*/
function picture_stop(obj,id) {
    layer.confirm('确认要取消订单吗？', function (index) {
        $.ajax({
            type: 'post',
            url: cancelUrl,
            async: false,
            data:{'id':id},
            dataType: 'json',
            success: function (res) {
                console.log(res);

                if(res.code==60007)
                {
                    layer.close(index);
                    $(obj).parent().parent().remove();
                    layer.msg(res.msg,{icon: 6,time:2000});
                }
                else {
                    layer.msg(res.msg,{icon: 5,time:2000});
                }
            },error: function (res) {
                console.log(res);
            }
        })

    });
}