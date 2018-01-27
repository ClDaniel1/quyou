<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/1/26
 * Time: 11:59
 */
namespace org;

use think\response\Json;

class Intro{
    public $page = 1;
    public $num = 0;
    public function getIntro($name){//获取百科
        $html = new simple_html_dom();
        $html->load_file("https://baike.baidu.com/item/{$name}");
        $intro = $html->find('div[class=para]',0);
        $intro2 = $html->find('div[class=para]',1);
        $intro = $intro.$intro2;
        $img = $html->find('div[class=summary-pic]',0)->first_child()->first_child ();
        $img = $img->attr['src'];
        $img = "<img src='".$img."' alt=''>";
        $intro = preg_replace("/<a[^>]*>(.*?)<\/a>/is", "$1", $intro);
        $intro = preg_replace("/<div[^>]*>(.*?)<\/div>/is", "$1", $intro);
        $intro = preg_replace("/<sup[^>]*>.*?<\/sup>/is", "$1", $intro);
       return ["intro"=>$intro,"img"=>$img];
    }

    public function getAll($desId,$id1){

        $this->getHotalImg($desId,$id1);

        echo "<div style='width: 100%;height: 75px;font-size: 25px;background: green;color: white;line-height: 75px;text-align: center'>酒店完成</div>";

        $this->num = 0;
        $this->page = 1;
        $this->getSecImg($desId,$id1);
        echo "<div style='width: 100%;height: 75px;font-size: 25px;background: green;color: white;line-height: 75px;text-align: center'>景点完成</div>";

        $this->num = 0;
        $this->page = 1;
        $this->getFoodImg($desId,$id1);
        echo "<div style='width: 100%;height: 75px;font-size: 25px;background: green;color: white;line-height: 75px;text-align: center'>美食完成</div>";

    }

    private function getHotalImg($desId,$id1){
        $html = new simple_html_dom();
        $html->clear();
        //获取酒店列表
        $res = $this->curlHttp("http://www.mafengwo.cn/hotel/ajax.php?iMddId=".$id1."&iAreaId=-1&iRegionId=-1&iPoiId=&position_name=&nLat=0&nLng=0&iDistance=10000&sCheckIn=2018-03-06&sCheckOut=2018-03-07&iAdultsNum=2&iChildrenNum=0&sChildrenAge=&iPriceMin=&iPriceMax=&sTags=&sSortType=comment&sSortFlag=DESC&has_booking_rooms=0&has_faved=0&sKeyWord=&iPage=".$this->page."&sAction=getPoiList5");
        $res = json_decode($res,true);
        $html2 = str_get_html($res["html"]);
        //分析酒店id
        $res = $html2->find("div[class=hotel-item clearfix _j_hotel_item]");
        $idArr = [];
        foreach ($res as $k => $v){
            if($v->attr["data-is-airbnb"] == 0){
                array_push($idArr,$v->attr["data-id"]);
            }
        }
        //循环酒店ID获取数据
        foreach ($idArr as $k => $id){
            //获取酒店缩略图参数
            $res = $this->curlHttp("http://www.mafengwo.cn/hotel/ajax.php?sAction=getAlbumClassTags&poi_id=".$id);
            $res = json_decode($res,true);
            //获取酒店详情页面
            $html = new simple_html_dom();
            $html->load_file("http://www.mafengwo.cn/hotel/".$id.".html?iMddid=10065");

            //获取酒店名字
            $name = $html->find('div[class=main-title]',0);
            $name = preg_replace("/<h1[^>]*>(.*?)<\/h1>/is", "$1", $name);
            $name = preg_replace("/<div[^>]*>(.*?)<\/div>/is", "$1", $name);
            $name = preg_replace("/<i[^>]*>(.*?)<\/i>/is", "$1", $name);
            $name = preg_replace("/\s*/", "$1", $name);

            //是否满足条件判断
            if(count($res) > 2 && $res[1]["count"]>=10 && $res[1]["name"]=="外观"){
                //获取酒店简介
                $jj = $html->find('div[class=exp]',0);
                if($jj != null){
                    $jj = $html->find('div[class=exp]',0)->first_child();
                    $jj = preg_replace("/<p[^>]*>(.*?)<\/p>/is", "$1", $jj);

                    //获取酒店价格
                    $res = $this->curlHttp("http://www.mafengwo.cn/hotel/ajax.php?sAction=getBookingInfo&poi_id=".$id."&check_in=2018-03-06&check_out=2018-03-07&adults_num=2&children_num=0&children_age=&mddid=10065&booking_flag=hotel_new");
                    $res = json_decode($res,true);
                    $html1 = str_get_html($res["html"]);
                    $pri = $html1->find('strong[class=_j_booking_price]',0);
                    $pri = preg_replace("/<strong[^>]*>(.*?)<\/strong>/is", "$1", $pri);
                    $pri = preg_replace("/￥/is", "$1", $pri);

                    //获取酒店房间数
                    $num = $html->find('dd[class=clearfix]',0)->last_child ()->find('strong',0);
                    $num = preg_replace("/<strong[^>]*>(.*?)<\/strong>/is", "$1", $num);

                    //获取图片相册id
                    $dataid = $html->find('ul[class=img-small]',0)->first_child ()->find('img',0)->attr["data-id"];

                    //将酒店插入数据库
                    $data1 =  ['hotelName' => $name, 'hotelDescribe' => $jj,'hotelPrice' => $pri,'hotelNum' => $num,'desId' => $desId,'img' => "img",];
                    $hid = db('t_hotel')->insertGetId($data1);

                    //获取酒店图片
                    $res = $this->curlHttp("http://www.mafengwo.cn/hotel/ajax.php?sAction=getAlbumImages&poi_id=".$id."&album_id=".$dataid."&num=10");
                    $res = json_decode($res,true);


                    $imgList = $res["list"];

                    //酒店图片文件夹名
                    $dirName = "static/images/hotel/".$hid;
                    if(!file_exists($dirName)){
                        mkdir ($dirName,0777,true);
                    }
                    else{
                        echo "</br>列表已完成！共{$this->num}</br>";
                        return;
                    }

                    //循环图片url数组保存图片
                    foreach ($imgList as $key=>$v){
                        $img =  $this->curlHttp($v["url_big"]);
                        $imgName = $hid."_".$key.".jpeg";
                        file_put_contents($dirName."/".$imgName,$img);
                        $imgUrl = "images/hotel/".$hid."/".$imgName;
                        if($key == 0){
                            db('t_hotel')->update(['img' => $imgUrl,'hotelId'=>$hid]);
                        }
                        else{
                            $data = ['url' => $imgUrl, 'hotelId' => $hid];
                            db('t_hotelimg')->insert($data);
                        }
                    }
                    $this->num =  $this->num+1;
                    echo $name." <span style='margin-left: 35px;display: inline-block'>第{$this->num}ok</span></br>";
                    if($this->num >= 10){
                        echo "</br>完成</br>";

                        $this->num = 0;
                        $this->page = 1;
                        return;
                    }
                }
                else{
                    echo $name."<span style='margin-left: 35px;display: inline-block'>没简介</span></br>";
                }
            }
            else{
                echo $name."<span style='margin-left: 35px;display: inline-block'>图片太少</span></br>";
            }
        }
        echo "</br>第".$this->page."页完成</br>";
        $this->page = $this->page+1;
        if($this->page >= 31){
            echo "</br>已30页，终止！！</br>";

            $this->num = 0;
            $this->page = 1;
            return;
        }
        $this->getHotalImg($desId,$id1);
    }

    private function getSecImg($desId,$id1){
        $html = new simple_html_dom();
        $html->clear();
        $url = "http://www.mafengwo.cn/ajax/router.php";
        $data = "sAct=KMdd_StructWebAjax%7CGetPoisByTag&iMddid=".$id1."&iTagId=0&iPage=".$this->page;
        $res = $this->curlHttp($url,$data);
        $res = json_decode($res,true);
        $res = $res["data"]["list"];
        $html1 = str_get_html($res);

        //景点数组
        $secArr=[];

        $a = $html1->find("a");
        foreach ($a as $k){
            $href =  explode("/",$k->href)[2];
            $href = explode(".",$href)[0];
            array_push($secArr,$href);
        }


        foreach ($secArr as $sec){
            $url = "http://www.mafengwo.cn/poi/".$sec.".html";
            $html->load_file($url);
            $title = $html->find("div[class=title]",0)->first_child();
            $title = preg_replace("/<h1[^>]*>(.*?)<\/h1>/is", "$1", $title);
            $title = preg_replace("/<div[^>]*>(.*?)<\/div>/is", "$1", $title);
            $title = preg_replace("/\s*/", "$1", $title);

            $summary = $html->find("div[class=summary]",0);
            $summary = preg_replace("/<div[^>]*>(.*?)<\/div>/is", "$1", $summary);
            $summary = preg_replace("/<br[^>]*>/", "$1", $summary);
            $summary = preg_replace("/\s*/", "$1", $summary);
            if(strlen($summary) == 0){
                echo $title."<span style='margin-left: 35px;display: inline-block'>没有简介</span></br>";
            }
            else{
                $priUrl = "http://pagelet.mafengwo.cn/poi/pagelet/poiTicketsApi?callback=jQuery18105915208781407191_1516968330159&params=%7B%22poi_id%22%3A%22".$sec."%22%7D&_=1516968330691";
                $res = $this->curlHttp($priUrl);

                $res = explode("(",$res)[1];
                $res = explode(")",$res)[0];
                $res = json_decode($res,true)["data"]["html"];
                $html2 = str_get_html($res);
                if($html2 == false){
                    echo $title."<span style='margin-left: 35px;display: inline-block'>没有价格</span></br>";
                }
                else{
                    $pri = $html2->find("td[class=price]");
                    $n = $html2->find("td[class=type]");
                    foreach ($n as $p=>$t){
                        $t = preg_replace("/<td[^>]*>(.*?)<\/td>/is", "$1", $t);
                        if($t == "景点门票"){
                            $n = $p;
                            break;
                        }
                    }
                    if(is_array($n)){
                        $n = 0;
                    }
                    $pri = $pri[$n];
                    $pri = preg_replace("/￥/", "$1", $pri);
                    $pri = preg_replace("/起/", "$1", $pri);
                    $pri = preg_replace("/<td[^>]*>(.*?)<\/td>/is", "$1", $pri);


                    $data1 =  ['scenicName' => $title, 'scenicDescribe' => $summary,'price' => $pri,'desId' => $desId,'scenicImg' => "img",];
                    $secid = db('t_scenic')->insertGetId($data1);

                    $dirName = "static/images/scenic/".$secid;
                    mkdir ($dirName,0777,true);

                    $photoUrl = "http://www.mafengwo.cn/mdd/ajax_photolist.php?act=getPoiPhotoList&poiid=".$sec."&page=1";
                    $html->load_file($photoUrl);
                    $img = $html->find("img");

                    foreach ($img as $k => $v){
                        $src = $v->src;
                        $src = explode("?",$src)[0];
                        $type = explode(".",$src);
                        $n = count($type)-1;
                        $type = $type[$n];

                        $img1 =  $this->curlHttp($src);

                        $imgName = $secid."_".$k.".".$type;
                        file_put_contents($dirName."/".$imgName,$img1);
                        $imgUrl = "images/scenic/".$secid."/".$imgName;
                        if($k == 0){
                            db('t_scenic')->update(['scenicImg' => $imgUrl,'scenicId'=>$secid]);
                        }
                        else{
                            $data = ['url' => $imgUrl, 'scenicId' => $secid];
                            db('t_scenicimg')->insert($data);
                        }
                    }

                    echo $title."<span style='margin-left: 35px;display: inline-block'>成功</span></br>";
                }

            }



        }

        $this->page = $this->page+1;
        if($this->page>2){
            return;
        }
        $this->getSecImg($desId,$id1);
    }

    private function getFoodImg($desId,$id1){
        $html = new simple_html_dom();
        $html->clear();

        $url = "http://www.mafengwo.cn/cy/".$id1."/0-0-0-0-0-".$this->page.".html";
        $html->load_file($url);
        $title = $html->find("div[class=title]");

        $foodArr = [];

        foreach ($title as $k){
            $k =  $k->find("a",0);
            $href =  explode("/",$k->href)[2];
            $href = explode(".",$href)[0];
            array_push($foodArr,$href);
        }

        foreach ($foodArr as $v){
            $url = "http://www.mafengwo.cn/poi/".$v.".html";
            $html->load_file($url);

            $title = $html->find("div[class=t]",0);
            $title = preg_replace("/<h1[^>]*>(.*?)<\/h1>/is", "$1", $title);
            $title = preg_replace("/<div[^>]*>(.*?)<\/div>/is", "$1", $title);
            $title = preg_replace("/\s*/", "$1", $title);


            $quote = $html->find("dd[class=quote]",0);
            if(strlen($quote) == 0){
                echo $title."<span style='margin-left: 35px;display: inline-block'>没有简介</span></br>";
            }else{
                $quote = preg_replace("/<dd[^>]*>(.*?)<\/dd>/is", "$1", $quote);
                $quote = preg_replace("   /[\xf0-\xf7].{3}/", "$1", $quote);
                $type = mt_rand(1,5);
                $add = $html->find("i[class=icon-location]",0)->parent();
                $add = preg_replace("/<i[^>]*>(.*?)<\/i>/is", "$1", $add);
                $add = preg_replace("/<li[^>]*>(.*?)<\/li>/is", "$1", $add);
                $add = preg_replace("/\s*/", "$1", $add);
                $add = preg_replace("/地址：/", "$1", $add);

                $data1 =  ['foodName' => $title, 'foodDescribe' => $quote,'desId' => $desId,'foodTypeId' => $type,'foodImg' => "img",'address'=>$add];
                $foodid = db('t_food')->insertGetId($data1);


                $dirName = "static/images/food/".$foodid;
                mkdir ($dirName,0777,true);

                $photoUrl = "http://www.mafengwo.cn/mdd/ajax_photolist.php?act=getPoiPhotoList&poiid=".$v."&page=1";
                $html->load_file($photoUrl);
                $img = $html->find("img");


                foreach ($img as $c => $i){
                    $src = $i->src;
                    $src = explode("?",$src)[0];
                    $type = explode(".",$src);
                    $n = count($type)-1;
                    $type = $type[$n];

                    $img1 =  $this->curlHttp($src);

                    $imgName = $foodid."_".$c.".".$type;
                    file_put_contents($dirName."/".$imgName,$img1);
                    $imgUrl = "images/food/".$foodid."/".$imgName;
                    if($c == 0){
                        db('t_food')->update(['foodImg' => $imgUrl,'foodId'=>$foodid]);
                    }
                    else{
                        $data = ['url' => $imgUrl, 'foodId' => $foodid];
                        db('t_foodimg')->insert($data);
                    }
                }
                echo $title."<span style='margin-left: 35px;display: inline-block'>成功</span></br>";
            }

        }

        $this->page = $this->page+1;
        if($this->page>2){
            return;
        }
        $this->getFoodImg($desId,$id1);

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