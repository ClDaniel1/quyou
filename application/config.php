<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用命名空间
    'app_namespace'          => 'app',
    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => false,
    // 应用模式状态
    'app_status'             => '',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => 'addslashes',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'home',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // URL伪静态后缀
    'url_html_suffix'        => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由
    'url_route_on'           => true,
    // 路由使用完整匹配
    'route_complete_match'   => false,
    // 路由配置文件（支持配置多个）
    'route_config_file'      => ['route'],
    // 是否强制使用路由
    'url_route_must'         => false,
    // 域名部署
    'url_domain_deploy'      => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [],
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'qy_',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => 'qy_',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],

    "APPID" =>"wx1c17ef311f295218",
    "APPSECRET"=>"81a83770b54c0b614e95b290f9586e04",
    //提示消息
    'msg'                     =>[
        'login'             => [
            'successLogin' => ["code"=>10001,"msg"=>'登录成功',"data"=>[]],
            'codeError' =>["code"=>10002,"msg"=>'验证码错误',"data"=>[]],
            'accountError' =>["code"=>10003,"msg"=>'用户名或密码错误',"data"=>[]],
            'successReg'=>["code"=>10005,"msg"=>'注册成功',"data"=>[]],
            'regError'=>["code"=>10004,"msg"=>'注册失败',"data"=>[]],
            'haveUser'=>["code"=>10006,"msg"=>'用户重复了',"data"=>[]],
            'havePhone'=>["code"=>10006,"msg"=>'您的手机号已经注册了，请前往登录',"data"=>[]],
            'withoutPhone'=>["code"=>10007,"msg"=>'您的手机号未被注册，可以使用',"data"=>[]],
            'noLogin'=>["code"=>19000,"msg"=>'您未登陆',"data"=>[]]
        ],
        'loginChek'     =>[
            'err'=>["code"=>10009,"msg"=>'登录信息有误，请重新登录',"data"=>[]]
        ],
        'note'      =>[
            'notUserNote'=>["code"=>20001,"msg"=>'这不是您的游记',"data"=>[]],
            'imgTooSmall'=>["code"=>20002,"msg"=>"图片过小，请选择宽度大于1350，并且高度大于480的图片","data"=>[]],
            'imgSelectTooSmall'=>["code"=>20003,"msg"=>"裁剪完图片过小，请重新裁剪","data"=>[]],
            'scaleErr'=>["code"=>20004,"msg"=>"图片比例不对，请重新裁剪","data"=>[]],
            'musicSuccess'=>["code"=>20004,"msg"=>"音乐设置成功","data"=>[]],
            "remusicSuccess"=>["code"=>20005,"msg"=>"移除游记音乐成功","data"=>[]],
            "upImgSuccess"=>["code"=>20006,"msg"=>"游记头图上传成功","data"=>[]],
            "musicErr"=>["code"=>20008,"msg"=>"游记音乐设置失败","data"=>[]],
            "remusicErr"=>["code"=>20009,"msg"=>"移除游记音乐失败","data"=>[]],
            "titleSuccess"=>["code"=>20010,"msg"=>"游记标题设置成功","data"=>[]],
            "titleErr"=>["code"=>20011,"msg"=>"游记标题设置失败","data"=>[]],
            "imgSuccess"=>["code"=>20012,"msg"=>"游记图片添加成功","data"=>[]],
            "imgErr"=>["code"=>20013,"msg"=>"游记图片添加失败","data"=>[]],
            "getCon"=>["code"=>20014,"msg"=>"获取内容成功","data"=>[]],
            "getConErr"=>["code"=>20015,"msg"=>"获取内容失败","data"=>[]],
            "saveSuccess"=>["code"=>20016,"msg"=>"草稿保存成功","data"=>[]],
            "saveErr"=>["code"=>20017,"msg"=>"草稿保存失败","data"=>[]],
            "reImgSuccess"=>["code"=>20018,"msg"=>"移除游记图片成功","data"=>[]],
            "reImgErr"=>["code"=>20019,"msg"=>"移除游记图片失败","data"=>[]],
            "upImgErr"=>["code"=>20020,"msg"=>"游记头图上传失败","data"=>[]],
            "submitErr"=>["code"=>20021,"msg"=>"游记提交失败","data"=>[]],
            "submitSuccess"=>["code"=>20022,"msg"=>"游记提交成功","data"=>[]],
            "submitTitleErr"=>["code"=>20023,"msg"=>"游记标题没设置","data"=>[]],
            "submitImgErr"=>["code"=>20024,"msg"=>"游记头图没设置","data"=>[]],
            "getNoteList"=>["code"=>20025,"msg"=>"获取游记列表成功","data"=>[]],

            //后台
            "getNoNoteListSuccess"=>["code"=>20026,"msg"=>"获取未审核游记列表成功","data"=>[]],
            "getNoteListSuccess"=>["code"=>20027,"msg"=>"获取已审核游记列表成功","data"=>[]],
            "escCheckSuccess" =>["code"=>20028,"msg"=>"撤销审核成功","data"=>[]],
            "passSuccess" =>["code"=>20029,"msg"=>"审核成功","data"=>[]],
            "unPassSuccess" =>["code"=>20030,"msg"=>"审核未通过成功","data"=>[]],
            "unPassErr" =>["code"=>20031,"msg"=>"审核未通过失败","data"=>[]],
        ],
        'personal'=> [
            'changeOK' =>["code"=>30002,"msg"=>'修改成功',"data"=>[]],
            'changeErr'=>["code"=>30003,"msg"=>'信息为原信息，请修改',"data"=>[]],
            'haveName'=>["code"=>30001,"msg"=>'昵称已被使用，换一个吧',"data"=>[]],
            'repeatPwd'=>["code"=>30004,"msg"=>'密码为原密码，修改不成功',"data"=>[]],
            'withoutName'=>["code"=>30005,"msg"=>'昵称没有重复，可以使用',"data"=>[]],
            'addFooterErr'=>["code"=>30006,"msg"=>'添加足迹失败',"data"=>[]],
            'addFooter'=>["code"=>30007,"msg"=>'添加足迹成功',"data"=>[]],
            "addFooterHave" =>["code"=>30008,"msg"=>'已经有该足迹了哦',"data"=>[]],
            "userInfoSucc" =>["code"=>30009,"msg"=>'获取用户信息成功',"data"=>[]],
            "userInfoErr" =>["code"=>30010,"msg"=>'登录有误，请重新登录',"data"=>[]],
            'nameSucc'=>["code"=>30011,"msg"=>'用户名修改成功',"data"=>[]],
            'nameErr'=>["code"=>30012,"msg"=>'用户名修改失败',"data"=>[]],
            "oldPswErr"=>["code"=>30013,"msg"=>'旧密码错误',"data"=>[]],
            "chPswErr"=>["code"=>30014,"msg"=>'密码修改失败',"data"=>[]],
            "getOrderSucc" =>["code"=>30015,"msg"=>'获取待支付订单成功',"data"=>[]],
            "getOrderInfoSucc" =>["code"=>30015,"msg"=>'获取订单详情成功',"data"=>[]],
        ],
        'staff'=>[
            'changeOK' =>["code"=>30002,"msg"=>'修改成功',"data"=>[]],
            'changeErr'=>["code"=>30003,"msg"=>'信息为原信息，请修改',"data"=>[]]
        ],
        'manager'=>[
            'changeOK' =>["code"=>60001,"msg"=>'修改成功',"data"=>[]],
            'changeErr'=>["code"=>60002,"msg"=>'修改失败',"data"=>[]],
            'delOK'=>["code"=>60003,"msg"=>'删除成功',"data"=>[]],
            'delErr'=>["code"=>60004,"msg"=>'删除失败',"data"=>[]]
        ],
        "userCon"=>[
            "rePsw"=>['code'  =>  "40001",'msg'   =>  "密码重置成功!",'data'  => []],
            "open"=>['code'   =>  "40002",'msg'  =>  "启用成功！" ,"data"=>[]],
            "stop"=>['code'   =>  "40003",'msg'  =>  "用户停用！" ,"data"=>[]],
            "del"=>['code'   =>  "40004",'msg'  =>  "删除成功！" ,"data"=>[]],
            "Repair"=>['code'   =>  "40005",'msg'  =>  "修改成功！" ,"data"=>[]],
            "haveWx" => ['code'   =>  "40006",'msg'  =>  "该账户已绑定微信,是否换绑为当前微信号?" ,"data"=>[]],
            "wxBindSucc" => ['code'   =>  "40007",'msg'  =>  "绑定成功" ,"data"=>[]],
            "wxBindhave" => ['code'   =>  "40008",'msg'  =>  "该微信已绑定账户" ,"data"=>[]],
            "wxBindErr" => ['code'   =>  "40009",'msg'  =>  "绑定失败" ,"data"=>[]],
            "wxBindTimeOut" => ['code'   =>  "40010",'msg'  =>  "微信登录已过期" ,"data"=>[]],
            "onKeySucc" => ['code'   =>  "40011",'msg'  =>  "一键注册成功" ,"data"=>[]]
        ],
        "msg" => [
            "getSysMsg" =>["code"=>50001,"msg"=>'获取系统消息成功',"data"=>[]]
        ],
        "tenants" =>  [
            "tenantsImg" =>["code"=>40001,"msg"=>'上传图片成功！',"data"=>[]],
            "coverImg"=>["code"=>40002,"msg"=>'已注册，待系统审查完毕将以短信通知您是否成功！',"data"=>[]],
            "coverNot"=>["code"=>40003,"msg"=>'商家账号已被注册，请重新输入！',"data"=>[]]
        ],
        "audit"=>[
            "auditPass"=>["code"=>40001,"msg"=>'审核通过，将以短信方式通知商家！',"data"=>[]],
            "auditPassNot"=>["code"=>40002,"msg"=>'审核失败，将以短信方式通知商家！',"data"=>[]]
        ],
        "contact"=>['code'  =>  "50001",'msg'   =>  "添加联系人成功!",'data'  => []],
        "order"=>[
            'orderF'=>['code'  =>  "60001",'msg'   =>  "下单失败，请重试!",'data'  => []],
            'orderT'=>['code'  =>  "60002",'msg'   =>  "下单成功，即将跳转至支付页面!",'data'  => []],
            'numF'=>['code'  =>  "60003",'msg'   =>  "请确认全部房间联系人是否填写完成!",'data'  => []],
            'pwdF'=>['code'  =>  "60004",'msg'   =>  "支付密码有误，请重新输入!",'data'  => []],
            'payF'=>['code'  =>  "60005",'msg'   =>  "余额不足，请先进行充值!",'data'  => []],
            'payT'=>['code'  =>  "60006",'msg'   =>  "恭喜您支付成功!",'data'  => []],
            'cancelT'=>['code'  =>  "60007",'msg'   =>  "取消订单成功!",'data'  => []],
            'cancelF'=>['code'  =>  "60008",'msg'   =>  "取消订单失败!",'data'  => []],
        ],
        "collection"=>[
            'collectionYes'=>['code'  =>  "70001",'msg'   =>  "收藏成功！",'data'  => []],
            'collectionNo'=>['code'  =>  "70002",'msg'   =>  "收藏失败！",'data'  => []]
        ],
        "focus"=>[
            'focusYes'=>['code'  =>  "80001",'msg'   =>  "关注成功！",'data'  => []],
            'focusNo'=>['code'  =>  "80002",'msg'   =>  "关注失败！",'data'  => []],
            'focusHeavy'=>['code'  =>  "80003",'msg'   =>  "不能关注自己！",'data'  => []]
        ],
<<<<<<< HEAD
=======
<<<<<<< HEAD
        "food"=>[
            "foodRegion"=>['code'  =>  "80001",'msg'   =>  "获取成功！",'data'  => []],
=======
<<<<<<< HEAD
>>>>>>> 87fcf57c6d3ca7519c05fc255573b6ed29b5f095
        "des" => [
            'getInSuccess' => ['code'  =>  90001,'msg'   =>  "获取信息成功",'data'  => []]
>>>>>>> b3bc5795c0583319ef04d12cdac8e83a113aeaf4
        ]
    ],
    //验证码
    'captcha'  => [
    // 验证码字符集合
    'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',

    // 验证码字体大小(px)
    'fontSize' => 20,

    // 是否画混淆曲线
    'useCurve' => false,

    // 验证码图片高度
    'imageH'   => 50,

    // 验证码图片宽度
    'imageW'   => 125,

    // 验证码位数
    'length'   => 4,

    // 验证成功后是否重置
    'reset'    => true
    ],

];
