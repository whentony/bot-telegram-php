<?php

namespace app;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;

//Exibição de Erros Ativado
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Classe que gerencia o envio de mensagens via Telegram
 */
class ApiController
{
    /**
     * Retorna o ID do Chat na qual o robo está inserido
     *
     * @param string $token
     * @return string
     */
    public static function getChatId(string $token): ?string
    {
        $chatId = null;
        //Montagem da URL da Rota para obter as mensagens para o robo
        $endPoint = "https://api.telegram.org/bot{$token}/getUpdates";
        //Consultamos a APi através do método GET
        $content = file_get_contents($endPoint);

        //Verifica a validade do conteúdo
        if ($content == '' || $content == null) {
            return null;
        }
        //o true no json_decode afirma que queremos um array associativo (map)
        //Transforma o JSON em um array associativo
        $arr = json_decode($content, true);

        //Verifica se o ID do chat não foi encontrado
        if (!isset($arr['result'][0]['message']['chat']['id'])) {
            return null;
        }

        // Retorna o ID do chat
        return $arr['result'][0]['message']['chat']['id'];

    }

    /**
     * Envia uma mensagem através do robo e chat informado
     *
     * @param string $message
     * @param $chatid
     * @return bool
     */
    public static function sendMessage(string $message, $chatid): bool
    {
        try {

            //Instância da classe botAPi, passando o token que se refere ao nosso robô
            $bot = new BotApi(TOKEN);
            //Chamamos  o método que envia  a mensagem para o robô
            $bot->sendMessage($chatid, $message, 'HTML');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}