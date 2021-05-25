<?php

namespace app;
//Exibição de Erros Ativado
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Requisita o arquivo de autoload do composer
require_once ('vendor/autoload.php');
include 'simplehtmldom_1_9_1/simple_html_dom.php';
use \app\ApiController;

$update_response = file_get_contents("php://input");

$update = json_decode($update_response, true);

if (isset($update["message"])) {
    $chat_id = $update["message"]['chat']['id'];
    $textoRetorno = $update["message"]['text'];
    $usuario = $update["message"]['from']['first_name'];
    /*if($textoRetorno == '/start'){
        ApiController::sendMessage('Bom dia '. $usuario . ' Seja bem-vindo', $chat_id);
    }*/

    if($textoRetorno == '!c catz' || $textoRetorno == '价格' || $textoRetorno == 'c' || $textoRetorno == 'p' || $textoRetorno == 'C' || $textoRetorno == 'P'){
    //    $html = file_get_html('https://coinmarketcap.com/currencies/catzcoin/');
      //  $cotacao = $html->find('div[class=priceValue___11gHJ]', 0)->plaintext;

        $html = file_get_html('https://digitalcoinprice.com/coins/catzcoin');
        $html2 = file_get_html('https://bscscan.com/token/0xbfbee3dac982148ac793161f7362344925506903');
        $cotacao = $html->find('span.price', 0)->plaintext;
        $oneHour = $html->find('div.last_hour div.detail_td', 0)->plaintext;
        $v4 = $html->find('div.last_day div.detail_td', 0)->plaintext;
        $seven_day = $html->find('div.last_seven_day div.detail_td', 0)->plaintext;
        $holder = $html2->find('div#ContentPlaceHolder1_tr_tokenHolders div.row div.col-md-8 div.d-flex div.mr-3', 0)->plaintext;
        ApiController::sendMessage('<b>Price: </b>'. $cotacao.PHP_EOL.'<b>1H: </b>'.$oneHour.PHP_EOL.'<b>24H: </b>'.$v4.PHP_EOL.'<b>7D: </b>'.$seven_day.PHP_EOL.'<b>Holders: </b> '. str_replace('addresses','', $holder), $chat_id        );
    }


}