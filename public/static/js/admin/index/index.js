/**
 * Created by yydashen on 2018/1/25.
 */
$.ajax({
    type:'get',
    url:menuUrl,
    async:false,
    dataType:'json',
    success:function(res) {
        var res=res.data[0];
        console.log(res);
        for(var i=0;i<res.length;i++)
        {
            if(res[i]['fid']==0)
            {
                var fMenu = $('<dl>'+
                                '<dt><i class="Hui-iconfont">&#xe616;</i> '+res[i]['menuName']+'<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>'+

                            '</dl>');
                var dd = $("<dd></dd>");
                for(var c=0;c<res.length;c++)
                {
                    if(res[i]['menuId']==res[c]['fid'])
                    {
                        var sMenu =
                            '<ul>'+
                            '<li><a data-href="'+res[c]['menuUrl']+'" data-title="'+res[c]['menuName']+'" href="javascript:void(0)">'+res[c]['menuName']+'</a></li>'+
                        '</ul>'

                        dd.append(sMenu);
                    }
                }
                fMenu.append(dd);
               $(".menu_dropdown").append(fMenu)
            }
        }
    }

});