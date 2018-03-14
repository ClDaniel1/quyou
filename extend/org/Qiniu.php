<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/3/4
 * Time: 22:34
 */

namespace org;

require '../root/vendor/autoload.php';


// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

use \Qiniu\Cdn\CdnManager;

class Qiniu
{
    public function up($filename,$keyName){
        $accessKey ="77cNcLYiAZfA60WeXeHTEpf0LZvAKvnmb6wlUz4e";
        $secretKey = "pE7ZdbatAv3uI-HN1FtUEsN2EpCzDWUSQWF9LqX-";
        $bucket = "quyou";
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        $filePath = $filename;
        // 上传到七牛后保存的文件名
        $key = $keyName;
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();


        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
    }

    public function re($fileName){
        $accessKey ="77cNcLYiAZfA60WeXeHTEpf0LZvAKvnmb6wlUz4e";
        $secretKey = "pE7ZdbatAv3uI-HN1FtUEsN2EpCzDWUSQWF9LqX-";
        $auth = new Auth($accessKey, $secretKey);
//待刷新的文件列表和目录，文件列表最多一次100个，目录最多一次10个
//参考文档：http://developer.qiniu.com/article/fusion/api/refresh.html
        $urls = array(
            "https://quyou.liner.fun/".$fileName

        );
        $cdnManager = new CdnManager($auth);
//如果只有刷新链接或者目录的需求，可以分布使用
        list($refreshResult, $refreshErr) = $cdnManager->refreshUrls($urls);
        if ($refreshErr != null) {
            var_dump($refreshErr);
        }
    }

    public function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }


    public function curlHttp($url,$data = null,$headers=null){//curl
        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL,$url);
        //POST请求
        if ($data != null){
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS ,$data);
        }
        if($headers!=null){
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_REFERER, "http://www.mafengwo.cn");
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        return $output;
    }
}