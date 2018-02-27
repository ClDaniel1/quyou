<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/7
 * Time: 15:21
 */

namespace org;

define("appID","wx0a220419a19f4239");
define("appsecret","58d9ceda4f50c014bc73edf55fdc39e6");

class wxApi{
    private $accKey = "";

    public  function first(){
        $echoStr = $_GET["echostr"];
        if($this->check()){

            ob_clean();
            echo $echoStr;
        }
        else{

        }
    }

    private function check()
    {
        $signature =  $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tocken = 'liner';


        $tmpArr = array($tocken,$timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function fansMsg(){
        $s = 1;
        $rcontent = "没懂哦";

        $msg = file_get_contents("php://input");

        file_put_contents("fans.txt",$msg);

        $msgObj = simplexml_load_string($msg, 'SimpleXMLElement', LIBXML_NOCDATA);

        $content = $msgObj->Content;

        if($msgObj->ToUserName == "gh_48682835ee2e"){
            $acc = $this->getLittAccKey();
            $type=1;
        }
        else{
            $acc = $this->getAccKey();
            $type=0;
        }

        switch ($msgObj->MsgType){
            case "text":
                //图灵API接口
                $url = "http://www.tuling123.com/openapi/api";
                //发送的消息
                $params = array(
                    "key" => '05c8180caf324951b283b2856a7f8f45',
                    "info" => (string) $content,
                    "userid" => (string)$msgObj -> FromUserName
                );
                $paramstring = json_encode($params, JSON_UNESCAPED_UNICODE);

                //curl 发送POST
                $headers[] = 'Content-Type: application/json; charset=utf-8';
                $result = json_decode($this->curlHttp($url,$paramstring,$headers));


                if($result->code == '200000'){
                    $s = 0;
                    $remsg = '<xml>
                                    <ToUserName><![CDATA['.$msgObj -> FromUserName.']]></ToUserName>
                                    <FromUserName><![CDATA['.$msgObj -> ToUserName.']]></FromUserName>
                                    <CreateTime>'.time().'</CreateTime>
                                    <MsgType><![CDATA[news]]></MsgType>
                                    <ArticleCount>1</ArticleCount>
                                    <Articles>
                                        <item>
                                            <Title><![CDATA['.$result->text.']]></Title> 
                                            <Description><![CDATA[点击即可查看]]></Description>
                                            <PicUrl><![CDATA[https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1515088391787&di=1603d9875935555879abe3058ec577ec&imgtype=0&src=http%3A%2F%2Fscimg.jb51.net%2Fallimg%2F170605%2F106-1F605102541131.jpg]]></PicUrl>
                                            <Url><![CDATA['.$result->url.']]></Url>
                                        </item>
                                    </Articles>
                                </xml>';
                    echo $remsg;
                }
                else{
                    $rcontent = $result->text;
                }
                break;

            case "event":
                switch ($msgObj->Event){
                    case "CLICK":
                        switch ($msgObj->EventKey){
                            case "clickclick":
                                $s = 0;
                                $data = array('name'=>'boy', "upload"=>"");
                                $data['upload']=new CURLFile(realpath(getcwd().'/sc/img.jpg'));
                                $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$acc}&type=thumb";
                                $res = $this->curlHttp($url,$data);
                                $res = json_decode($res);
                                $imgId = $res->thumb_media_id;
                                $resmsg = "<xml>
                                        <ToUserName><![CDATA[".$msgObj -> FromUserName."]]></ToUserName>
                                        <FromUserName><![CDATA[".$msgObj -> ToUserName."]]></FromUserName>
                                        <CreateTime>".time()."</CreateTime>
                                        <MsgType><![CDATA[music]]></MsgType>
                                        <Music>
                                            <Title><![CDATA[Shape Of You]]></Title>
                                            <Description><![CDATA[Ed Sheeran]]></Description>
                                            <MusicUrl><![CDATA[https://www.liner.fun/wx/sc/song.mp3]]></MusicUrl>
                                            <HQMusicUrl><![CDATA[https://www.liner.fun/wx/sc/song.mp3]]></HQMusicUrl>
                                            <ThumbMediaId><![CDATA[".$imgId."]]></ThumbMediaId>
                                        </Music>
                                        </xml>";

                                echo $resmsg;
                                break;
                            default:
                                $rcontent = "感谢点击";
                                break;
                        }
                        break;

                    case "scancode_waitmsg":
                        $rcontent = "感谢扫码";
                        break;

                    case "user_enter_tempsession":
                        $rcontent = "您好，有什么可以帮您";
                        break;
                }
                break;

            case "location":
                $rcontent = "感谢发送位置";
                break;

            case "image":
                $s = 0;
                $data = array('name'=>'boy', "upload"=>"");
                $data['upload']=new CURLFile(realpath(getcwd().'/sc/xin.png'));
                $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$acc}&type=image";
                $res = json_decode($this->curlHttp($url,$data));
                $imgId = $res->media_id;

                if($type == "0"){
                    $resmsg = "<xml>
                                        <ToUserName><![CDATA[".$msgObj -> FromUserName."]]></ToUserName>
                                        <FromUserName><![CDATA[".$msgObj -> ToUserName."]]></FromUserName>
                                        <CreateTime>".time()."</CreateTime>
                                        <MsgType><![CDATA[image]]></MsgType>
                                        <Image><MediaId><![CDATA[".$imgId."]]></MediaId></Image></xml>";
                    echo $resmsg;
                }
                else{
                    $data = '{
                                        "touser":"'.$msgObj -> FromUserName.'",
                                        "msgtype":"image",
                                        "image":
                                        {
                                          "media_id":"'.$imgId.'"
                                        }
                                    }';

                    $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$acc;
                    $this->curlHttp($url,$data);
                }

                break;
        }


        if($s == 1){
            $this->sendText($msgObj -> FromUserName,$msgObj -> ToUserName,$rcontent,$type);
        }
    }

    public function sendText($to,$from,$content,$type){
        if($type == 0){
        $remsg =  '<xml>
                                    <ToUserName><![CDATA['.$to.']]></ToUserName>
                                    <FromUserName><![CDATA['.$from.']]></FromUserName> 
                                    <CreateTime>'.time().'</CreateTime> <MsgType><![CDATA[text]]></MsgType> 
                                    <Content><![CDATA['.$content.']]>
                                    </Content>
                                </xml>';

            echo $remsg;
        }
        else{
            $acc = $this->getLittAccKey();
            $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$acc;

            $data = '{
                                "touser":"'.$to.'",
                                "msgtype":"text",
                                "text":
                                    {
                                         "content":"'.$content.'"
                                    }
                                }';

            $this->curlHttp($url,$data);
        }

    }

    public function setMenu(){
        $menu = ' {
                                 "button":[
                                 {    
                                      "type":"click",
                                      "name":"今日歌曲",
                                      "key":"clickclick"
                                  },
                                 {    
                                      "type":"view",
                                      "name":"问卷星",
                                      "url":"https://www.liner.fun/wx/wjx/index.php"
                                  },
                                  {
                                       "name":"菜单",
                                       "sub_button":[
                                       {    
                                           "type":"view",
                                           "name":"搜索",
                                           "url":"http://www.soso.com/"
                                        },
                                        {
                                           "type":"scancode_push",
                                           "name":"扫一扫",
                                           "key":"sys"
                                        },
                                        {
                                            "type":"pic_photo_or_album",
                                            "name":"拍一拍",
                                             "key":"pyp"
                                        },
                                        {
                                            "type":"location_select",
                                            "name":"发送位置",
                                             "key":"local"
                                        }]
                                   }]
                             }';

        $accKey = $this->getAccKey();
        $url =  "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accKey;

        var_dump($this->curlHttp($url,$menu));

    }

    public function delMenu(){
        $accKey = $this->getAccKey();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$accKey;
        $this->curlHttp($url);
    }

    public function setCus(){
        $acc = $this->getAccKey();
        $url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token={$acc}";
        $data = '{
                              "kf_account" : "cus1@gh_4f5606eb493e",
                              "nickname" : "客服1"
                           }';
        var_dump($this->curlHttp($url,$data));
    }

    private function checkAccKey(){
        $time = filemtime ("acc.txt");
        if($time == false){
            return($this->setAccKey());
        }
        else{
            if($time < strtotime("-1 hours")){
                return($this->setAccKey());
            }
            else{
                return true;
            }
        }
    }

    private function setAccKey(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".appID."&secret=".appsecret;
        $res = json_decode($this->curlHttp($url));
        return(file_put_contents("acc.txt",$res->access_token));
    }

    public function getAccKey(){
        if($this->checkAccKey()){
            return $this->accKey = file_get_contents("acc.txt");
        }
    }

    private function checkLittAccKey(){
        $time = filemtime ("Littacc.txt");
        if($time == false){
            return($this->setLittAccKey());
        }
        else{
            if($time < strtotime("-1 hours")){
                return($this->setLittAccKey());
            }
            else{
                return true;
            }
        }
    }

    private function setLittAccKey(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx1c17ef311f295218&secret=81a83770b54c0b614e95b290f9586e04";
        $res = json_decode($this->curlHttp($url));
        return(file_put_contents("Littacc.txt",$res->access_token));
    }

    public function getLittAccKey(){
        if($this->checkLittAccKey()){
            return $this->accKey = file_get_contents("Littacc.txt");
        }
    }

    public function curlHttp($url,$data = null,$headers=null){
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
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        return $output;
    }
}