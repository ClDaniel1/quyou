<?php
include_once('extend/org/simple_html_dom.php');

$html = new simple_html_dom();
$html->load_file('https://baike.baidu.com/item/福州');
$a = $html->find('div[class=para]',0);
$b = $html->find('div[class=summary-pic]',0)->first_child ()->first_child ();
$str = preg_replace("/<a[^>]*>(.*?)<\/a>/is", "$1", $a);
echo $str;
echo $b;


/*$url = "https://baike.baidu.com/item/%E7%A6%8F%E5%B7%9E";
$ch = curl_init();
//设置选项，包括URL
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HEADER,0);
//执行并获取HTML文档内容
$output = curl_exec($ch);
//释放curl句柄
curl_close($ch);
//打印获得的数据
$html = file_get_html($output);
var_dump($output) ;*/