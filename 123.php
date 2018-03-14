<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/3/3
 * Time: 1:56
 */
require '/root/vendor/autoload.php';


// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;




$sccN = 0;
$errN = 0;

function update($filename){
    global $sccN,$errN;
    if(is_dir($filename)){
        $filehand = opendir($filename);
        while(($filesname = readdir($filehand))!=false){
            if($filesname!="."&&$filesname!=".."){
                if(is_dir($filename."/".$filesname)){
                    update($filename."/".$filesname);
                }
                else{
                    // 需要填写你的 Access Key 和 Secret Key
                    $accessKey ="77cNcLYiAZfA60WeXeHTEpf0LZvAKvnmb6wlUz4e";
                    $secretKey = "pE7ZdbatAv3uI-HN1FtUEsN2EpCzDWUSQWF9LqX-";
                    $bucket = "quyou";
                    // 构建鉴权对象
                    $auth = new Auth($accessKey, $secretKey);
                    // 生成上传 Token
                    $token = $auth->uploadToken($bucket);

                    // 要上传文件的本地路径
                    $filePath = $filename."/".$filesname;
                    // 上传到七牛后保存的文件名
                    $key = $filename."/".$filesname;
                    // 初始化 UploadManager 对象并进行文件的上传。
                    $uploadMgr = new UploadManager();


                    // 调用 UploadManager 的 putFile 方法进行文件的上传。
                    list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);

                    if ($err !== null) {
                        echo "\n====> putFile result: \n";
                        var_dump($err);
                        $errN++;
                        echo '错误'.$errN."\n";
                    } else {
                       // var_dump($ret);
                        $sccN++;
                        echo '成功数'.$sccN."\n";
                    }
                }
            }
        }
        closedir($filehand);
    }
}

update("quyou/public/static/images");

echo 'done'."\n";
echo '总错误'.$errN."\n";
echo '总成功数'.$sccN."\n";



var_dump(123);
