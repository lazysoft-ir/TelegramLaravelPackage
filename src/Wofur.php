<?php

namespace Lazysoft\Wufor;

use Illuminate\Support\Facades\Facade;
use Lazysoft\Wufor\Services\Wofur\TelegramService;

class Wofur extends Facade
{

    protected static function getFacadeAccessor()
    {
        return "Wofur";
    }
}
