<?php


//Requisita o arquivo de autoload do composer
require_once ('vendor/autoload.php');
use \app\ApiController;


$chatId = ApiController::getChatId(TOKEN);

var_dump($chatId);
