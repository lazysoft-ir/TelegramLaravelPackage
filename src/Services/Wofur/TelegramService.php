<?php

namespace Lazysoft\Wufor\Services\Wofur;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Lazysoft\Wufor\WofurPlatformServiceInterface;

class TelegramService implements WofurPlatformServiceInterface
{
    private string $token;

    public function __construct()
    {
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    protected function url($method)
    {
        return "https://api.telegram.org/bot" . $this->token . "/" . $method;
    }

    /**
     * [execute description]
     *
     * @param   string  $method  [$method description]
     * @param   array   $param   [$param description]
     *
     * @return  boolean|array            [return description]
     */
    protected function execute(string $method, array $param)
    {
        $param = $param;
        $param["headers"] = ["Content-Type" => "application/json"];
        // $param["curl"] = [CURLOPT_PROXYTYPE => 7];
        // $param["proxy"] = "127.0.0.1:9050";
        $response = Http::post($this->url($method), $param);
        if (!$response || $response->getStatusCode() !== 200) {
            return false;
        }
        $updates = json_decode($response->getBody(), true);
        return $updates;
    }

    /**
     * [getUpdates description]
     *
     * @param   int  $offset  [$offset description]
     *
     * @return  [type]         [return description]
     */
    public function getUpdates(int $offset)
    {
        return self::execute("getUpdates", ["query" => ["offset" => $offset]]);
    }

    /**
     * [sendmessage description]
     *
     * @param   string  $message      [$message description]
     * @param   string  $chatId      [$chatId description]
     * @param   array   $reply_markup  [$reply_markup description]
     *
     * @return  []                     [return description]
     */
    public function sendMessage(string $message, string $chatId, array $replyMarkup = [])
    {
        $query = [
            "chat_id" => $chatId,
            "text" => $message,
        ];
        if (!empty($reply_markup)) {
            $query["reply_markup"] = json_encode($reply_markup);
        }
        $execute = self::execute("sendMessage", [
            "query" => $query,
        ]);

        return $execute;
    }

    /**
     * [make_keyboard description]
     *
     * @param   array  $keyboards  [$keyboards description]
     * @param   bool   $_resize    [$_resize description]
     * @param   false              [ description]
     * @param   bool   $_once      [$_once description]
     * @param   false              [ description]
     *
     * @return  array             [return description]
     */
    public function make_keyboard(array $keyboards, bool $_resize = false, bool $_once = false)
    {
        return [
            "keyboard" => $keyboards,
            "resize_keyboard" => $_resize,
            "one_time_keyboard" => $_once,
        ];
    }

    /**
     * [forward description]
     *
     * @param   string  $chatId       [$chatId description]
     * @param   string  $fromchatId  [$fromchatId description]
     * @param   string  $messageId    [$messageId description]
     *
     * @return  array
     */
    public function forward(string $chatId, string $fromchatId, string $messageId)
    {
        $query = [
            "chat_id" => $chatId,
            "fromchatId" => $fromchatId,
            "messageId" => $messageId,
        ];

        return self::execute("forwardMessage", [
            "query" => $query,
        ]);
    }

    public function deletemessage(string $messageId, string $chatId)
    {
        $query = [
            "chat_id" => $chatId,
            "messageId" => $messageId,
        ];

        return self::execute("deleteMessage", [
            "query" => $query,
        ]);
    }
}
