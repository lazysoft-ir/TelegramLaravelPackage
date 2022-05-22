<?php

namespace Lazysoft\Wufor;

use Illuminate\Support\Facades\Facade;
use Lazysoft\Wufor\Services\Wofur\TelegramService;

class Wofur extends Facade
{

    public static function app(string $name = "telegram", string $token = '')
    {
        return new TelegramService($token);
        // switch ($name) {
        //     case 'telegram':
        // return TelegramService::getInstance($token);
        //         break;
        //     default:
        //         break;
        // }
    }

    protected static function getFacadeAccessor()
    {
        return TelegramService::class;
    }
}
