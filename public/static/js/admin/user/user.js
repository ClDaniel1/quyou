/**
 * Created by yydashen on 2018/2/5.
 */
/*用户-停用*/
function member_stop(obj,id){
    layer.confirm('确认要停用吗？',function(index){
        $.ajax({
            type: 'POST',
            url: userTheShelves,
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                if(data.code=='40003')
                {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                    $(obj).remove();
                    layer.msg(data.msg,{icon: 5,time:1000});
                }
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}

/*用户-启用*/
function member_start(obj,id){
    layer.confirm('确认要启用吗？',function(index){
        $.ajax({
            type: 'POST',
            url: userShelves,
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                if(data.code=='40002')
                {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg(data.msg,{icon: 6,time:1000});
                }
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}
/*密码-修改*/
function change_password(id){
    layer.confirm('确定重置密码？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax({
            type: 'POST',
            url: userPawRepair,
            data: {'id': id},
            dataType: 'json',
            success: function (data) {
                if(data.code=='40001')
                {
                    layer.msg(data.msg, {icon: 1});
                }
                else{
                    layer.msg('修改失败！', {icon: 2});
                }
            }
        })
    }, function(){
        layer.msg('取消重置密码', {
            time: 20000, //20s后自动关闭
            btn: ['取消重置密码']
        });
    });
}
/*用户-删除*/
function member_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        layer.confirm('你确定删除该用户', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                type: 'POST',
                url: userDel,
                data:{'id':id},
                dataType: 'json',
                success: function(data){
                    if(data.code==40004)
                    {}
                    $(obj).parents("tr").remove();
                    layer.msg(data.msg,{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });

        }, function(){
            layer.msg('取消了！', {
                time: 20000, //20s后自动关闭
                btn: ['安全了！']
            });
        });
    });
}