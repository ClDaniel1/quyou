/**
 * Created by lenovo on 2018/1/30.
 */
//昵称重复验证
function checkReName(checkNameUrl,uname){
    //alert(1);
    if(uname == ""){
    }else{
        $.ajax({
            url:checkNameUrl,
            data:{uname:uname},
            dataType:'json',
            type:'post',
            success: function (res){
                console.log(res);
                if(res.code==30001){
                    layer.msg(res.msg);
                }else if(res.code==30005){
                    layer.msg(res.msg);
                }
            }
        })
    }
}