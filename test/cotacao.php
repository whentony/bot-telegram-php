<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../simplehtmldom_1_9_1/simple_html_dom.php';
/*$html = file_get_html('https://coinmarketcap.com/pt-br/currencies/catzcoin/social/');
$cotacao = $html->find('div[class=priceValue___11gHJ]', 0)->plaintext;*/
$html = file_get_html('https://digitalcoinprice.com/coins/catzcoin');
$oneHour = $html->find('div.last_hour', 0)->plaintext;
$cotacao = $html->find('span.price', 0)->plaintext;
$v4 = $html->find('div.last_day', 0)->plaintext;
$seven_day = $html->find('div.last_seven_day', 0)->plaintext;
var_dump($cotacao, $oneHour, $v4, $seven_day);